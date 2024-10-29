<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	 $params = $_REQUEST;  
	 $_date_format = ( isset( $params["date_format"] ) ? ( $params["date_format"] ) : 0 );  
	 $_limit_start =( isset( $params["limit_start"] ) ? intval( $params["limit_start"] ) : 0 );
	 $_limit_end = intval( $params["number_of_post_display"] );
	 $flg_pr =( isset( $params["flg_pr"] ) ? intval( $params["flg_pr"] ) : 0 );  
	 $is_default_category_with_hidden = 1; 
	 
	?><script language='javascript'>
		var request_obj_<?php echo esc_js( $params["vcode"] ); ?> = {
			hide_post_title:'<?php echo esc_js( $params["hide_post_title"] ); ?>',  
			post_title_color:'<?php echo esc_js( $params["post_title_color"] ); ?>', 
			panel_text_color:'<?php echo esc_js( $params["panel_text_color"] ); ?>',
			panel_background_color:'<?php echo esc_js( $params["panel_background_color"] ); ?>', 
			header_text_color:'<?php echo esc_js( $params["header_text_color"] ); ?>', 
			header_background_color:'<?php echo esc_js( $params["header_background_color"] ); ?>',
			display_title_over_image:'<?php echo esc_js( $params["display_title_over_image"] ); ?>', 
			number_of_post_display:'<?php echo esc_js( $params["number_of_post_display"] ); ?>',
			vcode:'<?php echo esc_js( $params["vcode"] ); ?>'
		}
	</script><?php   
	$_total_posts = $this->getTotalPosts( $_date_format, 1, $is_default_category_with_hidden );
	if( $_total_posts <= 0 ) {
		?><div class="ik-post-no-items"><?php echo __( 'No posts found.', 'archivesposttab' ); ?></div><?php
		die();
	} 
	$post_list = $this->getPostList( $_date_format, $_limit_end );	 
	 
	foreach ( $post_list as $_post ) { 
		$image  = $this->getPostImage( $_post->post_image ); 
		?>
		<div class='ik-post-item pid-<?php echo esc_attr( $_post->post_id ); ?>'> 
			<div class='ik-post-image' onmouseout="avptab_pr_item_image_mouseout(this)" onmouseover="avptab_pr_item_image_mousehover(this)">
					<a href="<?php echo get_permalink( $_post->post_id ); ?>">
					<div class="ov-layer" > 
						 <?php if( sanitize_text_field( $params["display_title_over_image"] ) == 'yes' ) { ?> 
								<div class='ik-overlay-post-content'>
									<?php if( sanitize_text_field( $params["hide_post_title"] ) == 'no' ) { ?> 
										<div class='ik-post-name' style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>" >
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
			<?php if( sanitize_text_field( $params["display_title_over_image"] ) == 'no' ) { ?> 
				<div class='ik-post-content'>
					<?php if( sanitize_text_field( $params["hide_post_title"] ) =='no'){ ?> 
						<div class='ik-post-name'>
							<a href="<?php echo get_permalink( $_post->post_id ); ?>" style="color:<?php echo esc_attr( $params["post_title_color"] ); ?>" >
								<?php echo esc_html( $_post->post_name ); ?>
							</a>	
						</div>
					<?php } ?>	 	 
				</div>	
			<?php } ?> 
		</div> 
		<?php 
	}
	
	if( $_total_posts > sanitize_text_field( $params["number_of_post_display"] ) ) { ?>
			<div class="clr"></div>
			<div class='ik-post-load-more'  align="center" onclick='AVPTAB_loadMorePosts( "<?php echo esc_js( $_date_format ); ?>", "<?php echo esc_js( $_limit_start+$_limit_end ); ?>", "<?php echo esc_js( $params["vcode"]."-".$_date_format ); ?>", "<?php echo esc_js( $_total_posts ); ?>", request_obj_<?php echo esc_js( $params["vcode"] ); ?> )'>
				<?php echo __('Load More', 'archivesposttab' ); ?>
			</div>
		<?php  
	} else {
		?><div class="clr"></div><?php
	}