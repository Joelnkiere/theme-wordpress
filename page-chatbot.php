<?php
/**
 * Template Name: Chatbot
 * Template Post Type: page
 *
 * @package AmCham_DRC
 */

get_header();
?>
<main class="chat-page-fullscreen" style="background: linear-gradient(135deg, rgba(11,21,37,0.85) 0%, rgba(11,21,37,0.65) 100%), url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/market-insights.png' ); ?>') center/cover;">
	<div class="chat-page-fullscreen__content shell">
		<div class="chat-page-fullscreen__text">
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Interactive Support', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'AmCham AI Assistant', 'amcham-drc' ); ?></h1>
			<p><?php esc_html_e( 'Ask me anything about investing in the DRC, business regulations, or AmCham services.', 'amcham-drc' ); ?></p>
			<a class="text-link text-link--light" href="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin-top: 2rem;">← <?php esc_html_e( 'Back to Home', 'amcham-drc' ); ?></a>
		</div>
		<div class="chat-page-fullscreen__window">
			<div class="chat-page__header">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="chat-page__back-btn" aria-label="Back" style="display: none;">
					<svg viewBox="0 0 24 24" style="width: 20px; height: 20px; fill: currentColor;"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
				</a>
				<div class="chat-page__header-dot"></div>
				<h3><?php esc_html_e( 'AI Assistant', 'amcham-drc' ); ?></h3>
				<span><?php esc_html_e( 'Online', 'amcham-drc' ); ?></span>
			</div>
			
			<div class="chat-page__messages" id="amcham-chat-messages-page">
				<div class="chat-page__message chat-page__message--bot">
					<div class="chat-page__bubble">
						Hello! I'm the AmCham DRC AI Assistant. How can I help you today with your business queries regarding the Democratic Republic of Congo?
					</div>
				</div>
			</div>
			
			<div class="chat-page__suggestions">
				<button class="chat-page__suggestion">How do I become a member?</button>
				<button class="chat-page__suggestion">What are the mining regulations?</button>
				<button class="chat-page__suggestion">Tell me about upcoming events</button>
			</div>

			<form class="chat-page__input-area" id="amcham-chat-form-page">
				<input type="text" class="chat-page__input" id="amcham-chat-input-page" placeholder="<?php esc_attr_e( 'Type your question...', 'amcham-drc' ); ?>" required autocomplete="off">
				<button type="submit" class="chat-page__send" aria-label="<?php esc_attr_e( 'Send message', 'amcham-drc' ); ?>">
					<svg viewBox="0 0 24 24"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
				</button>
			</form>
		</div>
	</div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const form = document.getElementById('amcham-chat-form-page');
	const input = document.getElementById('amcham-chat-input-page');
	const messagesContainer = document.getElementById('amcham-chat-messages-page');
	const suggestions = document.querySelectorAll('.chat-page__suggestion');
	
	if (!form) return;

	function addMessage(text, isUser = false) {
		const messageDiv = document.createElement('div');
		messageDiv.className = `chat-page__message chat-page__message--${isUser ? 'user' : 'bot'}`;
		
		const bubble = document.createElement('div');
		bubble.className = 'chat-page__bubble';
		bubble.textContent = text;
		
		messageDiv.appendChild(bubble);
		messagesContainer.appendChild(messageDiv);
		messagesContainer.scrollTop = messagesContainer.scrollHeight;
	}

	function addTypingIndicator() {
		const messageDiv = document.createElement('div');
		messageDiv.className = 'chat-page__message chat-page__message--bot chat-typing-indicator-page';
		
		const bubble = document.createElement('div');
		bubble.className = 'chat-page__bubble';
		bubble.innerHTML = '<div style="display:flex;gap:4px;align-items:center;height:24px"><span style="width:6px;height:6px;background:var(--ink-muted);border-radius:50%;animation:typing 1.4s infinite ease-in-out both;animation-delay:-0.32s"></span><span style="width:6px;height:6px;background:var(--ink-muted);border-radius:50%;animation:typing 1.4s infinite ease-in-out both;animation-delay:-0.16s"></span><span style="width:6px;height:6px;background:var(--ink-muted);border-radius:50%;animation:typing 1.4s infinite ease-in-out both"></span></div>';
		
		messageDiv.appendChild(bubble);
		messagesContainer.appendChild(messageDiv);
		messagesContainer.scrollTop = messagesContainer.scrollHeight;
		return messageDiv;
	}

	async function sendMessage(text) {
		if (!text.trim()) return;
		
		addMessage(text, true);
		input.value = '';
		
		const indicator = addTypingIndicator();
		
		try {
			const response = await fetch('/wp-json/amcham/v1/chat', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce': amchamChatbot.nonce
				},
				body: JSON.stringify({ message: text })
			});
			
			indicator.remove();
			
			if (response.ok) {
				const data = await response.json();
				addMessage(data.reply || 'Sorry, I could not understand that.');
			} else {
				addMessage('Error communicating with the server.');
			}
		} catch (error) {
			indicator.remove();
			addMessage('Connection error. Please try again later.');
		}
	}

	form.addEventListener('submit', function(e) {
		e.preventDefault();
		sendMessage(input.value);
	});

	suggestions.forEach(button => {
		button.addEventListener('click', function() {
			sendMessage(this.textContent);
		});
	});
});
</script>

<?php get_footer(); ?>
