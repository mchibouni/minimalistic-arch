<?php

// constants used for indentation
define('SP_IND_1', "\t");
define('SP_IND_2', "\t\t");
define('SP_IND_3', "\t\t\t");
define('SP_IND_4', "\t\t\t\t");




global $sliderpro_slider_settings;

$sliderpro_slider_settings = array( // general settings
									// style settings
									'width' => array('default_value' => 500, 
												     'name' => 'Width', 
												     'type' => 'text',
													 'category' => 'general',
													 'group' => 'Style'),

									'height' => array('default_value' => 300, 
												      'name' => 'Height', 
												      'type' => 'text',
													  'category' => 'general',
													  'group' => 'Style'),
									
									'shadow' => array('default_value' => true, 
													  'name' => 'Shadow', 
													  'type' => 'checkbox',
													  'category' => 'general',
													  'group' => 'Style'),
													  
									'skin' => array('default_value' => 'pixel', 
												    'name' => 'Skin', 
												    'type' => 'function',
													'function_name' => 'sliderpro_get_main_skin',
													'category' => 'general',
													'group' => 'Style'),
									
									'include_skin' => array('default_value' => false, 
													   		'name' => 'Include Skin', 
													   		'type' => 'checkbox',
															'category' => 'general',
															'group' => 'Style'),									
									
									'scale_type' => array('default_value' => 'outsideFit', 
														  'name' => 'Scale Type', 
														  'type' => 'select', 
														  'list' => 'scale_type',
														  'category' => 'general',
														  'group' => 'Scale and Align'),
									
									'align_type' => array('default_value' => 'centerCenter', 
														  'name' => 'Align Type', 
														  'type' => 'select', 
														  'list' => 'align_type',
														  'category' => 'general',
														  'group' => 'Scale and Align'),
									
									'allow_scale_up' => array('default_value' => false, 
															  'name' => 'Allow Scale Up', 
															  'type' => 'text',
															  'category' => 'general',
															  'group' => 'Scale and Align'),
									
									// slides settings
									'lazy_loading' => array('default_value' => false, 
															'name' => 'Lazy Loading', 
															'type' => 'checkbox',
															'category' => 'general',
															'group' => 'Slides'),
																	 					
									'preload_nearby_images' => array('default_value' => false, 
																     'name' => 'Preload Nearby Images', 
																     'type' => 'checkbox',
																	 'category' => 'general',
																	 'group' => 'Slides'),
									
									'slide_start' => array('default_value' => 0, 
														   'name' => 'Slide Start', 
														   'type' => 'text',
														   'category' => 'general',
														   'group' => 'Slides'),
									
									'shuffle' => array('default_value' => false, 
													   'name' => 'Shuffle', 
													   'type' => 'checkbox',
													   'category' => 'general',
													   'group' => 'Slides'),
											
									// custom JS and CSS
									'custom_class' => array('default_value' => '', 
														 'name' => 'Custom Class', 
														 'type' => 'text',
														 'category' => 'custom_js_css',
														 'group' => 'Custom JS and CSS'),
														   
									'enable_custom_js' => array('default_value' => false, 
															  	'name' => 'Enable Custom JS', 
															  	'type' => 'checkbox',
															  	'category' => 'custom_js_css',
															  	'group' => 'Custom JS and CSS'), 
									
									'enable_custom_css' => array('default_value' => false, 
															   	 'name' => 'Enable Custom CSS', 
															   	 'type' => 'checkbox',
															   	 'category' => 'custom_js_css',
															   	 'group' => 'Custom JS and CSS'),
															   
															   
															   				   
									// slideshow settings
									'slideshow' => array('default_value' => true, 
														 'name' => 'Slideshow', 
														 'type' => 'checkbox',
														 'category' => 'slideshow',
														 'group' => 'Slideshow'),
									
									'slideshow_delay' => array('default_value' => 5000, 
															   'name' => 'Slideshow Delay', 
															   'type' => 'text',
															   'category' => 'slideshow',
															   'group' => 'Slideshow'),
									
									'slideshow_loop' => array('default_value' => true, 
															  'name' => 'Slideshow Loop', 
															  'type' => 'checkbox',
															  'category' => 'slideshow',
															  'group' => 'Slideshow'),
									
									'slideshow_controls' => array('default_value' => false, 
																  'name' => 'Slideshow Controls', 
																  'type' => 'checkbox',
																  'category' => 'slideshow',
																  'group' => 'Slideshow'),									
									
									'slideshow_controls_toggle' => array('default_value' => true, 
																		 'name' => 'Slideshow Controls Toggle', 
																		 'type' => 'checkbox',
																		 'category' => 'slideshow',
																		 'group' => 'Slideshow'),
									
									'slideshow_controls_show_duration' => array('default_value' => 500, 
																			    'name' => 'Slideshow Controls Show Duration', 
																			    'type' => 'text',
																				'category' => 'slideshow',
																				'group' => 'Slideshow'),
									
									'slideshow_controls_hide_duration' => array('default_value' => 500, 
																			    'name' => 'Slideshow Controls Hide Duration', 
																			    'type' => 'text',
																				'category' => 'slideshow',
																				'group' => 'Slideshow'),
									
									'pause_slideshow_on_hover' => array('default_value' => false, 
																	    'name' => 'Pause Slideshow On Hover', 
																	    'type' => 'checkbox',
																		'category' => 'slideshow',
																		'group' => 'Slideshow'),
									
									'slideshow_direction' => array('default_value' => 'next', 
																   'name' => 'Slideshow Direction', 
																   'type' => 'select', 
																   'list' => 'slideshow_direction',
																   'category' => 'slideshow',
																   'group' => 'Slideshow'),
																   
																   
									
									// slide navigation controls settings
									'keyboard_navigation' => array('default_value' => false, 
																   'name' => 'Keyboard Navigation', 
																   'type' => 'checkbox',
																   'category' => 'slide_navigation_controls',
																   'group' => 'Keyboard'),
																   
									'keyboard_navigation_on_focus_only' => array('default_value' => false, 
																			     'name' => 'Keyboard Navigation On Focus Only', 
																			     'type' => 'checkbox',
																			     'category' => 'slide_navigation_controls',
																			     'group' => 'Keyboard'),
																   
									// slide arrows settings
									'slide_arrows' => array('default_value' => true, 
														  	'name' => 'Slide Arrows', 
														  	'type' => 'checkbox',
															'category' => 'slide_navigation_controls',
															'group' => 'Slide Arrows'),
									
									'slide_arrows_toggle' => array('default_value' => true, 
														  		   'name' => 'Slide Arrows Toggle', 
														  		   'type' => 'checkbox',
																   'category' => 'slide_navigation_controls',
																   'group' => 'Slide Arrows'),
									
									'slide_arrows_show_duration' => array('default_value' => 500, 
															   			  'name' => 'Slide Arrows Show Duration', 
															   			  'type' => 'text',
																		  'category' => 'slide_navigation_controls',
																		  'group' => 'Slide Arrows'),
									
									'slide_arrows_hide_duration' => array('default_value' => 500, 
															   			  'name' => 'Slide Arrows Hide Duration', 
															   			  'type' => 'text',
																		  'category' => 'slide_navigation_controls',
																		  'group' => 'Slide Arrows'),								
									
									// slide buttons settings
									'slide_buttons' => array('default_value' => true, 
														  	 'name' => 'Slide Buttons', 
														  	 'type' => 'checkbox',
															 'category' => 'slide_navigation_controls',
															 'group' => 'Slide Buttons'),
									
									'slide_buttons_center' => array('default_value' => true, 
																    'name' => 'Slide Buttons Center', 
																    'type' => 'checkbox',
																	'category' => 'slide_navigation_controls',
																	'group' => 'Slide Buttons'),
									
									'slide_buttons_container_center' => array('default_value' => true, 
																			  'name' => 'Slide Buttons Container Center', 
																			  'type' => 'checkbox',
																			  'category' => 'slide_navigation_controls',
																			  'group' => 'Slide Buttons'),
									
									'slide_buttons_toggle' => array('default_value' => false, 
																	'name' => 'Slide Buttons Toggle', 
																	'type' => 'checkbox',
																	'category' => 'slide_navigation_controls',
																	'group' => 'Slide Buttons'),
									
									'slide_buttons_show_duration' => array('default_value' => 500, 
															   			   'name' => 'Slide Buttons Show Duration', 
															   			   'type' => 'text',
																		   'category' => 'slide_navigation_controls',
																		   'group' => 'Slide Buttons'),
									
									'slide_buttons_hide_duration' => array('default_value' => 500, 
															   			   'name' => 'Slide Buttons Hide Duration', 
															   			   'type' => 'text',
																		   'category' => 'slide_navigation_controls',
																		   'group' => 'Slide Buttons'),
									
									'slide_buttons_number' => array('default_value' => false, 
																    'name' => 'Slide Buttons Number', 
																    'type' => 'checkbox',
																	'category' => 'slide_navigation_controls',
																	'group' => 'Slide Buttons'),
																	
																	
																	
									// lightbox settings
									'lightbox' => array('default_value' => false, 
														'name' => 'Lightbox', 
														'type' => 'checkbox',
														'category' => 'lightbox',
														'group' => 'Lightbox'),
									
									'lightbox_gallery' => array('default_value' => true, 
															  	'name' => 'Lightbox Gallery', 
															  	'type' => 'checkbox',
																'category' => 'lightbox',
																'group' => 'Lightbox'),
																
									'lightbox_theme' => array('default_value' => 'pp_default', 
															  'name' => 'Lightbox Theme', 
															  'type' => 'select', 
															  'list' => 'lightbox_theme',
															  'category' => 'lightbox',
															  'group' => 'Lightbox'),
									
									'lightbox_opacity' => array('default_value' => 0.8, 
																'name' => 'Lightbox Opacity', 
																'type' => 'text',
																'category' => 'lightbox',
																'group' => 'Lightbox'),
									
									'lightbox_icon' => array('default_value' => true, 
															 'name' => 'Lightbox Icon', 
															 'type' => 'checkbox',
															 'category' => 'lightbox',
															 'group' => 'Lightbox'),
																
									'lightbox_icon_toggle' => array('default_value' => false, 
															  		'name' => 'Lightbox Icon Toggle', 
															  		'type' => 'checkbox',
																	'category' => 'lightbox',
																	'group' => 'Lightbox'),
																
									'lightbox_icon_fade_duration' => array('default_value' => 500, 
																		   'name' => 'Lightbox Icon Fade Duration', 
																		   'type' => 'text',
																		   'category' => 'lightbox',
																		   'group' => 'Lightbox'),
																
									'thumbnail_lightbox_icon' => array('default_value' => true,
															  		   'name' => 'Thumbnail Lightbox Icon',
															  		   'type' => 'checkbox',
																	   'category' => 'lightbox',
																	   'group' => 'Lightbox'),
									
									'thumbnail_lightbox_icon_toggle' => array('default_value' => true,
															  				  'name' => 'Thumbnail Lightbox Icon Toggle',
															  				  'type' => 'checkbox',
																			  'category' => 'lightbox',
																			  'group' => 'Lightbox'),
																	   
																	   
																	   
									// timer animation settings
									'timer_animation' => array('default_value' => true, 
															   'name' => 'Timer Animation', 
															   'type' => 'checkbox',
															   'category' => 'timer_animation',
															   'group' => 'General'),
															   
									'timer_animation_controls' => array('default_value' => true, 
															   'name' => 'Timer Animation Controls', 
															   'type' => 'checkbox',
															   'category' => 'timer_animation',
															   'group' => 'General'),
									
									'timer_toggle' => array('default_value' => false, 
															'name' => 'Timer Toggle', 
															'type' => 'checkbox',
															'category' => 'timer_animation',
															'group' => 'General'),
															
									'timer_fade_duration' => array('default_value' => 500, 
																   'name' => 'Timer Fade Duration', 
																   'type' => 'text',
																   'category' => 'timer_animation',
																   'group' => 'General'),
																   
									'timer_radius' => array('default_value' => 18, 
															'name' => 'Timer Radius', 
															'type' => 'text',
															'category' => 'timer_animation',
															'group' => 'Graphic Style'),
									
									'timer_stroke_color1' => array('default_value' => '#000000', 
																   'name' => 'Timer Stroke Color 1', 
																   'type' => 'color',
																   'category' => 'timer_animation',
																   'group' => 'Graphic Style'),
									
									'timer_stroke_color2' => array('default_value' => '#FFFFFF', 
																   'name' => 'Timer Stroke Color 2', 
																   'type' => 'color',
																   'category' => 'timer_animation',
																   'group' => 'Graphic Style'),
									
									'timer_stroke_opacity1' => array('default_value' => 0.5, 
																   	 'name' => 'Timer Stroke Opacity 1', 
																   	 'type' => 'text',
																	 'category' => 'timer_animation',
																	 'group' => 'Graphic Style'),
									
									'timer_stroke_opacity2' => array('default_value' => 0.7, 
																   	 'name' => 'Timer Stroke Opacity 2', 
																   	 'type' => 'text',
																	 'category' => 'timer_animation',
																	 'group' => 'Graphic Style'),
									
									'timer_stroke_width1' => array('default_value' => 8, 
																   'name' => 'Timer Stroke Width 1', 
																   'type' => 'text',
																   'category' => 'timer_animation',
																   'group' => 'Graphic Style'),
									
									'timer_stroke_width2' => array('default_value' => 4, 
																   'name' => 'Timer Stroke Width 2', 
																   'type' => 'text',
																   'category' => 'timer_animation',
																   'group' => 'Graphic Style'),
																   
									
									
									// transition effects settings
									'effect_type' => array('default_value' => 'random', 
														   'name' => 'Effect Type', 
														   'type' => 'select', 
														   'list' => 'effect_type',
														   'category' => 'transition_effects',
														   'group' => 'General'),
									
									'css3_transitions' => array('default_value' => false, 
															  	'name' => 'CSS3 Transitions', 
															  	'type' => 'checkbox',
																'category' => 'transition_effects',
																'group' => 'General'),
																
									'initial_effect' => array('default_value' => true, 
															  'name' => 'Initial Effect', 
															  'type' => 'checkbox',
															  'category' => 'transition_effects',
															  'group' => 'General'),
									
									'html_during_transition' => array('default_value' => true, 
																	  'name' => 'HTML During Transition', 
																	  'type' => 'checkbox',
																	  'category' => 'transition_effects',
																	  'group' => 'General'),									
									
									'override_transition' => array('default_value' => false, 
																   'name' => 'Override Transition', 
																   'type' => 'checkbox',
																   'category' => 'transition_effects',
																   'group' => 'General'),
																   
									// slide transition
									'slide_direction' => array('default_value' => 'autoHorizontal', 
															   'name' => 'Slide Direction', 
															   'type' => 'select', 
															   'list' => 'slide_direction',
															   'category' => 'transition_effects',
															   'group' => 'Slide Transition'),
									
									'slide_loop' => array('default_value' => false, 
														  'name' => 'Slide Loop', 
														  'type' => 'checkbox',
														  'category' => 'transition_effects',
														  'group' => 'Slide Transition'),
									
									'slide_duration' => array('default_value' => 700, 
															  'name' => 'Slide Duration', 
															  'type' => 'text',
															  'category' => 'transition_effects',
															  'group' => 'Slide Transition'),
									
									'slide_easing' => array('default_value' => 'easeInOutExpo', 
															'name' => 'Slide Easing', 
															'type' => 'select', 
															'list' => 'easing',
															'category' => 'transition_effects',
															'group' => 'Slide Transition'),														
									
									// slice transition
									'slice_effect_type' => array('default_value' => 'random', 
																 'name' => 'Slice Effect Type', 
																 'type' => 'select', 
																 'list' => 'slice_effect_type',
																 'category' => 'transition_effects',
																 'group' => 'Slice Transition'),
									
									'horizontal_slices' => array('default_value' => 5, 
																 'name' => 'Horizontal Slices', 
																 'type' => 'text',
																 'category' => 'transition_effects',
																 'group' => 'Slice Transition'),
									
									'vertical_slices' => array('default_value' => 3, 
															   'name' => 'Vertical Slices', 
															   'type' => 'text',
															   'category' => 'transition_effects',
															   'group' => 'Slice Transition'),
									
									'slice_pattern' => array('default_value' => 'random', 
															 'name' => 'Slice Pattern', 
															 'type' => 'select', 
															 'list' => 'slice_pattern',
															 'category' => 'transition_effects',
															 'group' => 'Slice Transition'),
									
									'slice_duration' => array('default_value' => 1000, 
															  'name' => 'Slice Duration', 
															  'type' => 'text',
															  'category' => 'transition_effects',
															  'group' => 'Slice Transition'),
															  						 						   							 
									'slice_delay' => array('default_value' => 50, 
														   'name' => 'Slice Delay', 
														   'type' => 'text',
														   'category' => 'transition_effects',
														   'group' => 'Slice Transition'),
									
									'slice_point' => array('default_value' => 'centerCenter', 
														   'name' => 'Slice Point', 
														   'type' => 'select', 
														   'list' => 'slice_point',
														   'category' => 'transition_effects',
														   'group' => 'Slice Transition'),
									
									'slice_fade' => array('default_value' => true, 
														  'name' => 'Slice Fade', 
														  'type' => 'checkbox',
														  'category' => 'transition_effects',
														  'group' => 'Slice Transition'),
														  
									'slice_easing' => array('default_value' => 'swing', 
															'name' => 'Slice Easing', 
															'type' => 'select', 
															'list' => 'easing',
															'category' => 'transition_effects',
															'group' => 'Slice Transition'),									
														  
									'slice_start_position' => array('default_value' => 'left', 
																	'name' => 'Slice Start Position', 
																	'type' => 'select', 
																	'list' => 'slice_start_position',
																	'category' => 'transition_effects',
																	'group' => 'Slice Transition'),
									
									'slice_start_ratio' => array('default_value' => 1, 
																 'name' => 'Slice Start Ratio', 
																 'type' => 'text',
																 'category' => 'transition_effects',
																 'group' => 'Slice Transition'),
									
									'slide_mask' => array('default_value' => false, 
														  'name' => 'Slide Mask', 
														  'type' => 'checkbox',
														  'category' => 'transition_effects',
														  'group' => 'Slice Transition'),
									
									'fade_previous_slide' => array('default_value' => false, 
																   'name' => 'Fade Previous Slide', 
																   'type' => 'checkbox',
																   'category' => 'transition_effects',
																   'group' => 'Slice Transition'),
									
									'fade_previous_slide_duration' => array('default_value' => 300, 
																			'name' => 'Fade Previous Slide Duration', 
																			'type' => 'text',
																			'category' => 'transition_effects',
																			'group' => 'Slice Transition'),
									
									// fade transition
									'fade_in_duration' => array('default_value' => 700, 
																'name' => 'Fade In Duration', 
																'type' => 'text',
																'category' => 'transition_effects',
																'group' => 'Fade Transition'),
									
									'fade_out_duration' => array('default_value' => 700, 
																 'name' => 'Fade Out Duration', 
																 'type' => 'text',
																 'category' => 'transition_effects',
																 'group' => 'Fade Transition'),
									
									'fade_in_easing' => array('default_value' => 'swing', 
															  'name' => 'Fade In Easing', 
															  'type' => 'select', 
															  'list' => 'easing',
															  'category' => 'transition_effects',
															  'group' => 'Fade Transition'),
									
									'fade_out_easing' => array('default_value' => 'swing', 
															   'name' => 'Fade Out Easing', 
															   'type' => 'select', 
															   'list' => 'easing',
															   'category' => 'transition_effects',
															   'group' => 'Fade Transition'),
									
									// swipe transition
									'swipe_orientation' => array('default_value' => 'horizontal', 
															   	 'name' => 'Swipe Orientation', 
															   	 'type' => 'select', 
															   	 'list' => 'swipe_orientation',
																 'category' => 'transition_effects',
																 'group' => 'Swipe Transition'),
									
									'swipe_threshold' => array('default_value' => 50, 
															   'name' => 'Swipe Threshold', 
															   'type' => 'text',
															   'category' => 'transition_effects',
															   'group' => 'Swipe Transition'),
															   
									'swipe_duration' => array('default_value' => 700, 
															  'name' => 'Swipe Suration', 
															  'type' => 'text',
															  'category' => 'transition_effects',
															  'group' => 'Swipe Transition'),
									
									'swipe_back_duration' => array('default_value' => 300, 
															  	   'name' => 'Swipe Back Duration', 
															  	   'type' => 'text',
																   'category' => 'transition_effects',
																   'group' => 'Swipe Transition'),
									
									'swipe_slide_distance' => array('default_value' => 10, 
																    'name' => 'Swipe Slide Distance', 
																    'type' => 'text',
																	'category' => 'transition_effects',
																	'group' => 'Swipe Transition'),
									
									'swipe_easing' => array('default_value' => 'swing', 
															'name' => 'Swipe Easing', 
															'type' => 'select', 
															'list' => 'easing',
															'category' => 'transition_effects',
															'group' => 'Swipe Transition'),
									
									'swipe_mouse_drag' => array('default_value' => true, 
														  		'name' => 'Swipe Mouse Drag', 
														  		'type' => 'checkbox',
																'category' => 'transition_effects',
																'group' => 'Swipe Transition'),
									
									'swipe_touch_drag' => array('default_value' => true, 
														  		'name' => 'Swipe Touch Drag', 
														  		'type' => 'checkbox',
																'category' => 'transition_effects',
																'group' => 'Swipe Transition'),
									
									'swipe_grab_cursor' => array('default_value' => true, 
														  		 'name' => 'Swipe Grab Cursor', 
														  		 'type' => 'checkbox',
																 'category' => 'transition_effects',
																 'group' => 'Swipe Transition'),
																
																
									
									// thumbnail settings
									// thumbnail general settings
									'thumbnail_type' => array('default_value' => 'tooltip', 
															  'name' => 'Thumbnail Type', 
															  'type' => 'select', 
															  'list' => 'thumbnail_type',
															  'category' => 'thumbnails',
															  'group' => 'General'),
															  
									'thumbnail_width' => array('default_value' => 80, 
															   'name' => 'Thumbnail Width', 
															   'type' => 'text',
															   'category' => 'thumbnails',
															   'group' => 'General'),
									
									'thumbnail_height' => array('default_value' => 50, 
															   	'name' => 'Thumbnail Height', 
															   	'type' => 'text',
																'category' => 'thumbnails',
																'group' => 'General'),
															  
									// tooltip thumbnails settings						  										 
									'thumbnail_slide_amount' => array('default_value' => 10, 
															   		  'name' => 'Thumbnail Slide Amount', 
															   		  'type' => 'text',
																	  'category' => 'thumbnails',
																	  'group' => 'Tooltip Thumbnails'),
									
									'thumbnail_slide_duration' => array('default_value' => 300, 
															   			'name' => 'Thumbnail Slide Duration', 
															   			'type' => 'text',
																		'category' => 'thumbnails',
																		'group' => 'Tooltip Thumbnails'),
									
									'thumbnail_slide_easing' => array('default_value' => 'swing', 
															   		  'name' => 'Thumbnail Slide Easing', 
															   		  'type' => 'select',
																	  'list' => 'easing',
																	  'category' => 'thumbnails',
																	  'group' => 'Tooltip Thumbnails'),
									
									// thumbnail scroller settings
									'thumbnail_orientation' => array('default_value' => 'horizontal', 
																	 'name' => 'Thumbnail Orientation', 
																	 'type' => 'select', 
																	 'list' => 'thumbnail_orientation',
																	 'category' => 'thumbnails',
																	 'group' => 'Thumbnail Scroller'),
																	 
									'thumbnail_layers' => array('default_value' => '1', 
																'name' => 'Thumbnail Layers', 
																'type' => 'text',
																'category' => 'thumbnails',
																'group' => 'Thumbnail Scroller'),
																	 
									'maximum_visible_thumbnails' => array('default_value' => 5, 
																		  'name' => 'Maximum Visible Thumbnails', 
																		  'type' => 'text',
																		  'category' => 'thumbnails',
																		  'group' => 'Thumbnail Scroller'),
									
									'minimum_visible_thumbnails' => array('default_value' => 1, 
																		  'name' => 'Minimum Visible Thumbnails', 
																		  'type' => 'text',
																		  'category' => 'thumbnails',
																		  'group' => 'Thumbnail Scroller'),
									
									'thumbnail_scroller_responsive' => array('default_value' => false, 
																    		 'name' => 'Thumbnail Scroller Responsive', 
																    		 'type' => 'checkbox',
																			 'category' => 'thumbnails',
																			 'group' => 'Thumbnail Scroller'),
																			 
									'thumbnail_sync' => array('default_value' => true, 
															  'name' => 'Thumbnail Sync', 
															  'type' => 'checkbox',
															  'category' => 'thumbnails',
															  'group' => 'Thumbnail Scroller'),
															  								 
									'thumbnail_scroller_toggle' => array('default_value' => false, 
																    	 'name' => 'Thumbnail Scroller Toggle', 
																    	 'type' => 'checkbox',
																		 'category' => 'thumbnails',
																		 'group' => 'Thumbnail Scroller'),
									
									'thumbnail_scroller_hide_duration' => array('default_value' => 500, 
																				'name' => 'Thumbnail Scroller Hide Duration', 
																				'type' => 'text',
																				'category' => 'thumbnails',
																				'group' => 'Thumbnail Scroller'),
									
									'thumbnail_scroller_show_duration' => array('default_value' => 500, 
																				'name' => 'Thumbnail Scroller Show Duration', 
																				'type' => 'text',
																				'category' => 'thumbnails',
																				'group' => 'Thumbnail Scroller'),
									
									'thumbnail_scroller_center' => array('default_value' => true, 
																    	 'name' => 'Thumbnail Scroller Center', 
																    	 'type' => 'checkbox',
																		 'category' => 'thumbnails',
																		 'group' => 'Thumbnail Scroller'),									
									
									
									// thumbnail scroll animation settings
									'thumbnail_scroll_duration' => array('default_value' => 1000, 
																		 'name' => 'Thumbnail Scroll Duration', 
																		 'type' => 'text',
																		 'category' => 'thumbnails',
																		 'group' => 'Scrolling'),
									
									'thumbnail_scroll_easing' => array('default_value' => 'swing', 
																	   'name' => 'Thumbnail Scroll Easing', 
																	   'type' => 'select', 
																	   'list' => 'easing',
																	   'category' => 'thumbnails',
																	   'group' => 'Scrolling'),
																	   
									// thumbnail arrow settings
									'thumbnail_arrows' => array('default_value' => true, 
																'name' => 'Thumbnail Arrows', 
																'type' => 'checkbox',
																'category' => 'thumbnails',
																'group' => 'Arrows'),
									
									'thumbnail_arrows_toggle' => array('default_value' => false, 
															  		   'name' => 'Thumbnail Arrows Toggle', 
															  		   'type' => 'checkbox',
																	   'category' => 'thumbnails',
																	   'group' => 'Arrows'),
									
									'thumbnail_arrows_hide_duration' => array('default_value' => 500, 
																		 	  'name' => 'Thumbnail Arrows Hide Duration', 
																		 	  'type' => 'text',
																			  'category' => 'thumbnails',
																			  'group' => 'Arrows'),
									
									'thumbnail_arrows_show_duration' => array('default_value' => 500, 
																		 	  'name' => 'Thumbnail Arrows Show Duration', 
																		 	  'type' => 'text',
																			  'category' => 'thumbnails',
																			  'group' => 'Arrows'),
									
									// thumbnail buttons settings
									'thumbnail_buttons' => array('default_value' => false, 
															     'name' => 'Thumbnail Buttons', 
															     'type' => 'checkbox',
																 'category' => 'thumbnails',
																 'group' => 'Buttons'),
									
									'thumbnail_buttons_toggle' => array('default_value' => false, 
																	    'name' => 'Thumbnail Buttons Toggle', 
																	    'type' => 'checkbox',
																		'category' => 'thumbnails',
																		'group' => 'Buttons'),
									
									'thumbnail_buttons_hide_duration' => array('default_value' => 500, 
																		 	   'name' => 'Thumbnail Buttons Hide Duration', 
																		 	   'type' => 'text',
																			   'category' => 'thumbnails',
																			   'group' => 'Buttons'),
									
									'thumbnail_buttons_show_duration' => array('default_value' => 500, 
																		 	   'name' => 'Thumbnail Buttons Show Duration', 
																		 	   'type' => 'text',
																			   'category' => 'thumbnails',
																			   'group' => 'Buttons'),
									
									// thumbnail scrollbar settings
									'thumbnail_scrollbar' => array('default_value' => false, 
																   'name' => 'Thumbnail Scrollbar', 
																   'type' => 'checkbox',
																   'category' => 'thumbnails',
																   'group' => 'Scrollbar'),									
									
									'scrollbar_skin' => array('default_value' => 'scrollbar-1', 
															  'name' => 'Scrollbar Skin', 
															  'type' => 'function',
															  'function_name' => 'sliderpro_get_scrollbar_skin',
															  'category' => 'thumbnails',
															  'group' => 'Scrollbar'),
									
									'thumbnail_scrollbar_toggle' => array('default_value' => false, 
																		  'name' => 'Thumbnail Scrollbar Toggle', 
																		  'type' => 'checkbox',
																		  'category' => 'thumbnails',
																		  'group' => 'Scrollbar'),
																		  						  
									'thumbnail_scrollbar_hide_duration' => array('default_value' => 500, 
																		 	   	 'name' => 'Thumbnail Scrollbar Hide Duration', 
																		 	   	 'type' => 'text',
																				 'category' => 'thumbnails',
																				 'group' => 'Scrollbar'),
									
									'thumbnail_scrollbar_show_duration' => array('default_value' => 500, 
																		 		 'name' => 'Thumbnail Scrollbar Show Duration', 
																		 	   	 'type' => 'text',
																				 'category' => 'thumbnails',
																				 'group' => 'Scrollbar'),
									
									'thumbnail_scrollbar_ease' => array('default_value' => 10, 
																		'name' => 'Thumbnail Scrollbar Ease', 
																		'type' => 'text',
																		'category' => 'thumbnails',
																		'group' => 'Scrollbar'),
									
									'scrollbar_arrow_scroll_amount' => array('default_value' => 100, 
																		 	 'name' => 'Scrollbar Arrow Scroll Amount', 
																		 	 'type' => 'text',
																			 'category' => 'thumbnails',
																			 'group' => 'Scrollbar'),
									
									// thumbnail mouse scroll settings
									'thumbnail_mouse_scroll' => array('default_value' => false, 
																	  'name' => 'Thumbnail Mouse Scroll', 
																	  'type' => 'checkbox',
																	  'category' => 'thumbnails',
																	  'group' => 'Mouse Scroll'),
									
									'thumbnail_mouse_scroll_speed' => array('default_value' => 10, 
																			'name' => 'Thumbnail Mouse Scroll Speed', 
																			'type' => 'text',
																			'category' => 'thumbnails',
																			'group' => 'Mouse Scroll'),
									
									'thumbnail_mouse_scroll_ease' => array('default_value' => 90, 
																		   'name' => 'Thumbnail Mouse Scroll Ease', 
																		   'type' => 'text',
																		   'category' => 'thumbnails',
																		   'group' => 'Mouse Scroll'),
									
									// thumbnail mouse wheel settings
									'thumbnail_mouse_wheel' => array('default_value' => false, 
																     'name' => 'Thumbnail Mouse Wheel', 
																     'type' => 'checkbox',
																	 'category' => 'thumbnails',
																	 'group' => 'Mouse Wheel'),
									
									'thumbnail_mouse_wheel_speed' => array('default_value' => 20, 
																		   'name' => 'Thumbnail Mouse Scroll Speed', 
																		   'type' => 'text',
																		   'category' => 'thumbnails',
																		   'group' => 'Mouse Wheel'),
									
									'thumbnail_mouse_wheel_reverse' => array('default_value' => false, 
																		     'name' => 'Thumbnail Mouse Wheel Reverse', 
																		     'type' => 'checkbox',
																			 'category' => 'thumbnails',
																			 'group' => 'Mouse Wheel'),
									
									// thumbnail caption settings
									'thumbnail_caption_position' => array('default_value' => 'bottom', 
																	   	  'name' => 'Thumbnail Caption Position', 
																	   	  'type' => 'select', 
																	   	  'list' => 'thumbnail_caption_position',
																		  'category' => 'thumbnails',
																		  'group' => 'Caption'),									
									
									'thumbnail_caption_effect' => array('default_value' => 'slide', 
																	   	'name' => 'Thumbnail Caption Effect', 
																	   	'type' => 'select', 
																	   	'list' => 'thumbnail_caption_effect',
																		'category' => 'thumbnails',
																		'group' => 'Caption'),
									
									'thumbnail_caption_toggle' => array('default_value' => true, 
																	    'name' => 'Thumbnail Caption Toggle', 
																	    'type' => 'checkbox',
																		'category' => 'thumbnails',
																		'group' => 'Caption'),
																		
									'thumbnail_caption_show_duration' => array('default_value' => 500, 
															 				   'name' => 'Thumbnail Caption Show Duration', 
															 				   'type' => 'text',
																			   'category' => 'thumbnails',
																			   'group' => 'Caption'),
									
									'thumbnail_caption_hide_duration' => array('default_value' => 500, 
															 				   'name' => 'Thumbnail Caption Hide Duration', 
															 				   'type' => 'text',
																			   'category' => 'thumbnails',
																			   'group' => 'Caption'),
									
									'thumbnail_caption_easing' => array('default_value' => 'swing', 
																		'name' => 'Thumbnail Caption Easing', 
																		'type' => 'select', 
																		'list' => 'easing',
																		'category' => 'thumbnails',
																		'group' => 'Caption'),
									
									// thumbnail tooltip settings
									'thumbnail_tooltip' => array('default_value' => false, 
																 'name' => 'Thumbnail Tooltip', 
																 'type' => 'checkbox',
																 'category' => 'thumbnails',
																 'group' => 'Tooltip'),
																 
									'tooltip_show_duration' => array('default_value' => 300, 
															 		 'name' => 'Tooltip Show Duration', 
															 		 'type' => 'text',
																	 'category' => 'thumbnails',
																	 'group' => 'Tooltip'),
									
									'tooltip_hide_duration' => array('default_value' => 300, 
															 		 'name' => 'Tooltip Hide Duration', 
															 		 'type' => 'text',
																	 'category' => 'thumbnails',
																	 'group' => 'Tooltip'),
									
									
									
									// caption settings
									// style settings
									'caption_toggle' => array('default_value' => false, 
															  'name' => 'Caption Toggle', 
															  'type' => 'checkbox',
															  'category' => 'captions',
															  'group' => 'Style'),
									
									'caption_background_opacity' => array('default_value' => 0.5, 
																		  'name' => 'Caption Background Opacity', 
																		  'type' => 'text',
																		  'category' => 'captions',
																		  'group' => 'Style'),
									
									'caption_background_color' => array('default_value' => '#000000', 
																		'name' => 'Caption Background Color', 
																		'type' => 'color',
																		'category' => 'captions',
																		'group' => 'Style'),
									
									'caption_delay' => array('default_value' => 0, 
															 'name' => 'Caption Delay', 
															 'type' => 'text',
															 'category' => 'captions',
															 'group' => 'Show Effect'),
															 
									// size and position settings
									'caption_position' => array('default_value' => 'bottom', 
																'name' => 'Caption Position', 
																'type' => 'select', 
																'list' => 'caption_position',
																'category' => 'captions',
																'group' => 'Size and Position'),
									
									'caption_size' => array('default_value' => 70, 
															'name' => 'Caption Size', 
															'type' => 'text',
															'category' => 'captions',
															'group' => 'Size and Position'),
									
									'caption_left' => array('default_value' => 50, 
															'name' => 'Caption Left', 
															'type' => 'text',
															'category' => 'captions',
															'group' => 'Size and Position'),
									
									'caption_top' => array('default_value' => 50, 
														   'name' => 'Caption Top', 
														   'type' => 'text',
														   'category' => 'captions',
														   'group' => 'Size and Position'),
									
									'caption_width' => array('default_value' => 300, 
															 'name' => 'Caption Width', 
															 'type' => 'text',
															 'category' => 'captions',
															 'group' => 'Size and Position'),
									
									'caption_height' => array('default_value' => 100, 
															  'name' => 'Caption Height', 
															  'type' => 'text',
															  'category' => 'captions',
															  'group' => 'Size and Position'),
															  
									// show effect settings
									'caption_show_effect' => array('default_value' => 'slide', 
																   'name' => 'Caption Show Effect', 
																   'type' => 'select', 
																   'list' => 'caption_effect',
																   'category' => 'captions',
																   'group' => 'Show Effect'),
									
									'caption_show_effect_duration' => array('default_value' => 500, 
																			'name' => 'Caption Show Effect Duration', 
																			'type' => 'text',
																			'category' => 'captions',
																			'group' => 'Show Effect'),
									
									'caption_show_effect_easing' => array('default_value' => 'swing', 
																		  'name' => 'Caption Show Effect Easing', 
																		  'type' => 'select', 
																		  'list' => 'easing',
																		  'category' => 'captions',
																		  'group' => 'Show Effect'),
									
									'caption_show_slide_direction' => array('default_value' => 'auto', 
																			'name' => 'Caption Show Slide Direction', 
																			'type' => 'select', 
																			'list' => 'caption_slide_direction',
																			'category' => 'captions',
																			'group' => 'Show Effect'),									
									
									// hide effect settings
									'caption_hide_effect' => array('default_value' => 'fade', 
																   'name' => 'Caption Hide Effect', 
																   'type' => 'select', 
																   'list' => 'caption_effect',
																   'category' => 'captions',
																   'group' => 'Hide Effect'),
									
									'caption_hide_effect_duration' => array('default_value' => 300, 
																			'name' => 'Caption Hide Effect Duration', 
																			'type' => 'text',
																			'category' => 'captions',
																			'group' => 'Hide Effect'),
									
									'caption_hide_effect_easing' => array('default_value' => 'swing', 
																		  'name' => 'Caption Hide Effect Easing', 
																		  'type' => 'select', 
																		  'list' => 'easing',
																		  'category' => 'captions',
																		  'group' => 'Hide Effect'),
									
									'caption_hide_slide_direction' => array('default_value' => 'auto', 
																			'name' => 'Caption Hide Slide Direction', 
																			'type' => 'select', 
																			'list' => 'caption_slide_direction',
																			'category' => 'captions',
																			'group' => 'Hide Effect'),
																			
											
																			
									// video settings
									// controllers settings
									'youtube_controller' => array('default_value' => false, 
															  	  'name' => 'Youtube Controller', 
															  	  'type' => 'checkbox',
																  'category' => 'video',
																  'group' => 'Controllers'),
									
									'vimeo_controller' => array('default_value' => false, 
															  	'name' => 'Vimeo Controller', 
															  	'type' => 'checkbox',
																'category' => 'video',
																'group' => 'Controllers'),
									
									'html5_controller' => array('default_value' => false, 
															  	'name' => 'HMTL5 Controller', 
															  	'type' => 'checkbox',
																'category' => 'video',
																'group' => 'Controllers'),
									
									'videojs_controller' => array('default_value' => false, 
															  	  'name' => 'VideoJS Controller', 
															  	  'type' => 'checkbox',
																  'category' => 'video',
																  'group' => 'Controllers'),
																  
									
									// actions settings							  
									'video_play_action' => array('default_value' => 'stopSlideshow', 
																 'name' => 'Video Play Action', 
																 'type' => 'select', 
																 'list' => 'video_play_action',
																 'category' => 'video',
																 'group' => 'Actions'),
									
									'video_pause_action' => array('default_value' => 'none', 
																  'name' => 'Video Pause Action', 
																  'type' => 'select', 
																  'list' => 'video_pause_action',
																  'category' => 'video',
																  'group' => 'Actions'),
									
									'video_end_action' => array('default_value' => 'startSlideshow', 
																'name' => 'Video End Action', 
																'type' => 'select', 
																'list' => 'video_end_action',
																'category' => 'video',
																'group' => 'Actions'),
									
									'reach_video_action' => array('default_value' => 'none', 
																  'name' => 'Reach Video Action', 
																  'type' => 'select', 
																  'list' => 'reach_video_action',
																  'category' => 'video',
																  'group' => 'Actions'),
									
									'leave_video_action' => array('default_value' => 'pauseVideo', 
																  'name' => 'Leave Video Action', 
																  'type' => 'select', 
																  'list' => 'leave_video_action',
																  'category' => 'video',
																  'group' => 'Actions'),
									
									
									
									// image resizing settings
									// slide resizing settings
									'slide_resizing_resize' => array('default_value' => false, 
															  		 'name' => 'Slide Resizing Resize', 
															  		 'type' => 'checkbox',
																	 'category' => 'image_resizing',
																	 'group' => 'Slide'),
									
									'slide_resizing_align' => array('default_value' => 'c', 
																  	'name' => 'Slide Resizing Align', 
																  	'type' => 'select', 
																  	'list' => 'resizing_align',
																	'category' => 'image_resizing',
																	'group' => 'Slide'),
									
									'slide_resizing_crop' => array('default_value' => 1, 
																   'name' => 'Slide Resizing Crop', 
																   'type' => 'select',
																   'list' => 'resizing_crop',
																   'category' => 'image_resizing',
																   'group' => 'Slide'),
									
									'slide_resizing_quality' => array('default_value' => 95, 
																	  'name' => 'Slide Resizing Quality', 
																  	  'type' => 'text',
																	  'category' => 'image_resizing',
																	  'group' => 'Slide'),
									
									'slide_resizing_width' => array('default_value' => 'auto', 
																  	'name' => 'Slide Resizing Width', 
																  	'type' => 'text',
																	'category' => 'image_resizing',
																	'group' => 'Slide'),
									
									'slide_resizing_height' => array('default_value' => 'auto', 
																  	 'name' => 'Slide Resizing Height', 
																  	 'type' => 'text',
																	 'category' => 'image_resizing',
																	 'group' => 'Slide'),
									
									// thumbnail resizing settings
									'thumbnail_resizing_resize' => array('default_value' => true, 
															  			 'name' => 'Thumbnail Resizing Resize', 
															  			 'type' => 'checkbox',
																		 'category' => 'image_resizing',
																		 'group' => 'Thumbnail'),
									
									'thumbnail_resizing_align' => array('default_value' => 'c', 
																  		'name' => 'Thumbnail Resizing Align', 
																  		'type' => 'select', 
																  		'list' => 'resizing_align',
																		'category' => 'image_resizing',
																		'group' => 'Thumbnail'),
									
									'thumbnail_resizing_crop' => array('default_value' => 1, 
																   	   'name' => 'Thumbnail Resizing Crop', 
																   	   'type' => 'select',
																	   'list' => 'resizing_crop',
																	   'category' => 'image_resizing',
																	   'group' => 'Thumbnail'),
									
									'thumbnail_resizing_quality' => array('default_value' => 95, 
																	  	  'name' => 'Thumbnail Resizing Quality', 
																  	  	  'type' => 'text',
																		  'category' => 'image_resizing',
																		  'group' => 'Thumbnail')																		  
									);



