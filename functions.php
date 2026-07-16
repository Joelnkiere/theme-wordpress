<?php
/**
 * Theme bootstrap for AmCham DRC.
 *
 * @package AmCham_DRC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function amcham_drc_setup() {
	load_theme_textdomain( 'amcham-drc', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 280,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	register_nav_menus(
		array(
			'primary' => __( 'Primary navigation', 'amcham-drc' ),
			'footer'  => __( 'Footer navigation', 'amcham-drc' ),
		)
	);
}
add_action( 'after_setup_theme', 'amcham_drc_setup' );

/**
 * Flush rewrite rules on theme switch so CPT archives resolve immediately.
 */
function amcham_drc_flush_rewrite_rules() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'amcham_drc_flush_rewrite_rules' );

function amcham_drc_enqueue_assets() {
	$version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'amcham-drc-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'amcham-drc-style', get_stylesheet_uri(), array(), $version );
	wp_enqueue_style( 'amcham-drc-theme', get_template_directory_uri() . '/assets/css/theme.css', array( 'amcham-drc-style' ), $version );
	wp_enqueue_script( 'amcham-drc-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), $version, true );
	wp_enqueue_script( 'amcham-drc-scroll', get_template_directory_uri() . '/assets/js/scroll-animations.js', array(), $version, true );

	if ( get_theme_mod( 'amcham_enable_chatbot', false ) ) {
		wp_enqueue_script( 'amcham-drc-chatbot', get_template_directory_uri() . '/assets/js/chatbot.js', array(), $version, true );
		wp_localize_script( 'amcham-drc-chatbot', 'amchamChatbot', array(
			'nonce' => wp_create_nonce( 'wp_rest' ),
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'amcham_drc_enqueue_assets' );

function amcham_drc_menu_fallback() {
	$items = array(
		array( __( 'Home', 'amcham-drc' ), home_url( '/' ) ),
		array( __( 'About Us', 'amcham-drc' ), home_url( '/about/' ) ),
		array( __( 'Events', 'amcham-drc' ), home_url( '/events/' ) ),
		array( __( 'News', 'amcham-drc' ), home_url( '/news/' ) ),
		array( __( 'Partners', 'amcham-drc' ), home_url( '/partners/' ) ),
		array( __( 'Membership', 'amcham-drc' ), home_url( '/membership/' ) ),
		array( __( 'Resources', 'amcham-drc' ), home_url( '/resources/' ) ),
		array( __( 'Contact', 'amcham-drc' ), home_url( '/contact/' ) ),
	);

	echo '<ul class="menu">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	foreach ( $items as $item ) {
		printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $item[1] ), esc_html( $item[0] ) );
	}
	echo '</ul>';
}

function amcham_drc_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'amcham_homepage',
		array(
			'title'    => __( 'Homepage content', 'amcham-drc' ),
			'priority' => 30,
		)
	);

	$fields = array(
		// Hero
		'hero_eyebrow' => array( __( 'Hero eyebrow', 'amcham-drc' ), __( 'The voice of American business in DRC', 'amcham-drc' ), 'text' ),
		'hero_title'    => array( __( 'Hero title', 'amcham-drc' ), __( 'Global Network, Local Impact.', 'amcham-drc' ), 'text' ),
		'hero_text'     => array( __( 'Hero description', 'amcham-drc' ), __( 'Connecting the Democratic Republic of Congo to the global marketplace through strategic American partnerships.', 'amcham-drc' ), 'textarea' ),
		'contact_email' => array( __( 'Contact email', 'amcham-drc' ), 'info@amchamdrc.org', 'email' ),
		
		// Services Section
		'services_eyebrow' => array( __( 'Services Eyebrow', 'amcham-drc' ), __( 'What we do', 'amcham-drc' ), 'text' ),
		'services_title'   => array( __( 'Services Title', 'amcham-drc' ), __( 'Strategic Services', 'amcham-drc' ), 'text' ),
		'services_desc'    => array( __( 'Services Description', 'amcham-drc' ), __( 'Comprehensive support designed to accelerate your business growth in the region.', 'amcham-drc' ), 'textarea' ),
		
		// Report Banner
		'report_eyebrow' => array( __( 'Report Eyebrow', 'amcham-drc' ), __( 'Intelligence', 'amcham-drc' ), 'text' ),
		'report_title'   => array( __( 'Report Title', 'amcham-drc' ), __( 'DRC Market Reports', 'amcham-drc' ), 'text' ),
		'report_desc'    => array( __( 'Report Description', 'amcham-drc' ), __( 'Access in-depth analysis, sector reports, and economic indicators prepared by the International Trade Administration.', 'amcham-drc' ), 'textarea' ),
		
		// Membership CTA
		'cta_eyebrow' => array( __( 'CTA Eyebrow', 'amcham-drc' ), __( 'Membership', 'amcham-drc' ), 'text' ),
		'cta_title'   => array( __( 'CTA Title', 'amcham-drc' ), __( 'Become a Member', 'amcham-drc' ), 'text' ),
		'cta_desc'    => array( __( 'CTA Description', 'amcham-drc' ), __( 'Join a prestigious network of businesses committed to excellence and growth in the DRC. Gain access to exclusive resources, advocacy, and connections.', 'amcham-drc' ), 'textarea' ),
	);

	foreach ( $fields as $id => $field ) {
		$sanitize_cb = ( 'textarea' === $field[2] ) ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( 'amcham_' . $id, array( 'default' => $field[1], 'sanitize_callback' => $sanitize_cb ) );
		$wp_customize->add_control(
			'amcham_' . $id,
			array(
				'label'   => $field[0],
				'section' => 'amcham_homepage',
				'type'    => $field[2],
			)
		);
	}

	// Chatbot Settings
	$wp_customize->add_section(
		'amcham_chatbot',
		array(
			'title'    => __( 'AI Chatbot', 'amcham-drc' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting( 'amcham_enable_chatbot', array( 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean' ) );
	$wp_customize->add_control( 'amcham_enable_chatbot', array(
		'label'   => __( 'Enable AI Chatbot', 'amcham-drc' ),
		'section' => 'amcham_chatbot',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'amcham_chatbot_title', array( 'default' => 'AmCham Assistant', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'amcham_chatbot_title', array(
		'label'   => __( 'Chatbot Title', 'amcham-drc' ),
		'section' => 'amcham_chatbot',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'amcham_chatbot_api', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'amcham_chatbot_api', array(
		'label'   => __( 'API Endpoint URL', 'amcham-drc' ),
		'section' => 'amcham_chatbot',
		'type'    => 'url',
	) );
}
add_action( 'customize_register', 'amcham_drc_customize_register' );

function amcham_drc_theme_mod( $key, $default = '' ) {
	return get_theme_mod( 'amcham_' . $key, $default );
}

/**
 * Output SEO meta description in <head>.
 */
function amcham_drc_meta_description() {
	if ( is_singular() ) {
		global $post;
		$desc = wp_strip_all_tags( get_the_excerpt( $post ) );
	} elseif ( is_archive() ) {
		$desc = wp_strip_all_tags( get_the_archive_description() );
	} else {
		$desc = wp_strip_all_tags( get_bloginfo( 'description' ) );
	}
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( wp_trim_words( $desc, 30 ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'amcham_drc_meta_description', 1 );

/**
 * Register REST API endpoint as secure proxy for the AI Chatbot.
 * This hides the real API URL from the browser source.
 */
function amcham_drc_register_chatbot_route() {
	register_rest_route(
		'amcham/v1',
		'/chat',
		array(
			'methods'             => 'POST',
			'callback'            => 'amcham_drc_chatbot_proxy',
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', 'amcham_drc_register_chatbot_route' );

function amcham_drc_chatbot_proxy( WP_REST_Request $request ) {
	$api_url = get_theme_mod( 'amcham_chatbot_api', '' );
	if ( empty( $api_url ) ) {
		return new WP_REST_Response( array( 'reply' => __( 'Le chatbot n\'est pas encore configuré.', 'amcham-drc' ) ), 200 );
	}

	$message = sanitize_text_field( $request->get_param( 'message' ) );

	$response = wp_remote_post(
		$api_url,
		array(
			'headers'     => array( 'Content-Type' => 'application/json' ),
			'body'        => wp_json_encode( array( 'message' => $message ) ),
			'timeout'     => 30,
			'data_format' => 'body',
		)
	);

	if ( is_wp_error( $response ) ) {
		return new WP_REST_Response( array( 'reply' => __( 'Erreur de connexion à l\'IA.', 'amcham-drc' ) ), 200 );
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	$reply = isset( $body['reply'] ) ? sanitize_text_field( $body['reply'] ) : __( 'Je n\'ai pas pu traiter votre demande.', 'amcham-drc' );

	return new WP_REST_Response( array( 'reply' => $reply ), 200 );
}

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Meta Boxes
 */
require get_template_directory() . '/inc/meta-boxes.php';

/**
 * Block Patterns
 */
require get_template_directory() . '/inc/block-patterns.php';

