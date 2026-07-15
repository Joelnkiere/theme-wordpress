<?php
/**
 * Default page template.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content" class="content-page"><div class="shell content-page__inner">
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class(); ?>><header class="entry-header"><p class="eyebrow"><?php esc_html_e( 'AmCham DRC', 'amcham-drc' ); ?></p><h1><?php the_title(); ?></h1></header><div class="entry-content"><?php the_content(); ?></div></article>
<?php endwhile; ?>
</div></main>
<?php get_footer(); ?>
