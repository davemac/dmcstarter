<?php

// only show top level pages of these post types for landing pages
// set to show unlimited
function dmc_landing_pages_custom_pre_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( is_post_type_archive( 'jetpack-portfolio' )
		// || is_post_type_archive( 'jetpack-portfolio' )

	) {
		$query->set( 'posts_per_archive_page', -1 );
		$query->set( 'post_parent', 0 );
		// set_query_var( 'order', 'ASC' );
		// set_query_var( 'orderby', 'menu_order' );
		return $query;
	}
}
add_filter( 'pre_get_posts', 'dmc_landing_pages_custom_pre_get_posts' );


// add custom post types to search
function dmc_cpt_search( $query ) {
	if ( is_search() && $query->is_main_query() && $query->get( 's' ) ) {

		$query->set(
			'post_type',
			array( 'post', 'dmc-insight', 'dmc-column', 'dmc-opinion', 'dmc-regroundup' ),
			'meta_query',
			array(
				array(
					'key'     => 'wysiwyg',
					'value'   => '%s',
					'compare' => 'LIKE',
				),
			)
		);
		return $query;
	}
}
add_action( 'pre_get_posts', 'dmc_cpt_search' );


/**
 * Returns the index of the current loop iteration.
 *
 * @return int
 */
function pdk_get_current_loop_index() {
	global $wp_query;
	return $wp_query->current_post + 1;
}


// function dmc_remove_infinite_scroll() {
// 	if ( is_post_type_archive( 'dmc-building' ) ) {
// 		remove_theme_support( 'infinite-scroll' );
// 	}
// }
// add_action( 'pre_get_posts', 'dmc_remove_infinite_scroll' );


// sort event post type by date field
// only showing event with start date after today
function dmc_event_pre_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( is_post_type_archive( 'dmc-event' )
		|| is_tax( 'eventtype' )

	) {

		$date_now = date( 'Y-m-d H:i' );

		$query->set( 'posts_per_page', -1 );

		$meta_query = array(
			array(
				// 'key'       => 'dmc_course_dates_0_dmc_start_date_time',
				'compare' => '>=',
				'value'   => $date_now,
				'type'    => 'DATETIME',
			),
		);

		$query->set( 'meta_query', $meta_query );

		$query->set( 'meta_type', 'DATETIME' );
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'order', 'ASC' );

		return $query;
	}
}
add_filter( 'pre_get_posts', 'dmc_event_pre_get_posts' );


// WooCommerce display products by category
// called from {theme}/woocommerce/archive-product.php
function dmc_display_products_by_prodcat() {

	$cat_args           = array(
		'orderby' => 'title',
		'order'   => 'ASC',
	);
	$product_categories = get_terms( 'product_cat', $cat_args );

	if ( $product_categories ) {

		foreach ( $product_categories as $product_category ) {
			?>

			<h4 class="wc-category-title">
				<a href="<?php echo get_term_link( $product_category ); ?>">
					<?php echo $product_category->name; ?>
				</a>
			</h4>

			<?php
			$product_args = array(
				'posts_per_page' => -1,
				'tax_query'      => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $product_category->term_id,
					),
				),
				'post_type'      => 'product',
				'orderby'        => 'title,',
			);
			$products     = new WP_Query( $product_args );

			if ( $products->have_posts() ) {

				woocommerce_product_loop_start();

				while ( $products->have_posts() ) :
					$products->the_post();

					wc_get_template_part( 'content', 'product' );

				endwhile; // end of the loop.

				woocommerce_product_loop_end();

			} //endif
		} //endforeach
	} //endif

}
