<div class="postbox slidebox">
	<div class="handlediv" title="<?php _e('Show/Hide Slide', 'slider_pro'); ?>"></div>
    <div class="closediv" title="<?php _e('Delete Slide', 'slider_pro'); ?>"></div>
    <div class="duplicatediv" title="<?php _e('Duplicate Slide', 'slider_pro'); ?>"></div>
    <div class="visibilitydiv <?php echo ($is_slide && $slide['visibility'] == 'disabled') ? 'disableddiv' : 'enableddiv'; ?>" 
    	 title="<?php echo ($is_slide && $slide['visibility'] == 'disabled') ? __('Enable the slide', 'slider_pro') : __('Disable the slide', 'slider_pro'); ?>"></div>
    <div class="selectiondiv unmarkeddiv" title="<?php _e('Mark Slide', 'slider_pro'); ?>"></div>
	
	<h3 class="hndle"><?php echo $is_slide ? stripslashes($slide['name']) : __('Slide', 'slider_pro') . $counter; ?></h3>
    
    <input type="hidden" class="id" value="<?php echo $is_slide ? $slide['id'] : -1; ?>"/>
    <input type="hidden" class="name" name="slide[<?php echo $counter; ?>][name]" value="<?php echo $is_slide ? stripslashes($slide['name']) : __('Slide', 'slider_pro') . $counter; ?>"/>
    <input type="hidden" class="counter" value="<?php echo $counter; ?>"/>
    <input type="hidden" class="position" name="slide[<?php echo $counter; ?>][position]" value="<?php echo $counter; ?>"/>
    <input type="hidden" class="panel-state" name="slide[<?php echo $counter; ?>][panel_state]" value="<?php echo $is_slide ? $slide['panel_state'] : 'opened'; ?>"/>
	<input type="hidden" class="selected-tab" name="slide[<?php echo $counter; ?>][selected_tab]" value="<?php echo $is_slide ? $slide['selected_tab'] : 0; ?>"/>
    <input type="hidden" class="visibility" name="slide[<?php echo $counter; ?>][visibility]" value="<?php echo $is_slide ? $slide['visibility'] : 'enabled'; ?>"/>
    
	<div class="inside">
        <div class="slide-tabs">
        
        	<ul>
            	<li><a href="#image-<?php echo $counter;?>"><?php _e('Image', 'slider_pro'); ?></a></li>
                <li><a href="#thumbnail-<?php echo $counter;?>"><?php _e('Thumbnail', 'slider_pro'); ?></a></li>
        		<li><a href="#caption-<?php echo $counter;?>"><?php _e('Caption', 'slider_pro'); ?></a></li>
                <li><a href="#html-<?php echo $counter;?>"><?php _e('Inline HTML', 'slider_pro'); ?></a></li>
				<li><a href="#links-<?php echo $counter;?>"><?php _e('Links', 'slider_pro'); ?></a></li>
                <li><a href="#settings-<?php echo $counter;?>"><?php _e('Settings', 'slider_pro'); ?></a></li>
				<li><a href="#slide-type-<?php echo $counter;?>"><?php _e('Slide Type', 'slider_pro'); ?></a></li>
            </ul>
            
            <div id="image-<?php echo $counter;?>" class="clearfix">
            	
                <?php
					$image_path = sliderpro_get_slide_content($slide_content, 'image', true);
					
					if ($image_path != '' && strpos($image_path, '[') === false) {
						$timthumb = get_option('slider_pro_enable_timthumb') ? plugins_url('/slider-pro/includes/timthumb/timthumb.php') . '?w=155&h=95&q=95&src=' : '';
						echo '<div class="main-image preview-box">';
						echo '<img class="image" src="'. $timthumb . $image_path . '"/>';
						echo '</div>';
					} else {
						echo '<div class="main-image preview-box no-image">';
						echo '</div>';
					}					
				?>
                
                
                <div class="info-input">
                    <table>
					<tbody>
						<tr>
							<td><label title="image_path"><?php _e('Path', 'slider_pro'); ?></label></td>
							<td><input name="slide[<?php echo $counter;?>][content][image]" type="text" 
									   value="<?php echo $image_path ?>" class="path"/></td>
						</tr>
						
						<tr>
							<td><label title="image_alt"><?php _e('Alt', 'slider_pro'); ?></label></td>
							<td><input name="slide[<?php echo $counter;?>][content][alt]" type="text" 
									   value="<?php echo sliderpro_get_slide_content($slide_content, 'alt', true); ?>" /></td>
						</tr>
						
						<tr>
							<td><label title="image_title"><?php _e('Title', 'slider_pro'); ?></label></td>
							<td><input name="slide[<?php echo $counter;?>][content][title]" type="text" 
									   value="<?php echo sliderpro_get_slide_content($slide_content, 'title', true); ?>" /></td>
						</tr>
					</tbody>
                    </table>
                    
                    <div class="main-image-buttons">
                    	<a class="button-secondary preview-button" href="#">
							<?php _e('Refresh Image', 'slider_pro'); ?>
						</a>
						
                        <a class="button-secondary open-media-loader" href="<?php echo admin_url("admin-ajax.php?action=sliderpro_open_media&show_page=1&show_date=all&allow=single"); ?>"> 
							<?php _e('Add Image', 'slider_pro'); ?>
						</a>
                	</div>
                </div>
            </div>
            
			
            <div id="thumbnail-<?php echo $counter;?>" class="clearfix">
            	 <?php
				 	$thumbnail_path = sliderpro_get_slide_content($slide_content, 'thumbnail_image', true);
					
					if ($thumbnail_path != '' && strpos($thumbnail_path, '[') === false) {
						$timthumb = get_option('slider_pro_enable_timthumb') ? plugins_url('/slider-pro/includes/timthumb/timthumb.php') . '?w=110&h=77&q=95&src=' : '';
						echo '<div class="thumbnail preview-box">';
						echo '<img class="image" src="' . $timthumb . $thumbnail_path . '"/>';
						echo '</div>';
					} else {
						echo '<div class="thumbnail preview-box no-image">';
						echo '</div>';
					}
				?>
              	
                <div class="info-input">
                    <table>
						<tbody>
							<tr>
								<td><label title="thumbnail_path"><?php _e('Path', 'slider_pro'); ?></label></td>
								<td><input name="slide[<?php echo $counter;?>][content][thumbnail_image]" type="text" 
										   value="<?php echo $thumbnail_path; ?>" class="path"/></td>
							</tr>
							
							<tr>
								<td><label title="thumbnail_alt"><?php _e('Alt', 'slider_pro'); ?></label></td>
								<td><input name="slide[<?php echo $counter;?>][content][thumbnail_alt]" type="text" 
										   value="<?php echo sliderpro_get_slide_content($slide_content, 'thumbnail_alt', true); ?>" /></td>
							</tr>
							
							<tr>
								<td><label title="thumbnail_title"><?php _e('Title', 'slider_pro'); ?></label></td>
								<td><input name="slide[<?php echo $counter;?>][content][thumbnail_title]" type="text" 
										   value="<?php echo sliderpro_get_slide_content($slide_content, 'thumbnail_title', true); ?>" /></td>
							</tr>
						</tbody>
                    </table>
                    
                    <div class="thumbnail-buttons">
                    	<a class="button-secondary preview-button" href="#"> <?php _e('Refresh Image', 'slider_pro'); ?></a>
                        <a class="button-secondary open-media-loader" href="<?php echo admin_url("admin-ajax.php?action=sliderpro_open_media&show_page=1&show_date=all&allow=single"); ?>"> 
							<?php _e('Add Image', 'slider_pro'); ?>
						</a>
                	</div>
                </div>
            </div>
			
			
			<div id="caption-<?php echo $counter;?>">
				<textarea class="sp-editor" 
						  id="caption-editor-<?php echo $counter;?>" 
						  name="slide[<?php echo $counter;?>][content][caption]"><?php echo sliderpro_get_slide_content($slide_content, 'caption', true, true); ?></textarea>
            </div>
            
			
            <div id="html-<?php echo $counter;?>">
				<textarea class="sp-editor" 
						  id="html-editor-<?php echo $counter;?>" 
						  name="slide[<?php echo $counter;?>][content][html]"><?php echo sliderpro_get_slide_content($slide_content, 'html', true, true); ?></textarea>
            </div>
			
			
			<div id="links-<?php echo $counter;?>">
				<div class="links-input">
					
					<p class="links-section">Slide Link</p>
					
					<table>
					<tbody>
						<tr>
							<td>
						  		<label title="slide_link_path"><?php _e('Path', 'slider_pro'); ?></label>
						  	</td>
						  	<td>
						  		<input name="slide[<?php echo $counter;?>][content][slide_link_path]" type="text" 
									   value="<?php echo sliderpro_get_slide_content($slide_content, 'slide_link_path', true); ?>"/>
							</td>
							<td>
								<label title="slide_link_target"><?php _e('Target', 'slider_pro'); ?></label>
							</td>
							<td>
							  <select name="slide[<?php echo $counter;?>][settings][slide_link_target]">
								<?php 
									$list = sliderpro_get_settings_list('link_target');
									foreach ($list as $entry) {
										$selected = sliderpro_get_slide_setting($slide_settings, 'slide_link_target', 'extra') == $entry ? 'selected="selected"' : '';
										echo "<option $selected>" . $entry . "</option>";
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label title="slide_link_title"><?php _e('Title', 'slider_pro'); ?></label>
							</td>
							<td>
								<input name="slide[<?php echo $counter;?>][content][slide_link_title]" type="text" 
									   value="<?php echo sliderpro_get_slide_content($slide_content, 'slide_link_title', true); ?>" />
							</td>
							<td>
								<label title="slide_link_lightbox"><?php _e('Lightbox', 'slider_pro'); ?></label>
							</td>
							<td>
								<input name="slide[<?php echo $counter;?>][settings][slide_link_lightbox]" type="hidden" value="0"/>
								<input name="slide[<?php echo $counter;?>][settings][slide_link_lightbox]" type="checkbox" value="1" 
									   <?php echo sliderpro_get_slide_setting($slide_settings, 'slide_link_lightbox', 'extra') == true ? 'checked="checked"' : ''; ?> />
							</td>
						</tr>
					</tbody>
                    </table>
					
					<div class="spacediv"></div>
					
					<p class="links-section">Thumbnail Link</p>
					
					<table>
					<tbody>
						<tr>
							<td>
						  		<label title="thumbnail_link_path"><?php _e('Path', 'slider_pro'); ?></label>
						  	</td>
						  	<td>
						  		<input name="slide[<?php echo $counter;?>][content][thumbnail_link_path]" type="text" 
									   value="<?php echo sliderpro_get_slide_content($slide_content, 'thumbnail_link_path', true); ?>"/>
							</td>
							<td>
								<label title="thumbnail_link_target"><?php _e('Target', 'slider_pro'); ?></label>
							</td>
							<td>
								<select name="slide[<?php echo $counter;?>][settings][thumbnail_link_target]">
								<?php 
									$list = sliderpro_get_settings_list('link_target');
									foreach ($list as $entry) {
										$selected = sliderpro_get_slide_setting($slide_settings, 'thumbnail_link_target', 'extra') == $entry ? 'selected="selected"' : '';
										echo "<option $selected>" . $entry . "</option>";
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label title="thumbnail_link_title"><?php _e('Title', 'slider_pro'); ?></label>
							</td>
							<td>
								<input name="slide[<?php echo $counter;?>][content][thumbnail_link_title]" type="text" 
									   value="<?php echo sliderpro_get_slide_content($slide_content, 'thumbnail_link_title', true); ?>" />
							</td>
							<td>
								<label title="thumbnail_link_lightbox"><?php _e('Lightbox', 'slider_pro'); ?></label>
							</td>
							<td>
								<input name="slide[<?php echo $counter;?>][settings][thumbnail_link_lightbox]" type="hidden" value="0"/>
								<input name="slide[<?php echo $counter;?>][settings][thumbnail_link_lightbox]" type="checkbox" value="1" 
									   <?php echo sliderpro_get_slide_setting($slide_settings, 'thumbnail_link_lightbox', 'extra') == true ? 'checked="checked"' : ''; ?> />
							</td>
						</tr>
					</tbody>
                    </table>
				</div>
            </div>	
					
            
            <div id="settings-<?php echo $counter;?>">
				
				<div class="settings-menu">
					<?php
					
						echo '<select class="settings-multiselect" multiple="multiple">' . PHP_EOL;
					
						$set_settings = array();
						
						foreach ($individual_slide_settings as $key => $value) {
							echo SP_IND_1 . '<optgroup label="' . $key . '">' . PHP_EOL;
							
							foreach ($individual_slide_settings[$key] as $setting) {
								$value = $sliderpro_slide_settings[$setting]['default_value'];
								$selected = '';
								
								if (isset($slide_settings[$setting])) {
									$selected = ' selected="selected"';
									$set_settings[$setting] = $slide_settings[$setting];
								}
								
								if ($value === true)
									$value = 'true';
								else if ($value === false)
									$value = 'false';
								
								if ($sliderpro_slide_settings[$setting]['type'] == 'select')
									$value = sliderpro_get_settings_pretty_name($value);
								
								echo SP_IND_2 . '<option' . $selected . ' value="' . $setting . '">' . $sliderpro_slide_settings[$setting]['name'] . ': ' . $value . '</option>' . PHP_EOL;
							}
								
							echo SP_IND_1 . '</optgroup>' . PHP_EOL;
						}
						
						echo '</select>' . PHP_EOL;
					
					?>
					
					<a class="button-secondary show-selected-settings" href="<?php echo admin_url("admin-ajax.php?action=sliderpro_show_slide_settings") . '&counter=' . $counter; ?>">
						Show
					</a>
				</div>
				
				<table class="settings-container">
					<?php
						foreach ($set_settings as $name => $value)
							echo SP_IND_1 . sliderpro_create_slide_setting_field($name, $value, $counter) . PHP_EOL;
						
						unset($set_settings);
					?>
				</table>
				
            </div>
			
			
			<div id="slide-type-<?php echo $counter;?>">
				
				<div class="slide-type-indicator">
					<?php $slide_type = sliderpro_get_slide_setting($slide_settings, 'slide_type', 'dynamic'); ?>
					
					<label title="slide_type"><?php _e('Slide Type', 'slider_pro'); ?></label>
				
					<select name="slide[<?php echo $counter;?>][settings][slide_type]" class="slide-type">
						<?php 
							$list = sliderpro_get_settings_list('slide_types');
							
							foreach ($list as $entry) {
								$selected = $slide_type == $entry ? ' selected="selected"' : '';
								echo '<option' . $selected . ' value="' . $entry . '">' . sliderpro_get_settings_pretty_name($entry) . '</option>';
							}
						?>
					</select>
				
					<p class="loading-controls-indicator hide">Loading Controls...</p>
				</div>				
				
				<div class="dynamic-control-fields-container <?php echo $slide_type; ?>">
					<?php 
						if ($slide_type == 'posts')
							include('posts-data-fields.php');
						else if ($slide_type == 'gallery')
							include('gallery-data-fields.php');
					?>
				</div>
				
            </div>
            
        </div>
    </div>
    
</div>