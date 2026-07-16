<?php
/**
 * Template Name: Actualités
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
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Updates', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'News & Insights', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'Stay informed with the latest updates from AmCham DRC, member news, and developments in the Congolese business landscape.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="filter-pills" style="margin-bottom: 3rem;">
				<button class="filter-pill filter-pill--active"><?php esc_html_e( 'All News', 'amcham-drc' ); ?></button>
				<button class="filter-pill"><?php esc_html_e( 'Chamber Updates', 'amcham-drc' ); ?></button>
				<button class="filter-pill"><?php esc_html_e( 'Member News', 'amcham-drc' ); ?></button>
				<button class="filter-pill"><?php esc_html_e( 'Policy Insights', 'amcham-drc' ); ?></button>
			</div>

			<div class="news-page-grid">
				<?php
				$news_query = new WP_Query( array(
					'post_type'      => 'post',
					'posts_per_page' => 9,
					'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
				) );

				if ( $news_query->have_posts() ) :
					while ( $news_query->have_posts() ) : $news_query->the_post();
						$categories = get_the_category();
						$category_name = ! empty( $categories ) ? esc_html( $categories[0]->name ) : 'News';
				?>
						<article class="np-card">
							<div class="np-card__image">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large' ); ?>
								<?php else : ?>
									<div style="width: 100%; height: 100%; background: #e0e5ea; display: flex; align-items: center; justify-content: center;">
										<svg style="width:40px;height:40px;fill:var(--ink-muted);opacity:0.3" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
									</div>
								<?php endif; ?>
							</div>
							<div class="np-card__body">
								<span class="np-card__category"><?php echo $category_name; ?></span>
								<div class="np-card__date"><?php echo get_the_date(); ?></div>
								<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
								<p><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="np-card__readmore">
									<?php esc_html_e( 'Read Article', 'amcham-drc' ); ?>
									<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
								</a>
							</div>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<p style="grid-column: 1/-1; text-align: center; color: var(--ink-muted);"><?php esc_html_e( 'No news found.', 'amcham-drc' ); ?></p>
				<?php endif; ?>
			</div>

			<?php
			$pagination = paginate_links( array(
				'total'     => $news_query->max_num_pages,
				'prev_text' => '←',
				'next_text' => '→',
				'type'      => 'list',
			) );
			
			if ( $pagination ) {
				// Strip ul wrapping as paginate_links with type=list returns ul class='page-numbers'
				echo '<nav class="nav-links" aria-label="Pagination">' . $pagination . '</nav>';
			}
			wp_reset_postdata();
			?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
