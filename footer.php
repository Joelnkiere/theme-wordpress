<?php
/**
 * Site footer.
 *
 * @package AmCham_DRC
 */
?>
<footer class="site-footer">
	<div class="shell site-footer__top">
		<div class="site-footer__brand">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/amcham-logo.png' ); ?>" alt="" width="60" height="60">
			<div><strong>AmCham DRC</strong><span><?php esc_html_e( 'American Chamber of Commerce', 'amcham-drc' ); ?></span></div>
		</div>
		<div class="site-footer__contact">
			<a href="mailto:<?php echo esc_attr( antispambot( amcham_drc_theme_mod( 'contact_email', 'info@amchamdrc.org' ) ) ); ?>"><?php echo esc_html( antispambot( amcham_drc_theme_mod( 'contact_email', 'info@amchamdrc.org' ) ) ); ?></a>
			<div class="social-links" aria-label="<?php esc_attr_e( 'Social media', 'amcham-drc' ); ?>">
				<a href="https://linkedin.com/" aria-label="LinkedIn">in</a><a href="https://twitter.com/" aria-label="X">𝕏</a><a href="https://facebook.com/" aria-label="Facebook">f</a>
			</div>
		</div>
	</div>

	<?php if ( has_nav_menu( 'footer' ) ) : ?>
		<nav class="site-footer__nav shell" aria-label="<?php esc_attr_e( 'Footer navigation', 'amcham-drc' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'footer-menu',
				'depth'          => 1,
			) );
			?>
		</nav>
	<?php endif; ?>

	<div class="shell site-footer__bottom">
		<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php esc_html_e( 'AmCham DRC. All rights reserved.', 'amcham-drc' ); ?></p>
		<div><a href="#"><?php esc_html_e( 'Privacy Policy', 'amcham-drc' ); ?></a><a href="#"><?php esc_html_e( 'Terms of Service', 'amcham-drc' ); ?></a></div>
	</div>
</footer>

<?php if ( get_theme_mod( 'amcham_enable_chatbot', false ) ) : 
	$chatbot_title = get_theme_mod( 'amcham_chatbot_title', 'AmCham Assistant' );
	// Use WP REST proxy — hides the real third-party API key/URL from browser source.
	$proxy_url = rest_url( 'amcham/v1/chat' );
?>
<div id="amcham-chatbot" class="amcham-chatbot" data-api-url="<?php echo esc_url( $proxy_url ); ?>">
	<button id="amcham-chatbot-toggle" class="chatbot-toggle" aria-label="<?php esc_attr_e( 'Open Chat', 'amcham-drc' ); ?>">
		<svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
	</button>
	<div id="amcham-chatbot-window" class="chatbot-window">
		<div class="chatbot-header">
			<h3><?php echo esc_html( $chatbot_title ); ?></h3>
			<button id="amcham-chatbot-close" class="chatbot-close" aria-label="<?php esc_attr_e( 'Close Chat', 'amcham-drc' ); ?>">&times;</button>
		</div>
		<div id="amcham-chatbot-messages" class="chatbot-messages">
			<div class="chatbot-message chatbot-message--bot">
				<div class="chatbot-bubble">
					<?php esc_html_e( 'Hello! How can I help you today?', 'amcham-drc' ); ?>
				</div>
			</div>
		</div>
		<div class="chatbot-input-area">
			<input type="text" id="amcham-chatbot-input" placeholder="<?php esc_attr_e( 'Type your message...', 'amcham-drc' ); ?>" aria-label="<?php esc_attr_e( 'Chat input', 'amcham-drc' ); ?>">
			<button id="amcham-chatbot-send" class="chatbot-send" aria-label="<?php esc_attr_e( 'Send message', 'amcham-drc' ); ?>">
				<svg viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
			</button>
		</div>
	</div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
