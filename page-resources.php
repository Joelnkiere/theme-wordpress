<?php
/**
 * Template Name: Ressources
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
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Intelligence', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'Resources & Market Intelligence', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'Access comprehensive reports, sector analyses, and business guides to inform your strategy in the DRC market.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<!-- Resource Categories -->
	<section class="section">
		<div class="shell">
			<div class="resource-tabs">
				<?php
				$resource_terms = get_terms( array(
					'taxonomy'   => 'resource_type',
					'hide_empty' => false,
				) );
				
				if ( empty( $resource_terms ) || is_wp_error( $resource_terms ) ) {
					// Fallback if no terms exist yet
					$resource_terms = array(
						(object) array( 'slug' => 'market-insights', 'name' => 'Market Insights', 'description' => 'In-depth analysis and economic indicators for the DRC market.' ),
						(object) array( 'slug' => 'publications', 'name' => 'Publications', 'description' => 'Official publications, newsletters, and policy papers from AmCham DRC.' ),
						(object) array( 'slug' => 'external', 'name' => 'External Resources', 'description' => 'Key resources from trusted institutions for doing business in the DRC.' ),
					);
				}

				foreach ( $resource_terms as $index => $term ) {
					$active = ( $index === 0 ) ? ' resource-tab--active' : '';
					echo '<a href="#' . esc_attr( $term->slug ) . '" class="resource-tab' . $active . '">' . esc_html( $term->name ) . '</a>';
				}
				// Always add ANAPI guide at the end
				echo '<a href="#anapi-guide" class="resource-tab">' . esc_html__( 'ANAPI Guide', 'amcham-drc' ) . '</a>';
				?>
			</div>
		</div>
	</section>

	<?php foreach ( $resource_terms as $index => $term ) : ?>
		<section id="<?php echo esc_attr( $term->slug ); ?>" class="section" <?php echo ( $index === 0 ) ? 'style="padding-top: 0;"' : 'style="background: var(--paper);"'; ?>>
			<div class="shell">
				<div class="section-heading">
					<p class="eyebrow"><?php echo esc_html( $term->name ); ?></p>
					<h2><?php echo esc_html( $term->name ); ?></h2>
					<?php if ( ! empty( $term->description ) ) : ?>
						<p><?php echo esc_html( $term->description ); ?></p>
					<?php endif; ?>
				</div>
				<div class="resource-grid">
					<?php
					$args = array(
						'post_type'      => 'amcham_resource',
						'posts_per_page' => -1,
						'tax_query'      => array(
							array(
								'taxonomy' => 'resource_type',
								'field'    => 'slug',
								'terms'    => $term->slug,
							),
						),
					);
					$query = new WP_Query( $args );

					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post();
							$file_url = get_post_meta( get_the_ID(), '_amcham_file_url', true );
							$badge = get_post_meta( get_the_ID(), '_amcham_badge', true );
							if ( empty( $badge ) ) $badge = 'Free';
							$badge_class = ( strtolower( $badge ) === 'free' ) ? 'free' : 'member';
							?>
							<div class="resource-card">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="resource-card__icon" style="padding:0; overflow:hidden; background:none;">
										<?php the_post_thumbnail( 'thumbnail', array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) ); ?>
									</div>
								<?php else : ?>
									<div class="resource-card__icon icon-circle">
										<svg viewBox="0 0 24 24"><path d="M4 22h14a2 2 0 0 0 2-2V7.5L14.5 2H6a2 2 0 0 0-2 2v4"/><path d="M14 2v6h6"/><path d="M2 15h10"/><path d="M2 19h10"/></svg>
									</div>
								<?php endif; ?>
								<div class="resource-card__content">
									<h3><?php the_title(); ?></h3>
									<p><?php echo get_the_excerpt(); ?></p>
									<div class="resource-card__footer">
										<?php if ( $term->slug !== 'external' ) : ?>
											<span class="resource-card__badge resource-card__badge--<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $badge ); ?></span>
										<?php endif; ?>
										<a class="text-link" href="<?php echo esc_url( $file_url ); ?>" <?php echo ( $term->slug === 'external' ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
											<?php echo ( $term->slug === 'external' ) ? esc_html__( 'Visit Site', 'amcham-drc' ) : esc_html__( 'Access Resource', 'amcham-drc' ); ?> →
										</a>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						echo '<p style="color: var(--ink-muted);">' . esc_html__( 'No resources found for this category yet.', 'amcham-drc' ) . '</p>';
					endif;
					?>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<!-- ANAPI Guide -->
	<section id="anapi-guide" class="section">
		<div class="shell">
			<div class="report-banner__inner">
				<div style="background: var(--ink-deep); border-radius: 8px; min-height: 280px; display: flex; align-items: center; justify-content: center; color: var(--white);">
					<svg viewBox="0 0 24 24" style="width: 80px; height: 80px; fill: none; stroke: currentColor; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
				</div>
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Business Guide', 'amcham-drc' ); ?></p>
					<h2><?php esc_html_e( 'ANAPI Investment Guide', 'amcham-drc' ); ?></h2>
					<p style="color: var(--ink-muted); max-width: 500px;"><?php esc_html_e( 'A comprehensive guide to the National Agency for Investment Promotion (ANAPI) processes, registration requirements, and investment incentives in the DRC.', 'amcham-drc' ); ?></p>
					<a href="#" class="button button--outline" style="margin-top: 1rem;"><?php esc_html_e( 'Download Guide', 'amcham-drc' ); ?> →</a>
				</div>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
