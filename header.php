<?php
/**
 * Site header.
 *
 * @package AmCham_DRC
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'amcham-drc' ); ?></a>
<header class="site-header" data-site-header>
	<div class="site-header__inner">
		<div class="brand">
			<a class="brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php if ( has_custom_logo() ) : ?>
					<?php
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					echo wp_get_attachment_image( $custom_logo_id, 'full', false, array( 'class' => 'brand__mark' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				<?php else : ?>
					<img class="brand__mark" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/amcham-logo.png' ); ?>" alt="<?php esc_attr_e( 'AmCham DRC logo', 'amcham-drc' ); ?>">
				<?php endif; ?>
				<span class="brand__text"><strong>AmCham DRC</strong><small><?php esc_html_e( 'American Chamber of Commerce', 'amcham-drc' ); ?></small></span>
			</a>
		</div>

		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu" data-menu-toggle>
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'amcham-drc' ); ?></span>
			<span></span><span></span><span></span>
		</button>
		<nav class="primary-navigation" id="primary-menu" aria-label="<?php esc_attr_e( 'Primary navigation', 'amcham-drc' ); ?>" data-primary-nav>
			<div class="primary-navigation__inner">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'fallback_cb'    => 'amcham_drc_menu_fallback',
						'menu_class'     => 'menu',
					)
				);
				?>
				<a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="nav-cta-link button button--red" style="min-height: 40px; padding: 0 16px; font-size: 11px; flex-shrink: 0; margin-bottom: 0;">
					<?php esc_html_e( 'Nous rejoindre', 'amcham-drc' ); ?>
				</a>
			</div>
		</nav>
	</div>
</header>
