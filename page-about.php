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
	<section class="section">
		<div class="shell">
			<div class="cards-2col">
				<div class="info-card">
					<div class="info-card__icon">🎯</div>
					<h2><?php esc_html_e( 'Our Mission', 'amcham-drc' ); ?></h2>
					<p><?php esc_html_e( 'To promote and facilitate trade and investment between the United States and the Democratic Republic of Congo by providing advocacy, networking opportunities, and business intelligence to our members.', 'amcham-drc' ); ?></p>
				</div>
				<div class="info-card">
					<div class="info-card__icon">📈</div>
					<h2><?php esc_html_e( 'Our Vision', 'amcham-drc' ); ?></h2>
					<p><?php esc_html_e( 'To be the leading voice of American business in the DRC, driving sustainable economic development and creating lasting partnerships that benefit both nations.', 'amcham-drc' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- What We Do -->
	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<h2><?php esc_html_e( 'What We Do', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'AmCham DRC provides comprehensive services to support American businesses in the DRC market.', 'amcham-drc' ); ?></p>
			</div>
			<div class="service-grid" style="margin-top: 3rem;">
				<?php
				$services = array(
					array( '🤝', __( 'Business Matchmaking', 'amcham-drc' ), __( 'Connecting US and DRC businesses for strategic partnerships and investment opportunities.', 'amcham-drc' ) ),
					array( '🌍', __( 'Networking Events', 'amcham-drc' ), __( 'Exclusive events designed to foster connections, share insights, and build a strong business community.', 'amcham-drc' ) ),
					array( '📢', __( 'Advocacy & Dialogue', 'amcham-drc' ), __( 'Representing member interests and promoting a favorable business climate in the DRC.', 'amcham-drc' ) ),
					array( '📊', __( 'Market Intelligence', 'amcham-drc' ), __( 'Providing critical market intelligence and guidance for successful entry into the DRC market.', 'amcham-drc' ) ),
				);
				foreach ( $services as $s ) : ?>
					<article class="service-card">
						<div style="padding: 2rem 1.75rem 0;font-size: 2rem;"><?php echo $s[0]; ?></div>
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
	<section class="section">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<h2><?php esc_html_e( 'Our Board of Directors', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'Meet the leadership team guiding AmCham DRC\'s mission to strengthen US-DRC business relations.', 'amcham-drc' ); ?></p>
			</div>
			<div class="team-grid">
				<?php
				$board = array(
					array( 'President', 'Yannick Sukakumu', 'Raxio DRC' ),
					array( 'Vice President', 'Wilmot Gibson', 'Musau Entreprise' ),
					array( 'Treasurer', 'Zahid Mirr', 'Keytech' ),
					array( 'Board Member', 'Mirela Pekmezi', 'FINCA' ),
					array( 'Board Member', 'Patricia Veringa Gieskes', 'PVG Trust' ),
				);
				foreach ( $board as $member ) : ?>
					<article class="team-card">
						<div class="team-card__image-wrap">
							<div class="team-card__placeholder">👤</div>
						</div>
						<div class="team-card__content">
							<span class="team-card__role"><?php echo esc_html( $member[0] ); ?></span>
							<h3><?php echo esc_html( $member[1] ); ?></h3>
							<p><?php echo esc_html( $member[2] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
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
					array( '🤝', 'Integrity', 'We conduct our business with honesty, transparency, and ethical practices, building trust with all stakeholders.' ),
					array( '🌍', 'Collaboration', 'We foster partnerships and cooperation between American and Congolese businesses to create mutual growth opportunities.' ),
					array( '💡', 'Innovation', 'We embrace new ideas and approaches to address the evolving challenges and opportunities in the DRC market.' ),
					array( '🌱', 'Sustainability', 'We promote responsible business practices that support long-term economic growth and social development.' ),
				);
				foreach ( $values as $v ) : ?>
					<article class="cv-card">
						<div class="cv-card__icon"><?php echo $v[0]; ?></div>
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
