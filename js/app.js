
'use strict';
jQuery( document ).ready( function( $ ) {

	$('.property-slider-combined').flickity({
		// options
		cellAlign: 'left',
		wrapAround: true,
		groupCells: true,
		freeScroll: true,
		freeScrollFriction: 0.04,
		lazyLoad: 2
	});

	// set readonly attribute on form fields with this class
	$( '.gform_wrapper .dmc-read-only input' ).attr( 'readonly', '' );

});
