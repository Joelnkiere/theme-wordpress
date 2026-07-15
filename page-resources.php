<?php
/**
 * Template Name: Ressources
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
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Intelligence', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'Resources & Market Intelligence', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'Access comprehensive reports, sector analyses, and business guides to inform your strategy in the DRC market.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<!-- Resource Categories -->
	<section class="section">
		<div class="shell">
			<div class="resource-tabs">
				<a href="#market-insights" class="resource-tab resource-tab--active"><?php esc_html_e( 'Market Insights', 'amcham-drc' ); ?></a>
				<a href="#publications" class="resource-tab"><?php esc_html_e( 'Publications', 'amcham-drc' ); ?></a>
				<a href="#anapi-guide" class="resource-tab"><?php esc_html_e( 'ANAPI Guide', 'amcham-drc' ); ?></a>
				<a href="#external" class="resource-tab"><?php esc_html_e( 'External Resources', 'amcham-drc' ); ?></a>
			</div>
		</div>
	</section>

	<!-- Market Insights -->
	<section id="market-insights" class="section" style="padding-top: 0;">
		<div class="shell">
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'Market Insights', 'amcham-drc' ); ?></p>
				<h2><?php esc_html_e( 'DRC Market Reports', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'In-depth analysis and economic indicators for the DRC market.', 'amcham-drc' ); ?></p>
			</div>
			<div class="resource-grid">
				<?php
				$reports = array(
					array( '📊', 'DRC Economic Outlook 2024', 'Comprehensive overview of the DRC economy, key sectors, and investment opportunities.', 'Members Only', '#' ),
					array( '⛏️', 'Mining Sector Analysis', 'Deep dive into DRC\'s mining industry, regulations, and major players.', 'Members Only', '#' ),
					array( '💹', 'Trade Statistics Report', 'US-DRC bilateral trade data and trend analysis.', 'Free', '#' ),
					array( '🌿', 'Agriculture & Agribusiness', 'Investment opportunities in the DRC agricultural sector.', 'Members Only', '#' ),
				);
				foreach ( $reports as $r ) : ?>
					<div class="resource-card">
						<div class="resource-card__icon"><?php echo $r[0]; ?></div>
						<div class="resource-card__content">
							<h3><?php echo esc_html( $r[1] ); ?></h3>
							<p><?php echo esc_html( $r[2] ); ?></p>
							<div class="resource-card__footer">
								<span class="resource-card__badge resource-card__badge--<?php echo ( 'Free' === $r[3] ) ? 'free' : 'member'; ?>"><?php echo esc_html( $r[3] ); ?></span>
								<a class="text-link" href="<?php echo esc_url( $r[4] ); ?>"><?php esc_html_e( 'Access Report', 'amcham-drc' ); ?> →</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Publications -->
	<section id="publications" class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'Publications', 'amcham-drc' ); ?></p>
				<h2><?php esc_html_e( 'AmCham DRC Publications', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'Official publications, newsletters, and policy papers from AmCham DRC.', 'amcham-drc' ); ?></p>
			</div>
			<div class="resource-grid">
				<?php
				$pubs = array(
					array( '📰', 'Monthly Newsletter', 'Stay informed with the latest news, events, and business updates from AmCham DRC.', 'Free', '#' ),
					array( '📋', 'Annual Report 2023', 'Review of AmCham DRC activities, achievements, and membership highlights for 2023.', 'Free', '#' ),
					array( '📜', 'Policy Position Papers', 'AmCham DRC\'s official positions on key regulatory and business environment issues.', 'Members Only', '#' ),
				);
				foreach ( $pubs as $r ) : ?>
					<div class="resource-card">
						<div class="resource-card__icon"><?php echo $r[0]; ?></div>
						<div class="resource-card__content">
							<h3><?php echo esc_html( $r[1] ); ?></h3>
							<p><?php echo esc_html( $r[2] ); ?></p>
							<div class="resource-card__footer">
								<span class="resource-card__badge resource-card__badge--<?php echo ( 'Free' === $r[3] ) ? 'free' : 'member'; ?>"><?php echo esc_html( $r[3] ); ?></span>
								<a class="text-link" href="<?php echo esc_url( $r[4] ); ?>"><?php esc_html_e( 'Download', 'amcham-drc' ); ?> →</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ANAPI Guide -->
	<section id="anapi-guide" class="section">
		<div class="shell">
			<div class="report-banner__inner">
				<div style="background: var(--ink-deep); border-radius: 8px; min-height: 280px; display: flex; align-items: center; justify-content: center; font-size: 5rem;">📖</div>
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Business Guide', 'amcham-drc' ); ?></p>
					<h2><?php esc_html_e( 'ANAPI Investment Guide', 'amcham-drc' ); ?></h2>
					<p style="color: var(--ink-muted); max-width: 500px;"><?php esc_html_e( 'A comprehensive guide to the National Agency for Investment Promotion (ANAPI) processes, registration requirements, and investment incentives in the DRC.', 'amcham-drc' ); ?></p>
					<a href="#" class="button button--outline" style="margin-top: 1rem;"><?php esc_html_e( 'Download Guide', 'amcham-drc' ); ?> →</a>
				</div>
			</div>
		</div>
	</section>

	<!-- External Resources -->
	<section id="external" class="section" style="background: var(--paper);">
		<div class="shell">
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'External Resources', 'amcham-drc' ); ?></p>
				<h2><?php esc_html_e( 'Useful Links', 'amcham-drc' ); ?></h2>
				<p><?php esc_html_e( 'Key resources from trusted institutions for doing business in the DRC.', 'amcham-drc' ); ?></p>
			</div>
			<div class="resource-grid">
				<?php
				$external = array(
					array( '🇺🇸', 'US Embassy Kinshasa', 'Official portal with business and visa information.', 'https://cd.usembassy.gov/' ),
					array( '🏛️', 'International Trade Administration', 'US government resource for exporting and international business.', 'https://www.trade.gov/' ),
					array( '🌍', 'World Bank DRC', 'Data, projects, and research on the DRC economy.', 'https://www.worldbank.org/en/country/drc' ),
					array( '💼', 'ANAPI', 'Agence Nationale pour la Promotion des Investissements.', 'https://www.anapi.cd/' ),
				);
				foreach ( $external as $r ) : ?>
					<div class="resource-card">
						<div class="resource-card__icon"><?php echo $r[0]; ?></div>
						<div class="resource-card__content">
							<h3><?php echo esc_html( $r[1] ); ?></h3>
							<p><?php echo esc_html( $r[2] ); ?></p>
							<a class="text-link" href="<?php echo esc_url( $r[3] ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Visit Site', 'amcham-drc' ); ?> →</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
