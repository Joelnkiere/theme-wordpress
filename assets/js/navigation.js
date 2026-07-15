( function () {
  const toggle = document.querySelector( '[data-menu-toggle]' );
  const nav = document.querySelector( '[data-primary-nav]' );
  const header = document.querySelector( '[data-site-header]' );

  if ( toggle && nav ) {
    toggle.addEventListener( 'click', function () {
      const open = nav.classList.toggle( 'is-open' );
      toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
      document.body.classList.toggle( 'menu-is-open', open );
    } );
  }

  if ( header ) {
    const updateHeader = function () {
      header.classList.toggle( 'is-scrolled', window.scrollY > 20 );
    };
    updateHeader();
    window.addEventListener( 'scroll', updateHeader, { passive: true } );
  }
}() );
