<?php

// Display category image on category archive
add_action( 'woocommerce_archive_description', 'dmc_woocommerce_category_image', 2 );
function dmc_woocommerce_category_image() {

	if ( is_product_category() ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();

		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
		?>

			<style>
				.woocommerce-products-header{
					background-image: url('<?php echo esc_url( $image ); ?>');
				}
			</style>
		<?php
		}
	}

}


// Display acf category image on category archive
add_action( 'woocommerce_archive_description', 'dmc_woocommerce_acf_category_image', 2 );
function dmc_woocommerce_acf_category_image() {

	if ( is_product_category() ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();

		$taxonomy_prefix = $cat->taxonomy;
		$term_id = $cat->term_id;
		$term_id_prefixed = $taxonomy_prefix . '_' . $term_id;

		$image = get_field( 'dmc_category_hero_image', $term_id_prefixed );
		if ( $image ) {
		?>

			<style>
				.woocommerce-products-header{
					background-image: url('<?php echo esc_url( $image['url'] ); ?>');
				}
			</style>
		<?php
		}
	}

}


// Display category headline on category archive
add_action( 'woocommerce_before_shop_loop', 'dmc_woocommerce_category_headline', 10 );
function dmc_woocommerce_category_headline() {

	if ( is_product_category() ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();

		$taxonomy_prefix = $cat->taxonomy;
		$term_id = $cat->term_id;
		$term_id_prefixed = $taxonomy_prefix . '_' . $term_id;
		$term_desc = $cat->description;

		$tax_headline = get_field( 'dmc_prodcat_headline', $term_id_prefixed );
		if ( $tax_headline ) {
		?>
			<section class="flex-row dmc-max-two category-meta">
					<h2>
						<?php
						echo esc_attr( $tax_headline );
						?>
					</h2>
				<p>
					<?php
					echo esc_attr( $term_desc );
					?>
				</p>
			</section>
		<?php
		}
	}

}
