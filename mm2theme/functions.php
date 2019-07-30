<?php

// require_once('wp_bootstrap_navwalker.php');


// require_once get_template_directory() . '/wp_bootstrap_navwalker.php';


if ( ! file_exists( get_template_directory() . '/wp_bootstrap_navwalker.php' ) ) {
	// file does not exist... return an error.
	return new WP_Error( 'wp-bootstrap-navwalker-missing', __( 'It appears the wp_bootstrap_navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
	// file exists... require it.
    require_once get_template_directory() . '/wp_bootstrap_navwalker.php';
}



/*-----------------------------------------------------------------------------------*/
/*	Theme Setup
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'site_setup' ) ) :

function site_setup() {
    // Add Menu Support
    add_theme_support('menus');

    // Register Menus
    register_nav_menus( array(
       'primary' => __('Primary Menu','mmd2theme') // Main Navigation
//        'footer-menu' => __('Quicklinks','mmd2theme') // Footer Navigation
    ));

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

/* Add support for side bar */
if( function_exists('acf_add_options_page') ) {

	$args = array(
		/* (string) The title displayed on the options page. Required. */
		'page_title' => 'Global Variables',

		/* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID (123), or a string ('user_2').
		Defaults to 'options'. Added in v5.2.7 */
		'post_id' => 'globalitems',
	);

	acf_add_options_page( $args );

}

/*-----------------------------------------------------------------------------------*/
/*	Functions
/*-----------------------------------------------------------------------------------*/

// Load scripts
function main_enqueue_scripts()
{
   if (!is_admin()) {

		wp_register_script('jquery',get_template_directory_uri() . '/lib/jquery/jquery-3.2.1.min.js');
		wp_enqueue_script('jquery');

		wp_register_script('popper',get_template_directory_uri() . '/lib/popper.min.js');
        wp_enqueue_script('popper');

		// do i need instead ??? https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js
		wp_register_script('bootstrap',get_template_directory_uri() . '/lib/bootstrap/js/bootstrap.min.js');
		wp_enqueue_script('bootstrap');  

    	// wp_register_script('waves',get_template_directory_uri() . '/lib/waves.min.js');
        // wp_enqueue_script('waves');

		// wp_register_script('cookie',get_template_directory_uri() . '/js/cookie.js');
        // wp_enqueue_script('cookie');


    	wp_register_script('main',get_template_directory_uri() . '/js/main.js');
        wp_enqueue_script('main');

    	
		// wp_register_script('weather',get_template_directory_uri() . '/js/weather.js');
        // wp_enqueue_script('weather');
   


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
}
add_action('wp_enqueue_scripts', 'main_enqueue_scripts'); // Add Custom Scripts to wp_head
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

//bootstrap pagination
function custom_pagination() {
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'   => TRUE,
			'prev_text'    => __('«'),
			'next_text'    => __('»'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<ul class="pagination">';
            foreach ( $pages as $page ) {
                    echo "<li>$page</li>";
            } 
           echo '</ul>';
        }
}


//Pagination
//This is the blog paging controls
function main_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {  
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	echo custom_pagination();

}

function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 35;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



/**
 * Conditionally Override Yoast SEO Breadcrumb Trail
 * http://plugins.svn.wordpress.org/wordpress-seo/trunk/frontend/class-breadcrumbs.php
 * -----------------------------------------------------------------------------------
 */

add_filter( 'wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail' );

function wpse_100012_override_yoast_breadcrumb_trail( $links ) {
    global $post;

    if ( is_singular( array( 'photos' ) ) || (is_archive() ) ) {

        $breadcrumb[] = array(
//            'url' => get_permalink( get_page_by_title( 'dfgdfgd' ) ),
//			            'url' => get_permalink( get_option( 'category' ) ),
			            'url' => '/before-and-after/',

            'text' => 'Before and After'
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }

    return $links;
}

//convert to the slug format according to conventions
//by pulling out the spaces and the symbols and making lowercase
function urlconvert( $procedurename ) {
	$procedurename = strtolower( $procedurename );
	$procedurename = str_replace( " ", "-", $procedurename);
	$procedurename = str_replace( "&trade;", "", $procedurename);
	$procedurename = str_replace( "&reg;", "", $procedurename);
	//$procedurename = mb_ereg_replace( "[^a-z]", "", $procedurename);
	return $procedurename;
}



// remove version from head
remove_action('wp_head', 'wp_generator');

// remove version from rss
add_filter('the_generator', '__return_empty_string');

// remove version from scripts and styles
function shapeSpace_remove_version_scripts_styles($src) {
	if (strpos($src, 'ver=')) {
		$src = remove_query_arg('ver', $src);
	}
	return $src;
}
add_filter('style_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);


?>