// default settings that are used for the slider's slides but are not included in the JS slider
$sliderpro_slide_extra_settings = array('slide_link_target' => '_self',
										'slide_link_lightbox' => false,
										'thumbnail_link_target' => '_self',
										'thumbnail_link_lightbox' => false);
								
												
												
// default settings for the dynamic fields
$sliderpro_slide_dynamic_settings = array('slide_type' => 'static',
										  'dynamic_posts_types' => '',
										  'dynamic_posts_taxonomies' => '',
										  'dynamic_posts_relation' => 'or',												  
										  'dynamic_posts_orderby' => 'date',
										  'dynamic_posts_order' => 'DESC', 
										  'dynamic_posts_maximum' => 10, 
										  'dynamic_posts_offset' => 0,
										  'dynamic_posts_featured' => false,
										  'dynamic_gallery_post' => '-1',
										  'dynamic_gallery_maximum' => -1, 
										  'dynamic_gallery_offset' => 0);
												  
							
												  
// default settings for the alide
$sliderpro_slide_settings = array('align_type' => array('default_value' => 'centerCenter', 
														'name' => 'Align Type', 
														'type' => 'select', 
														'list' => 'align_type',
														'group' => 'Miscellaneous'),
									
									'slideshow_delay' => array('default_value' => 5000, 
															   'name' => 'Slideshow Delay', 
															   'type' => 'text',
															   'group' => 'Miscellaneous'),
									
									'thumbnail_type' => array('default_value' => 'tooltip', 
															  'name' => 'Thumbnail Type', 
															  'type' => 'select', 
															  'list' => 'thumbnail_type',
															  'group' => 'Miscellaneous'),
									
									'effect_type' => array('default_value' => 'random', 
														   'name' => 'Effect Type', 
														   'type' => 'select', 
														   'list' => 'effect_type',
														   'group' => 'Effects General'),
									
									'slice_effect_type' => array('default_value' => 'random', 
																 'name' => 'Slice Effect Type', 
																 'type' => 'select', 
																 'list' => 'slice_effect_type',
																 'group' => 'Effects General'),
									
									'html_during_transition' => array('default_value' => true, 
																	  'name' => 'HTML During Transition', 
																	  'type' => 'checkbox',
																	  'group' => 'Effects General'),
									
									'slide_direction' => array('default_value' => 'autoHorizontal', 
															   'name' => 'Slide Direction', 
															   'type' => 'select', 
															   'list' => 'slide_direction',
															   'group' => 'Slide Effect'),
									
									'slide_loop' => array('default_value' => false, 
														  'name' => 'Slide Loop', 
														  'type' => 'checkbox',
														  'group' => 'Slide Effect'),
									
									'slide_duration' => array('default_value' => 700, 
															  'name' => 'Slide Duration', 
															  'type' => 'text',
															  'group' => 'Slide Effect'),
									
									'slide_easing' => array('default_value' => 'easeInOutExpo', 
															'name' => 'Slide Easing', 
															'type' => 'select', 
															'list' => 'easing',
															'group' => 'Slide Effect'),
									
									'slice_delay' => array('default_value' => 50, 
														   'name' => 'Slice Delay', 
														   'type' => 'text',
														   'group' => 'Slice Effect'),
									
									'slice_duration' => array('default_value' => 1000, 
															  'name' => 'Slice Duration', 
															  'type' => 'text',
															  'group' => 'Slice Effect'),
									
									'slice_easing' => array('default_value' => 'swing', 
															'name' => 'Slice Easing', 
															'type' => 'select', 
															'list' => 'easing',
															'group' => 'Slice Effect'),
									
									'horizontal_slices' => array('default_value' => 5,
																 'name' => 'Horizontal Slices', 
																 'type' => 'text',
																 'group' => 'Slice Effect'),
									
									'vertical_slices' => array('default_value' => 3, 
															   'name' => 'Vertical Slices', 
															   'type' => 'text',
															   'group' => 'Slice Effect'),
									
									'slice_pattern' => array('default_value' => 'random', 
															 'name' => 'Slice Pattern', 
															 'type' => 'select', 
															 'list' => 'slice_pattern',
															 'group' => 'Slice Effect'),
									
									'slice_point' => array('default_value' => 'centerCenter', 
														   'name' => 'Slice Point', 
														   'type' => 'select', 
														   'list' => 'slice_point',
														   'group' => 'Slice Effect'),
									
									'slice_start_position' => array('default_value' => 'left', 
																	'name' => 'Slice Start Position', 
																	'type' => 'select', 
																	'list' => 'slice_start_position',
																	'group' => 'Slice Effect'),
									
									'slice_start_ratio' => array('default_value' => 1, 
																 'name' => 'Slice Start Ratio', 
																 'type' => 'text',
																 'group' => 'Slice Effect'),
									
									'slice_fade' => array('default_value' => true, 
														  'name' => 'Slice Fade', 
														  'type' => 'checkbox',
														  'group' => 'Slice Effect'),
									
									'slide_mask' => array('default_value' => false, 
														  'name' => 'Slide Mask', 
														  'type' => 'checkbox',
														  'group' => 'Slice Effect'),
									
									'fade_previous_slide' => array('default_value' => false, 
																   'name' => 'Fade Previous Slide', 
																   'type' => 'checkbox',
																   'group' => 'Slice Effect'),
									
									'fade_previous_slide_duration' => array('default_value' => 300, 
																			'name' => 'Fade Previous Slide Duration', 
																			'type' => 'text',
																			'group' => 'Slice Effect'),
									
									'fade_in_duration' => array('default_value' => 700, 
																'name' => 'Fade In Duration', 
																'type' => 'text',
																'group' => 'Fade Effect'),
									
									'fade_out_duration' => array('default_value' => 700, 
																 'name' => 'Fade Out Duration', 
																 'type' => 'text',
																 'group' => 'Fade Effect'),
									
									'fade_in_easing' => array('default_value' => 'swing', 
															  'name' => 'Fade In Easing', 
															  'type' => 'select', 
															  'list' => 'easing',
															  'group' => 'Fade Effect'),
									
									'fade_out_easing' => array('default_value' => 'swing', 
															   'name' => 'Fade Out Easing', 
															   'type' => 'select', 
															   'list' => 'easing',
															   'group' => 'Fade Effect'),
									
									'caption_position' => array('default_value' => 'bottom', 
																'name' => 'Caption Position', 
																'type' => 'select', 
																'list' => 'caption_position',
																'group' => 'Caption'),
									
									'caption_delay' => array('default_value' => 0, 
															 'name' => 'Caption Delay', 
															 'type' => 'text',
															 'group' => 'Caption'),
									
									'caption_background_opacity' => array('default_value' => 0.5, 
																		  'name' => 'Caption Background Opacity', 
																		  'type' => 'text',
																		  'group' => 'Caption'),
									
									'caption_background_color' => array('default_value' => '#000000', 
																		'name' => 'Caption Background Color', 
																		'type' => 'color',
																		'group' => 'Caption'),
									
									'caption_show_effect' => array('default_value' => 'slide', 
																   'name' => 'Caption Show Effect', 
																   'type' => 'select', 
																   'list' => 'caption_effect',
																   'group' => 'Caption'),
									
									'caption_show_effect_duration' => array('default_value' => 500, 
																			'name' => 'Caption Show Effect Duration', 
																			'type' => 'text',
																			'group' => 'Caption'),
									
									'caption_show_effect_easing' => array('default_value' => 'swing', 
																		  'name' => 'Caption Show Effect Easing', 
																		  'type' => 'select', 
																		  'list' => 'easing',
																		  'group' => 'Caption'),
									
									'caption_show_slide_direction' => array('default_value' => 'auto', 
																			'name' => 'Caption Show Slide Direction', 
																			'type' => 'select', 
																			'list' => 'caption_slide_direction',
																			'group' => 'Caption'),
									
									'caption_hide_effect' => array('default_value' => 'fade', 
																   'name' => 'Caption Hide Effect', 
																   'type' => 'select', 
																   'list' => 'caption_effect',
																   'group' => 'Caption'),
									
									'caption_hide_effect_duration' => array('default_value' => 300, 
																			'name' => 'Caption Hide Effect Duration', 
																			'type' => 'text',
																			'group' => 'Caption'),
									
									'caption_hide_effect_easing' => array('default_value' => 'swing', 
																		  'name' => 'Caption Hide Effect Easing', 
																		  'type' => 'select', 
																		  'list' => 'easing',
																		  'group' => 'Caption'),
									
									'caption_hide_slide_direction' => array('default_value' => 'auto', 
																			'name' => 'Caption Hide Slide Direction', 
																			'type' => 'select', 
																			'list' => 'caption_slide_direction',
																			'group' => 'Caption'),
									
									'caption_size' => array('default_value' => 70, 
															'name' => 'Caption Size', 
															'type' => 'text',
															'group' => 'Caption'),
									
									'caption_left' => array('default_value' => 50, 
															'name' => 'Caption Left', 
															'type' => 'text',
															'group' => 'Caption'),
									
									'caption_top' => array('default_value' => 50, 
														   'name' => 'Caption Top', 
														   'type' => 'text',
														   'group' => 'Caption'),
									
									'caption_width' => array('default_value' => 300, 
															 'name' => 'Caption Width', 
															 'type' => 'text',
															 'group' => 'Caption'),
									
									'caption_height' => array('default_value' => 100, 
															  'name' => 'Caption Height', 
															  'type' => 'text',
															  'group' => 'Caption'));



