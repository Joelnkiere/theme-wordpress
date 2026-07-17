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
	// Board Members
	register_post_type( 'amcham_board', array(
		'labels' => array(
			'name' => _x( 'Board Members', 'Post type general name', 'amcham-drc' ),
			'singular_name' => _x( 'Board Member', 'Post type singular name', 'amcham-drc' ),
			'menu_name' => _x( 'Board Members', 'Admin Menu text', 'amcham-drc' ),
		),
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'menu_position' => 22,
		'menu_icon' => 'dashicons-businessman',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );

	// Committees
	register_post_type( 'amcham_committee', array(
		'labels' => array(
			'name' => _x( 'Committees', 'Post type general name', 'amcham-drc' ),
			'singular_name' => _x( 'Committee', 'Post type singular name', 'amcham-drc' ),
			'menu_name' => _x( 'Committees', 'Admin Menu text', 'amcham-drc' ),
		),
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'menu_position' => 23,
		'menu_icon' => 'dashicons-networking',
		'supports' => array( 'title', 'editor', 'excerpt' ),
		'show_in_rest' => true,
	) );

	// Services
	register_post_type( 'amcham_service', array(
		'labels' => array(
			'name' => _x( 'Services', 'Post type general name', 'amcham-drc' ),
			'singular_name' => _x( 'Service', 'Post type singular name', 'amcham-drc' ),
			'menu_name' => _x( 'Services', 'Admin Menu text', 'amcham-drc' ),
		),
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'menu_position' => 24,
		'menu_icon' => 'dashicons-portfolio',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );
	// Resources
	register_post_type( 'amcham_resource', array(
		'labels' => array(
			'name' => _x( 'Resources', 'Post type general name', 'amcham-drc' ),
			'singular_name' => _x( 'Resource', 'Post type singular name', 'amcham-drc' ),
			'menu_name' => _x( 'Resources', 'Admin Menu text', 'amcham-drc' ),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'menu_position' => 25,
		'menu_icon' => 'dashicons-media-document',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'show_in_rest' => true,
	) );

	// Resource Type Taxonomy
	register_taxonomy( 'resource_type', array( 'amcham_resource' ), array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Resource Types', 'Taxonomy General Name', 'amcham-drc' ),
			'singular_name' => _x( 'Resource Type', 'Taxonomy Singular Name', 'amcham-drc' ),
			'menu_name' => __( 'Resource Types', 'amcham-drc' ),
		),
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'show_in_rest' => true,
	) );

	// Member Directory (Partners) -> actually let's use the existing amcham_partner or register amcham_directory. Let's register amcham_directory to be safe.
	register_post_type( 'amcham_directory', array(
		'labels' => array(
			'name' => _x( 'Member Directory', 'Post type general name', 'amcham-drc' ),
			'singular_name' => _x( 'Directory Member', 'Post type singular name', 'amcham-drc' ),
			'menu_name' => _x( 'Member Directory', 'Admin Menu text', 'amcham-drc' ),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'menu_position' => 26,
		'menu_icon' => 'dashicons-building',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ), // Title=Company, Excerpt=Industry, Content=Bio. We need Parent Group, Location, Website. We can use Custom Fields.
		'show_in_rest' => true,
	) );
	// Membership Tiers
	register_post_type( 'amcham_membership', array(
		'labels' => array(
			'name' => _x( 'Membership Tiers', 'Post type general name', 'amcham-drc' ),
			'singular_name' => _x( 'Membership Tier', 'Post type singular name', 'amcham-drc' ),
			'menu_name' => _x( 'Memberships', 'Admin Menu text', 'amcham-drc' ),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'menu_position' => 27,
		'menu_icon' => 'dashicons-groups',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ), // Title=Name, Excerpt=Price, Editor=Features list
		'show_in_rest' => true,
	) );

	// Sponsors
	register_post_type( 'amcham_sponsor', array(
		'labels' => array(
			'name' => _x( 'Sponsorships', 'Post type general name', 'amcham-drc' ),
			'singular_name' => _x( 'Sponsorship', 'Post type singular name', 'amcham-drc' ),
			'menu_name' => _x( 'Sponsorships', 'Admin Menu text', 'amcham-drc' ),
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'menu_position' => 28,
		'menu_icon' => 'dashicons-awards',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ), // Title=Level, Excerpt=Description, Editor=Benefits list
		'show_in_rest' => true,
	) );
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
