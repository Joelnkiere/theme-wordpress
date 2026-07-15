<?php
/**
 * The searchform template.
 * Overrides WordPress default search form.
 *
 * @package AmCham_DRC
 */
?>
<form class="amcham-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="amcham-search-input"><?php esc_html_e( 'Search for:', 'amcham-drc' ); ?></label>
	<div class="amcham-search-form__inner">
		<input
			type="search"
			id="amcham-search-input"
			class="amcham-search-form__input"
			placeholder="<?php esc_attr_e( 'Search news, events, resources...', 'amcham-drc' ); ?>"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			name="s"
		>
		<button type="submit" class="amcham-search-form__submit" aria-label="<?php esc_attr_e( 'Search', 'amcham-drc' ); ?>">
			<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5">
				<circle cx="11" cy="11" r="8"/>
				<line x1="21" y1="21" x2="16.65" y2="16.65"/>
			</svg>
		</button>
	</div>
</form>