// associates a setting with the javascript name of the property
$sliderpro_js_properties = array('width' => 'width', 
								  'height' => 'height',
								  'skin' => 'skin', 
								  'scrollbar_skin' => 'scrollbarSkin', 								  
								  'align_type' => 'alignType', 								  							  
								  'scale_type' => 'scaleType',
								  'allow_scale_up' => 'allowScaleUp',
								  'preload_nearby_images' => 'preloadNearbyImages',
								  'shuffle' => 'shuffle',
								  'slide_start' => 'slideStart',
											
								  'slideshow' => 'slideshow', 
								  'slideshow_loop' => 'slideshowLoop',
								  'slideshow_delay' => 'slideshowDelay', 
								  'slideshow_direction' => 'slideshowDirection', 
								  'slideshow_controls' => 'slideshowControls',
								  'slideshow_controls_toggle' => 'slideshowControlsToggle',
								  'slideshow_controls_show_duration' => 'slideshowControlsShowDuration',
								  'slideshow_controls_hide_duration' => 'slideshowControlsHideDuration', 
								  'pause_slideshow_on_hover' => 'pauseSlideshowOnHover', 
								  
								  'lightbox' => 'lightbox',
								  'lightbox_theme' => 'lightboxTheme',
								  'lightbox_opacity' => 'lightboxOpacity',
								  'lightbox_icon' => 'lightboxIcon',
								  'lightbox_icon_toggle' => 'lightboxIconToggle',
								  'lightbox_icon_fade_duration' => 'lightboxIconFadeDuration',
								  'thumbnail_lightbox_icon' => 'thumbnailLightboxIcon',
								  'thumbnail_lightbox_icon_toggle' => 'thumbnailLightboxIconToggle',
								  
								  'shadow' => 'shadow',
								  
								  'timer_animation' => 'timerAnimation', 
								  'timer_animation_controls' => 'timerAnimationControls',
								  'timer_fade_duration' => 'timerFadeDuration', 
								  'timer_toggle' => 'timerToggle', 
								  'timer_radius' => 'timerRadius', 
								  'timer_stroke_color1' => 'timerStrokeColor1', 
								  'timer_stroke_color2' => 'timerStrokeColor2', 
								  'timer_stroke_opacity1' => 'timerStrokeOpacity1', 
								  'timer_stroke_opacity2' => 'timerStrokeOpacity2', 
								  'timer_stroke_width1' => 'timerStrokeWidth1', 
								  'timer_stroke_width2' => 'timerStrokeWidth2', 
								  
								  'override_transition' => 'overrideTransition', 
								  'effect_type' => 'effectType',
								  'slice_effect_type' => 'sliceEffectType',
								  'initial_effect' => 'initialEffect',
								  'html_during_transition' => 'htmlDuringTransition',
								  
								  'slide_direction' => 'slideDirection', 
								  'slide_loop' => 'slideLoop', 
								  'slide_duration' => 'slideDuration', 
								  'slide_easing' => 'slideEasing', 
								 
								  'slice_delay' => 'sliceDelay', 
								  'slice_duration' => 'sliceDuration', 
								  'slice_easing' => 'sliceEasing', 
								  'horizontal_slices' => 'horizontalSlices', 
								  'vertical_slices' => 'verticalSlices', 
								  'slice_pattern' => 'slicePattern', 
								  'slice_point' => 'slicePoint', 
								  'slice_start_position' => 'sliceStartPosition', 
								  'slice_start_ratio' => 'sliceStartRatio', 
								  'slice_fade' => 'sliceFade', 
								  'slide_mask' => 'slideMask', 
								  'fade_previous_slide' => 'fadePreviousSlide',
								  'fade_previous_slide_duration' => 'fadePreviousSlideDuration',
								  
								  'fade_in_duration' => 'fadeInDuration',
								  'fade_out_duration' => 'fadeOutDuration',
								  'fade_in_easing' => 'fadeInEasing',
								  'fade_out_easing' => 'fadeOutEasing',
								
								  'swipe_orientation' => 'swipeOrientation',
								  'swipe_duration' => 'swipeDuration',
								  'swipe_back_duration' => 'swipeBackDuration',
								  'swipe_slide_distance' => 'swipeSlideDistance',
								  'swipe_easing' => 'swipeEasing',
								  'swipe_mouse_drag' => 'swipeMouseDrag',
								  'swipe_touch_drag' => 'swipeTouchDrag',
								  'swipe_grab_cursor' => 'swipeGrabCursor',
								  'swipe_threshold' => 'swipeThreshold',
								  
								  'keyboard_navigation' => 'keyboardNavigation',
								  'keyboard_navigation_on_focus_only' => 'keyboardNavigationOnFocusOnly',
								  'slide_arrows' => 'slideArrows', 
								  'slide_arrows_toggle' => 'slideArrowsToggle', 
								  'slide_arrows_show_duration' => 'slideArrowsShowDuration',
								  'slide_arrows_hide_duration' => 'slideArrowsHideDuration', 
								  'slide_buttons' => 'slideButtons', 
								  'slide_buttons_center' => 'slideButtonsCenter',									
								  'slide_buttons_container_center' => 'slideButtonsContainerCenter',									
								  'slide_buttons_toggle' => 'slideButtonsToggle',
								  'slide_buttons_show_duration' => 'slideButtonsShowDuration',
								  'slide_buttons_hide_duration' => 'slideButtonsHideDuration',
								  'slide_buttons_number' => 'slideButtonsNumber',
								  
								  'thumbnail_slide_amount' => 'thumbnailSlideAmount', 
								  'thumbnail_slide_duration' => 'thumbnailSlideDuration', 
								  'thumbnail_slide_easing' => 'thumbnailSlideEasing',
								  'thumbnail_scroller_toggle' => 'thumbnailScrollerToggle', 
								  'thumbnail_scroller_hide_duration' => 'thumbnailScrollerHideDuration',
								  'thumbnail_scroller_show_duration' => 'thumbnailScrollerShowDuration', 
								  'thumbnail_scroller_center' => 'thumbnailScrollerCenter',
								  'thumbnail_sync' => 'thumbnailSync',
								  'thumbnail_scroller_responsive' => 'thumbnailScrollerResponsive',
								  'maximum_visible_thumbnails' => 'maximumVisibleThumbnails',
								  'minimum_visible_thumbnails' => 'minimumVisibleThumbnails',
								  'thumbnail_type' => 'thumbnailType',
								  'thumbnail_width' => 'thumbnailWidth',
								  'thumbnail_height' => 'thumbnailHeight',
								  'thumbnail_orientation' => 'thumbnailOrientation', 
								  'thumbnail_layers' => 'thumbnailLayers',
								  'thumbnail_arrows' => 'thumbnailArrows', 
								  'thumbnail_arrows_toggle' => 'thumbnailArrowsToggle', 
								  'thumbnail_scroll_duration' => 'thumbnailScrollDuration', 
								  'thumbnail_scroll_easing' => 'thumbnailScrollEasing', 
								  'thumbnail_arrows_hide_duration' => 'thumbnailArrowsHideDuration', 
								  'thumbnail_arrows_show_duration' => 'thumbnailArrowsShowDuration', 
								  'thumbnail_buttons' => 'thumbnailButtons', 
								  'thumbnail_buttons_toggle' => 'thumbnailButtonsToggle',  
								  'thumbnail_buttons_hide_duration' => 'thumbnailButtonsHideDuration', 
								  'thumbnail_buttons_show_duration' => 'thumbnailButtonsShowDuration', 
								  'thumbnail_scrollbar' => 'thumbnailScrollbar', 
								  'thumbnail_scrollbar_toggle' => 'thumbnailScrollbarToggle', 
								  'thumbnail_scrollbar_hide_duration' => 'thumbnailScrollbarHideDuration',
								  'thumbnail_scrollbar_show_duration' => 'thumbnailScrollbarShowDuration', 
								  'thumbnail_scrollbar_ease' => 'thumbnailScrollbarEase',
								  'scrollbar_arrow_scroll_amount' => 'scrollbarArrowScrollAmount',								
								  'thumbnail_mouse_scroll' => 'thumbnailMouseScroll', 
								  'thumbnail_mouse_scroll_speed' => 'thumbnailMouseScrollSpeed', 
								  'thumbnail_mouse_scroll_ease' => 'thumbnailMouseScrollEase', 
								  'thumbnail_mouse_wheel' => 'thumbnailMouseWheel',
								  'thumbnail_mouse_wheel_speed' => 'thumbnailMouseWheelSpeed', 
								  'thumbnail_mouse_wheel_reverse' => 'thumbnailMouseWheelReverse',
								  'thumbnail_caption_position' => 'thumbnailCaptionPosition', 
								  'thumbnail_caption_toggle' => 'thumbnailCaptionToggle', 
								  'thumbnail_caption_effect' => 'thumbnailCaptionEffect', 
								  'thumbnail_caption_show_duration' => 'thumbnailCaptionShowDuration', 
								  'thumbnail_caption_hide_duration' => 'thumbnailCaptionHideDuration', 
								  'thumbnail_caption_easing' => 'thumbnailCaptionEasing', 
								  'thumbnail_tooltip' => 'thumbnailTooltip',
								  'tooltip_show_duration' => 'tooltipShowDuration', 
								  'tooltip_hide_duration' => 'tooltipHideDuration', 
								  
								  'caption_position' => 'captionPosition',
								  'caption_toggle' => 'captionToggle', 
								  'caption_background_opacity' => 'captionBackgroundOpacity', 
								  'caption_background_color' => 'captionBackgroundColor', 
								  'caption_show_effect' => 'captionShowEffect', 
								  'caption_show_effect_duration' => 'captionShowEffectDuration',
								  'caption_show_effect_easing' => 'captionShowEffectEasing', 
								  'caption_show_slide_direction' => 'captionShowSlideDirection', 
								  'caption_hide_effect' => 'captionHideEffect', 
								  'caption_hide_effect_duration' => 'captionHideEffectDuration',
								  'caption_hide_effect_easing' => 'captionHideEffectEasing', 
								  'caption_hide_slide_direction' => 'captionHideSlideDirection',
								  'caption_delay' => 'captionDelay', 
								  'caption_size' => 'captionSize', 
								  'caption_left' => 'captionLeft', 
								  'caption_top' => 'captionTop',
								  'caption_width' => 'captionWidth', 
								  'caption_height' => 'captionHeight',
								  
								  'video_play_action' => 'videoPlayAction',
								  'video_pause_action' => 'videoPauseAction',
								  'video_end_action' => 'videoEndAction',
								  'reach_video_action' => 'reachVideoAction',
								  'leave_video_action' => 'leaveVideoAction');
					
								  
								  
// list with all the possible roles
$sliderpro_role_access = array('Administrator' => 'manage_options', 'Editor' => 'publish_pages', 'Author' => 'publish_posts', 'Contributor' => 'edit_posts');



// add Super Admin to the roles list if the plugin is installed in a multisite environment
if (function_exists('is_multisite') && is_multisite())
	$sliderpro_role_access['Super Admin'] = 'manage_network';
	
?>