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

// Add Meta Boxes for Member Directory
function amcham_directory_add_meta_boxes() {
	add_meta_box( 'amcham_directory_details', __( 'Company Details', 'amcham-drc' ), 'amcham_directory_meta_box_callback', 'amcham_directory', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'amcham_directory_add_meta_boxes' );

function amcham_directory_meta_box_callback( $post ) {
	wp_nonce_field( 'amcham_directory_save_meta_box_data', 'amcham_directory_meta_box_nonce' );
	$parent_group = get_post_meta( $post->ID, '_amcham_parent_group', true );
	$location = get_post_meta( $post->ID, '_amcham_location', true );
	$website = get_post_meta( $post->ID, '_amcham_website', true );
	?>
	<p>
		<label for="amcham_parent_group"><strong><?php _e( 'Parent Group', 'amcham-drc' ); ?></strong></label><br>
		<input type="text" id="amcham_parent_group" name="amcham_parent_group" value="<?php echo esc_attr( $parent_group ); ?>" size="25" />
	</p>
	<p>
		<label for="amcham_location"><strong><?php _e( 'Location', 'amcham-drc' ); ?></strong></label><br>
		<input type="text" id="amcham_location" name="amcham_location" value="<?php echo esc_attr( $location ); ?>" size="25" />
	</p>
	<p>
		<label for="amcham_website"><strong><?php _e( 'Website URL (e.g. www.example.com)', 'amcham-drc' ); ?></strong></label><br>
		<input type="text" id="amcham_website" name="amcham_website" value="<?php echo esc_attr( $website ); ?>" size="25" />
	</p>
	<p><em>Note: Use the Excerpt field to set the Industry (e.g., Mining, Finance). Use the Title for the Company Name.</em></p>
	<?php
}

function amcham_directory_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['amcham_directory_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['amcham_directory_meta_box_nonce'], 'amcham_directory_save_meta_box_data' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	if ( isset( $_POST['amcham_parent_group'] ) ) { update_post_meta( $post_id, '_amcham_parent_group', sanitize_text_field( $_POST['amcham_parent_group'] ) ); }
	if ( isset( $_POST['amcham_location'] ) ) { update_post_meta( $post_id, '_amcham_location', sanitize_text_field( $_POST['amcham_location'] ) ); }
	if ( isset( $_POST['amcham_website'] ) ) { update_post_meta( $post_id, '_amcham_website', sanitize_text_field( $_POST['amcham_website'] ) ); }
}
add_action( 'save_post', 'amcham_directory_save_meta_box_data' );

// Add Meta Boxes for Resources
function amcham_resource_add_meta_boxes() {
	add_meta_box( 'amcham_resource_details', __( 'Resource Details', 'amcham-drc' ), 'amcham_resource_meta_box_callback', 'amcham_resource', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'amcham_resource_add_meta_boxes' );

function amcham_resource_meta_box_callback( $post ) {
	wp_nonce_field( 'amcham_resource_save_meta_box_data', 'amcham_resource_meta_box_nonce' );
	$file_url = get_post_meta( $post->ID, '_amcham_file_url', true );
	$badge = get_post_meta( $post->ID, '_amcham_badge', true );
	?>
	<p>
		<label for="amcham_file_url"><strong><?php _e( 'File URL / Link', 'amcham-drc' ); ?></strong></label><br>
		<input type="url" id="amcham_file_url" name="amcham_file_url" value="<?php echo esc_url( $file_url ); ?>" style="width: 100%;" />
	</p>
	<p>
		<label for="amcham_badge"><strong><?php _e( 'Access Level', 'amcham-drc' ); ?></strong></label><br>
		<select id="amcham_badge" name="amcham_badge">
			<option value="Free" <?php selected( $badge, 'Free' ); ?>><?php _e( 'Free', 'amcham-drc' ); ?></option>
			<option value="Members Only" <?php selected( $badge, 'Members Only' ); ?>><?php _e( 'Members Only', 'amcham-drc' ); ?></option>
		</select>
	</p>
	<p><em>Note: Use the Excerpt field to set the description. Add a Resource Type category (e.g. Market Insights, Publications, External Resources) on the right.</em></p>
	<?php
}

function amcham_resource_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['amcham_resource_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['amcham_resource_meta_box_nonce'], 'amcham_resource_save_meta_box_data' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	if ( isset( $_POST['amcham_file_url'] ) ) { update_post_meta( $post_id, '_amcham_file_url', esc_url_raw( $_POST['amcham_file_url'] ) ); }
	if ( isset( $_POST['amcham_badge'] ) ) { update_post_meta( $post_id, '_amcham_badge', sanitize_text_field( $_POST['amcham_badge'] ) ); }
}
add_action( 'save_post', 'amcham_resource_save_meta_box_data' );
// Add Meta Boxes for Memberships and Sponsors
function amcham_membership_add_meta_boxes() {
	add_meta_box( 'amcham_membership_details', __( 'Membership Details', 'amcham-drc' ), 'amcham_membership_meta_box_callback', 'amcham_membership', 'normal', 'high' );
	add_meta_box( 'amcham_sponsor_details', __( 'Sponsorship Details', 'amcham-drc' ), 'amcham_sponsor_meta_box_callback', 'amcham_sponsor', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'amcham_membership_add_meta_boxes' );

function amcham_membership_meta_box_callback( $post ) {
	wp_nonce_field( 'amcham_membership_save_meta_box_data', 'amcham_membership_meta_box_nonce' );
	$price = get_post_meta( $post->ID, '_amcham_price', true );
	$is_featured = get_post_meta( $post->ID, '_amcham_is_featured', true );
	?>
	<p>
		<label for="amcham_price"><strong><?php _e( 'Price (e.g. $2,000 / year)', 'amcham-drc' ); ?></strong></label><br>
		<input type="text" id="amcham_price" name="amcham_price" value="<?php echo esc_attr( $price ); ?>" size="25" />
	</p>
	<p>
		<label><input type="checkbox" name="amcham_is_featured" value="1" <?php checked( $is_featured, '1' ); ?> /> <strong><?php _e( 'Highlight this tier (Featured)', 'amcham-drc' ); ?></strong></label>
	</p>
	<p><em>Note: Use the Excerpt field for the short description. Use the main content editor to list the features (one per line).</em></p>
	<?php
}

function amcham_sponsor_meta_box_callback( $post ) {
	wp_nonce_field( 'amcham_sponsor_save_meta_box_data', 'amcham_sponsor_meta_box_nonce' );
	// We'll use the main content editor for the benefits list (one per line)
	?>
	<p><em>Note: Use the Title for the Sponsorship Level (e.g. Platinum). Use the Excerpt for the short description. Use the main content editor to list the benefits (one per line).</em></p>
	<?php
}

function amcham_membership_save_meta_box_data( $post_id ) {
	if ( isset( $_POST['amcham_membership_meta_box_nonce'] ) && wp_verify_nonce( $_POST['amcham_membership_meta_box_nonce'], 'amcham_membership_save_meta_box_data' ) && current_user_can( 'edit_post', $post_id ) ) {
		if ( isset( $_POST['amcham_price'] ) ) { update_post_meta( $post_id, '_amcham_price', sanitize_text_field( $_POST['amcham_price'] ) ); }
		$is_featured = isset( $_POST['amcham_is_featured'] ) ? '1' : '0';
		update_post_meta( $post_id, '_amcham_is_featured', $is_featured );
	}
}
add_action( 'save_post', 'amcham_membership_save_meta_box_data' );
