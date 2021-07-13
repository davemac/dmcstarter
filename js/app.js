
'use strict';

jQuery(function ($) {

	// offCanvas menu
	var menuToggle = document.querySelector("#menu-toggle");
	var menuContainer = document.querySelector(".off-canvas-wrap");
	var menuOffCanvas = document.querySelector(".right-off-canvas-menu");

	menuToggle.addEventListener("click", function(event) {
		var menuContainerOpen = menuContainer.classList.contains("move-left");
		var newMenuContainerOpenStatus = !menuContainerOpen;

		menuToggle.setAttribute("aria-expanded", newMenuContainerOpenStatus);
		menuContainer.classList.toggle("move-left");
		menuOffCanvas.classList.toggle("menu-hide");

		$("nav.right-off-canvas-menu").attr('aria-hidden') ?
			$("nav.right-off-canvas-menu").removeAttr('aria-hidden') : $("nav.right-off-canvas-menu").attr('aria-hidden', 'true');

	});

	$('.homepage-slider').flickity({
		// watchCSS: true,
		wrapAround: true,
		freeScroll: true,
		freeScrollFriction: 0.04,
		lazyLoad: true,
		pageDots: false,
	});

	$('.testimonial-slider').flickity({
		// watchCSS: true,
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
		// watchCSS: true,
		cellAlign: 'left',
		wrapAround: true,
		freeScroll: true,
		freeScrollFriction: 0.04,
		lazyLoad: true,
	});

	$('.product-slider').flickity({
		// watchCSS: true,
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
