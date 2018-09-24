<?php

// Update order notes placeholder
add_filter( 'woocommerce_checkout_fields', 'custom_woocommerce_checkout_fields' );
function custom_woocommerce_checkout_fields( $fields ) {
	$fields['order']['order_comments']['placeholder'] = 'Optional order notes here';
	return $fields;
}


// Auto Complete all WooCommerce orders.

add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) {
	global $woocommerce;
	if ( ! $order_id )
		return;
	$order = new WC_Order( $order_id );
	$order->update_status( 'completed' );
}
