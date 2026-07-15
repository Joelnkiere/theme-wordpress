<?php
/**
 * The template for displaying partner archives.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content" class="content-page">
	<div class="shell content-page__inner" style="max-width: 1180px;">
		<header class="entry-header" style="text-align: center; max-width: 800px; margin-left: auto; margin-right: auto;">
			<p class="eyebrow"><?php esc_html_e( 'Our Network', 'amcham-drc' ); ?></p>
			<h1><?php post_type_archive_title(); ?></h1>
			<p style="color: var(--ink-muted); margin-top: 1rem; font-size: 1.1rem;">
				<?php esc_html_e( 'Collaborating with leading organizations to foster economic growth and bilateral trade.', 'amcham-drc' ); ?>
			</p>
		</header>
		
		<div class="partners-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem; margin-top: 4rem;">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); 
					$url = get_post_meta( get_the_ID(), '_amcham_partner_url', true );
				?>
					<article class="partner-card" style="background: var(--white); padding: 2rem; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: transform 0.2s ease;">
						<?php if ( $url ) : ?>
							<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" style="display: contents;">
						<?php endif; ?>
						
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="partner-logo" style="margin-bottom: 1.5rem;">
								<?php the_post_thumbnail( 'medium', array( 'style' => 'max-height: 100px; width: auto; max-width: 100%; object-fit: contain;' ) ); ?>
							</div>
						<?php endif; ?>
						<h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--ink);"><?php the_title(); ?></h3>
						
						<?php if ( $url ) : ?>
							</a>
						<?php endif; ?>
						
						<div class="partner-excerpt" style="font-size: 0.9rem; color: var(--ink-muted);">
							<?php the_excerpt(); ?>
						</div>
					</article>
				<?php endwhile; ?>
				
				<div style="grid-column: 1 / -1;">
					<?php the_posts_navigation(); ?>
				</div>
				
			<?php else : ?>
				<p style="grid-column: 1 / -1; text-align: center;"><?php esc_html_e( 'No partners found.', 'amcham-drc' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
