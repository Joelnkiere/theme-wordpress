<?php
/**
 * Custom Meta Boxes for AmCham DRC theme.
 *
 * @package AmCham_DRC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Media Uploader for Custom Fields
 */
function amcham_drc_admin_scripts( $hook ) {
	global $post;
	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
		wp_enqueue_media();
	}
}
add_action( 'admin_enqueue_scripts', 'amcham_drc_admin_scripts' );

function amcham_drc_admin_footer_js() {
	?>
	<script>
	jQuery(document).ready(function($){
		var file_frame;
		$('.amcham-upload-button').on('click', function(e) {
			e.preventDefault();
			var button = $(this);
			var target = $(button.data('target'));
			if ( file_frame ) {
				file_frame.open();
				return;
			}
			file_frame = wp.media.frames.file_frame = wp.media({
				title: '<?php esc_html_e( 'Select or Upload a File', 'amcham-drc' ); ?>',
				button: { text: '<?php esc_html_e( 'Use this file', 'amcham-drc' ); ?>' },
				multiple: false
			});
			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				target.val(attachment.url);
			});
			file_frame.open();
		});
	});
	</script>
	<?php
}
add_action( 'admin_footer', 'amcham_drc_admin_footer_js' );

/**
 * Register Event & Partner meta boxes.
 */
function amcham_drc_add_meta_boxes() {
	add_meta_box( 'amcham_event_details', __( 'Event Details', 'amcham-drc' ), 'amcham_drc_event_meta_box_html', 'amcham_event', 'normal', 'high' );
	add_meta_box( 'amcham_partner_details', __( 'Partner Details', 'amcham-drc' ), 'amcham_drc_partner_meta_box_html', 'amcham_partner', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'amcham_drc_add_meta_boxes' );

function amcham_drc_event_meta_box_html( $post ) {
	wp_nonce_field( 'amcham_drc_save_meta_box_data', 'amcham_drc_meta_box_nonce' );
	$date     = get_post_meta( $post->ID, '_amcham_event_date', true );
	$time     = get_post_meta( $post->ID, '_amcham_event_time', true );
	$location = get_post_meta( $post->ID, '_amcham_event_location', true );
	$link     = get_post_meta( $post->ID, '_amcham_event_link', true );
	?>
	<table class="form-table">
		<tr><th><label for="amcham_event_date"><?php esc_html_e( 'Event Date', 'amcham-drc' ); ?></label></th><td><input type="date" id="amcham_event_date" name="amcham_event_date" value="<?php echo esc_attr( $date ); ?>" class="regular-text" /></td></tr>
		<tr><th><label for="amcham_event_time"><?php esc_html_e( 'Event Time', 'amcham-drc' ); ?></label></th><td><input type="time" id="amcham_event_time" name="amcham_event_time" value="<?php echo esc_attr( $time ); ?>" class="regular-text" /></td></tr>
		<tr><th><label for="amcham_event_location"><?php esc_html_e( 'Location', 'amcham-drc' ); ?></label></th><td><input type="text" id="amcham_event_location" name="amcham_event_location" value="<?php echo esc_attr( $location ); ?>" class="regular-text" /></td></tr>
		<tr><th><label for="amcham_event_link"><?php esc_html_e( 'Registration / External Link', 'amcham-drc' ); ?></label></th><td><input type="url" id="amcham_event_link" name="amcham_event_link" value="<?php echo esc_attr( $link ); ?>" class="regular-text" /></td></tr>
	</table>
	<?php
}

function amcham_drc_partner_meta_box_html( $post ) {
	wp_nonce_field( 'amcham_drc_save_meta_box_data', 'amcham_drc_meta_box_nonce' );
	$url = get_post_meta( $post->ID, '_amcham_partner_url', true );
	?>
	<table class="form-table">
		<tr><th><label for="amcham_partner_url"><?php esc_html_e( 'Website URL', 'amcham-drc' ); ?></label></th><td><input type="url" id="amcham_partner_url" name="amcham_partner_url" value="<?php echo esc_attr( $url ); ?>" class="regular-text" /></td></tr>
	</table>
	<?php
}

function amcham_drc_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['amcham_drc_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['amcham_drc_meta_box_nonce'], 'amcham_drc_save_meta_box_data' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	if ( isset( $_POST['amcham_event_date'] ) ) { update_post_meta( $post_id, '_amcham_event_date', sanitize_text_field( wp_unslash( $_POST['amcham_event_date'] ) ) ); }
	if ( isset( $_POST['amcham_event_time'] ) ) { update_post_meta( $post_id, '_amcham_event_time', sanitize_text_field( wp_unslash( $_POST['amcham_event_time'] ) ) ); }
	if ( isset( $_POST['amcham_event_location'] ) ) { update_post_meta( $post_id, '_amcham_event_location', sanitize_text_field( wp_unslash( $_POST['amcham_event_location'] ) ) ); }
	if ( isset( $_POST['amcham_event_link'] ) ) { update_post_meta( $post_id, '_amcham_event_link', esc_url_raw( wp_unslash( $_POST['amcham_event_link'] ) ) ); }
	if ( isset( $_POST['amcham_partner_url'] ) ) { update_post_meta( $post_id, '_amcham_partner_url', esc_url_raw( wp_unslash( $_POST['amcham_partner_url'] ) ) ); }
}
add_action( 'save_post', 'amcham_drc_save_meta_box_data' );

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
	<p><label for="amcham_parent_group"><strong><?php _e( 'Parent Group', 'amcham-drc' ); ?></strong></label><br><input type="text" id="amcham_parent_group" name="amcham_parent_group" value="<?php echo esc_attr( $parent_group ); ?>" size="25" /></p>
	<p><label for="amcham_location"><strong><?php _e( 'Location', 'amcham-drc' ); ?></strong></label><br><input type="text" id="amcham_location" name="amcham_location" value="<?php echo esc_attr( $location ); ?>" size="25" /></p>
	<p><label for="amcham_website"><strong><?php _e( 'Website URL (e.g. www.example.com)', 'amcham-drc' ); ?></strong></label><br><input type="text" id="amcham_website" name="amcham_website" value="<?php echo esc_attr( $website ); ?>" size="25" /></p>
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
		<input type="url" id="amcham_file_url" name="amcham_file_url" value="<?php echo esc_url( $file_url ); ?>" style="width: 70%;" />
		<button class="button amcham-upload-button" data-target="#amcham_file_url"><?php _e( 'Upload File', 'amcham-drc' ); ?></button>
	</p>
	<p>
		<label for="amcham_badge"><strong><?php _e( 'Access Level', 'amcham-drc' ); ?></strong></label><br>
		<select id="amcham_badge" name="amcham_badge">
			<option value="Free" <?php selected( $badge, 'Free' ); ?>><?php _e( 'Free', 'amcham-drc' ); ?></option>
			<option value="Members Only" <?php selected( $badge, 'Members Only' ); ?>><?php _e( 'Members Only', 'amcham-drc' ); ?></option>
		</select>
	</p>
	<p><em>Note: Use the Excerpt field to set the description. Add a Resource Type category on the right.</em></p>
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
	<p><label for="amcham_price"><strong><?php _e( 'Price (e.g. $2,000 / year)', 'amcham-drc' ); ?></strong></label><br><input type="text" id="amcham_price" name="amcham_price" value="<?php echo esc_attr( $price ); ?>" size="25" /></p>
	<p><label><input type="checkbox" name="amcham_is_featured" value="1" <?php checked( $is_featured, '1' ); ?> /> <strong><?php _e( 'Highlight this tier (Featured)', 'amcham-drc' ); ?></strong></label></p>
	<p><em>Note: Use the Excerpt field for the short description. Use the main content editor to list the features (one per line).</em></p>
	<?php
}

