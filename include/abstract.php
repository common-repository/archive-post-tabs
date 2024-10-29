<?php 
/** 
 * Abstract class  has been designed to use common functions.
 * This is file is responsible to add custom logic needed by all templates and classes.  
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly   
if ( ! class_exists( 'archivesPostTabLib' ) ) { 
	abstract class archivesPostTabLib extends WP_Widget {
		
	   /**
		* Default values can be stored
		*
		* @access    public
		* @since     1.0
		*
		* @var       array
		*/
		public $_config = array();

		/**
		 * PHP5 constructor method.
		 *
		 * Run the following methods when this class is loaded.
		 * 
		 * @access    public
		 * @since     1.0
		 *
		 * @return    void
		 */ 
		public function __construct() {  
		
			/**
			 * Default values configuration 
			 */
			$this->_config = array(
				'widget_title'=>avptab_widget_title,
				'date_format'=>avptab_date_format, 
				'number_of_post_display'=>avptab_number_of_post_display, 
				'title_text_color'=>avptab_title_text_color,
				'panel_text_color'=>avptab_panel_text_color,
				'panel_background_color'=>avptab_panel_background_color,
				'header_text_color'=>avptab_header_text_color,
				'header_background_color'=>avptab_header_background_color,
				'display_title_over_image'=>avptab_display_title_over_image, 
				'hide_widget_title'=>avptab_hide_widget_title, 
				'hide_post_title'=>avptab_hide_post_title, 
				'template'=>avptab_template, 
				'vcode'=>$this->getUCode(),  
				'security_key'=>avptab_security_key,
				'tp_widget_width'=>avptab_widget_width, 
				'st' => get_option('archivesposttab_license_status')
			); 
			
			/**
			 * Load text domain
			 */
			add_action( 'plugins_loaded', array( $this, 'archivesposttab_text_domain' ) );
			
			parent::WP_Widget( false, $name = __( 'Archive Posts Tab', 'archivesposttab' ) ); 	
			
			/**
			 * Widget initialization
			 */
			add_action( 'widgets_init', array( &$this, 'initArchivesPostTab' ) ); 
			
			/**
			 * Load the CSS/JS scripts
			 */
			add_action( 'init',  array( $this, 'archivesposttab_scripts' ) );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'avptab_admin_enqueue' ) ); 
			
		}
		
		
 	   /**
		* Register and load JS/CSS for admin widget configuration 
		*
		* @access  private
		* @since   1.0
		*
		* @return  bool|void It returns false if not valid page or display HTML for JS/CSS
		*/  
		public function avptab_admin_enqueue() {

			if ( ! $this->validate_page() )
				return FALSE;
			
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'admin-archivesposttab.css', AVPTAB_MEDIA."css/admin-archivesposttab.css" );
			wp_enqueue_script( 'admin-archivesposttab.js', AVPTAB_MEDIA."js/admin-archivesposttab.js" ); 
			
		}		 
		
	   /**
		* Validate widget or shortcode post type page
		*
		* @access  private
		* @since   1.0
		*
		* @return  bool It returns true if page is post.php or widget otherwise returns false
		*/ 
		private function validate_page() {

			if ( ( isset( $_GET['post_type'] )  && $_GET['post_type'] == 'avptab_archives' ) || strpos($_SERVER["REQUEST_URI"],"widgets.php") > 0  || strpos($_SERVER["REQUEST_URI"],"post.php" ) > 0 || strpos($_SERVER["REQUEST_URI"], "archivesposttab_settings" ) > 0  )
				return TRUE;
		
		} 	
		
		/**
		 * Load the CSS/JS scripts
		 *
		 * @return  void
		 *
		 * @access  public
		 * @since   1.0
		 */
		function archivesposttab_scripts() {

			$dependencies = array( 'jquery' );
			 
			/**
			 * Include Archive Posts Tab JS/CSS 
			 */
			wp_enqueue_style( 'archivesposttab', AVPTAB_MEDIA."css/archivesposttab.css" );
			 
			wp_enqueue_script( 'archivesposttab', AVPTAB_MEDIA."js/archivesposttab.js", $dependencies  );
			
			/**
			 * Define global javascript variable
			 */
			wp_localize_script( 'archivesposttab', 'archivesposttab', array(
				'avptab_ajax_url' => admin_url( 'admin-ajax.php' ),
				'avptab_security'  =>  wp_create_nonce(avptab_security_key),
				'avptab_all'  => __( 'All', 'archivesposttab' ),
				'avptab_plugin_url' => plugins_url( '/', __FILE__ ),
				'avptab_media' => AVPTAB_MEDIA
			));
		} 
		
		/**
		 * Loads ajax date list as per post type selection
		 *
		 * @access  private
		 * @since   1.0
		 *
		 * @return  void
		 */
		public function getListDateArray() { 

			global $wpdb;
			
			/**
			* Check security token from ajax request
			*/
			check_ajax_referer( $this->_config["security_key"], 'security' );
			
			$__category_type = "";
			$_flh = 0;
			
			if(isset( $_REQUEST['date_format'] ) && trim( $_REQUEST['date_format'] ) != "" && isset( $_REQUEST['pst_type'] ) && trim( $_REQUEST['pst_type'] ) != "" ) {
			
				$__pst_type = sanitize_text_field( $_REQUEST['pst_type'] );
				$date_format = sanitize_text_field( $_REQUEST['date_format'] );
				 
				$_panel_fetch_format_display_text = "%M - %Y";
				$_panel_fetch_format_comapre_text = "%m%Y";
				if($date_format == "year") {
				
					$_panel_fetch_format_display_text = "%Y";
					$_panel_fetch_format_comapre_text = "%Y";
				
				} 
				 
				$_result_items = $wpdb->get_results( " SELECT DATE_FORMAT(post_date,'".$_panel_fetch_format_display_text."') as d1, DATE_FORMAT(post_date,'".$_panel_fetch_format_comapre_text."') as d2 FROM `{$wpdb->prefix}posts` where post_status = 'publish' and post_type = '".$__pst_type."' group by DATE_FORMAT(post_date,'".$_panel_fetch_format_display_text."') order by DATE_FORMAT(post_date,'".$_panel_fetch_format_comapre_text."') desc" ); 
				
				if( count( $_result_items ) > 0 ) { 
					?> <option selected="true" value="0"><?php echo __( 'None', 'archivesposttab' ); ?></option> <?php 	
					foreach( $_result_items as $_value ) {  
						?> <option value="<?php echo $_value->d2; ?>"><?php echo $_value->d1; ?></option> <?php  
					} 
				}
				 
			}
			
			die();
			 
		}	 
		
		/**
		 * Loads the text domain
		 *
		 * @access  private
		 * @since   1.0
		 *
		 * @return  void
		 */
		public function archivesposttab_text_domain() {

		  /**
		   * Load text domain
		   */
		   load_plugin_textdomain( 'archivesposttab', false, AVPTAB_Plugin_DIR . '/languages' );
			
		}
		 
		/**
		 * Load and register widget settings
		 *
		 * @access  private
		 * @since   1.0
		 *
		 * @return  void
		 */ 
		public function initArchivesPostTab() { 
			
		  /**
		   * Widget registration
		   */
		  // if($this->_config["st"] == "valid")
			  register_widget( 'archivesPostTabWidget_Admin' );
			
		}  
		 
		/**
		 * Create different panel from post dates
		 *
		 * @access  public
		 * @since   1.0 
		 * @return  array  An array of  the date
		 */
		public function getTabArray( $date_format = "" ) { 
			
			global $wpdb; 
			
			$_panel_fetch_format_display_text = "%M - %Y";
			$_panel_fetch_format_comapre_text = "%m%Y";
			if($date_format == "year") {
				$_panel_fetch_format_display_text = "%Y";
				$_panel_fetch_format_comapre_text = "%Y";
			}  

			$_arr_list = array();  
			$_check_type = " and wp.post_type = 'post' ";
			$_result_items = $wpdb->get_results( " SELECT DATE_FORMAT(wp.post_date,'".$_panel_fetch_format_display_text."') as d1, DATE_FORMAT(wp.post_date,'".$_panel_fetch_format_comapre_text."') as d2 FROM `{$wpdb->prefix}posts` as wp ".$_category_filter_query." where wp.post_status = 'publish' ".$_check_type." group by DATE_FORMAT(wp.post_date,'".$_panel_fetch_format_display_text."') order by DATE_FORMAT(wp.post_date,'".$_panel_fetch_format_comapre_text."') desc" ); 
			
			foreach( $_result_items as $_value ) {
			
				$_arr_list["a".$_value->d2] = $_value->d1; 
			
			} 
			
			return $_arr_list;	
		
		}    
		
		/**
		 * Short terms hierarchy order
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @param   array $terms terms array to make hierarchy
		 * @return  object It contains all the hierarchy terms for shop
		 */
		function sort_terms_hierarchy(Array &$terms) {
			$result = array();
			$parent = 0;
			$depth = 0;
			$i = 0;
			do {
				$temp = array();
				foreach($terms as $j => $term) {
					if ($term->parent == $parent) {
						$term->depth = $depth;  
						array_push($temp, $term);
						unset($terms[$j]);
					} 
					$term->category = $term->name;
					$term->id = $term->term_taxonomy_id;
				}
				array_splice($result, $i, 0, $temp);
				$parent = $result[$i]->term_id;
				$depth = $result[$i]->depth + 1;
			} while ($i++ < count($result));
			$terms = $result;
		} 
		
		/**
		 * Get the number of dash string
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @param   number $depth numberic value that indicates the depth of term
		 * @return  string It returns dash string.
		 */
		function get_hierarchy_dash($depth) {
			$_dash = "";
			for( $i = 0; $i < $depth; $i++ ) {
				$_dash .= "--"; 
			} 
			return $_dash." ";
		}
		 
		/**
		 * Get post image by given image attachment id
		 *
 		 * @access  public
		 * @since   1.0
		 *
		 * @param   int   $img  Image attachment ID
		 * @return  string  Returns image html from post attachment
		 */
		 public function getPostImage( $img ) {
		 
			$image_link = wp_get_attachment_url( $img ); 
			if( $image_link ) {
				$image_title = esc_attr( get_the_title( $img ) );  
				return wp_get_attachment_image( $img , array(180,180), 0, $attr = array(
									'title'	=> $image_title,
									'alt'	=> $image_title
								) );
			}else{
				return "<img src='".AVPTAB_MEDIA."images/no-img.png' />";
			}
		 }
		  
		/**
		 * Get all the categories types
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @return  object It contains all the types of categories
		 */
		public function archivesposttab_getCategoryTypes() {
		
			global $wpdb;
			 
			return $wpdb->get_results( "select taxonomy from {$wpdb->prefix}term_taxonomy group by taxonomy" );
		
		} 
		
		/**
		* Get the total numbers of posts
		*
		* @access  public
		* @since   1.0
		*
		* @param   float  $_date_format  		Set the date format 
		* @param   int    $c_flg  				Whether to fetch whether posts by category id or prevent for searching
		* @param   int    $is_default_category_with_hidden  To check settings of default category If it's value is '1'. Default value is '0'
		* @return  int	  Total number of posts  	
		*/  
		public function getTotalPosts( $_date_format=0, $c_flg, $is_default_category_with_hidden) { 
		
			global $wpdb;   
			
		   /**
			* Check security token from ajax request
			*/
			//check_ajax_referer( $this->_config["security_key"], 'security' );

		   /**
			* Fetch posts as per search filter
			*/	
			$_res_total = $this->getSqlResult( $_date_format, 0, 0, $c_flg, $is_default_category_with_hidden, 1, $_default_categorie);
			
			return $_res_total[0]->total_val;
			 
		}
		
		 /**
		* Fetch post data from database by formated date, category, search text and item limit
		*
		* @access  public
		* @since   1.0 
		*
		* @param   float  $date_format  		Set the date format  
		* @param   int    $_limit_start  		Limit to fetch post starting from given position
		* @param   int    $_limit_end  			Limit to fetch post ending to given position
		* @param   int    $category_flg  		Whether to fetch whether posts by category id or prevent for searching
		* @param   int    $is_default_category_with_hidden  To check settings of default category If it's value is '1'. Default value is '0'
		* @param   int    $is_count  			Whether to fetch only number of posts from database as count of items 
		* @return  object Set of searched post data
		*/
		 function getSqlResult( $date_format, $_limit_start, $_limit_end, $category_flg = 0, $is_default_category_with_hidden = 0, $is_count = 0) {
			
			global $wpdb;  
			$_post_text_filter_query = "";
			$_fetch_fields = "";
			$_limit = ""; 
			 
		   /**
			* Prepare safe mysql database query
			*/
			 
			if( $is_count == 1 ) { 
				$_fetch_fields = " count(*) as total_val ";
			} else {  
				$_fetch_fields = " wp.post_type, wp.post_date, pm_image.meta_value as post_image, wp.ID as post_id, wp.post_title as post_name ";
				$_limit = $wpdb->prepare( " order by wp.post_date desc limit  %d, %d ", $_limit_start, $_limit_end );
			}  
			 
			if( trim( $date_format ) != "all" && trim( $date_format ) != "0"  && trim( $date_format ) != "" ){
				$date_format = explode("a",$date_format);
				$date_format = $date_format[1];
				$_post_text_filter_query .=  " and ( DATE_FORMAT(wp.post_date,'%m%Y') = ".intval($date_format)." OR DATE_FORMAT(wp.post_date,'%Y') = ".intval($date_format)." ) ";   
			}  
			
			 
		   /**
			* Fetch post data from database
			*/
			$_result_items = $wpdb->get_results( "select $_fetch_fields from {$wpdb->prefix}posts as wp  
				 LEFT JOIN {$wpdb->prefix}postmeta as pm_image on pm_image.post_id = wp.ID and pm_image.meta_key = '_thumbnail_id' where wp.post_status = 'publish' and wp.post_type = 'post' $_post_text_filter_query $_limit " ); 
				  
			return $_result_items;
		
		}
		
		 
		/**
		 * Get Unique Block ID
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @return  string 
		 */
		public function getUCode() { 
			
			return 'uid_'.md5( "TABULARPANE321@#RPSDD@SQSITARAM@A$".time() );
		
		} 
		
		/**
		 * Get Archive Posts Tab Template
		 *
		 * @access  public
		 * @since   1.0
		 *
		 * @param   string $file Template file name
		 * @return  string Returns template file path
		 */
		public function getArchivesPostTabTemplate( $file ) {
			
			if( locate_template( $file ) != "" ){
				return locate_template( $file );
			}else{
				return plugin_dir_path( dirname( __FILE__ ) ) . 'templates/' . $file ;
			} 
				
	   }
   }
}