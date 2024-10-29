<?php  
/**
 * Register shortcode and render post data as per shortcode configuration. 
 */ 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly   
if ( ! class_exists( 'archivesPostTabWidget' ) ) { 
	class archivesPostTabWidget extends archivesPostTabLib {
	 
	   /**
		* PHP5 constructor method.
		*
		* Run the following methods when this class is loaded
		*
		* @access  public
		* @since   1.0
		*
		* @return  void
		*/ 
		public function __construct() {
		
			add_action( 'init', array( &$this, 'init' ) ); 
			parent::__construct();
			
		}  
		
	   /**
		* Load required methods on wordpress init action 
		*
		* @access  public
		* @since   1.0
		*
		* @return  void
		*/ 
		public function init() {
		
			add_action( 'wp_ajax_getTotalPosts',array( &$this, 'getTotalPosts' ) );
			add_action( 'wp_ajax_getPosts',array( &$this, 'getPosts' ) ); 
			add_action( 'wp_ajax_getMorePosts',array( &$this, 'getMorePosts' ) );
			
			add_action( 'wp_ajax_nopriv_getTotalPosts', array( &$this, 'getTotalPosts' ) );
			add_action( 'wp_ajax_nopriv_getPosts', array( &$this, 'getPosts' ) ); 
			add_action( 'wp_ajax_nopriv_getMorePosts', array( &$this, 'getMorePosts' ) ); 
			
			add_shortcode( 'archivesposttab', array( &$this, 'archivesPostTab' ) ); 
			
		} 
		
	  	

		 
	   /**
		* Render the shortcode
		*
		* @access  public
		* @since   1.0
		*
		* @param   array   $params  Shortcode configuration options from admin settings
		* @return  string  Render tab pane HTML
		*/
		public function archivesPostTab( $params = array() ) { 	
		
			$archivesposttab_id = $params["id"]; 
			$avptab_shortcode = get_post_meta( $archivesposttab_id ); 
			
			foreach ( $avptab_shortcode as $sc_key => $sc_val ) {			
				$avptab_shortcode[$sc_key] = $sc_val[0];			
			} 
			
			if(!isset($avptab_shortcode["date_format"]))	
				$avptab_shortcode["date_format"] = 0; 
			if(!isset($avptab_shortcode["number_of_post_display"]))	
				$avptab_shortcode["number_of_post_display"] = 0; 
				
			$this->_config = shortcode_atts( $this->_config, $avptab_shortcode ); 
			
		   /**
			* Load template according to admin settings
			*/
			ob_start();
			
			require( $this->getArchivesPostTabTemplate( "template_" . $this->_config["template"] . ".php" ) ); 
			
			return ob_get_clean();
		
		}   
		
	   /**
		* Load more post via ajax request
		*
		* @access  public
		* @since   1.0
		* 
		* @return  void Displays searched posts HTML to load more pagination
		*/	
		public function getMorePosts() {
		
			global $wpdb, $wp_query; 
			
		   /**
			* Check security token from ajax request
			*/
			check_ajax_referer($this->_config["security_key"], 'security' );
			
			$_date_format = ( isset( $_REQUEST["date_format"] )?esc_attr( $_REQUEST["date_format"] ):0 ); 
			$_total = ( isset( $_REQUEST["total"] )?esc_attr( $_REQUEST["total"] ):0 ); 
			$_limit_start = ( isset( $_REQUEST["limit_start"])?esc_attr( $_REQUEST["limit_start"] ):0 );
			$_limit_end = ( isset( $_REQUEST["number_of_post_display"])?esc_attr( $_REQUEST["number_of_post_display"] ):avptab_number_of_post_display ); 
			
		   /**
			* Fetch posts as per search filter
			*/	
			$_result_items = $this->getSqlResult( $_date_format, $_limit_start, $_limit_end );
		  
			require( $this->getArchivesPostTabTemplate( 'ajax_load_more_posts.php' ) );	
			
			wp_die();
		}    
		
	   /**
		* Load more posts via ajax request
		*
		* @access  public
		* @since   1.0
		* 
		* @return  object Displays searched posts HTML
		*/
		public function getPosts() {
		
		   global $wpdb; 
			
		   /**
			* Check security token from ajax request
			*/	
		   check_ajax_referer( $this->_config["security_key"], 'security' );	   
		   
		   require( $this->getArchivesPostTabTemplate( 'ajax_load_posts.php' ) );	
		   
  		   wp_die();
		
		}
		 
	   /**
		* Get post list with specified limit and filtered by date, category and search text
		*
		* @access  public
		* @since   1.0 
		* 
		* @param   float   $date_format		  Set the date format
		* @param   int     $_limit_end		  Limit to fetch post ending to given position
		* @return  object  Set of searched post data
		*/
		public function getPostList( $date_format, $_limit_end ) {
			
		   /**
			* Check security token from ajax request
			*/	
			check_ajax_referer( $this->_config["security_key"], 'security' );		
			
		   /**
			* Fetch data from database
			*/
			return $this->getSqlResult( $date_format, 0, $_limit_end );
			 
		}
		 
	  
		
	}
	
}
new archivesPostTabWidget();