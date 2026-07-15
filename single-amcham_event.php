<?php
/**
 * The template for displaying all single events.
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main id="main-content" class="content-page">
	<div class="shell content-page__inner">
		<?php while ( have_posts() ) : the_post(); 
			$event_date = get_post_meta( get_the_ID(), '_amcham_event_date', true );
			$event_time = get_post_meta( get_the_ID(), '_amcham_event_time', true );
			$location   = get_post_meta( get_the_ID(), '_amcham_event_location', true );
			$link       = get_post_meta( get_the_ID(), '_amcham_event_link', true );
			
			$display_date = $event_date ? date_i18n( get_option( 'date_format' ), strtotime( $event_date ) ) : get_the_date();
		?>
			<article <?php post_class(); ?>>
				<header class="entry-header">
					<p class="eyebrow">
						<?php 
							printf( 
								/* translators: %s: Event Date */
								esc_html__( 'Event on %s', 'amcham-drc' ), 
								esc_html( $display_date ) 
							); 
						?>
					</p>
					<h1><?php the_title(); ?></h1>
					
					<div class="event-meta-info" style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-top: 1.5rem; padding: 1rem; background: var(--rule); border-radius: 8px;">
						<?php if ( $event_time ) : ?>
							<div><strong><?php esc_html_e( 'Time:', 'amcham-drc' ); ?></strong> <?php echo esc_html( $event_time ); ?></div>
						<?php endif; ?>
						<?php if ( $location ) : ?>
							<div><strong><?php esc_html_e( 'Location:', 'amcham-drc' ); ?></strong> <?php echo esc_html( $location ); ?></div>
						<?php endif; ?>
						<?php if ( $link ) : ?>
							<div><a class="text-link" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Registration Link', 'amcham-drc' ); ?> →</a></div>
						<?php endif; ?>
					</div>
				</header>
				
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-thumbnail" style="margin-bottom: 2rem;">
						<?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: auto; border-radius: 8px;' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>
<?php get_footer(); ?>
