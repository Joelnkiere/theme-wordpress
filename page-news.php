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
			<form method="get" action="<?php echo esc_url( get_permalink() ); ?>" class="directory-search" style="margin-bottom: 2rem;">
				<div class="directory-search__icon">
					<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
				</div>
				<input type="text" name="news_search" value="<?php echo isset( $_GET['news_search'] ) ? esc_attr( wp_unslash( $_GET['news_search'] ) ) : ''; ?>" class="directory-search__input" placeholder="<?php esc_attr_e( 'Search news and insights...', 'amcham-drc' ); ?>">
				<?php if ( isset( $_GET['cat_filter'] ) ) : ?>
					<input type="hidden" name="cat_filter" value="<?php echo esc_attr( $_GET['cat_filter'] ); ?>">
				<?php endif; ?>
			</form>

			<div class="filter-pills" style="margin-bottom: 3rem;">
				<?php
				$active_cat = isset( $_GET['cat_filter'] ) ? sanitize_text_field( $_GET['cat_filter'] ) : '';
				
				$all_url = remove_query_arg( 'cat_filter' );
				$active_class = empty( $active_cat ) ? 'filter-pill--active' : '';
				echo '<a href="' . esc_url( $all_url ) . '" class="filter-pill ' . esc_attr( $active_class ) . '">' . esc_html__( 'All News', 'amcham-drc' ) . '</a>';

				$categories = get_categories( array( 'hide_empty' => true ) );
				foreach ( $categories as $category ) {
					$cat_url = add_query_arg( 'cat_filter', $category->slug );
					$active_class = ( $active_cat === $category->slug ) ? 'filter-pill--active' : '';
					echo '<a href="' . esc_url( $cat_url ) . '" class="filter-pill ' . esc_attr( $active_class ) . '">' . esc_html( $category->name ) . '</a>';
				}
				?>
			</div>

			<div class="news-page-grid">
				<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => 9,
					'paged'          => $paged,
				);

				if ( ! empty( $active_cat ) ) {
					$args['category_name'] = $active_cat;
				}

				if ( ! empty( $_GET['news_search'] ) ) {
					$args['s'] = sanitize_text_field( wp_unslash( $_GET['news_search'] ) );
				}

				$news_query = new WP_Query( $args );

				if ( $news_query->have_posts() ) :
					while ( $news_query->have_posts() ) : $news_query->the_post();
						$post_categories = get_the_category();
						$category_name = ! empty( $post_categories ) ? esc_html( $post_categories[0]->name ) : 'News';
				?>
						<article class="np-card">
							<div class="np-card__image">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large', array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) ); ?>
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
					<p style="grid-column: 1/-1; text-align: center; color: var(--ink-muted); padding: 4rem 0; font-size: 1.1rem;"><?php esc_html_e( 'No news found matching your criteria.', 'amcham-drc' ); ?></p>
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
