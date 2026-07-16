/**
 * Scroll-triggered animations using IntersectionObserver.
 *
 * @package AmCham_DRC
 */
(function () {
	'use strict';

	var SELECTOR = '.animate-on-scroll';

	function init() {
		var elements = document.querySelectorAll(SELECTOR);
		if (!elements.length) return;

		if (!('IntersectionObserver' in window)) {
			// Fallback: show everything immediately
			elements.forEach(function (el) { el.classList.add('is-visible'); });
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				var delayAccumulator = 0;
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						var delay = parseInt(entry.target.getAttribute('data-delay'), 10);
						if (isNaN(delay)) {
							delay = delayAccumulator;
							delayAccumulator += 100;
						}
						setTimeout(function () {
							entry.target.classList.add('is-visible');
						}, delay);
						observer.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.1, rootMargin: '0px 0px -40px 0px' }
		);

		elements.forEach(function (el) { observer.observe(el); });
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
