<?php
/**
 * Block Patterns for AmCham DRC.
 *
 * @package AmCham_DRC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function amcham_drc_register_block_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	register_block_pattern_category(
		'amcham-patterns',
		array( 'label' => __( 'AmCham DRC Patterns', 'amcham-drc' ) )
	);

	// Mission & Vision Pattern
	register_block_pattern(
		'amcham-drc/mission-vision',
		array(
			'title'       => __( 'Mission & Vision Cards', 'amcham-drc' ),
			'categories'  => array( 'amcham-patterns' ),
			'content'     => '
				<!-- wp:html -->
				<div class="mission-vision-grid">
					<article class="mv-card">
						<div class="mv-card__icon">🎯</div>
						<h3>Our Mission</h3>
						<p>To promote and facilitate trade and investment between the United States and the Democratic Republic of Congo by providing advocacy, networking opportunities, and business intelligence to our members.</p>
					</article>
					<article class="mv-card">
						<div class="mv-card__icon">📈</div>
						<h3>Our Vision</h3>
						<p>To be the leading voice of American business in the DRC, driving sustainable economic development and creating lasting partnerships that benefit both nations.</p>
					</article>
				</div>
				<!-- /wp:html -->
			',
		)
	);

	// Core Values Pattern
	register_block_pattern(
		'amcham-drc/core-values',
		array(
			'title'       => __( 'Core Values Grid', 'amcham-drc' ),
			'categories'  => array( 'amcham-patterns' ),
			'content'     => '
				<!-- wp:html -->
				<div class="core-values-grid">
					<article class="cv-card">
						<div class="cv-card__icon">🤝</div>
						<h3>Integrity</h3>
						<p>We conduct our business with honesty, transparency, and ethical practices, building trust with all stakeholders.</p>
					</article>
					<article class="cv-card">
						<div class="cv-card__icon">🌍</div>
						<h3>Collaboration</h3>
						<p>We foster partnerships and cooperation between American and Congolese businesses to create mutual growth opportunities.</p>
					</article>
					<article class="cv-card">
						<div class="cv-card__icon">💡</div>
						<h3>Innovation</h3>
						<p>We embrace new ideas and approaches to address the evolving challenges and opportunities in the DRC market.</p>
					</article>
					<article class="cv-card">
						<div class="cv-card__icon">🌱</div>
						<h3>Sustainability</h3>
						<p>We promote responsible business practices that support long-term economic growth and social development.</p>
					</article>
				</div>
				<!-- /wp:html -->
			',
		)
	);
	
	// Board Members Pattern
	register_block_pattern(
		'amcham-drc/board-members',
		array(
			'title'       => __( 'Board / Committee Members', 'amcham-drc' ),
			'categories'  => array( 'amcham-patterns' ),
			'content'     => '
				<!-- wp:html -->
				<div class="team-grid">
					<article class="team-card">
						<div class="team-card__image-wrap">
							<!-- Replace with actual image -->
							<div class="team-card__placeholder">👥</div>
						</div>
						<div class="team-card__content">
							<span class="team-card__role">President</span>
							<h3>Yannick Sukakumu</h3>
							<p>Raxio DRC</p>
						</div>
					</article>
					<article class="team-card">
						<div class="team-card__image-wrap">
							<div class="team-card__placeholder">👥</div>
						</div>
						<div class="team-card__content">
							<span class="team-card__role">Vice President</span>
							<h3>Wilmot Gibson</h3>
							<p>Musau Entreprise</p>
						</div>
					</article>
					<article class="team-card">
						<div class="team-card__image-wrap">
							<div class="team-card__placeholder">👥</div>
						</div>
						<div class="team-card__content">
							<span class="team-card__role">Treasurer</span>
							<h3>Zahid Mirr</h3>
							<p>Keytech</p>
						</div>
					</article>
				</div>
				<!-- /wp:html -->
			',
		)
	);
}
add_action( 'init', 'amcham_drc_register_block_patterns' );
