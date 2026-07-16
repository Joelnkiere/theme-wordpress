<?php
/**
 * The template for displaying event archives.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content">
	<!-- Hero -->
	<section class="event-archive-hero">
		<div class="shell">
			<p class="eyebrow eyebrow--red"><?php esc_html_e( 'Agenda', 'amcham-drc' ); ?></p>
			<h1><?php post_type_archive_title(); ?></h1>
			<p class="page-hero__lead" style="margin: 0 auto;"><?php esc_html_e( 'Browse all upcoming and past events hosted by the American Chamber of Commerce in the DRC.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="events-page-grid">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); 
						$date     = get_post_meta( get_the_ID(), '_amcham_event_date', true );
						$location = get_post_meta( get_the_ID(), '_amcham_event_location', true );
						
						// Check if past or upcoming
						$is_past = false;
						if ( $date && strtotime( $date ) < time() ) {
							$is_past = true;
						}
					?>
						<article class="ep-card <?php echo $is_past ? 'ep-card--past' : ''; ?>" <?php echo $is_past ? 'style="opacity: 0.75;"' : ''; ?>>
							<?php if ( ! $is_past ) : ?>
								<span class="ep-card__badge"><?php esc_html_e( 'Upcoming', 'amcham-drc' ); ?></span>
							<?php endif; ?>
							
							<?php if ( $date ) : ?>
								<div class="ep-card__date">
									<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
									<?php echo esc_html( date_i18n( 'F j, Y', strtotime( $date ) ) ); ?>
								</div>
							<?php endif; ?>
							
							<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
							
							<?php if ( $location ) : ?>
								<div class="ep-card__meta">
									<svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
									<?php echo esc_html( $location ); ?>
								</div>
							<?php endif; ?>
							
							<?php if ( ! $is_past ) : ?>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="button button--outline" style="margin-top: 1.5rem; width: 100%;"><?php esc_html_e( 'Register', 'amcham-drc' ); ?></a>
							<?php else : ?>
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="text-link" style="margin-top: 1.5rem; align-self: flex-start;"><?php esc_html_e( 'View Details', 'amcham-drc' ); ?> →</a>
							<?php endif; ?>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<p style="grid-column: 1/-1; color: var(--ink-muted); text-align: center;"><?php esc_html_e( 'No events found.', 'amcham-drc' ); ?></p>
				<?php endif; ?>
			</div>

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
	</section>
</main>
<?php get_footer(); ?>
