<?php
/**
 * Template Name: Événements
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
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Gatherings', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'Events & Networking', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'Join our exclusive events to connect with industry leaders, gain market insights, and grow your business network in the DRC.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="events-section-header">
				<h2><?php esc_html_e( 'Upcoming Events', 'amcham-drc' ); ?></h2>
				<span class="events-count-badge">
					<?php
					$upcoming_events = new WP_Query( array(
						'post_type'      => 'amcham_event',
						'posts_per_page' => -1,
						'meta_query'     => array(
							array(
								'key'     => '_amcham_event_date',
								'value'   => gmdate( 'Y-m-d' ),
								'compare' => '>=',
								'type'    => 'DATE',
							),
						),
					) );
					echo esc_html( $upcoming_events->found_posts );
					?>
				</span>
			</div>
			
			<div class="events-page-grid">
				<?php if ( $upcoming_events->have_posts() ) : ?>
					<?php while ( $upcoming_events->have_posts() ) : $upcoming_events->the_post();
						$date     = get_post_meta( get_the_ID(), '_amcham_event_date', true );
						$location = get_post_meta( get_the_ID(), '_amcham_event_location', true );
						$time     = get_post_meta( get_the_ID(), '_amcham_event_time', true );
					?>
						<article class="ep-card">
							<span class="ep-card__badge"><?php esc_html_e( 'Upcoming', 'amcham-drc' ); ?></span>
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
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="button button--outline" style="margin-top: 1.5rem; width: 100%;"><?php esc_html_e( 'Register', 'amcham-drc' ); ?></a>
						</article>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php else : ?>
					<p style="grid-column: 1/-1; color: var(--ink-muted);"><?php esc_html_e( 'No upcoming events currently scheduled. Check back soon!', 'amcham-drc' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="shell">
			<div class="events-section-header">
				<h2><?php esc_html_e( 'Past Events', 'amcham-drc' ); ?></h2>
				<span class="events-count-badge events-count-badge--muted">
					<?php
					$past_events = new WP_Query( array(
						'post_type'      => 'amcham_event',
						'posts_per_page' => 6,
						'meta_query'     => array(
							array(
								'key'     => '_amcham_event_date',
								'value'   => gmdate( 'Y-m-d' ),
								'compare' => '<',
								'type'    => 'DATE',
							),
						),
						'meta_key'       => '_amcham_event_date',
						'orderby'        => 'meta_value',
						'order'          => 'DESC',
					) );
					echo esc_html( $past_events->found_posts );
					?>
				</span>
			</div>
			
			<div class="events-page-grid events-page-grid--past">
				<?php if ( $past_events->have_posts() ) : ?>
					<?php while ( $past_events->have_posts() ) : $past_events->the_post();
						$date     = get_post_meta( get_the_ID(), '_amcham_event_date', true );
						$location = get_post_meta( get_the_ID(), '_amcham_event_location', true );
					?>
						<article class="ep-card">
							<?php if ( $date ) : ?>
								<div class="ep-card__date">
									<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
									<?php echo esc_html( date_i18n( 'F j, Y', strtotime( $date ) ) ); ?>
								</div>
							<?php endif; ?>
							<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo wp_trim_words( get_the_excerpt(), 12, '...' ); ?></p>
							<?php if ( $location ) : ?>
								<div class="ep-card__meta">
									<svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
									<?php echo esc_html( $location ); ?>
								</div>
							<?php endif; ?>
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="text-link" style="margin-top: 1.5rem; align-self: flex-start;"><?php esc_html_e( 'View Details', 'amcham-drc' ); ?> →</a>
						</article>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php else : ?>
					<p style="grid-column: 1/-1; color: var(--ink-muted);"><?php esc_html_e( 'No past events found.', 'amcham-drc' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="membership-cta">
		<div class="shell membership-cta__inner">
			<p class="eyebrow eyebrow--red"><?php esc_html_e( 'Stay Informed', 'amcham-drc' ); ?></p>
			<h2><?php esc_html_e( 'Never Miss an Event', 'amcham-drc' ); ?></h2>
			<p><?php esc_html_e( 'Sign up for our newsletter to receive invitations to upcoming networking events, forums, and webinars.', 'amcham-drc' ); ?></p>
			<div style="max-width: 500px; margin: 2rem auto 0; display: flex; gap: 0.5rem;">
				<input type="email" placeholder="<?php esc_attr_e( 'Enter your email address', 'amcham-drc' ); ?>" style="flex: 1; padding: 0.8rem 1.25rem; border: none; border-radius: 4px; outline: none; font-family: inherit; font-size: 0.95rem;">
				<button class="button button--red"><?php esc_html_e( 'Subscribe', 'amcham-drc' ); ?></button>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
