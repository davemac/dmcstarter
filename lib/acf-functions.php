<?php

// Hide ACF in admin menu for certain URLs
function dmc_hide_acf_admin() {
	$site_url = get_bloginfo( 'url' );

	$protected_urls = array(
		'https://prod.com.au',
		'https://staging.com.au',
	);

	if ( in_array( $site_url, $protected_urls, true ) ) {
		// Hide the ACF menu item
		return false;

	} else {
		return true;
	}
}
add_filter( 'acf/settings/show_admin', 'dmc_hide_acf_admin' );


// adds ACF options page
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => 'Sitewide options',
			'menu_title' => 'Sitewide options',
			'menu_slug'  => 'site-global-settings',
			'position'   => 2,
			'capability' => 'edit_posts',
		)
	);
}


// only show published posts for relationship field
function dmc_filter_acf_relationship( $args, $field, $post_id ) {
	$args['post_status'] = 'publish';
	return $args;
}
add_filter( 'acf/fields/relationship/query', 'dmc_filter_acf_relationship', 10, 3 );


// displays ACF dmc_featured_content repeater fields
function dmc_display_acf_featured_content() {
	if ( have_rows( 'dmc_featured_content' ) ) :
		?>
		<section class="featured-article">
			<?php
			while ( have_rows( 'dmc_featured_content' ) ) :
				the_row();
				get_template_part( 'content', 'dmc-featured' );
			endwhile;
			?>
		</section>
		<?php
	endif;
}


/**
 * Google Maps Javascript API key for show map
 */
function dmc_acf_init() {
	acf_update_setting( 'google_api_key', '[api_key_here]' );
}
add_action( 'acf/init', 'dmc_acf_init' );


// adds class to aa content block, defined by an ACF conditional field
function dmc_add_class( $dmc_class ) {
	if ( get_sub_field( 'dmc_full_width_centered' ) == 1 ) {
		echo $dmc_class;
	} else {
		// do nothing
	}
}


// display an ACF smart button field in a repeater
// https://github.com/gillesgoetsch/acf-smart-button
function dmc_button_repeater() {

	if ( have_rows( 'dmc_buttons' ) ) :
		?>
	<div class="button-repeater">
		<?php
		while ( have_rows( 'dmc_buttons' ) ) :
			the_row();
			?>
			<?php
			if ( get_sub_field( 'dmc_button' ) ) :
				$dmc_button        = get_sub_field( 'dmc_button' );
				$dmc_button_label  = $dmc_button['text'];
				$dmc_button_url    = $dmc_button['url'];
				$dmc_button_target = $dmc_button['target'];
				?>
			<a href="<?php echo $dmc_button_url; ?>" class="button medium">
				<?php echo $dmc_button_label; ?>
			</a>
				<?php
		endif;
		endwhile;
		?>
	</div>
		<?php
	endif;

}


// displays an ACF image field by field name and size
function dmc_display_acf_image( $acffield, $imagesize ) {

	$image = get_sub_field( $acffield );
	$size  = $imagesize;
	if ( $image ) {
		$default_attr = array(
			'class' => 'img-featured wp-acf-image',
		);
		echo wp_get_attachment_image( $image, $size, 0, $default_attr );
	};

}


// displays an ACF file field, including file size, file type and file extension
function dmc_display_file_upload( $acffield, $subfield ) {

	if ( ! empty( $subfield ) ) {
		$file = get_sub_field( $subfield );
	} else {
		$file = get_field( $acffield );
	}

	if ( $file ) :
		// vars
		$attachment_id = $file['id'];
		$url           = $file['url'];
		$title         = $file['title'];

		$post_type         = get_post_type( get_the_ID() );
		$obj               = get_post_type_object( $post_type );
		$content_type_name = $obj->labels->singular_name;

		$filesize = filesize( get_attached_file( $attachment_id ) );

		$filetype = wp_check_filetype( $url );
		$fileext  = strtoupper( $filetype['ext'] );

		$filesize = size_format( $filesize );
		?>

		<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $title ); ?>" class="button download large">
			Download a PDF version of this <?php echo esc_attr( $content_type_name ); ?>
			<span>
				<?php echo ' (' . $fileext . ' ' . $filesize . ')'; ?>
			</span>
		</a>
		<?php
		endif;

}


/*
 * Add columns to ACF admin post list
 * https://catapultthemes.com/add-acf-fields-to-admin-columns/
 */


/*
 * Add columns to dmc-venues post list
 */
function add_acf_columns( $columns ) {
	return array_merge(
		$columns,
		array(
			'dmc_sponsored_venue' => __( 'Sponsored?' ),
		)
	);
}
add_filter( 'manage_dmc-venues_posts_columns', 'add_acf_columns' );

function venues_custom_column( $column, $post_id ) {
	switch ( $column ) {
		case 'dmc_sponsored_venue':
			echo get_post_meta( $post_id, 'dmc_sponsored_venue', true );
			break;
	}
}
add_action( 'manage_dmc-venues_posts_custom_column', 'venues_custom_column', 10, 2 );


// disable ACF css on front-end ACF forms
// add_action( 'wp_print_styles', 'dmc_deregister_styles', 100 );

// function dmc_deregister_styles() {
//     wp_deregister_style( 'acf' );
//     wp_deregister_style( 'acf-field-group' );
//     wp_deregister_style( 'acf-global' );
//     wp_deregister_style( 'acf-input' );
//     wp_deregister_style( 'acf-datepicker' );
//     wp_deregister_style( 'acf-pro-input' );
// }
