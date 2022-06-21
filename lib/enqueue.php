<?php

/**********************
Enqueue CSS and Scripts
**********************/

// enque WP and vendor scripts
function dmcstarter_enqueue_scripts() {

	if ( ! is_admin() ) :
		// modernizr (customised from Gruntfile.js)
		// wp_enqueue_script( 'dmcstarter-modernizr', get_template_directory_uri() . '/js/modernizr-custom.min.js', array(), '3.5.0', false );

		// only add WP comment-reply.min.js if threaded comments are on an it's a post of some type
		if ( get_option( 'thread_comments' ) && is_singular() ) :
			wp_enqueue_script( 'comment-reply' );
		endif;

		// add vendor scripts files in the footer
		wp_enqueue_script( 'dmcstarter-js', get_template_directory_uri() . '/js/bower.min.js', array( 'jquery' ), 'false', true );

		// contact page
		if ( is_page( '30' ) ) :

			$gapi = GOOGLE_API_KEY;
			$maps_url = 'https://maps.googleapis.com/maps/api/js?key=' . $gapi;

			wp_register_script( 'googlemap-js-api', $maps_url, '', 'false', true );

			wp_enqueue_script( 'acf-googlemap', get_template_directory_uri() . '/js/maps-init.js', array( 'googlemap-js-api' ), 'false', true );

			wp_enqueue_script( 'googlemap-display', get_template_directory_uri() . '/js/maps-display.js', array( 'googlemap-js-api' ), 'false', true );

		endif;

		// wp_register_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), false, true );

		// if ( is_front_page() || is_post_type_archive( 'jetpack-portfolio' ) ) {
		// 	wp_register_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), false, true );
		// 	wp_enqueue_script( 'isotope-init', get_template_directory_uri() . '/js/isotope-init.js', array( 'isotope' ), '3.0', true );
		// }

		// wp_enqueue_style( 'magnific-css', get_template_directory_uri() . '/css/magnific-popup.css' );
		// wp_enqueue_script( 'magnific-init', get_template_directory_uri() . '/js/magnific-init.js', array( 'magnific' ), true );

		// if ( is_singular( 'dmc-courses' ) ) {
		// 	wp_enqueue_script( 'addevent', 'https://addevent.com/libs/atc/1.6.1/atc.min.js', '', true );
		// }

	endif;

}
add_action( 'wp_enqueue_scripts', 'dmcstarter_enqueue_scripts' );

// https://wpshout.com/make-site-faster-async-deferred-javascript-introducing-script_loader_tag/
function dmc_defer_scripts( $tag, $handle, $src ) {
	// The handles of the enqueued scripts we want to defer
	$defer_scripts = array(
		// 'addevent',
		// 'admin-bar',
		// 'cookie',
		'devicepx',
		'comment-reply',
		'jquery-migrate',
	);
	if ( in_array( $handle, $defer_scripts, true ) ) {
		return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'dmc_defer_scripts', 10, 3 );


// async these scripts
add_filter(
	'googlemap-js-api',
	function ( $tag, $handle ) {

		if ( 'googlemap-js-api' !== $handle ) {
			return $tag;
		}

		// return str_replace( ' src', ' defer src', $tag ); // defer the script
		return str_replace( ' src', ' async src', $tag ); // OR async the script
		//return str_replace( ' src', ' async defer src', $tag ); // OR do both!

	},
	10, 2
);


// vendor styles
function dmcstarter_enqueue_style() {
	// only serve google fonts externally for the following
	wp_enqueue_style( 'dmc-google-font-fragment', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Roboto:ital,wght@0,500;1,400&display=swap', array(), null );

	// main stylesheet
	wp_enqueue_style( 'dmcstarter-stylesheet', get_stylesheet_directory_uri() . '/css/style.css', array(), 'false', 'all' );

	// vendor styles
	wp_enqueue_style( 'vendor', get_template_directory_uri() . '/css/vendor.css', array(), 'false', 'all' );
}
add_action( 'wp_enqueue_scripts', 'dmcstarter_enqueue_style' );


// add extra attributes
function dmc_google_font_loader_tag_filter( $html, $handle ) {
	if ( $handle === 'dmc-google-font-fragment' ) {
		$rel_preconnect = "rel='stylesheet preconnect'";

		return str_replace(
			"rel='stylesheet'",
			$rel_preconnect,
			$html
		);
	}
	return $html;
}
add_filter( 'style_loader_tag', 'dmc_google_font_loader_tag_filter', 10, 2 );


// only load WooCommerce styles and scripts on WooCommerce pages
function dmc_conditionally_load_woc_js_css() {

	if ( function_exists( 'is_woocommerce_activated' ) ) :

		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() ) :

			## Dequeue scripts.
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );

			## Dequeue styles.
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce-smallscreen' );
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

		endif;

	endif;
}
add_action( 'wp_enqueue_scripts', 'dmc_conditionally_load_woc_js_css' );


// function dmc_load_wc_js_css_exceptions() {
// 	if ( function_exists( 'is_woocommerce' ) ) {
// 		if ( is_singular( 'jetpack-portfolio' ) || ( is_front_page() ) ) {

// 			// ## Enqueue scripts.
// 			wp_enqueue_script( 'woocommerce' );

// 			// ## Enqueue styles.
// 			wp_enqueue_style( 'woocommerce-general' );
// 			// wp_enqueue_style( 'woocommerce-layout' );
// 			wp_enqueue_style( 'woocommerce-smallscreen' );
// 		}
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'dmc_load_wc_js_css_exceptions' );


// remove Gutenberg block CSS
function dmc_remove_block_css() {
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'dmc_remove_block_css', 100 );
