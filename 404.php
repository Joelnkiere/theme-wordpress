<?php get_header(); ?>
<main id="main-content" class="content-page"><div class="shell content-page__inner"><p class="eyebrow">404</p><h1><?php esc_html_e( 'This page cannot be found.', 'amcham-drc' ); ?></h1><p><?php esc_html_e( 'The page may have moved or no longer be available.', 'amcham-drc' ); ?></p><a class="button button--red" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'amcham-drc' ); ?></a></div></main>
<?php get_footer(); ?>
