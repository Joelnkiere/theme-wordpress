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
				<input type="text" id="dirSearchInput" class="directory-search__input" placeholder="<?php esc_attr_e( 'Search by company name, industry, or keyword...', 'amcham-drc' ); ?>">
			</div>

			<?php
			$args = array(
				'post_type'      => 'amcham_directory',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			);
			$query = new WP_Query( $args );

			// Collect unique industries
			$industries = array();
			$members_html = '';
			$count = 0;

			if ( $query->have_posts() ) {
				ob_start();
				while ( $query->have_posts() ) {
					$query->the_post();
					$title = get_the_title();
					$initial = substr( $title, 0, 1 );
					$industry = get_the_excerpt();
					if ( empty( $industry ) ) {
						$industry = 'Business';
					}
					if ( ! in_array( $industry, $industries ) ) {
						$industries[] = $industry;
					}
					
					$parent_group = get_post_meta( get_the_ID(), '_amcham_parent_group', true );
					if ( empty( $parent_group ) ) {
						$parent_group = 'Independent';
					}
					$location = get_post_meta( get_the_ID(), '_amcham_location', true );
					if ( empty( $location ) ) {
						$location = 'DRC';
					}
					$website = get_post_meta( get_the_ID(), '_amcham_website', true );
					$website_display = preg_replace( '#^https?://#', '', $website );
					$website_display = rtrim( $website_display, '/' );
					
					// Output Member Card
					?>
					<article class="member-card" data-title="<?php echo esc_attr( strtolower( $title ) ); ?>" data-industry="<?php echo esc_attr( strtolower( $industry ) ); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="member-card__avatar" style="background:none; overflow:hidden;">
								<?php the_post_thumbnail( 'thumbnail', array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) ); ?>
							</div>
						<?php else : ?>
							<div class="member-card__avatar"><?php echo esc_html( $initial ); ?></div>
						<?php endif; ?>
						<h3><?php echo esc_html( $title ); ?></h3>
						<span class="member-card__industry"><?php echo esc_html( $industry ); ?></span>
						
						<div class="member-card__details">
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Parent Group', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value"><?php echo esc_html( $parent_group ); ?></div>
							</div>
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Location', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value"><?php echo esc_html( $location ); ?></div>
							</div>
							<?php if ( ! empty( $website ) ) : 
								$website_url = ( strpos( $website, 'http' ) === 0 ) ? $website : 'https://' . $website;
							?>
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Website', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value">
									<a href="<?php echo esc_url( $website_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $website_display ); ?></a>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</article>
					<?php
					$count++;
				}
				$members_html = ob_get_clean();
				wp_reset_postdata();
			} else {
				// Fallback if no members have been added yet
				$fallback_members = array(
					array( 'Kamoto Copper Company', 'Mining', 'Glencore', 'Kolwezi', 'www.glencore.com' ),
					array( 'Equity BCDC', 'Finance', 'Equity Group', 'Kinshasa', 'www.equitybcdc.cd' ),
					array( 'Liquid Intelligent Technologies', 'Technology', 'Cassava Technologies', 'Kinshasa', 'www.liquid.tech' ),
					array( 'PwC Francophone Africa', 'Consulting', 'PwC', 'Kinshasa', 'www.pwc.com' ),
					array( 'Congo Equipment', 'Heavy Machinery', 'Tractafric', 'Lubumbashi', 'www.congo-equipment.com' ),
					array( 'Tenke Fungurume Mining', 'Mining', 'CMOC', 'Fungurume', 'www.tfm.cd' ),
				);
				ob_start();
				foreach ( $fallback_members as $m ) {
					$title = $m[0];
					$initial = substr( $title, 0, 1 );
					$industry = $m[1];
					if ( ! in_array( $industry, $industries ) ) {
						$industries[] = $industry;
					}
					?>
					<article class="member-card" data-title="<?php echo esc_attr( strtolower( $title ) ); ?>" data-industry="<?php echo esc_attr( strtolower( $industry ) ); ?>">
						<div class="member-card__avatar"><?php echo esc_html( $initial ); ?></div>
						<h3><?php echo esc_html( $title ); ?></h3>
						<span class="member-card__industry"><?php echo esc_html( $industry ); ?></span>
						<div class="member-card__details">
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Parent Group', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value"><?php echo esc_html( $m[2] ); ?></div>
							</div>
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Location', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value"><?php echo esc_html( $m[3] ); ?></div>
							</div>
							<div>
								<div class="member-card__detail-label"><?php esc_html_e( 'Website', 'amcham-drc' ); ?></div>
								<div class="member-card__detail-value">
									<a href="https://<?php echo esc_attr( $m[4] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $m[4] ); ?></a>
								</div>
							</div>
						</div>
					</article>
					<?php
					$count++;
				}
				$members_html = ob_get_clean();
			}
			sort( $industries );
			?>

			<!-- Filters -->
			<div class="directory-filters" id="dirFilters">
				<button class="filter-pill filter-pill--active" data-filter="all"><?php esc_html_e( 'All Industries', 'amcham-drc' ); ?></button>
				<?php foreach ( $industries as $ind ) : ?>
					<button class="filter-pill" data-filter="<?php echo esc_attr( strtolower( $ind ) ); ?>"><?php echo esc_html( $ind ); ?></button>
				<?php endforeach; ?>
			</div>

			<p class="directory-results-count" id="dirCount"><?php printf( esc_html__( 'Showing %d member companies', 'amcham-drc' ), $count ); ?></p>

			<!-- Dynamic Data Grid -->
			<div class="member-grid" id="dirGrid">
				<?php echo $members_html; ?>
			</div>
		</div>
	</section>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const searchInput = document.getElementById('dirSearchInput');
		const filterBtns = document.querySelectorAll('#dirFilters .filter-pill');
		const cards = document.querySelectorAll('#dirGrid .member-card');
		const countEl = document.getElementById('dirCount');
		let activeFilter = 'all';

		function filterMembers() {
			const searchTerm = searchInput.value.toLowerCase().trim();
			let visibleCount = 0;

			cards.forEach(card => {
				const title = card.getAttribute('data-title');
				const industry = card.getAttribute('data-industry');
				
				const matchesSearch = title.includes(searchTerm) || industry.includes(searchTerm);
				const matchesFilter = activeFilter === 'all' || industry === activeFilter;

				if (matchesSearch && matchesFilter) {
					card.style.display = '';
					visibleCount++;
				} else {
					card.style.display = 'none';
				}
			});

			countEl.textContent = `Showing ${visibleCount} member companies`;
		}

		searchInput.addEventListener('input', filterMembers);

		filterBtns.forEach(btn => {
			btn.addEventListener('click', function() {
				filterBtns.forEach(b => b.classList.remove('filter-pill--active'));
				this.classList.add('filter-pill--active');
				activeFilter = this.getAttribute('data-filter');
				filterMembers();
			});
		});
	});
	</script>
</main>
<?php get_footer(); ?>
