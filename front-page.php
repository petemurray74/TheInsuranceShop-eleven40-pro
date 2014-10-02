<?php
/**
 * This file adds the Landing template to the eleven40 Pro Theme.
 *
 * @author StudioPress
 * @package eleven40 Pro
 * @subpackage Customizations
 */

/*
Template Name: Home Page
*/

//* Add landing body class to the head
add_filter( 'body_class', 'eleven40_add_body_class' );
function eleven40_add_body_class( $classes ) {

	$classes[] = 'eleven40-front-page';
	return $classes;

}

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

//* Remove eleven40 page title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');

//* Run the Genesis loop
genesis();
