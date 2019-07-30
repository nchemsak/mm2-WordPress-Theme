<?php

// require_once('wp_bootstrap_navwalker.php');
// require_once get_template_directory() . '/wp_bootstrap_navwalker.php';


// if ( ! file_exists( get_template_directory() . '/wp_bootstrap_navwalker.php' ) ) {
// 	// file does not exist... return an error.
// 	return new WP_Error( 'wp-bootstrap-navwalker-missing', __( 'It appears the wp_bootstrap_navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
// } else {
// 	// file exists... require it.
//     require_once get_template_directory() . '/wp_bootstrap_navwalker.php';
// }



/*-----------------------------------------------------------------------------------*/
/*	Theme Setup
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'site_setup' ) ) :

function site_setup() {
    // Add Menu Support
    add_theme_support('menus');

    // Register Menus
    // register_nav_menus( array(
    //    'primary' => __('Primary Menu','mmd2theme') 
    //    // Main Navigation
      
    // ));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( 'css/editor-style.css' );
}

endif; // end main set-up function
add_action( 'after_setup_theme', 'site_setup' );


/*-----------------------------------------------------------------------------------*/
/*	Functions
/*-----------------------------------------------------------------------------------*/

// Load scripts
// function main_enqueue_scripts()
// {
   if (!is_admin()) {
		// wp_deregister_script('jquery');
		// wp_register_script('jquery', ("/lib/jquery/jquery-3.2.1.min.js"), false);
		// wp_enqueue_script('jquery');


	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
	wp_enqueue_script('jquery');


		wp_register_script('popper',get_template_directory_uri() . '/lib/popper.min.js');
        wp_enqueue_script('popper');

		// do i need instead ??? https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
		wp_register_script('bootstrap',get_template_directory_uri() . '/lib/bootstrap/js/bootstrap.min.js');
		wp_enqueue_script('bootstrap');  

    	// wp_register_script('waves',get_template_directory_uri() . '/lib/waves.min.js');
        // wp_enqueue_script('waves');

		wp_register_script('cookie',get_template_directory_uri() . '/js/cookie.js');
        wp_enqueue_script('cookie');


    	wp_register_script('main',get_template_directory_uri() . '/js/main.js');
        wp_enqueue_script('main');

    	
		wp_register_script('weather',get_template_directory_uri() . '/js/weather.js');
        wp_enqueue_script('weather');
   


	 //   	if (is_front_page()) {
	 //   	if (is_sequencer page...however that is written()) {

	// wp_register_script('sequencer',get_template_directory_uri() . '/js/sequencer.js');
        // wp_enqueue_script('sequencer');

	// wp_register_script('theremin',get_template_directory_uri() . '/js/theremin.js');
        // wp_enqueue_script('theremin');

	// wp_register_script('liveinput',get_template_directory_uri() . '/js/liveinput.js');
        // wp_enqueue_script('liveinput');

		// }



    }
// }
// add_action('wp_enqueue_scripts', 'main_enqueue_scripts'); // Add Custom Scripts to wp_head
add_theme_support( 'post-thumbnails');
set_post_thumbnail_size( 200, 200, false );

// Load CSS styles
function main_enqueue_css() 
{

    wp_register_style('bootstrap-css', get_template_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style('bootstrap-css');

	// ???
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );

	wp_register_style('fontawesome-css', get_template_directory_uri() . '/lib/fontawesome-5.6.3-web/css/all.min.css');
    wp_enqueue_style('fontawesome-css');

	wp_register_style('main-css', get_template_directory_uri() . '/css/styles.min.css' );
   	wp_enqueue_style('main-css');

	wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Press+Start+2P', false);

	
}
add_action('wp_enqueue_scripts', 'main_enqueue_css'); // Add Theme Stylesheet



function obscure_login_errors(){
  return "Hack muh nutz...";
}
add_filter( 'login_errors', 'obscure_login_errors' );



// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link'); 
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);



// enable threaded comments - NOT sure why I'd need this...https://digwp.com/2010/03/wordpress-functions-php-template-custom-functions/
function enable_threaded_comments(){
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
			wp_enqueue_script('comment-reply');
		}
}
add_action('get_header', 'enable_threaded_comments');

// add google analytics to footer
// function add_google_analytics() {
// 	echo '<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>';
// 	echo '<script type="text/javascript">';
// 	echo 'var pageTracker = _gat._getTracker("UA-XXXXX-X");';
// 	echo 'pageTracker._trackPageview();';
// 	echo '</script>';
// }
// add_action('wp_footer', 'add_google_analytics');


// function wpb_custom_logo() {
// echo '
// <style type="text/css">
// #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
// background-image: url(' . get_bloginfo('stylesheet_directory') . '/images/icons/arrowkey.png) !important;
// background-position: 0 0;
// color:rgba(0, 0, 0, 0);
// }
// #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon { 
// background-position: 0 0;
// }
// </style>
// ';
// }
// //hook into the administrative header output
// add_action('wp_before_admin_bar_render', 'wpb_custom_logo');
?>
