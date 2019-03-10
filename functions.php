<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

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
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

/**
 * author: Phil Zoechner
 * from: https://wordpress.stackexchange.com/a/39818
 */
// BEGIN
add_action( 'pre_get_posts', 'my_change_sort_order_of_country_archive'); 
function my_change_sort_order_of_country_archive($query){
    if( is_archive() && is_post_type_archive('country') ):
       $query->set( 'order', 'ASC' );
       $query->set( 'orderby', 'title' );
    endif;    
};
// END

/**
 * Shortcode to display upcoming events on front page
 * TODO: limit query to upcoming events only
 * 
 * author: Phil Zoechner
 * from: https://wordpress.stackexchange.com/a/242641
 */
// BEGIN
function wpse_event_upcoming_posts() {
    $out = '';

    $args = array( 
        'numberposts' => '10', 
        'post_status' => 'publish', 
        'post_type' => 'event',
    );

    $upcoming = wp_get_recent_posts($args);

    if ($upcoming) {
		$out .= '<h1 class="entry-title m-4">Upcoming Events</h1>';
        $out .= '<ul class="list-group">';

        foreach ($upcoming as $item) {
            $out .= '<li class="list-group-item">';
            $out .= '<a href="' . get_permalink($item['ID']) . '">';
            $out .= get_the_title($item['ID']); 
            $out .= '</a></li>';
        }

        $out .= '</ul>';
    } else {
		$out = '<h1 class="entry-title">No upcoming events for now</h1>';
	}

    return $out;
}
add_shortcode( 'upcoming-events', 'wpse_event_upcoming_posts' );
// END
