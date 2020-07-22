
'use strict';
jQuery( document ).ready( function( $ ) {

	$('.testimonial-slider').flickity({
		// options
		cellAlign: 'left',
		wrapAround: true,
		groupCells: true,
		freeScroll: true,
		freeScrollFriction: 0.04,
	});

	$('.posts-slider').flickity({
		// options
		cellAlign: 'left',
		wrapAround: true,
		freeScroll: true,
		freeScrollFriction: 0.04,
		lazyLoad: true,
	});

	$('.product-slider').flickity({
		// options
		wrapAround: true,
		freeScroll: true,
		freeScrollFriction: 0.04,
		lazyLoad: true
	});

	// set readonly attribute on form fields with this class
	$( '.gform_wrapper .dmc-read-only input' ).attr( 'readonly', '' );

});
