<?php
/**
 * Template Name: Annuaire
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
			<p class="eyebrow eyebrow--light"><?php esc_html_e( 'Network', 'amcham-drc' ); ?></p>
			<h1><?php esc_html_e( 'Member Directory', 'amcham-drc' ); ?></h1>
			<p class="page-hero__lead"><?php esc_html_e( 'Discover the diverse network of businesses driving economic growth and partnership between the United States and the DRC.', 'amcham-drc' ); ?></p>
		</div>
	</section>

	<section class="section" style="background: var(--paper);">
		<div class="shell">
			<!-- Search -->
			<div class="directory-search">
				<div class="directory-search__icon">
					<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
				</div>
				<input type="text" class="directory-search__input" placeholder="<?php esc_attr_e( 'Search by company name, industry, or keyword...', 'amcham-drc' ); ?>">
			</div>

			<!-- Filters -->
			<div class="directory-filters">
				<button class="filter-pill filter-pill--active"><?php esc_html_e( 'All Industries', 'amcham-drc' ); ?></button>
				<button class="filter-pill"><?php esc_html_e( 'Mining', 'amcham-drc' ); ?></button>
				<button class="filter-pill"><?php esc_html_e( 'Finance', 'amcham-drc' ); ?></button>
				<button class="filter-pill"><?php esc_html_e( 'Technology', 'amcham-drc' ); ?></button>
				<button class="filter-pill"><?php esc_html_e( 'Logistics', 'amcham-drc' ); ?></button>
				<button class="filter-pill"><?php esc_html_e( 'Legal', 'amcham-drc' ); ?></button>
			</div>

			<p class="directory-results-count">Showing 6 member companies</p>

			<!-- Static Data Grid (as per implementation plan) -->
			<div class="member-grid">
				<?php
				$members = array(
					array( 'K', 'Kamoto Copper Company', 'Mining', 'Glencore', 'Kolwezi', 'www.glencore.com' ),
					array( 'E', 'Equity BCDC', 'Finance', 'Equity Group', 'Kinshasa', 'www.equitybcdc.cd' ),
					array( 'L', 'Liquid Intelligent Technologies', 'Technology', 'Cassava Technologies', 'Kinshasa', 'www.liquid.tech' ),
					array( 'P', 'PwC Francophone Africa', 'Consulting', 'PwC', 'Kinshasa', 'www.pwc.com' ),
					array( 'C', 'Congo Equipment', 'Heavy Machinery', 'Tractafric', 'Lubumbashi', 'www.congo-equipment.com' ),
					array( 'T', 'Tenke Fungurume Mining', 'Mining', 'CMOC', 'Fungurume', 'www.tfm.cd' ),
				);
				foreach ( $members as $m ) : ?>
					<article class="member-card">
						<div class="member-card__avatar"><?php echo esc_html( $m[0] ); ?></div>
						<h3><?php echo esc_html( $m[1] ); ?></h3>
						<span class="member-card__industry"><?php echo esc_html( $m[2] ); ?></span>
						
						<div class="member-card__details">
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Parent Group', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value"><?php echo esc_html( $m[3] ); ?></div>
							</div>
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Location', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value"><?php echo esc_html( $m[4] ); ?></div>
							</div>
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Website', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value">
									<a href="https://<?php echo esc_attr( $m[5] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $m[5] ); ?></a>
								</div>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
