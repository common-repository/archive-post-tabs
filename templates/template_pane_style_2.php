<?php if ( ! defined( 'ABSPATH' ) ) exit;   $vcode = $this->_config["vcode"];  ?>
 <script type='text/javascript' language='javascript'> 
	var request_obj_<?php echo $vcode; ?> = {
			hide_post_title:'<?php echo $this->_config["hide_post_title"]; ?>', 
			post_title_color:'<?php echo $this->_config["title_text_color"]; ?>',
			panel_text_color:'<?php echo $this->_config["panel_text_color"]; ?>', 
			panel_background_color:'<?php echo $this->_config["panel_background_color"]; ?>',
			header_text_color:'<?php echo $this->_config["header_text_color"]; ?>',   
			header_background_color:'<?php echo $this->_config["header_background_color"]; ?>',
			display_title_over_image:'<?php echo $this->_config["display_title_over_image"]; ?>', 
			number_of_post_display:'<?php echo $this->_config["number_of_post_display"]; ?>', 
			vcode:'<?php echo $vcode; ?>'
		} 
 </script> 
<?php
	$date_format = $this->_config["date_format"]; 
	$_panel_list = $this->getTabArray($date_format);  
?>
 <div id="archivesposttab" style="width:<?php echo $this->_config["tp_widget_width"]; ?>"  class="pane_style_2 <?php echo ( ( trim( $this->_config["display_title_over_image"] ) == "yes" ) ? "disp_title_over_img" : "" ); ?>">
	<?php if($this->_config["hide_widget_title"]=="no"){ ?>
		<div class="ik-panel-tab-title-head" style="background-color:<?php echo $this->_config["header_background_color"]; ?>;color:<?php echo $this->_config["header_text_color"]; ?>"  >
			<?php echo $this->_config["widget_title"]; ?>   
		</div>
	<?php } ?> 
	<span class='wp-load-icon'>
		<img width="18px" height="18px" src="<?php echo AVPTAB_MEDIA.'images/loader.gif'; ?>" />
	</span>
	<div class="wea_content lt-tab">
		<?php 
			  
			$_category_res_n = array(); 
			
			$_date_range_array = array(); 
				
			if( count( $_panel_list ) > 0 ) {
					  
				foreach( $_panel_list as $__pane_key => $__pane_text ) {    
					$_date_range_array[$__pane_key] = array( "value" => $__pane_text);
				} 
				
				$ik = 0; 
				$_date_format = "";
				foreach( $_date_range_array as $__pane_key => $__pane_text ) {
				
				$__pn_item_class = "";
				if( $ik == 0 ) { 
					$__pn_item_class = " pn-active";
					$_date_format = $__pane_key;
				} 
				$ik++;
				  ?>
					<div class="item-panel-list">
						<div class="panel-item <?php echo $__pn_item_class; ?>"  onmouseout="avptab_panel_ms_out( this )" onmouseover="avptab_panel_ms_hover( this )" id="<?php echo $vcode.'-'.($__pane_key); ?>" onclick="AVPTAB_fillPosts( this.id, '<?php echo ($__pane_key);?>', request_obj_<?php echo $vcode; ?>, 1 )"  style="color:<?php echo $this->_config["panel_text_color"]; ?>;background-color:<?php echo $this->_config["panel_background_color"]; ?>;" >
							<div class="panel-item-text"  onmouseout="avptab_panel_ms_out( this.parentNode )" onmouseover="avptab_panel_ms_hover( this.parentNode )">
								<?php echo $__pane_text["value"]; ?>  
							</div>
							<div class="ld-panel-item-text"></div>
							<div class="clr"></div>
						</div>						
						
					 </div> 
					 
				   <?php
				}
				?>
				<div class="clr"></div>
				<div class="item-posts">
							
							<?php 
								 	// Default category opened category start
									if( trim($_date_format) != ""  ) { 
									 
											 $post_search_text =  "" ; 
											 $_limit_start = 0;
											 $_limit_end =  $this->_config["number_of_post_display"]; 
											  $is_default_category_with_hidden = 1; 
											 
											?><script language='javascript'>
												var request_obj_<?php echo esc_js( $this->_config["vcode"] ); ?> = { 
													hide_post_title:'<?php echo esc_js( $this->_config["hide_post_title"] ); ?>',  
													post_title_color:'<?php echo esc_js( $this->_config["title_text_color"] ); ?>',panel_text_color:'<?php echo esc_js( $this->_config["panel_text_color"] ); ?>',
													panel_background_color:'<?php echo esc_js( $this->_config["panel_background_color"] ); ?>', 
													header_text_color:'<?php echo esc_js( $this->_config["header_text_color"] ); ?>', 
													header_background_color:'<?php echo esc_js( $this->_config["header_background_color"] ); ?>',
													display_title_over_image:'<?php echo esc_js( $this->_config["display_title_over_image"] ); ?>', 
													number_of_post_display:'<?php echo esc_js( $this->_config["number_of_post_display"] ); ?>',
													vcode:'<?php echo esc_js( $this->_config["vcode"] ); ?>'
												} 
											</script><?php   
											$_total_posts = $this->getTotalPosts( $_date_format, 1, $is_default_category_with_hidden );
											if( $_total_posts <= 0 ) {
												?><div class="ik-post-no-items"><?php echo __( 'No posts found.', 'archivesposttab' ); ?></div><?php 
											} 
											 	 
											$post_list = $this->getSqlResult( $_date_format, 0, $_limit_end);
											 
											foreach ( $post_list as $_post ) { 
												$image  = $this->getPostImage( $_post->post_image ); 
												?>
												<div class='ik-post-item pid-<?php echo esc_attr( $_post->post_id ); ?>'> 
													<div class='ik-post-image' onmouseout="avptab_pr_item_image_mouseout(this)" onmouseover="avptab_pr_item_image_mousehover(this)">
															<a href="<?php echo get_permalink( $_post->post_id ); ?>">
															<div class="ov-layer" > 
																 <?php if( sanitize_text_field( $this->_config["display_title_over_image"] ) == 'yes' ) { ?> 
																		<div class='ik-overlay-post-content'>
																			<?php if( sanitize_text_field( $this->_config["hide_post_title"] ) == 'no' ) { ?> 
																				<div class='ik-post-name' style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" >
																					 <?php echo esc_html( $_post->post_name ); ?>
																				</div>
																			<?php } ?>   
																			<div class="clr"></div>
																		</div>
																		<div class="clr"></div>
																<?php } ?>
															</div>
															<div class="clr"></div>
														</a>
														<div class="clr"></div>
														<a href="<?php echo get_permalink( $_post->post_id ); ?>"> 
															<?php echo $image; ?>
														</a>   
													</div>  
													<?php if( sanitize_text_field( $this->_config["display_title_over_image"] ) == 'no' ) { ?> 
														<div class='ik-post-content'>
															<?php if( sanitize_text_field( $this->_config["hide_post_title"] ) =='no'){ ?> 
																<div class='ik-post-name'>
																	<a href="<?php echo get_permalink( $_post->post_id ); ?>" style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" >
																		<?php echo esc_html( $_post->post_name ); ?>
																	</a>	
																</div>
															<?php } ?>	   
														</div>	
													<?php } ?> 
												</div> 
												<?php 
											}
											
											if( $_total_posts > sanitize_text_field( $this->_config["number_of_post_display"] ) ) { ?>
													<div class="clr"></div>
													<div class='ik-post-load-more'  align="center" onclick='AVPTAB_loadMorePosts( "<?php echo esc_js( $_date_format ); ?>", "<?php echo esc_js( $_limit_start+$_limit_end ); ?>", "<?php echo esc_js( $this->_config["vcode"]."-".$_date_format ); ?>", "<?php echo esc_js( $_total_posts ); ?>", request_obj_<?php echo esc_js( $this->_config["vcode"] ); ?> )'>
														<?php echo __('Load More', 'archivesposttab' ); ?>
													</div>
												<?php  
											} else {
												?><div class="clr"></div><?php
											}
									
									}  
									// End Default category opened.
							?>  
						
						</div>
						<div class="clr"></div>
					
				<?php
				
			}			
		?>
		<div class="clr"></div>
	</div>
</div>