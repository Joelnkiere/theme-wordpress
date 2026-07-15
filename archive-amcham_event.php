<?php
/**
 * The template for displaying event archives.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content" class="content-page">
	<div class="shell content-page__inner">
		<header class="entry-header">
			<p class="eyebrow"><?php esc_html_e( 'Agenda', 'amcham-drc' ); ?></p>
			<h1><?php post_type_archive_title(); ?></h1>
		</header>
		
		<div class="events-section section--dark" style="padding: 4rem; border-radius: 8px;">
			<div class="events-layout" style="grid-template-columns: 1fr;">
				<div class="event-list">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); 
							$event_date = get_post_meta( get_the_ID(), '_amcham_event_date', true );
							if ( ! $event_date ) {
								$event_date = get_the_date( 'Y-m-d' );
							}
							$timestamp = strtotime( $event_date );
							$day = date_i18n( 'd', $timestamp );
							$month = strtoupper( date_i18n( 'M', $timestamp ) );
							
							$location = get_post_meta( get_the_ID(), '_amcham_event_location', true );
						?>
							<article class="event-card">
								<time datetime="<?php echo esc_attr( $event_date ); ?>">
									<b><?php echo esc_html( $day ); ?></b>
									<span><?php echo esc_html( $month ); ?></span>
								</time>
								<div>
									<h3><?php the_title(); ?></h3>
									<?php if ( $location ) : ?>
										<p style="color: var(--red); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.5rem; font-weight: bold;">
											<?php echo esc_html( $location ); ?>
										</p>
									<?php endif; ?>
									<div class="event-excerpt">
										<?php the_excerpt(); ?>
									</div>
									<a class="text-link text-link--light" href="<?php the_permalink(); ?>">
										<?php esc_html_e( 'Read details', 'amcham-drc' ); ?> →
									</a>
								</div>
							</article>
						<?php endwhile; ?>
						
						<?php the_posts_navigation(); ?>
						
					<?php else : ?>
						<p><?php esc_html_e( 'No upcoming events found.', 'amcham-drc' ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
