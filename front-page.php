<?php
/**
 * Homepage template.
 *
 * @package AmCham_DRC
 */

get_header();

$hero_eyebrow = amcham_drc_theme_mod( 'hero_eyebrow', __( 'The voice of American business in DRC', 'amcham-drc' ) );
$hero_title    = amcham_drc_theme_mod( 'hero_title', __( 'Global Network, Local Impact.', 'amcham-drc' ) );
$hero_text     = amcham_drc_theme_mod( 'hero_text', __( 'Connecting the Democratic Republic of Congo to the global marketplace through strategic American partnerships.', 'amcham-drc' ) );

$services_eyebrow = amcham_drc_theme_mod( 'services_eyebrow', __( 'What we do', 'amcham-drc' ) );
$services_title   = amcham_drc_theme_mod( 'services_title', __( 'Strategic Services', 'amcham-drc' ) );
$services_desc    = amcham_drc_theme_mod( 'services_desc', __( 'Comprehensive support designed to accelerate your business growth in the region.', 'amcham-drc' ) );

$report_eyebrow = amcham_drc_theme_mod( 'report_eyebrow', __( 'Intelligence', 'amcham-drc' ) );
$report_title   = amcham_drc_theme_mod( 'report_title', __( 'DRC Market Reports', 'amcham-drc' ) );
$report_desc    = amcham_drc_theme_mod( 'report_desc', __( 'Access in-depth analysis, sector reports, and economic indicators prepared by the International Trade Administration.', 'amcham-drc' ) );

$cta_eyebrow = amcham_drc_theme_mod( 'cta_eyebrow', __( 'Membership', 'amcham-drc' ) );
$cta_title   = amcham_drc_theme_mod( 'cta_title', __( 'Become a Member', 'amcham-drc' ) );
$cta_desc    = amcham_drc_theme_mod( 'cta_desc', __( 'Join a prestigious network of businesses committed to excellence and growth in the DRC. Gain access to exclusive resources, advocacy, and connections.', 'amcham-drc' ) );

