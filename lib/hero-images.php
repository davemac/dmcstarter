<?php
// show hero image
function dmc_display_hero() {

	if ( has_post_thumbnail() ) {
		$dmc_thumb = 'y-thumb';
	}

	ob_start();
	?>

		<section class="page-hero <?php echo esc_attr( $dmc_thumb ); ?>" <?php dmc_display_featured_img_bg(); ?>>
		</section>

	<?php
	$output = ob_get_clean();
	echo $output;

}


//  show featured image URL for CSS background attribute
function dmc_display_featured_img_bg( $post_id = null ) {

	if ( $post_id ) {
		$thumbnail_id = get_post_thumbnail_id( $post_id );
	} else {
		$thumbnail_id = get_post_thumbnail_id();
	}

	if ( $thumbnail_id ) {
		$image_src = wp_get_attachment_image_src( $thumbnail_id, 'normal-bg' );
		if ( $image_src ) {
			printf( ' style="background-image: url(%s);"', esc_url( $image_src[0] ) );
		}
	}
}


//  display ACF image URL for CSS background attribute
function dmc_display_acf_img_bg( $dmc_set_id = null ) {

	$dmc_page_hero_image = get_field( 'dmc_page_hero_image', $dmc_set_id );
	if ( $dmc_page_hero_image ) {
		$image_src = $dmc_page_hero_image['url'];
		if ( $image_src ) {
			printf( ' style="background-image: url(%s);"', esc_url( $image_src ) );
		}
	} else {
		// use a default image
		printf( ' style="background-image: url(%s);"', wp_get_attachment_url( 13484 ) );
	}
}


//  display random ACF repeater sub field image URL for CSS background attribute
function dmc_display_acf_random_img_bg() {
	$page_hero_images = get_field( 'dmc_page_hero_images' );

	if ( $page_hero_images ) {

		$count = count( $page_hero_images );
		if ( 1 === $count ) {
			$rand = 0;
		} else {
			$rand = wp_rand( 0, ( $count - 1 ) );
		}

		$rand_sub_field = $page_hero_images[ $rand ]['dmc_page_hero_image'];
		$rand_img_url   = $rand_sub_field['url'];

		if ( $page_hero_images ) {
			$image_src = $rand_img_url;
		};
		printf( 'style="background-image: url(%s);"', esc_url( $image_src ) );

	}
}
