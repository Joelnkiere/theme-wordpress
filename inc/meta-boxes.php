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
 * Register meta boxes.
 */
function amcham_drc_add_meta_boxes() {
	// Event Details
	add_meta_box(
		'amcham_event_details',
		__( 'Event Details', 'amcham-drc' ),
		'amcham_drc_event_meta_box_html',
		'amcham_event',
		'normal',
		'high'
	);

	// Partner Details
	add_meta_box(
		'amcham_partner_details',
		__( 'Partner Details', 'amcham-drc' ),
		'amcham_drc_partner_meta_box_html',
		'amcham_partner',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'amcham_drc_add_meta_boxes' );

/**
 * Event meta box HTML.
 */
function amcham_drc_event_meta_box_html( $post ) {
	wp_nonce_field( 'amcham_drc_save_meta_box_data', 'amcham_drc_meta_box_nonce' );

	$date     = get_post_meta( $post->ID, '_amcham_event_date', true );
	$time     = get_post_meta( $post->ID, '_amcham_event_time', true );
	$location = get_post_meta( $post->ID, '_amcham_event_location', true );
	$link     = get_post_meta( $post->ID, '_amcham_event_link', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="amcham_event_date"><?php esc_html_e( 'Event Date', 'amcham-drc' ); ?></label></th>
			<td><input type="date" id="amcham_event_date" name="amcham_event_date" value="<?php echo esc_attr( $date ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="amcham_event_time"><?php esc_html_e( 'Event Time', 'amcham-drc' ); ?></label></th>
			<td><input type="time" id="amcham_event_time" name="amcham_event_time" value="<?php echo esc_attr( $time ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="amcham_event_location"><?php esc_html_e( 'Location', 'amcham-drc' ); ?></label></th>
			<td><input type="text" id="amcham_event_location" name="amcham_event_location" value="<?php echo esc_attr( $location ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="amcham_event_link"><?php esc_html_e( 'Registration / External Link', 'amcham-drc' ); ?></label></th>
			<td><input type="url" id="amcham_event_link" name="amcham_event_link" value="<?php echo esc_attr( $link ); ?>" class="regular-text" /></td>
		</tr>
	</table>
	<?php
}

/**
 * Partner meta box HTML.
 */
function amcham_drc_partner_meta_box_html( $post ) {
	wp_nonce_field( 'amcham_drc_save_meta_box_data', 'amcham_drc_meta_box_nonce' );

	$url = get_post_meta( $post->ID, '_amcham_partner_url', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="amcham_partner_url"><?php esc_html_e( 'Website URL', 'amcham-drc' ); ?></label></th>
			<td><input type="url" id="amcham_partner_url" name="amcham_partner_url" value="<?php echo esc_attr( $url ); ?>" class="regular-text" /></td>
		</tr>
	</table>
	<?php
}

/**
 * Save meta box data.
 */
function amcham_drc_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['amcham_drc_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['amcham_drc_meta_box_nonce'], 'amcham_drc_save_meta_box_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Save Event Fields
	if ( isset( $_POST['amcham_event_date'] ) ) {
		update_post_meta( $post_id, '_amcham_event_date', sanitize_text_field( wp_unslash( $_POST['amcham_event_date'] ) ) );
	}
	if ( isset( $_POST['amcham_event_time'] ) ) {
		update_post_meta( $post_id, '_amcham_event_time', sanitize_text_field( wp_unslash( $_POST['amcham_event_time'] ) ) );
	}
	if ( isset( $_POST['amcham_event_location'] ) ) {
		update_post_meta( $post_id, '_amcham_event_location', sanitize_text_field( wp_unslash( $_POST['amcham_event_location'] ) ) );
	}
	if ( isset( $_POST['amcham_event_link'] ) ) {
		update_post_meta( $post_id, '_amcham_event_link', esc_url_raw( wp_unslash( $_POST['amcham_event_link'] ) ) );
	}

	// Save Partner Fields
	if ( isset( $_POST['amcham_partner_url'] ) ) {
		update_post_meta( $post_id, '_amcham_partner_url', esc_url_raw( wp_unslash( $_POST['amcham_partner_url'] ) ) );
	}
}
add_action( 'save_post', 'amcham_drc_save_meta_box_data' );