$asset_uri     = get_template_directory_uri() . '/assets/images/';
?>
<main id="main-content">
	<section class="hero" aria-labelledby="hero-title">
		<div class="hero__backdrop" style="background-image:linear-gradient(90deg, rgba(11, 21, 38, .91) 0%, rgba(14, 27, 46, .76) 44%, rgba(14, 27, 46, .24) 100%), url('<?php echo esc_url( $asset_uri . 'hero-kinshasa.png' ); ?>');"></div>
		<div class="shell hero__content">
			<p class="eyebrow eyebrow--light"><?php echo esc_html( $hero_eyebrow ); ?></p>
			<h1 id="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
			<p class="hero__lead"><?php echo esc_html( $hero_text ); ?></p>
			<div class="hero__actions"><a class="button button--red" href="<?php echo esc_url( home_url( '/membership/' ) ); ?>"><?php esc_html_e( 'Join now', 'amcham-drc' ); ?><span>→</span></a><a class="text-link text-link--light" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About us', 'amcham-drc' ); ?></a></div>
			<div class="hero__stats" aria-label="<?php esc_attr_e( 'AmCham DRC at a glance', 'amcham-drc' ); ?>">
				<div><strong>50+</strong><span><?php esc_html_e( 'Members', 'amcham-drc' ); ?></span></div>
				<div><strong>12</strong><span><?php esc_html_e( 'Events / yr', 'amcham-drc' ); ?></span></div>
				<div><strong>24/7</strong><span><?php esc_html_e( 'Support', 'amcham-drc' ); ?></span></div>
			</div>
		</div>
		<a class="hero__insight-card" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">
			<img src="<?php echo esc_url( $asset_uri . 'market-insights.png' ); ?>" alt="<?php esc_attr_e( 'Market Insights', 'amcham-drc' ); ?>">
			<span><small><?php esc_html_e( 'Market insights', 'amcham-drc' ); ?></small><strong><?php esc_html_e( 'Access reports and analysis on US and DRC markets', 'amcham-drc' ); ?></strong><em><?php esc_html_e( 'Explore reports', 'amcham-drc' ); ?> →</em></span>
		</a>
	</section>

	<section class="services section">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<p class="eyebrow"><?php echo esc_html( $services_eyebrow ); ?></p>
				<h2><?php echo esc_html( $services_title ); ?></h2>
				<p><?php echo esc_html( $services_desc ); ?></p>
			</div>
			<div class="service-grid">
				<?php
				// For the sake of simplicity without over-engineering 12 customizer fields for individual services,
				// these are left in array form which could be extended via Customizer or block patterns if needed,
				// but the main headings are now dynamic.
				$services = array(
					array( 'service-networking.avif', __( 'Exclusive Networking Events', 'amcham-drc' ), __( 'Connect with key business leaders, government officials, and potential partners at our regular exclusive events, fostering invaluable relationships.', 'amcham-drc' ) ),
					array( 'service-advocacy.avif', __( 'Strong Business Advocacy', 'amcham-drc' ), __( 'Benefit from AmCham DRC’s powerful voice in advocating for a favorable business climate, policy reforms, and fair trade practices.', 'amcham-drc' ) ),
					array( 'service-intelligence.avif', __( 'Access to Market Intelligence', 'amcham-drc' ), __( 'Gain a competitive edge with exclusive in-depth market reports, economic analyses, and sector insights specific to the DRC.', 'amcham-drc' ) ),
					array( 'service-matching.avif', __( 'Tailored Business Matching', 'amcham-drc' ), __( 'Identify and connect with suitable partners, suppliers, or clients to support market entry and expansion.', 'amcham-drc' ) ),
				);
				foreach ( $services as $service ) :
					?>
					<article class="service-card"><img src="<?php echo esc_url( $asset_uri . $service[0] ); ?>" alt=""><div><h3><?php echo esc_html( $service[1] ); ?></h3><p><?php echo esc_html( $service[2] ); ?></p><a class="text-link" href="<?php echo esc_url( home_url( '/membership/' ) ); ?>"><?php esc_html_e( 'Learn more', 'amcham-drc' ); ?> →</a></div></article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="events-section section section--dark">
		<div class="shell events-layout">
			<div class="section-heading section-heading--light">
				<p class="eyebrow eyebrow--red"><?php esc_html_e( 'Agenda', 'amcham-drc' ); ?></p>
				<h2><?php esc_html_e( 'Upcoming Events', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'Join our exclusive networking sessions, policy roundtables, and business forums.', 'amcham-drc' ); ?></p>
				<a class="text-link text-link--light" href="<?php echo esc_url( get_post_type_archive_link( 'amcham_event' ) ); ?>"><?php esc_html_e( 'View full calendar', 'amcham-drc' ); ?> →</a>
			</div>
			<div class="event-list">
				<?php
				$events_query = new WP_Query( array(
					'post_type'      => 'amcham_event',
					'posts_per_page' => 2,
					'meta_key'       => '_amcham_event_date',
					'orderby'        => 'meta_value',
					'order'          => 'ASC',
				) );
				
				if ( $events_query->have_posts() ) :
					while ( $events_query->have_posts() ) : $events_query->the_post();
						$event_date = get_post_meta( get_the_ID(), '_amcham_event_date', true );
						if ( ! $event_date ) {
							$event_date = get_the_date( 'Y-m-d' );
						}
						$timestamp = strtotime( $event_date );
						$day = date_i18n( 'd', $timestamp );
						$month = strtoupper( date_i18n( 'M', $timestamp ) );
				?>
						<article class="event-card">
							<time datetime="<?php echo esc_attr( $event_date ); ?>">
								<b><?php echo esc_html( $day ); ?></b>
								<span><?php echo esc_html( $month ); ?></span>
							</time>
							<div>
								<h3><?php the_title(); ?></h3>
								<p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
								<a class="text-link text-link--light" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read details', 'amcham-drc' ); ?> →</a>
							</div>
						</article>
				<?php
					endwhile;
					wp_reset_postdata();
				else :
				?>
					<p><?php esc_html_e( 'No upcoming events at this time.', 'amcham-drc' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="report-banner">
		<div class="shell report-banner__inner">
			<img src="<?php echo esc_url( $asset_uri . 'report-cover.png' ); ?>" alt="">
			<div>
				<p class="eyebrow"><?php echo esc_html( $report_eyebrow ); ?></p>
				<h2><?php echo esc_html( $report_title ); ?></h2>
				<p><?php echo esc_html( $report_desc ); ?></p>
				<a class="button button--outline" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Access reports', 'amcham-drc' ); ?> <span>→</span></a>
			</div>
		</div>
	</section>

	<section class="news-section section">
		<div class="shell">
			<div class="news-heading">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'From the chamber', 'amcham-drc' ); ?></p>
					<h2><?php esc_html_e( 'Latest News', 'amcham-drc' ); ?></h2>
				</div>
				<a class="text-link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'View all articles', 'amcham-drc' ); ?> →</a>
			</div>
			
			<?php
			$news_query = new WP_Query( array(
				'post_type'      => 'post',
				'posts_per_page' => 3,
			) );
			
			if ( $news_query->have_posts() ) :
			?>
				<div class="news-grid">
					<?php 
					// First post (Featured)
					$news_query->the_post(); 
					?>
					<article class="news-featured">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large' ); ?>
						<?php else : ?>
							<img src="<?php echo esc_url( $asset_uri . 'mining-cover.png' ); ?>" alt="">
						<?php endif; ?>
						<div>
							<p class="news-meta">
								<?php esc_html_e( 'Featured', 'amcham-drc' ); ?> <span>•</span> 
								<?php echo esc_html( get_the_date() ); ?> <span>•</span> 
								<?php the_author(); ?>
							</p>
							<h3><?php the_title(); ?></h3>
							<p><?php echo wp_trim_words( get_the_excerpt(), 25 ); ?></p>
							<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read article', 'amcham-drc' ); ?> →</a>
						</div>
					</article>
					
					<?php if ( $news_query->current_post + 1 < $news_query->post_count ) : ?>
						<div class="news-list">
							<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
								<article>
									<time><?php echo esc_html( get_the_date( 'n/j/Y' ) ); ?></time>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</article>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php 
				wp_reset_postdata();
			else : 
			?>
				<p><?php esc_html_e( 'No news found.', 'amcham-drc' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<section class="membership-cta">
		<div class="shell membership-cta__inner">
			<p class="eyebrow eyebrow--red"><?php echo esc_html( $cta_eyebrow ); ?></p>
			<h2><?php echo esc_html( $cta_title ); ?></h2>
			<p><?php echo esc_html( $cta_desc ); ?></p>
			<div>
				<a class="button button--red" href="<?php echo esc_url( home_url( '/membership/' ) ); ?>"><?php esc_html_e( 'Apply now', 'amcham-drc' ); ?> <span>→</span></a>
				<a class="button button--ghost" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact us', 'amcham-drc' ); ?></a>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
