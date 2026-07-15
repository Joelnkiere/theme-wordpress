<?php
/**
 * Default archive template.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content" class="content-page"><div class="shell content-page__inner">
	<header class="entry-header"><p class="eyebrow"><?php esc_html_e( 'News & insights', 'amcham-drc' ); ?></p><h1><?php bloginfo( 'name' ); ?></h1></header>
	<?php if ( have_posts() ) : ?><div class="post-grid"><?php while ( have_posts() ) : the_post(); ?><article <?php post_class( 'post-card' ); ?>><?php if ( has_post_thumbnail() ) : ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a><?php endif; ?><p class="news-meta"><?php echo esc_html( get_the_date() ); ?></p><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p><a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read article', 'amcham-drc' ); ?> →</a></article><?php endwhile; ?></div><?php the_posts_pagination(); ?><?php else : ?><p><?php esc_html_e( 'No posts found.', 'amcham-drc' ); ?></p><?php endif; ?>
</div></main>
<?php get_footer(); ?>
