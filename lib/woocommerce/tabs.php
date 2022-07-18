<?php

// remove product tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
	// unset( $tabs['description'] );      	// Remove the description tab
	unset( $tabs['reviews'] );          // Remove the reviews tab
	unset( $tabs['additional_information'] );   // Remove the additional information tab
	return $tabs;
}


// add a custom product data tab

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
	$tabs['ingredient_tab'] = array(
		'title'    => __( 'Ingredients', 'woocommerce' ),
		'priority' => 50,
		'callback' => 'dmc_woo_ingredients_tab_content',
	);

	$tabs['nutrition_tab'] = array(
		'title'    => __( 'Nutrition', 'woocommerce' ),
		'priority' => 50,
		'callback' => 'dmc_woo_nutrition_tab_content',
	);

	$tabs['prepare_tab'] = array(
		'title'    => __( 'How to Prepare', 'woocommerce' ),
		'priority' => 50,
		'callback' => 'dmc_woo_prepare_tab_content',
	);

	$tabs['feeding_tab'] = array(
		'title'    => __( 'Feeding Table', 'woocommerce' ),
		'priority' => 50,
		'callback' => 'dmc_woo_feeding_tab_content',
	);
	return $tabs;

}

function dmc_woo_ingredients_tab_content() {
	if ( get_field( 'dmc_ingredients' ) ) :
		?>
		<div class="extra_content dmc-prod-meta">
			<?php the_field( 'dmc_ingredients' ); ?>
		</div>
		<?php
	endif;
}

function dmc_woo_nutrition_tab_content() {
	if ( get_field( 'dmc_nutrition' ) ) :
		?>
		<div class="extra_content dmc-prod-meta">
			<?php the_field( 'dmc_nutrition' ); ?>
		</div>
		<?php
	endif;
}

function dmc_woo_prepare_tab_content() {
	if ( get_field( 'dmc_prepare' ) ) :
		?>
		<div class="extra_content dmc-prod-meta">
			<?php the_field( 'dmc_prepare' ); ?>
		</div>
		<?php
	endif;
}

function dmc_woo_feeding_tab_content() {
	if ( get_field( 'dmc_feeding' ) ) :
		?>
		<div class="extra_content dmc-prod-meta">
			<?php the_field( 'dmc_feeding' ); ?>
	</div>
		<?php
	endif;
}
