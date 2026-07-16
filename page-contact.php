<?php
/**
 * Template Name: Contact
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
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Get in Touch', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'Contact AmCham DRC', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'Have questions or want to learn more about our services? We\'d love to hear from you.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<!-- Contact Info Cards -->
	<section class="section">
		<div class="shell">
			<div class="cards-3col">
				<div class="info-card">
					<div class="info-card__icon icon-circle">
						<svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
					</div>
					<h3><?php esc_html_e( 'Email', 'amcham-drc' ); ?></h3>
					<p><?php esc_html_e( 'General Inquiries:', 'amcham-drc' ); ?></p>
					<a href="mailto:info@amchamdrc.org" style="color: var(--red); font-weight: 600;">info@amchamdrc.org</a>
					<p style="margin-top: 1rem;"><?php esc_html_e( 'Membership:', 'amcham-drc' ); ?></p>
					<a href="mailto:membership@amchamdrc.org" style="color: var(--red); font-weight: 600;">membership@amchamdrc.org</a>
				</div>
				<div class="info-card">
					<div class="info-card__icon icon-circle">
						<svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
					</div>
					<h3><?php esc_html_e( 'Phone', 'amcham-drc' ); ?></h3>
					<p><?php esc_html_e( 'Main Office:', 'amcham-drc' ); ?></p>
					<a href="tel:+243123456789" style="color: var(--red); font-weight: 600; font-size: 1.1rem;">+243 (0) 123 456 789</a>
					<p style="margin-top: 1rem; font-size: 0.9rem; color: var(--ink-muted);"><?php esc_html_e( 'Monday - Friday: 9:00 AM - 5:00 PM (CAT)', 'amcham-drc' ); ?></p>
				</div>
				<div class="info-card">
					<div class="info-card__icon icon-circle">
						<svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
					</div>
					<h3><?php esc_html_e( 'Address', 'amcham-drc' ); ?></h3>
					<p style="line-height: 1.9;">
						AmCham DRC<br>
						<?php esc_html_e( 'Avenue de la Paix', 'amcham-drc' ); ?><br>
						<?php esc_html_e( 'Kinshasa, Democratic Republic of Congo', 'amcham-drc' ); ?><br>
						<span style="font-size: 0.9rem; color: var(--ink-muted);">P.O. Box 12345</span>
					</p>
				</div>
			</div>

			<!-- Map -->
			<div style="margin-top: 4rem; border-radius: 8px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.08);">
				<iframe
					width="100%"
					height="400"
					style="border:0; display:block;"
					loading="lazy"
					allowfullscreen
					referrerpolicy="no-referrer-when-downgrade"
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126716.69386178!2d15.2345!3d-4.3217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a330b7c8bb73d%3A0x9f7f4c2a6c748d8a!2sKinshasa%2C%20Democratic%20Republic%20of%20the%20Congo!5e0!3m2!1sen!2sus!4v1699900000000"
				></iframe>
			</div>
		</div>
	</section>

	<!-- Contact Form + FAQ -->
	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="contact-layout">
				<!-- Form -->
				<div>
					<h2><?php esc_html_e( 'Send us a Message', 'amcham-drc' ); ?></h2>
					<p style="color: var(--ink-muted); margin-bottom: 2rem;"><?php esc_html_e( 'Fill out the form below and we\'ll get back to you as soon as possible.', 'amcham-drc' ); ?></p>

					<?php if ( isset( $_GET['contact_sent'] ) && '1' === $_GET['contact_sent'] ) : ?>
						<div class="amcham-form__success">
							✓ <?php esc_html_e( 'Thank you! Your message has been sent. We will get back to you soon.', 'amcham-drc' ); ?>
						</div>
					<?php else : ?>
					<form class="amcham-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
						<?php wp_nonce_field( 'amcham_contact_form', 'amcham_contact_nonce' ); ?>
						<input type="hidden" name="action" value="amcham_contact_submit">
						<div class="amcham-form__row">
							<div class="amcham-form__field">
								<label for="cnt_name"><?php esc_html_e( 'Full Name *', 'amcham-drc' ); ?></label>
								<input type="text" id="cnt_name" name="cnt_name" required placeholder="<?php esc_attr_e( 'Your name', 'amcham-drc' ); ?>">
							</div>
							<div class="amcham-form__field">
								<label for="cnt_email"><?php esc_html_e( 'Email Address *', 'amcham-drc' ); ?></label>
								<input type="email" id="cnt_email" name="cnt_email" required placeholder="your@email.com">
							</div>
						</div>
						<div class="amcham-form__field">
							<label for="cnt_phone"><?php esc_html_e( 'Phone Number', 'amcham-drc' ); ?></label>
							<input type="tel" id="cnt_phone" name="cnt_phone" placeholder="+243 (0) 123 456 789">
						</div>
						<div class="amcham-form__field">
							<label for="cnt_subject"><?php esc_html_e( 'Subject *', 'amcham-drc' ); ?></label>
							<input type="text" id="cnt_subject" name="cnt_subject" required placeholder="<?php esc_attr_e( 'What is this about?', 'amcham-drc' ); ?>">
						</div>
						<div class="amcham-form__field">
							<label for="cnt_message"><?php esc_html_e( 'Message *', 'amcham-drc' ); ?></label>
							<textarea id="cnt_message" name="cnt_message" rows="6" required placeholder="<?php esc_attr_e( 'Tell us more about your inquiry...', 'amcham-drc' ); ?>"></textarea>
						</div>
						<button type="submit" class="button button--red"><?php esc_html_e( 'Send Message', 'amcham-drc' ); ?> →</button>
					</form>
					<?php endif; ?>
				</div>

				<!-- FAQ -->
				<div class="faq-list">
					<h2><?php esc_html_e( 'Frequently Asked Questions', 'amcham-drc' ); ?></h2>
					<?php
					$faqs = array(
						array( 'How do I become a member?', 'Visit our Membership page to learn about membership benefits and application requirements. You can also contact us at membership@amchamdrc.org.' ),
						array( 'What events do you organize?', 'We organize networking events, business forums, policy roundtables, and professional development training sessions.' ),
						array( 'How can I access market reports?', 'Members have access to exclusive market intelligence reports and analysis. Visit our Resources page to browse available documents.' ),
						array( 'What is your response time?', 'We aim to respond to all inquiries within 24-48 business hours. For urgent matters, please call our office during business hours.' ),
					);
					foreach ( $faqs as $faq ) : ?>
						<details class="faq-item">
							<summary><?php echo esc_html( $faq[0] ); ?></summary>
							<p><?php echo esc_html( $faq[1] ); ?></p>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
