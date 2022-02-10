<?php

function dmc_maybe_display_ribbon( $product_id ) {
	$prod_badge = get_the_terms( $product_id, 'product_badge' );
	if ( $prod_badge ) :
		$rib_term = $prod_badge[0]->term_id;

		$layout = ( is_product() ) ? 'horizontal' : 'top-right';

		?>
		<div class="ribbon ribbon-<?php echo esc_attr( $layout ); ?> rib-<?php echo esc_attr( $rib_term ); ?>">
			<span>
				<?php echo esc_html( $prod_badge[0]->name ); ?>
			</span>
		</div>
		<?php
	endif;
}
