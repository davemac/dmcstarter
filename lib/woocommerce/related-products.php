<?php
// remove unwanted elements
add_action( 'init', 'dmc_wc_related_product_tweaks' );
function dmc_wc_related_product_tweaks() {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 30 );
}


// upgrade_100()Change number of related products output
function dmc_woo_related_products_limit() {
	global $product;
	$args['posts_per_page'] = 6;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'dmc_woo_related_products_args', 20 );
function dmc_woo_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 3;
	return $args;

}
