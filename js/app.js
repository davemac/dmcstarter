
'use strict';
jQuery(document).ready(function ($) {

	$('.homepage-slider').flickity({
		// options
		wrapAround: true,
		freeScroll: true,
		freeScrollFriction: 0.04,
		lazyLoad: true,
		pageDots: false,
	});

	$('.testimonial-slider').flickity({
		// options
		cellAlign: 'left',
		wrapAround: true,
		groupCells: true,
		// freeScroll: true,
		// freeScrollFriction: 0.08,
		selectedAttraction: 0.01,
		friction: 0.15,
		lazyLoad: true,
		// prevNextButtons: false,
		// pageDots: false
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

	// smooth scroll element into view
	function scrollTo(selector) {
		document.querySelector(selector).scrollIntoView(
			{ behavior: 'smooth' }
	)};

	$('.total-colour-mastery').click(function() {
		document.getElementById('total-colour-mastery').scrollIntoView(
			{ behavior: "smooth" }
		)
	});

	// set readonly attribute on form fields with this class
	$( '.gform_wrapper .dmc-read-only input' ).attr( 'readonly', '' );

});
