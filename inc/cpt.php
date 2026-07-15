<?php
/**
 * Custom Post Types for AmCham DRC.
 *
 * @package AmCham_DRC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Custom Post Types.
 */
function amcham_drc_register_cpts() {
	// Events (Événements)
	$event_labels = array(
		'name'                  => _x( 'Events', 'Post type general name', 'amcham-drc' ),
		'singular_name'         => _x( 'Event', 'Post type singular name', 'amcham-drc' ),
		'menu_name'             => _x( 'Events', 'Admin Menu text', 'amcham-drc' ),
		'name_admin_bar'        => _x( 'Event', 'Add New on Toolbar', 'amcham-drc' ),
		'add_new'               => __( 'Add New', 'amcham-drc' ),
		'add_new_item'          => __( 'Add New Event', 'amcham-drc' ),
		'new_item'              => __( 'New Event', 'amcham-drc' ),
		'edit_item'             => __( 'Edit Event', 'amcham-drc' ),
		'view_item'             => __( 'View Event', 'amcham-drc' ),
		'all_items'             => __( 'All Events', 'amcham-drc' ),
		'search_items'          => __( 'Search Events', 'amcham-drc' ),
		'parent_item_colon'     => __( 'Parent Events:', 'amcham-drc' ),
		'not_found'             => __( 'No events found.', 'amcham-drc' ),
		'not_found_in_trash'    => __( 'No events found in Trash.', 'amcham-drc' ),
	);

	$event_args = array(
		'labels'             => $event_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'events' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-calendar-alt',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'amcham_event', $event_args );

	// Partners (Partenaires)
	$partner_labels = array(
		'name'                  => _x( 'Partners', 'Post type general name', 'amcham-drc' ),
		'singular_name'         => _x( 'Partner', 'Post type singular name', 'amcham-drc' ),
		'menu_name'             => _x( 'Partners', 'Admin Menu text', 'amcham-drc' ),
		'name_admin_bar'        => _x( 'Partner', 'Add New on Toolbar', 'amcham-drc' ),
		'add_new'               => __( 'Add New', 'amcham-drc' ),
		'add_new_item'          => __( 'Add New Partner', 'amcham-drc' ),
		'new_item'              => __( 'New Partner', 'amcham-drc' ),
		'edit_item'             => __( 'Edit Partner', 'amcham-drc' ),
		'view_item'             => __( 'View Partner', 'amcham-drc' ),
		'all_items'             => __( 'All Partners', 'amcham-drc' ),
		'search_items'          => __( 'Search Partners', 'amcham-drc' ),
		'parent_item_colon'     => __( 'Parent Partners:', 'amcham-drc' ),
		'not_found'             => __( 'No partners found.', 'amcham-drc' ),
		'not_found_in_trash'    => __( 'No partners found in Trash.', 'amcham-drc' ),
	);

	$partner_args = array(
		'labels'             => $partner_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'partners' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'amcham_partner', $partner_args );
}
add_action( 'init', 'amcham_drc_register_cpts' );

/**
 * Sort Events by Event Date meta field on archives.
 */
function amcham_drc_sort_events( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'amcham_event' ) ) {
		$query->set( 'meta_key', '_amcham_event_date' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'amcham_drc_sort_events' );

