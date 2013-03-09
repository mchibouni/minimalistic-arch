<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_enqueue_script("jquery"); ?>

<?php wp_head(); ?>
<script type="text/javascript">
jQuery(function(){
	$ = jQuery ; 
	$('body').hide().fadeIn('slow');
	var depthMenu = $('ul > li > ul > li > ul > li');
	var parentMenu = $('ul > li > ul > li ');
	parentMenu.addClass('parent-menu');
	parentMenu.children('a').addClass('parent-menu');
	depthMenu.addClass('depth-menu');
	depthMenu.children('a').addClass('parent-menu').css('color','#D9D9D9');

	$('#menu-ikbelarch-1').children().find('a').not('.parent-menu').each(function(){
		$(this).css('color','#333333');
	});

	$('#content').html('');

	$('ul.sub-menu').addClass('parent-menu');
	$('.menu-item').css('font-size','20px');
	$('.menu-item > a').css(
	{
		'outline' : 'none',
		'border'  : 'none'
	});
	$('a.previous').live('mouseenter',function(event){
		$(this).mouseenter();
		preventDefault();
		return false;
	});


	$('.menu-item-26').click(function(){

		$('#content').load('http://localhost/wordpress/wp-admin/admin-ajax.php?action=sliderpro_slider_preview&id=1',function(data){
			$.post('http://localhost/wordpress/wp-admin/admin-ajax.php',{'action':'my_ajax'},function(data){
				$('#content').append(data);
			});
		});
	});
});
</script>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<hgroup>
				<div id="ikbel-arch">
					<span class="regular bold">IKBAL</span> 
					<span class="regular">BOUAITA</span> 
					<span class="regular grayed">ARCHITECTURE</span>
				</div>
			</hgroup>

<!--		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav> 
	-->
	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
<?php endif; ?>
</header><!-- #masthead -->

<div id="main" class="wrapper">