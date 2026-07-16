<?php
/**
 * The template for displaying partner archives.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content">
	<!-- Hero -->
	<section class="partner-archive-hero">
		<div class="shell">
			<p class="eyebrow eyebrow--red"><?php esc_html_e( 'Our Network', 'amcham-drc' ); ?></p>
			<h1><?php post_type_archive_title(); ?></h1>
			<p class="page-hero__lead" style="margin: 0 auto;"><?php esc_html_e( 'Collaborating with leading organizations to foster economic growth and bilateral trade.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="partners-grid">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); 
						$url = get_post_meta( get_the_ID(), '_amcham_partner_url', true );
					?>
						<article class="partner-card">
							<?php if ( $url ) : ?>
								<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" style="display: contents;">
							<?php endif; ?>
							
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="partner-card__logo">
									<?php the_post_thumbnail( 'medium' ); ?>
								</div>
							<?php else : ?>
								<div class="partner-card__logo">
									<div style="width: 80px; height: 80px; background: rgba(11,21,37,0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; color: var(--ink-muted);">
										<svg viewBox="0 0 24 24" style="width: 32px; height: 32px; fill: none; stroke: currentColor; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;"><path d="M16 21v-2a4 4 0 0 0-4-4H5c-1.1 0-2 .9-2 2v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
									</div>
								</div>
							<?php endif; ?>
							
							<h3><?php the_title(); ?></h3>
							
							<?php if ( $url ) : ?>
								</a>
							<?php endif; ?>
							
							<div class="partner-card__excerpt">
								<?php the_excerpt(); ?>
							</div>
						</article>
					<?php endwhile; ?>
					
					<div style="grid-column: 1 / -1; margin-top: 2rem;">
						<?php
						$pagination = paginate_links( array(
							'prev_text' => '←',
							'next_text' => '→',
							'type'      => 'list',
						) );
						if ( $pagination ) {
							echo '<nav class="nav-links" aria-label="Pagination">' . $pagination . '</nav>';
						}
						?>
					</div>
					
				<?php else : ?>
					<p style="grid-column: 1 / -1; text-align: center; color: var(--ink-muted);"><?php esc_html_e( 'No partners found.', 'amcham-drc' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
