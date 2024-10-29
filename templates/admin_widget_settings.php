<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  ?> 
<table class="archivesposttab-admin archivesposttab-admin-widget" cellspacing="0" cellpadding="0">
	<tr> <td class="tp-label">
			<p><label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php echo __( 'Widget title', 'archivesposttab' ); ?>:</label></p>
	 	</td> 
		<td>
			<p>
				<input id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo $instance['widget_title']; ?>"   />
			</p>
		</td>
	</tr>	

	<tr>
		<td class="tp-label">
			<p><label for="<?php echo $this->get_field_id( 'date_format' ); ?>"><?php echo __( 'Date Format', 'archivesposttab' ); ?>:</label></p>
		</td>  
		<td> 
			<p>		
				<?php 
					$_d_format = $instance['date_format']; 
					$_df_res = array(
						'month_year' => __( 'Month and Year', 'archivesposttab' ),
						'year' => __( 'Only Year', 'archivesposttab' )
					); 
				?>
				<select  name="<?php echo $this->get_field_name( 'date_format' ); ?>" class="date_format" id = "<?php echo $this->get_field_id( 'date_format' ); ?>">
					<?php
						foreach( $_df_res as $__ky_year => $_df_item ) {
							if( $_d_format == $__ky_year ) {
								?><option selected="true" value="<?php echo $__ky_year; ?>"><?php echo $_df_item; ?></option><?php
							} else {
								?><option value="<?php echo $__ky_year; ?>"><?php echo $_df_item; ?></option><?php
							}
						}	
					?>		
				</select> 
			</p>
		</td>
	</tr>	 
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'number_of_post_display' ); ?>"><?php echo __( 'Number of post display', 'archivesposttab' ); ?>:</label> </p> 
		</td>  
		<td>
			<p> 
				<input id="<?php echo $this->get_field_id( 'number_of_post_display' ); ?>" name="<?php echo $this->get_field_name( 'number_of_post_display' ); ?>" type="text" value="<?php echo $instance['number_of_post_display']; ?>"   />
			</p>
		</td>
	</tr> 
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'title_text_color' ); ?>"><?php echo __( 'Post title text color', 'archivesposttab' ); ?>:</label> </p> 
		</td>  
		<td>  
			<p> 
				<input class="color-field" id="<?php echo $this->get_field_id( 'title_text_color' ); ?>" name="<?php echo $this->get_field_name( 'title_text_color' ); ?>" type="text" value="<?php echo $instance['title_text_color']; ?>"   />
			</p>
		</td>
	</tr> 
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'panel_text_color' ); ?>"><?php echo __( 'Tab text color', 'archivesposttab' ); ?>:</label> </p> 
		</td> 
		<td>
			<p> 
				<input class="color-field" id="<?php echo $this->get_field_id( 'panel_text_color' ); ?>" name="<?php echo $this->get_field_name( 'panel_text_color' ); ?>" type="text" value="<?php echo $instance['panel_text_color']; ?>"   />
			</p>
		</td>
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'panel_background_color' ); ?>"><?php echo __( 'Tab background color', 'archivesposttab' ); ?>:</label> </p>
		</td> 
		<td> 
			<p> 
				<input class="color-field" id="<?php echo $this->get_field_id( 'panel_background_color' ); ?>" name="<?php echo $this->get_field_name( 'panel_background_color' ); ?>" type="text" value="<?php echo $instance['panel_background_color']; ?>"   />
			</p>
		</td>
	</tr>

	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'header_text_color' ); ?>"><?php echo __( 'Widget title text color', 'archivesposttab' ); ?>:</label> </p>
		</td> 
		<td> 
			<p> 
				<input class="color-field" id="<?php echo $this->get_field_id( 'header_text_color' ); ?>" name="<?php echo $this->get_field_name( 'header_text_color' ); ?>" type="text" value="<?php echo $instance['header_text_color']; ?>"   />
			</p>
		</td>
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'header_background_color' ); ?>"><?php echo __( 'Widget title background color', 'archivesposttab' ); ?>:</label> </p>
		</td> 
		<td>
			<p> 
				<input class="color-field" id="<?php echo $this->get_field_id( 'header_background_color' ); ?>" name="<?php echo $this->get_field_name( 'header_background_color' ); ?>" type="text" value="<?php echo $instance['header_background_color']; ?>"   />
			</p> 
		</td> 	
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'tp_widget_width' ); ?>"><?php echo __( 'Widget Width', 'archivesposttab' ); ?>:</label> </p>
		</td> 
		<td>   
			<p> 
				<input id="<?php echo $this->get_field_id( 'tp_widget_width' ); ?>" name="<?php echo $this->get_field_name( 'tp_widget_width' ); ?>" type="text" value="<?php echo $instance['tp_widget_width']; ?>"   />
			</p>
		</td>
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>"><?php echo __( 'Display title over image?', 'archivesposttab' ); ?></label> </p>
		</td> 
		<td>    
			<p> 
				<input type="radio" <?php echo ( $instance['display_title_over_image'] == "yes" ) ? ' checked="checked"' : ''; ?> value="yes" name="<?php echo $this->get_field_name( 'display_title_over_image' ); ?>" id="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>_1" /> 
				<label for="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>_1"><?php echo __( 'Yes', 'archivesposttab' ); ?></label>
				
				<input type="radio" <?php echo ( $instance['display_title_over_image'] == "no" ) ? ' checked="checked"' : ''; ?> value="no" name="<?php echo $this->get_field_name( 'display_title_over_image' ); ?>" id="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>_2" />
				<label for="<?php echo $this->get_field_id( 'display_title_over_image' ); ?>_2"><?php echo __( 'No', 'archivesposttab' ); ?></label>
			</p>
		</td>
	</tr>
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>"><?php echo __( 'Hide widget title?', 'archivesposttab' ); ?></label> </p>
		</td> 
		<td> 
			<p> 
				<input type="radio" <?php echo ( $instance['hide_widget_title'] == "yes" ) ? ' checked="checked"' : ''; ?> value="yes" name="<?php echo $this->get_field_name( 'hide_widget_title' ); ?>" id="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>_1" />
				<label for="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>_1"><?php echo __( 'Yes', 'archivesposttab' ); ?></label>	
				
				<input type="radio" <?php echo ( $instance['hide_widget_title'] == "no" ) ? ' checked="checked"' : ''; ?> value="no" name="<?php echo $this->get_field_name( 'hide_widget_title' ); ?>" id="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>_2" />
				<label for="<?php echo $this->get_field_id( 'hide_widget_title' ); ?>_2"><?php echo __( 'No', 'archivesposttab' ); ?></label>
			</p>
		</td>
	</tr> 
	
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'hide_post_title' ); ?>"><?php echo __( 'Hide post title?', 'archivesposttab' ); ?></label> </p>
		</td>
		<td>  
			<p> 
				<input type="radio" <?php echo ( $instance['hide_post_title'] == "yes" ) ? ' checked="checked"' : ''; ?> value="yes" name="<?php echo $this->get_field_name( 'hide_post_title' ); ?>" id="<?php echo $this->get_field_id( 'hide_post_title' ); ?>_1" /> 
				<label for="<?php echo $this->get_field_id( 'hide_post_title' ); ?>_1"><?php echo __( 'Yes', 'archivesposttab' ); ?></label>
				
				<input type="radio" <?php echo ( $instance['hide_post_title'] == "no" ) ? ' checked="checked"' : ''; ?> value="no" name="<?php echo $this->get_field_name( 'hide_post_title' ); ?>" id="<?php echo $this->get_field_id( 'hide_post_title' ); ?>_2" />
				<label for="<?php echo $this->get_field_id( 'hide_post_title' ); ?>_2"><?php echo __( 'No', 'archivesposttab' ); ?></label>
			</p>
		</td>
	</tr>  
	<tr>
		<td class="tp-label">
			<p> <label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php echo __( 'Template', 'archivesposttab' ); ?>:</label> </p>
		</td>
		<td>
			<p> 
				<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" >
					<option <?php echo ( ( $instance['template'] == 'pane_style_1' || $instance['template'] == '' ) ? "selected" : "" ); ?> value="pane_style_1"><?php echo __( 'Tab style 1', 'archivesposttab' ); ?></option>
					<option <?php echo ( ( $instance['template'] == 'pane_style_2' ) ? "selected" : "" ); ?> value="pane_style_2"><?php echo __( 'Tab style 2', 'archivesposttab' ); ?></option>
					<option <?php echo ( ( $instance['template'] == 'pane_style_3' ) ? "selected" : "" ); ?> value="pane_style_3"><?php echo __( 'Tab style 3', 'archivesposttab' ); ?></option> 
				</select>
			</p> 
		</td>
	</tr>
</table>
<input type="hidden" name="<?php echo $this->get_field_name( 'vcode' ); ?>" id="<?php echo $this->get_field_id( 'vcode' ); ?>" value="<?php echo $instance["vcode"]; ?>" /><br />