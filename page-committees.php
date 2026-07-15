<?php
/**
 * Template Name: Comités
 * Template Post Type: page
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content">

	<!-- Hero -->
	<section class="page-hero">
		<div class="shell">
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Working Groups', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'Our Committees', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'Sector-focused committees that drive AmCham DRC\'s advocacy efforts and deliver specialized value to our members.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<!-- Committees Grid -->
	<section class="section">
		<div class="shell">
			<?php
			$committees = array(
				array(
					'icon'   => '⛏️',
					'name'   => 'Mining & Natural Resources',
					'desc'   => 'Addresses policy, regulatory, and operational challenges facing the extractive industries sector in the DRC.',
					'focus'  => array( 'Mining Code Updates', 'Environmental Compliance', 'Community Relations', 'Supply Chain' ),
					'chair'  => 'Committee Chair: TBD',
				),
				array(
					'icon'   => '💻',
					'name'   => 'Technology & Digital Economy',
					'desc'   => 'Promotes digital transformation, fintech, and ICT investment opportunities across the DRC.',
					'focus'  => array( 'Digital Infrastructure', 'Fintech Regulation', 'E-Commerce', 'Cybersecurity' ),
					'chair'  => 'Committee Chair: TBD',
				),
				array(
					'icon'   => '🌿',
					'name'   => 'Agriculture & Agribusiness',
					'desc'   => 'Advocates for investment-friendly policies in the agricultural sector and food security.',
					'focus'  => array( 'Land Rights', 'Supply Chain', 'Export Facilitation', 'Food Security' ),
					'chair'  => 'Committee Chair: TBD',
				),
				array(
					'icon'   => '⚡',
					'name'   => 'Energy & Infrastructure',
					'desc'   => 'Works to improve the DRC\'s energy landscape and infrastructure development policies.',
					'focus'  => array( 'Power Generation', 'PPP Frameworks', 'Renewable Energy', 'Logistics' ),
					'chair'  => 'Committee Chair: TBD',
				),
				array(
					'icon'   => '🏦',
					'name'   => 'Finance & Banking',
					'desc'   => 'Engages with financial regulators to promote a stable and transparent banking environment.',
					'focus'  => array( 'Banking Regulation', 'Microfinance', 'FDI Frameworks', 'Currency Stability' ),
					'chair'  => 'Committee Chair: TBD',
				),
				array(
					'icon'   => '⚖️',
					'name'   => 'Legal & Regulatory Affairs',
					'desc'   => 'Monitors legislative developments and provides advocacy on business law reform.',
					'focus'  => array( 'Contract Enforcement', 'IP Rights', 'Arbitration', 'Tax Policy' ),
					'chair'  => 'Committee Chair: TBD',
				),
			);
			foreach ( $committees as $c ) : ?>
				<article class="committee-card">
					<div class="committee-card__header">
						<div class="committee-card__icon"><?php echo $c['icon']; ?></div>
						<div>
							<h2><?php echo esc_html( $c['name'] ); ?></h2>
							<p class="committee-card__chair" style="color: var(--red); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin: 0.25rem 0 0;"><?php echo esc_html( $c['chair'] ); ?></p>
						</div>
					</div>
					<p><?php echo esc_html( $c['desc'] ); ?></p>
					<div class="committee-card__focus">
						<?php foreach ( $c['focus'] as $tag ) : ?>
							<span class="committee-tag"><?php echo esc_html( $tag ); ?></span>
						<?php endforeach; ?>
					</div>
					<a class="text-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Join this committee', 'amcham-drc' ); ?> →</a>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- CTA -->
	<section class="membership-cta">
		<div class="shell membership-cta__inner">
			<p class="eyebrow eyebrow--red"><?php esc_html_e( 'Get Involved', 'amcham-drc' ); ?></p>
			<h2><?php esc_html_e( 'Participate in a Committee', 'amcham-drc' ); ?></h2>
			<p><?php esc_html_e( 'AmCham DRC members are encouraged to actively participate in our committees. Committee participation is exclusive to members.', 'amcham-drc' ); ?></p>
			<div>
				<a class="button button--red" href="<?php echo esc_url( home_url( '/membership/' ) ); ?>"><?php esc_html_e( 'Become a Member', 'amcham-drc' ); ?> →</a>
				<a class="button button--ghost" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'amcham-drc' ); ?></a>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
