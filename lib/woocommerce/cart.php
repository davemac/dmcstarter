<?php

// shows cart indicator
function dmc_woocommerce_show_cart_indicator() {

	$count = WC()->cart->cart_contents_count;
	if ( $count > 0 ) {
	?>
		<a class="dmc-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View cart' ); ?>">
			<span class="cart-contents-count">
				<?php echo esc_html( $count ); ?>
			</span>
		</a>
	<?php
	}

}


/**
 * https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function dmc_custom_add_to_cart_fragment( $fragments ) {

	ob_start();
	$count = WC()->cart->cart_contents_count;
	?>
		<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View cart' ); ?>">
			<?php
			if ( $count > 0 ) {
				?>
				<span class="cart-contents-count">
					<?php echo esc_html( $count ); ?>
				</span>
			<?php
			}
			?>
		</a>
	<?php

	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'dmc_custom_add_to_cart_fragment' );


// don't show payment fields if this coupon is used
// function dmc_filter_cart_needs_payment( $needs_payment, $cart ) {
// 	$targeted_coupon_code = '4u4kgjw2';

// 	if ( in_array( $targeted_coupon_code, $cart->get_applied_coupons(), true ) ) {
// 		$needs_payment = false;
// 	}
// 	return $needs_payment;
// }
// add_filter( 'woocommerce_cart_needs_payment', 'dmc_filter_cart_needs_payment', 10, 2 );


/**
 * Add a standard $ value surcharge to all transactions in cart / checkout
 */
// add_action( 'woocommerce_cart_calculate_fees','dmc_wc_add_surcharge' );
function dmc_wc_add_surcharge() {
	global $woocommerce;

	if ( is_admin() && ! defined( 'DOING_AJAX' ) )
	return;

	$county = array('AUS');
	// change the $fee to set the surcharge to a value to suit
	$fee = 100.00;

	// if ( in_array( WC()->customer->get_shipping_country(), $county ) ) :
		$woocommerce->cart->add_fee( 'Refundable Bond', $fee, true, 'standard' );
	// endif;
}
