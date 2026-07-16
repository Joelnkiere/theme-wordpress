<?php
/**
 * Template Name: Membership
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
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Membership', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'Join the Premier Business Network', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'Connect with industry leaders, access exclusive resources, and shape the future of US-DRC business relations.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<!-- Membership Options -->
	<section class="section">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<h2><?php esc_html_e( 'Membership Options', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'Choose the membership tier that best fits your organization\'s needs and goals.', 'amcham-drc' ); ?></p>
			</div>

			<div class="pricing-grid">
				<?php
				$args_mem = array(
					'post_type'      => 'amcham_membership',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order title',
					'order'          => 'ASC',
				);
				$query_mem = new WP_Query( $args_mem );

				if ( $query_mem->have_posts() ) :
					while ( $query_mem->have_posts() ) : $query_mem->the_post();
						$price = get_post_meta( get_the_ID(), '_amcham_price', true );
						$is_featured = get_post_meta( get_the_ID(), '_amcham_is_featured', true );
						$features_raw = get_the_content();
						$features = array_filter( array_map( 'trim', explode( "\n", strip_tags( $features_raw ) ) ) );
						
						$featured_class = ( '1' === $is_featured ) ? 'pricing-card--featured' : '';
						$button_class = ( '1' === $is_featured ) ? 'button--red' : 'button--outline';
						?>
						<div class="pricing-card <?php echo esc_attr( $featured_class ); ?>">
							<?php if ( '1' === $is_featured ) : ?><div class="pricing-card__bar"></div><?php endif; ?>
							<h3><?php the_title(); ?></h3>
							<div class="pricing-card__price"><span><?php echo esc_html( $price ); ?></span></div>
							<p><?php echo get_the_excerpt(); ?></p>
							<ul class="pricing-card__features">
								<?php foreach ( $features as $f ) : ?>
									<li><span class="pricing-card__check">✓</span> <?php echo esc_html( $f ); ?></li>
								<?php endforeach; ?>
							</ul>
							<a href="#apply" class="button <?php echo esc_attr( $button_class ); ?>"><?php esc_html_e( 'Apply Now', 'amcham-drc' ); ?> →</a>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					// Fallback
				?>
				<!-- Corporate -->
				<div class="pricing-card pricing-card--featured">
					<div class="pricing-card__bar"></div>
					<h3><?php esc_html_e( 'Corporate Membership', 'amcham-drc' ); ?></h3>
					<div class="pricing-card__price"><span>$2,000</span> <?php esc_html_e( '/ year', 'amcham-drc' ); ?></div>
					<p><?php esc_html_e( 'Ideal for established businesses seeking comprehensive access to AmCham DRC services and networking opportunities.', 'amcham-drc' ); ?></p>
					<ul class="pricing-card__features">
						<?php foreach ( array( 'Voting rights and board eligibility', 'Unlimited event access', 'Premium member directory listing', 'Exclusive market intelligence reports', 'Business matchmaking services', 'Advocacy support and representation' ) as $f ) : ?>
							<li><span class="pricing-card__check">✓</span> <?php echo esc_html( $f ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a href="#apply" class="button button--red"><?php esc_html_e( 'Apply Now', 'amcham-drc' ); ?> →</a>
				</div>

				<!-- NGO -->
				<div class="pricing-card">
					<h3><?php esc_html_e( 'NGO Membership', 'amcham-drc' ); ?></h3>
					<div class="pricing-card__price"><span>$1,000</span> <?php esc_html_e( '/ year', 'amcham-drc' ); ?></div>
					<p><?php esc_html_e( 'Perfect for non-governmental organizations committed to US-DRC business development.', 'amcham-drc' ); ?></p>
					<ul class="pricing-card__features">
						<?php foreach ( array( 'Member directory listing', 'Event access (discounted rates)', 'Market intelligence resources', 'Networking opportunities', 'Collaboration initiatives', 'Newsletter and updates' ) as $f ) : ?>
							<li><span class="pricing-card__check">✓</span> <?php echo esc_html( $f ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a href="#apply" class="button button--outline"><?php esc_html_e( 'Apply Now', 'amcham-drc' ); ?> →</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Apply Form -->
	<section id="apply" class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<h2><?php esc_html_e( 'Apply for Membership', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'Fill out the form below and our team will get back to you within 24 hours.', 'amcham-drc' ); ?></p>
			</div>
			<div class="amcham-form-card">
				<?php
				if ( isset( $_GET['membership_sent'] ) && '1' === $_GET['membership_sent'] ) : ?>
					<div class="amcham-form__success">
						✓ <?php esc_html_e( 'Thank you! Your membership inquiry has been submitted. We\'ll be in touch soon.', 'amcham-drc' ); ?>
					</div>
				<?php else : ?>
				<form class="amcham-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data">
					<?php wp_nonce_field( 'amcham_membership_form', 'amcham_membership_nonce' ); ?>
					<input type="hidden" name="action" value="amcham_membership_submit">
					<div class="amcham-form__row">
						<div class="amcham-form__field">
							<label for="mem_name"><?php esc_html_e( 'Full Name *', 'amcham-drc' ); ?></label>
							<input type="text" id="mem_name" name="mem_name" required placeholder="<?php esc_attr_e( 'Your full name', 'amcham-drc' ); ?>">
						</div>
						<div class="amcham-form__field">
							<label for="mem_company"><?php esc_html_e( 'Company Name *', 'amcham-drc' ); ?></label>
							<input type="text" id="mem_company" name="mem_company" required placeholder="<?php esc_attr_e( 'Your company name', 'amcham-drc' ); ?>">
						</div>
					</div>
					<div class="amcham-form__row">
						<div class="amcham-form__field">
							<label for="mem_email"><?php esc_html_e( 'Email Address *', 'amcham-drc' ); ?></label>
							<input type="email" id="mem_email" name="mem_email" required placeholder="your@email.com">
						</div>
						<div class="amcham-form__field">
							<label for="mem_phone"><?php esc_html_e( 'Phone Number', 'amcham-drc' ); ?></label>
							<input type="tel" id="mem_phone" name="mem_phone" placeholder="+243 (0) 123 456 789">
						</div>
					</div>
					<div class="amcham-form__field">
						<label for="mem_type"><?php esc_html_e( 'Membership Type *', 'amcham-drc' ); ?></label>
						<select id="mem_type" name="mem_type" required>
						<option value=""><?php esc_html_e( 'Select a type...', 'amcham-drc' ); ?></option>
						<?php
						$tiers = new WP_Query( array(
							'post_type'      => 'amcham_membership',
							'posts_per_page' => -1,
							'orderby'        => 'menu_order title',
							'order'          => 'ASC',
						) );
						if ( $tiers->have_posts() ) :
							while ( $tiers->have_posts() ) : $tiers->the_post();
								$price = get_post_meta( get_the_ID(), '_amcham_price', true );
								$label = get_the_title() . ( $price ? ' (' . esc_html( $price ) . ')' : '' );
								?>
								<option value="<?php echo esc_attr( sanitize_title( get_the_title() ) ); ?>"><?php echo esc_html( $label ); ?></option>
							<?php endwhile;
							wp_reset_postdata();
						else : ?>
							<option value="corporate"><?php esc_html_e( 'Corporate ($2,000/yr)', 'amcham-drc' ); ?></option>
							<option value="ngo"><?php esc_html_e( 'NGO ($1,000/yr)', 'amcham-drc' ); ?></option>
						<?php endif; ?>
					</select>
					</div>
					<div class="amcham-form__field">
						<label for="mem_message"><?php esc_html_e( 'Tell us about your business *', 'amcham-drc' ); ?></label>
						<textarea id="mem_message" name="mem_message" rows="5" required placeholder="<?php esc_attr_e( 'Please describe your business, industry, and why you\'re interested in joining AmCham DRC...', 'amcham-drc' ); ?>"></textarea>
					</div>
					<button type="submit" class="button button--red"><?php esc_html_e( 'Submit Application', 'amcham-drc' ); ?> →</button>
				</form>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Sponsorship -->
	<section class="section">
		<div class="shell">
			<div class="section-heading section-heading--center">
				<h2><?php esc_html_e( 'Sponsorship Opportunities', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'Elevate your brand visibility through strategic sponsorships.', 'amcham-drc' ); ?></p>
			</div>
			<div class="sponsor-grid">
				<?php
				$args_spon = array(
					'post_type'      => 'amcham_sponsor',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order title',
					'order'          => 'ASC',
				);
				$query_spon = new WP_Query( $args_spon );

				if ( $query_spon->have_posts() ) :
					$icons = array(
						'<svg viewBox="0 0 24 24"><path d="M2 20h20M4 16l3-8 5 4 5-4 3 8H4zM12 8V4M12 4L10 6M12 4l2 2"/></svg>',
						'<svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>',
						'<svg viewBox="0 0 24 24"><path d="M12 17l-5.88 3.1 1.12-6.54-4.75-4.63 6.57-.95L12 2l2.94 5.98 6.57.95-4.75 4.63 1.12 6.54z"/><path d="M12 2v15"/></svg>'
					);
					$i = 0;
					while ( $query_spon->have_posts() ) : $query_spon->the_post();
						$benefits_raw = get_the_content();
						$benefits = array_filter( array_map( 'trim', explode( "\n", strip_tags( $benefits_raw ) ) ) );
						$icon = $icons[ $i % count( $icons ) ];
						$i++;
						?>
						<div class="info-card" style="text-align: left;">
							<div class="info-card__icon icon-circle icon-circle--lg" style="margin-bottom: 1.5rem;"><?php echo $icon; ?></div>
							<h3><?php the_title(); ?></h3>
							<p><?php echo get_the_excerpt(); ?></p>
							<ul style="list-style: none; padding: 0; margin: 1rem 0; display: flex; flex-direction: column; gap: 0.4rem;">
								<?php foreach ( $benefits as $b ) : ?>
									<li style="font-size: 0.9rem; color: var(--ink-muted);">• <?php echo esc_html( $b ); ?></li>
								<?php endforeach; ?>
							</ul>
							<a href="#apply" class="text-link"><?php esc_html_e( 'Inquire', 'amcham-drc' ); ?> →</a>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					// Fallback
					$sponsors = array(
						array( '<svg viewBox="0 0 24 24"><path d="M2 20h20M4 16l3-8 5 4 5-4 3 8H4zM12 8V4M12 4L10 6M12 4l2 2"/></svg>', 'Platinum Sponsor', 'Premium visibility at all major AmCham DRC events and initiatives.', array( 'Logo on all event materials', 'Speaking opportunity at events', 'Premium booth', 'Exclusive networking reception', 'Annual recognition dinner' ) ),
						array( '<svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>', 'Gold Sponsor', 'Strong brand presence at key AmCham DRC events throughout the year.', array( 'Logo on event materials', 'Standard booth at events', 'Networking reception access', 'Member newsletter feature', 'Website recognition' ) ),
						array( '<svg viewBox="0 0 24 24"><path d="M12 17l-5.88 3.1 1.12-6.54-4.75-4.63 6.57-.95L12 2l2.94 5.98 6.57.95-4.75 4.63 1.12 6.54z"/><path d="M12 2v15"/></svg>', 'Silver Sponsor', 'Growing brand visibility in AmCham DRC community activities.', array( 'Event attendance', 'Website listing', 'Newsletter mention', 'Networking access', 'Member directory' ) ),
					);
					foreach ( $sponsors as $s ) : ?>
						<div class="info-card" style="text-align: left;">
							<div class="info-card__icon icon-circle icon-circle--lg" style="margin-bottom: 1.5rem;"><?php echo $s[0]; ?></div>
							<h3><?php echo esc_html( $s[1] ); ?></h3>
							<p><?php echo esc_html( $s[2] ); ?></p>
							<ul style="list-style: none; padding: 0; margin: 1rem 0; display: flex; flex-direction: column; gap: 0.4rem;">
								<?php foreach ( $s[3] as $b ) : ?>
									<li style="font-size: 0.9rem; color: var(--ink-muted);">• <?php echo esc_html( $b ); ?></li>
								<?php endforeach; ?>
							</ul>
							<a href="#apply" class="text-link"><?php esc_html_e( 'Inquire', 'amcham-drc' ); ?> →</a>
						</div>
					<?php endforeach; 
				endif;
				?>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
