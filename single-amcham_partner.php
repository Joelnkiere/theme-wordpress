<?php
/**
 * The template for displaying a single partner.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content" class="content-page">
	<div class="shell content-page__inner">
		<?php while ( have_posts() ) : the_post();
			$url = get_post_meta( get_the_ID(), '_amcham_partner_url', true );
		?>
			<article <?php post_class(); ?>>
				<header class="entry-header">
					<p class="eyebrow">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'amcham_partner' ) ); ?>">
							← <?php esc_html_e( 'All Partners', 'amcham-drc' ); ?>
						</a>
					</p>
					<h1><?php the_title(); ?></h1>
					<?php if ( $url ) : ?>
						<a class="button button--red" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" style="margin-top: 1rem; display: inline-flex;">
							<?php esc_html_e( 'Visit Website', 'amcham-drc' ); ?> →
						</a>
					<?php endif; ?>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div style="margin: 2rem 0; max-width: 300px;">
						<?php the_post_thumbnail( 'medium', array( 'style' => 'max-height: 120px; width: auto; object-fit: contain;' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>
<?php get_footer(); ?>
