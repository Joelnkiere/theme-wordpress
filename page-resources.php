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
					array( '<svg viewBox="0 0 24 24"><rect x="18" y="3" width="4" height="18"/><rect x="10" y="8" width="4" height="13"/><rect x="2" y="13" width="4" height="8"/></svg>', 'DRC Economic Outlook 2024', 'Comprehensive overview of the DRC economy, key sectors, and investment opportunities.', 'Members Only', '#' ),
					array( '<svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>', 'Mining Sector Analysis', 'Deep dive into DRC\'s mining industry, regulations, and major players.', 'Members Only', '#' ),
					array( '<svg viewBox="0 0 24 24"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>', 'Trade Statistics Report', 'US-DRC bilateral trade data and trend analysis.', 'Free', '#' ),
					array( '<svg viewBox="0 0 24 24"><path d="M11 20A7 7 0 0 1 4 13V4a7 7 0 0 1 7 7 7 7 0 0 1 7-7v9a7 7 0 0 1-7 7z"/></svg>', 'Agriculture & Agribusiness', 'Investment opportunities in the DRC agricultural sector.', 'Members Only', '#' ),
				);
				foreach ( $reports as $r ) : ?>
					<div class="resource-card">
						<div class="resource-card__icon icon-circle"><?php echo $r[0]; ?></div>
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
					array( '<svg viewBox="0 0 24 24"><path d="M4 22h14a2 2 0 0 0 2-2V7.5L14.5 2H6a2 2 0 0 0-2 2v4"/><path d="M14 2v6h6"/><path d="M2 15h10"/><path d="M2 19h10"/></svg>', 'Monthly Newsletter', 'Stay informed with the latest news, events, and business updates from AmCham DRC.', 'Free', '#' ),
					array( '<svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="9" x2="15" y2="9"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="15" y2="17"/></svg>', 'Annual Report 2023', 'Review of AmCham DRC activities, achievements, and membership highlights for 2023.', 'Free', '#' ),
					array( '<svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>', 'Policy Position Papers', 'AmCham DRC\'s official positions on key regulatory and business environment issues.', 'Members Only', '#' ),
				);
				foreach ( $pubs as $r ) : ?>
					<div class="resource-card">
						<div class="resource-card__icon icon-circle"><?php echo $r[0]; ?></div>
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
				<div style="background: var(--ink-deep); border-radius: 8px; min-height: 280px; display: flex; align-items: center; justify-content: center; color: var(--white);">
					<svg viewBox="0 0 24 24" style="width: 80px; height: 80px; fill: none; stroke: currentColor; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
				</div>
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
					array( '<svg viewBox="0 0 24 24"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>', 'US Embassy Kinshasa', 'Official portal with business and visa information.', 'https://cd.usembassy.gov/' ),
					array( '<svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>', 'International Trade Administration', 'US government resource for exporting and international business.', 'https://www.trade.gov/' ),
					array( '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>', 'World Bank DRC', 'Data, projects, and research on the DRC economy.', 'https://www.worldbank.org/en/country/drc' ),
					array( '<svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>', 'ANAPI', 'Agence Nationale pour la Promotion des Investissements.', 'https://www.anapi.cd/' ),
				);
				foreach ( $external as $r ) : ?>
					<div class="resource-card">
						<div class="resource-card__icon icon-circle"><?php echo $r[0]; ?></div>
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
