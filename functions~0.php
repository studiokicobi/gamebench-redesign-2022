<?php
/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once $understrap_inc_dir . $file;
}

function my_acf_add_local_field_groups() {
    remove_filter('acf_the_content', 'wpautop' );
}
add_action('acf/init', 'my_acf_add_local_field_groups');

if(function_exists('acf_add_options_page')){
  acf_add_options_page(
    array(
      'page_title' => "Theme Options",
      'menu_title' => 'Theme Options',
      'menu_slug' => 'theme-settings',
    )
  );
}

function load_more_script() {
 
	global $wp_query; 
 
	// In most cases it is already included on the page and this line can be removed
// 	wp_enqueue_script('jquery');
 
	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/loadmore.js', array('jquery') );
 
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'my_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'load_more_script' );
function loadmore_ajax_handler(){
   // prepare our arguments for the query
   $args = json_decode( stripslashes( $_POST['query'] ), true );
   $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
   $args['post_status'] = 'publish';
   if( $args['pagename'] == 'events' ) {
      $eventsArgs = array(
         'paged' => $_POST['page'] + 1,
         'post_status' => 'publish',
         'post_type' => 'event',
         'posts_per_page' => 4,
         'order' => 'ASC',
         'meta_key' => 'status',
         'meta_value' => 'Recent',
      );
      $recentEvents = new WP_Query( $eventsArgs );
      foreach ( $recentEvents->posts as $recentEvent ) {
         if ( have_rows( 'external_content', $recentEvent->ID ) ) {
            while ( have_rows( 'external_content', $recentEvent->ID ) ): the_row();
               get_template_part( 'global-templates/recent-event-listing' );
            endwhile;
         }
      }
   } else {
      query_posts( $args );
      if( have_posts() ) :
         // run the loop
         while( have_posts() ): the_post();
          get_template_part( 'global-templates/blog-listing' );
         endwhile;
      endif;
   }
   die; // here we exit the script and even no wp_reset_query() required!
}
 
add_action('wp_ajax_loadmore', 'loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler'); // wp_ajax_nopriv_{action}


function load_more_cases() {
   $args = array(
    'post_type'		=> 'case-studies',
    'order'				=> 'ASC',
  );

  // query
  $casesQuery = new WP_Query( $args );

  global $casesQuery;

 
	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');
 
	// register our main script but do not enqueue it yet
	wp_register_script( 'cases_loadmore', get_stylesheet_directory_uri() . '/js/cases.js', array('jquery') );
 
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'cases_loadmore', 'cases_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $casesQuery ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $casesQuery->max_num_pages
	) );
 
 	wp_enqueue_script( 'cases_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'load_more_cases' );

function loadmore_ajax_cases(){
 
	// prepare our arguments for the query

  $args = array(
    'post_type'		=> 'case-studies',
    'order'				=> 'ASC',
    'paged'       =>  $_POST['page'],
  );

  // query
  $the_query = new WP_Query( $args );
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( $the_query->have_posts() ):
 
		// run the loop
		while( $the_query->have_posts() ) : $the_query->the_post();

    get_template_part( 'global-templates/cases-listing' );
			
		endwhile;
 
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
add_action('wp_ajax_cases', 'loadmore_ajax_cases'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_cases', 'loadmore_ajax_cases'); // wp_ajax_nopriv_{action}

function defer_parsing_of_js( $url ) {
    if ( is_user_logged_in() ) return $url; //don't break WP Admin
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url;
    return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );