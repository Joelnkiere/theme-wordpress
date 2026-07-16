<?php
/**
 * The template for displaying all single events.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content">
	<?php while ( have_posts() ) : the_post(); 
		$event_date = get_post_meta( get_the_ID(), '_amcham_event_date', true );
		$event_time = get_post_meta( get_the_ID(), '_amcham_event_time', true );
		$location   = get_post_meta( get_the_ID(), '_amcham_event_location', true );
		$link       = get_post_meta( get_the_ID(), '_amcham_event_link', true );
		
		$display_date = $event_date ? date_i18n( 'F j, Y', strtotime( $event_date ) ) : get_the_date();
	?>
		<!-- Event Hero -->
		<section class="event-single-hero">
			<div class="shell">
				<p class="eyebrow eyebrow--red"><?php esc_html_e( 'Event Details', 'amcham-drc' ); ?></p>
				<h1 style="max-width: 900px;"><?php the_title(); ?></h1>
				
				<div class="event-meta-bar">
					<div class="event-meta-item">
						<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
						<span><?php echo esc_html( $display_date ); ?></span>
					</div>
					
					<?php if ( $event_time ) : ?>
						<div class="event-meta-item">
							<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
							<span><?php echo esc_html( $event_time ); ?></span>
						</div>
					<?php endif; ?>
					
					<?php if ( $location ) : ?>
						<div class="event-meta-item">
							<svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
							<span><?php echo esc_html( $location ); ?></span>
						</div>
					<?php endif; ?>
					
					<?php if ( $link ) : ?>
						<div class="event-meta-item" style="margin-left: auto;">
							<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer">
								<?php esc_html_e( 'Register for Event', 'amcham-drc' ); ?> →
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<section class="section" style="padding-top: 4rem;">
			<div class="shell" style="max-width: 860px; margin: 0 auto;">
				<?php if ( has_post_thumbnail() ) : ?>
					<div style="margin-bottom: 3rem; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 40px rgba(11,21,37,0.1);">
						<?php the_post_thumbnail( 'full', array( 'style' => 'width: 100%; height: auto; max-height: 500px; object-fit: cover;' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				
				<div class="single-article__footer">
					<div class="single-article__nav">
						<?php
						$prev_post = get_previous_post();
						if ( $prev_post ) :
						?>
							<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="single-article__nav-prev">
								<span style="color: var(--ink-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700;"><?php esc_html_e( 'Previous Event', 'amcham-drc' ); ?></span>
								<strong><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></strong>
							</a>
						<?php else : ?>
							<div></div>
						<?php endif; ?>

						<?php
						$next_post = get_next_post();
						if ( $next_post ) :
						?>
							<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="single-article__nav-next">
								<span style="color: var(--ink-muted); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 700;"><?php esc_html_e( 'Next Event', 'amcham-drc' ); ?></span>
								<strong><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></strong>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
