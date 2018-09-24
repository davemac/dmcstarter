<?php

// shows cart indicator
function dmc_woocommerce_show_cart_indicator() {

	$count = WC()->cart->cart_contents_count;
	if ( $count > 0 ) {
	?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View cart' ); ?>">
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