function amcham_sponsor_meta_box_callback( $post ) {
	wp_nonce_field( 'amcham_sponsor_save_meta_box_data', 'amcham_sponsor_meta_box_nonce' );
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

// Add Meta Boxes for Committees
function amcham_committee_add_meta_boxes() {
	add_meta_box( 'amcham_committee_details', __( 'Committee Details', 'amcham-drc' ), 'amcham_committee_meta_box_callback', 'amcham_committee', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'amcham_committee_add_meta_boxes' );

function amcham_committee_meta_box_callback( $post ) {
	wp_nonce_field( 'amcham_committee_save_meta_box_data', 'amcham_committee_meta_box_nonce' );
	$chair = get_post_meta( $post->ID, '_amcham_committee_chair', true );
	?>
	<p>
		<label for="amcham_committee_chair"><strong><?php _e( 'Committee Chair', 'amcham-drc' ); ?></strong></label><br>
		<input type="text" id="amcham_committee_chair" name="amcham_committee_chair" value="<?php echo esc_attr( $chair ); ?>" size="40" />
	</p>
	<p><em>Note: Use the Excerpt field to set the Focus areas (comma separated).</em></p>
	<?php
}

function amcham_committee_save_meta_box_data( $post_id ) {
	if ( isset( $_POST['amcham_committee_meta_box_nonce'] ) && wp_verify_nonce( $_POST['amcham_committee_meta_box_nonce'], 'amcham_committee_save_meta_box_data' ) && current_user_can( 'edit_post', $post_id ) ) {
		if ( isset( $_POST['amcham_committee_chair'] ) ) { update_post_meta( $post_id, '_amcham_committee_chair', sanitize_text_field( $_POST['amcham_committee_chair'] ) ); }
	}
}
add_action( 'save_post', 'amcham_committee_save_meta_box_data' );
