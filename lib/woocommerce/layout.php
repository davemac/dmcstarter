<?php

add_action( 'init', 'dmc_wc_layout_tweaks' );
function dmc_wc_layout_tweaks() {

	// remove shop page title
	// add_filter( 'woocommerce_show_page_title', '__return_false' );

	// remove product meta altogether
	// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

	// move product meta below title on single product
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );

	// move category description
	// remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	// add_action( 'woocommerce_before_shop_loop', 'woocommerce_taxonomy_archive_description', 10 )

	//move tabs into product summary
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 20 );

	//move sharing up to above title
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 26 );
}


// display product filters
add_action( 'woocommerce_before_shop_loop', 'dmc_display_filters' );
function dmc_display_filters() {
	if ( is_shop()
		|| is_product_category()
	) {
		require_once get_template_directory() . '/lib/woocommerce/results-filters.php';
	}
}


// display featured image on shop page
add_action( 'woocommerce_before_shop_loop', 'dmc_display_shop_featured_image' );
function dmc_display_shop_featured_image() {
	if ( is_shop() ) {
		$thumbnail_id = get_post_thumbnail_id( wc_get_page_id( 'shop' ) );

		if ( $thumbnail_id ) {
			$image_src = wp_get_attachment_image_src( $thumbnail_id, 'normal-bg' );
			if ( $image_src ) {
			?>
				<style>
				.woocommerce-products-header{
					background-image:
					linear-gradient(to bottom, rgba(0,0,0,0.2) 0, rgba(0,0,0,0.2) 100px),
					url(<?php echo esc_url( $image_src[0] ); ?>);
				}
				</style>
			<?php
			}
		}
	}
}


// add_action( 'woocommerce_after_main_content', 'dmc_display_feaured_product_cats_holder' );
function dmc_display_feaured_product_cats_holder() {
	?>

	<section class="featured-products featured-prods product_cat">
		<h2 class="section-heading">
			Featured Categories:
		</h2>
		<div class="cards">
			<?php dmc_display_featured_product_cats( 2 ); ?>
		</div>
	</section>

	<?php
}


// show additional product meta
add_action( 'woocommerce_after_single_product_summary', 'dmc_display_resources' );
function dmc_display_resources() {

	if ( have_rows( 'row_file_uploads' ) ) :
	?>
		<div class="resources dmc-prod-meta">
			<h2>
				Resources
			</h2>
			<ul>
				<?php
				while ( have_rows( 'row_file_uploads' ) ) :
					the_row();
					dmc_display_file_upload( '', 'file_upload' );
				endwhile;
				?>
			</ul>
		</div>
	<?php
	endif;
	?>

	<div class="dmc-wrapper">

		<?php
		if ( get_field( 'dmc_preperation' ) ) :
		?>
			<div class="extra_content dmc-prod-meta">
				<h2>
					Preperation
				</h2>
				<p>
					<?php the_field( 'dmc_preperation' ); ?>
				</p>
			</div>
		<?php
		endif;

		if ( get_field( 'dmc_application' ) ) :
		?>
			<div class="extra_content dmc-prod-meta">
				<h2>
					Application
				</h2>
				<p>
					<?php the_field( 'dmc_application' ); ?>
				</p>
			</div>
		<?php
		endif;
		?>

	</div>

	<?php
	if ( have_rows( 'dmc_video_group' ) ) :
	?>

		<div class="dmc-wrapper product-video-row">
			<?php
			while ( have_rows( 'dmc_video_group' ) ) :
				the_row();
			?>
				<div class="product-video">
					<div class="video-items">
						<div class="video-wrap">
							<?php
							the_sub_field( 'video_url' );
							?>
						</div>
					</div>
				</div>
				<div class="product-video-desc">
					<?php
					the_sub_field( 'video_description' );
					?>
				</div>
			<?php
			endwhile;
			?>
		</div>

	<?php
	endif;

}
