<?php
/**
 * The template for displaying all single posts.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content" class="content-page">
	<div class="shell">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'single-article' ); ?>>

				<header class="single-article__header">
					<div class="single-article__header-inner">
						<p class="eyebrow">
							<?php
							$cats = get_the_category();
							if ( $cats ) {
								echo esc_html( $cats[0]->name );
							} else {
								esc_html_e( 'News & Insights', 'amcham-drc' );
							}
							?>
						</p>
						<h1><?php the_title(); ?></h1>
						<div class="single-article__meta">
							<span><?php echo esc_html( get_the_date() ); ?></span>
							<span>·</span>
							<span><?php the_author(); ?></span>
						</div>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="single-article__hero-image">
						<?php the_post_thumbnail( 'full', array( 'class' => 'single-article__hero-img' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="shell content-page__inner">
					<div class="entry-content single-article__content">
						<?php the_content(); ?>
					</div>

					<footer class="single-article__footer">
						<?php
						$tags = get_the_tags();
						if ( $tags ) : ?>
							<div class="single-article__tags">
								<?php foreach ( $tags as $tag ) : ?>
									<a href="<?php echo esc_url( get_tag_link( $tag ) ); ?>" class="single-article__tag">
										<?php echo esc_html( $tag->name ); ?>
									</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<nav class="single-article__nav" aria-label="<?php esc_attr_e( 'Post navigation', 'amcham-drc' ); ?>">
							<?php
							$prev = get_previous_post();
							$next = get_next_post();
							?>
							<?php if ( $prev ) : ?>
								<a class="single-article__nav-prev" href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
									<span class="eyebrow"><?php esc_html_e( '← Previous', 'amcham-drc' ); ?></span>
									<strong><?php echo esc_html( get_the_title( $prev ) ); ?></strong>
								</a>
							<?php endif; ?>
							<?php if ( $next ) : ?>
								<a class="single-article__nav-next" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
									<span class="eyebrow"><?php esc_html_e( 'Next →', 'amcham-drc' ); ?></span>
									<strong><?php echo esc_html( get_the_title( $next ) ); ?></strong>
								</a>
							<?php endif; ?>
						</nav>
					</footer>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>
<?php get_footer(); ?>
