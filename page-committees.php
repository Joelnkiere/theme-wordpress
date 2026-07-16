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
	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<?php
			$comm_query = new WP_Query( array(
				'post_type'      => 'amcham_committee',
				'posts_per_page' => -1,
				'order'          => 'ASC',
				'orderby'        => 'menu_order title',
			) );

			if ( $comm_query->have_posts() ) :
				while ( $comm_query->have_posts() ) : $comm_query->the_post();
					$desc = wp_strip_all_tags( get_the_content() );
					$focus_raw = get_the_excerpt();
					$focus_tags = ! empty( $focus_raw ) ? array_map('trim', explode( ',', $focus_raw )) : array();
					$chair = get_post_meta( get_the_ID(), '_amcham_committee_chair', true );
					if ( empty( $chair ) ) $chair = 'TBD';
					
					// Generate a consistent SVG placeholder based on title since we didn't add icon meta yet
					$icons = array(
						'<svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>',
						'<svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
						'<svg viewBox="0 0 24 24"><path d="M11 20A7 7 0 0 1 4 13V4a7 7 0 0 1 7 7 7 7 0 0 1 7-7v9a7 7 0 0 1-7 7z"/></svg>',
						'<svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
						'<svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>'
					);
					$icon = $icons[ crc32( get_the_title() ) % count( $icons ) ];
				?>
					<article class="committee-card">
						<div class="committee-card__header">
							<div class="committee-card__icon"><?php echo $icon; ?></div>
							<div>
								<h2><?php the_title(); ?></h2>
								<p class="committee-card__chair" style="color: var(--red); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin: 0.25rem 0 0;">
									<?php echo esc_html( sprintf( __( 'Committee Chair: %s', 'amcham-drc' ), $chair ) ); ?>
								</p>
							</div>
						</div>
						<p><?php echo esc_html( $desc ); ?></p>
						<div class="committee-card__focus">
							<?php foreach ( $focus_tags as $tag ) : ?>
								<span class="committee-tag"><?php echo esc_html( $tag ); ?></span>
							<?php endforeach; ?>
						</div>
						<a class="text-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Join this committee', 'amcham-drc' ); ?> →</a>
					</article>
				<?php endwhile;
				wp_reset_postdata();
			else :
				// Fallback if no custom posts exist yet
				$committees = array(
					array(
						'icon'   => '<svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>',
						'name'   => 'Mining & Natural Resources',
						'desc'   => 'Addresses policy, regulatory, and operational challenges facing the extractive industries sector in the DRC.',
						'focus'  => array( 'Mining Code Updates', 'Environmental Compliance', 'Community Relations', 'Supply Chain' ),
						'chair'  => 'Committee Chair: TBD',
					),
					array(
						'icon'   => '<svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
						'name'   => 'Technology & Digital Economy',
						'desc'   => 'Promotes digital transformation, fintech, and ICT investment opportunities across the DRC.',
						'focus'  => array( 'Digital Infrastructure', 'Fintech Regulation', 'E-Commerce', 'Cybersecurity' ),
						'chair'  => 'Committee Chair: TBD',
					),
					array(
						'icon'   => '<svg viewBox="0 0 24 24"><path d="M11 20A7 7 0 0 1 4 13V4a7 7 0 0 1 7 7 7 7 0 0 1 7-7v9a7 7 0 0 1-7 7z"/></svg>',
						'name'   => 'Agriculture & Agribusiness',
						'desc'   => 'Advocates for investment-friendly policies in the agricultural sector and food security.',
						'focus'  => array( 'Land Rights', 'Supply Chain', 'Export Facilitation', 'Food Security' ),
						'chair'  => 'Committee Chair: TBD',
					),
					array(
						'icon'   => '<svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
						'name'   => 'Energy & Infrastructure',
						'desc'   => 'Works to improve the DRC\'s energy landscape and infrastructure development policies.',
						'focus'  => array( 'Power Generation', 'PPP Frameworks', 'Renewable Energy', 'Logistics' ),
						'chair'  => 'Committee Chair: TBD',
					),
					array(
						'icon'   => '<svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',
						'name'   => 'Finance & Banking',
						'desc'   => 'Engages with financial regulators to promote a stable and transparent banking environment.',
						'focus'  => array( 'Banking Regulation', 'Microfinance', 'FDI Frameworks', 'Currency Stability' ),
						'chair'  => 'Committee Chair: TBD',
					),
					array(
						'icon'   => '<svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>',
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
				<?php endforeach;
			endif; ?>
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
