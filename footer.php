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
				<a href="https://linkedin.com/" aria-label="LinkedIn">
					<svg viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
				</a>
				<a href="https://twitter.com/" aria-label="X">
					<svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
				</a>
				<a href="https://facebook.com/" aria-label="Facebook">
					<svg viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
				</a>
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
