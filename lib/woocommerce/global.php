<?php
// global tweaks, remove unwanted elements
add_action( 'init', 'dmc_wc_global_tweaks' );
function dmc_wc_global_tweaks() {
	// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	// add_action( 'woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 30 );

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}


// // remove product tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
	// unset( $tabs['description'] );      	// Remove the description tab
	unset( $tabs['reviews'] );          // Remove the reviews tab
	unset( $tabs['additional_information'] );   // Remove the additional information tab
	return $tabs;
}


// show product attributes
add_action( 'woocommerce_product_meta_start', 'show_attributes', 25 );
function show_attributes() {
	global $product;
	wc_display_product_attributes( $product );
}


// modify inventory availability messages
add_filter( 'woocommerce_get_availability', 'dmc_get_availability', 1, 2 );
function dmc_get_availability( $availability, $_product ) {
	if ( $_product->is_in_stock() ) $availability['availability'] = __( 'In Stock', 'woocommerce' );

	if ( ! $_product->is_in_stock() ) $availability['availability'] = __( 'Sold Out', 'woocommerce' );
	return $availability;
}


// modify strings
function dmc_woo_text_strings( $translated_text, $text, $domain ) {
	if ( ! is_admin() ) {
		switch ( $translated_text ) {
			case 'Related products':
				$translated_text = __( 'You may also need', 'woocommerce' );
				break;

			case 'Description':
				$translated_text = __( 'Product Description', 'woocommerce' );
				break;
		}
	}
	return $translated_text;
}
add_filter( 'gettext', 'dmc_woo_text_strings', 20, 3 );
