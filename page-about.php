<?php
/**
 * Template Name: À Propos
 * Template Post Type: page
 *
 * @package AmCham_DRC
 */

get_header();
$asset_uri = get_template_directory_uri() . '/assets/images/';
?>
<main id="main-content">

	<!-- Hero -->
	<section class="page-hero">
		<div class="shell">
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'About Us', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'Connecting Economies, Empowering Business', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'AmCham DRC serves as the premier platform for American businesses operating in the Democratic Republic of Congo, fostering trade, investment, and sustainable economic growth.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<!-- Mission & Vision -->
	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="cards-2col">
				<div class="info-card">
					<div class="info-card__icon icon-circle">
						<svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><circle cx="12" cy="12" r="3"/></svg>
					</div>
					<h2><?php echo esc_html( amcham_drc_theme_mod( 'mission_title', __( 'Our Mission', 'amcham-drc' ) ) ); ?></h2>
					<p><?php echo esc_html( amcham_drc_theme_mod( 'mission_text', __( 'To promote and facilitate trade and investment between the United States and the Democratic Republic of Congo by providing advocacy, networking opportunities, and business intelligence to our members.', 'amcham-drc' ) ) ); ?></p>
				</div>
				<div class="info-card">
					<div class="info-card__icon icon-circle">
						<svg viewBox="0 0 24 24"><path d="M2 20h20M5 16l4-4 4 4 6-6M15 10V6h4v4"/></svg>
					</div>
					<h2><?php echo esc_html( amcham_drc_theme_mod( 'vision_title', __( 'Our Vision', 'amcham-drc' ) ) ); ?></h2>
					<p><?php echo esc_html( amcham_drc_theme_mod( 'vision_text', __( 'To be the leading voice of American business in the DRC, driving sustainable economic development and creating lasting partnerships that benefit both nations.', 'amcham-drc' ) ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- What We Do -->
	<section class="section">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<h2><?php esc_html_e( 'What We Do', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'AmCham DRC provides comprehensive services to support American businesses in the DRC market.', 'amcham-drc' ); ?></p>
			</div>
			<div class="service-grid" style="margin-top: 3rem;">
				<?php
				$services = array(
					array( '<svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>', __( 'Business Matchmaking', 'amcham-drc' ), __( 'Connecting US and DRC businesses for strategic partnerships and investment opportunities.', 'amcham-drc' ) ),
					array( '<svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>', __( 'Networking Events', 'amcham-drc' ), __( 'Exclusive events designed to foster connections, share insights, and build a strong business community.', 'amcham-drc' ) ),
					array( '<svg viewBox="0 0 24 24"><path d="M3 11l18-5v12L3 14v-3zM11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>', __( 'Advocacy & Dialogue', 'amcham-drc' ), __( 'Representing member interests and promoting a favorable business climate in the DRC.', 'amcham-drc' ) ),
					array( '<svg viewBox="0 0 24 24"><path d="M21.21 15.89A10 10 0 1 1 8 2.83M22 12A10 10 0 0 0 12 2v10z"/></svg>', __( 'Market Intelligence', 'amcham-drc' ), __( 'Providing critical market intelligence and guidance for successful entry into the DRC market.', 'amcham-drc' ) ),
				);
				foreach ( $services as $s ) : ?>
					<article class="service-card service-card--icon">
						<div class="icon-circle" style="margin-bottom: 1rem;"><?php echo $s[0]; ?></div>
						<div>
							<h3><?php echo esc_html( $s[1] ); ?></h3>
							<p><?php echo esc_html( $s[2] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Board of Directors -->
	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<h2><?php esc_html_e( 'Our Board of Directors', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'Meet the leadership team guiding AmCham DRC\'s mission to strengthen US-DRC business relations.', 'amcham-drc' ); ?></p>
			</div>
			<div class="team-grid">
				<?php
				$board_query = new WP_Query( array(
					'post_type'      => 'amcham_board',
					'posts_per_page' => -1,
					'order'          => 'ASC',
					'orderby'        => 'menu_order title',
				) );

				if ( $board_query->have_posts() ) :
					while ( $board_query->have_posts() ) : $board_query->the_post();
						$role = get_the_excerpt();
						$company = wp_strip_all_tags( get_the_content() );
						$name = get_the_title();
						$initials = substr( $name, 0, 1 );
						$words = explode( ' ', $name );
						if ( count( $words ) > 1 ) {
							$initials .= substr( end( $words ), 0, 1 );
						}
						$colors = array('#1a3a6b', '#b21f35', '#1d4e4e', '#6b3a1a', '#2d1a6b');
						$bg_color = $colors[ crc32( $name ) % count( $colors ) ];
					?>
						<article class="team-card">
							<div class="team-card__image-wrap">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'class' => 'team-card__photo' ) ); ?>
								<?php else : ?>
									<div class="team-card__initials" style="background: <?php echo esc_attr( $bg_color ); ?>;">
										<?php echo esc_html( strtoupper( $initials ) ); ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="team-card__content">
								<span class="team-card__role"><?php echo esc_html( $role ); ?></span>
								<h3><?php the_title(); ?></h3>
								<p><?php echo esc_html( $company ); ?></p>
							</div>
						</article>
					<?php endwhile;
					wp_reset_postdata();
				else :
					// Fallback if no custom posts exist yet
					$board = array(
						array( 'President', 'Yannick Sukakumu', 'Raxio DRC', 'YS', '#1a3a6b', 'team-yannick.png' ),
						array( 'Vice President', 'Wilmot Gibson', 'Musau Entreprise', 'WG', '#b21f35', '' ),
						array( 'Treasurer', 'Zahid Mirr', 'Keytech', 'ZM', '#1d4e4e', '' ),
						array( 'Board Member', 'Mirela Pekmezi', 'FINCA', 'MP', '#6b3a1a', '' ),
						array( 'Board Member', 'Patricia Veringa Gieskes', 'PVG Trust', 'PV', '#2d1a6b', '' ),
					);
					foreach ( $board as $member ) :
						$img_file = ! empty( $member[5] ) ? $asset_uri . $member[5] : '';
					?>
						<article class="team-card">
							<div class="team-card__image-wrap">
								<?php if ( $img_file ) : ?>
									<img src="<?php echo esc_url( $img_file ); ?>" alt="<?php echo esc_attr( $member[1] ); ?>" class="team-card__photo">
								<?php else : ?>
									<div class="team-card__initials" style="background: <?php echo esc_attr( $member[4] ); ?>;">
										<?php echo esc_html( $member[3] ); ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="team-card__content">
								<span class="team-card__role"><?php echo esc_html( $member[0] ); ?></span>
								<h3><?php echo esc_html( $member[1] ); ?></h3>
								<p><?php echo esc_html( $member[2] ); ?></p>
							</div>
						</article>
					<?php endforeach;
				endif; ?>
			</div>
		</div>
	</section>

	<!-- Core Values -->
	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<h2><?php esc_html_e( 'Our Core Values', 'amcham-drc' ); ?></h2>
			</div>
			<div class="core-values-grid" style="max-width: 860px; margin: 3rem auto 0;">
				<?php
				$values = array(
					array( '<svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>', 'Integrity', 'We conduct our business with honesty, transparency, and ethical practices, building trust with all stakeholders.' ),
					array( '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg>', 'Collaboration', 'We foster partnerships and cooperation between American and Congolese businesses to create mutual growth opportunities.' ),
					array( '<svg viewBox="0 0 24 24"><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/><circle cx="12" cy="12" r="4"/></svg>', 'Innovation', 'We embrace new ideas and approaches to address the evolving challenges and opportunities in the DRC market.' ),
					array( '<svg viewBox="0 0 24 24"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z"/></svg>', 'Sustainability', 'We promote responsible business practices that support long-term economic growth and social development.' ),
				);
				foreach ( $values as $v ) : ?>
					<article class="cv-card">
						<div class="cv-card__icon icon-circle"><?php echo $v[0]; ?></div>
						<h3><?php echo esc_html( $v[1] ); ?></h3>
						<p><?php echo esc_html( $v[2] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="membership-cta">
		<div class="shell membership-cta__inner">
			<p class="eyebrow eyebrow--red"><?php esc_html_e( 'Join Us', 'amcham-drc' ); ?></p>
			<h2><?php esc_html_e( 'Ready to Become a Member?', 'amcham-drc' ); ?></h2>
			<p><?php esc_html_e( 'Become part of a dynamic community of businesses shaping the future of US-DRC trade relations.', 'amcham-drc' ); ?></p>
			<div>
				<a class="button button--red" href="<?php echo esc_url( home_url( '/membership/' ) ); ?>"><?php esc_html_e( 'Apply for Membership', 'amcham-drc' ); ?> →</a>
				<a class="button button--ghost" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'amcham-drc' ); ?></a>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
