<?php
/**
 * UnderStrap enqueue scripts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'site-font-license', 'https://use.typekit.net/kdn3tyn.css', array(), $css_version );

		wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );

		$css_version_builder = $theme_version . '.' . filemtime( get_template_directory() . '/css/builder-components.css' );
		wp_enqueue_style( 'builder-styles', get_template_directory_uri() . '/css/builder-components.css', array(), $css_version_builder );

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );

		wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/css/slick.css', array(), $css_version );
		wp_enqueue_script( 'slick-scripts', get_template_directory_uri() . '/js/slick.js',  array(), $js_version, true );
		wp_enqueue_script( 'waitForImages-scripts', get_template_directory_uri() . '/js/waitforimages.min.js',  array(), $js_version );


		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // End of if function_exists( 'understrap_scripts' ).


function load_more_script() {

	global $wp_query;

	// In most cases it is already included on the page and this line can be removed
// 	wp_enqueue_script('jquery');

	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/loadmore.js', array('slick-scripts') );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
	) );

	wp_enqueue_script( 'my_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );
add_action( 'wp_enqueue_scripts', 'load_more_script' );
