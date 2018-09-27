<?php

/**
 * adds ACF options page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title'    => 'Sitewide options',
			'menu_title'    => 'Sitewide options',
			'menu_slug'     => 'site-global-settings',
			'position'      => 2,
			'capability'    => 'edit_posts',
		)
	);
}

/**
 * Google Maps Javascript API key for show map
 */
function my_acf_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyC4A5q-R5EbwwvDVf4HjYD9fAWH8Zmyh2M' );
}
add_action( 'acf/init', 'my_acf_init' );


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

	if ( have_rows( 'dmc_buttons' ) ) : ?>
	<div class="button-repeater">
		<?php
		while ( have_rows( 'dmc_buttons' ) ) :
			the_row();
		?>
		<?php
		if ( get_sub_field( 'dmc_button' ) ) :
			$dmc_button = get_sub_field( 'dmc_button' );
			$dmc_button_label = $dmc_button['text'];
			$dmc_button_url = $dmc_button['url'];
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
	$size = $imagesize;
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

		$filesize = filesize( get_attached_file( $attachment_id ) );

		$filetype = wp_check_filetype( $url );
		$fileext  = $filetype['ext'];

		$filesize = size_format( $filesize );
		?>

		<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $title ); ?>" class="button round">
			Download <?php echo esc_html( $title ); ?> 
			<span>
				<?php echo ' (' . $fileext . ' ' . $filesize . ')'; ?>
			</span>
		</a>
		<?php
		endif;

}


// get ACF date/time picker field value and return human readable date/time format
function dmc_format_acf_date() {

	$dmc_get_date = get_field( 'dmc_resource_date', $post->ID );
	if ( $dmc_get_date ) {
		// if there is multiple dates, get the first one only
		// $dmc_get_first_date = $dmc_get_dates[0]['dmc_start_date_time'];

		// Create PHP DateTime object from Date/Time Picker Value
		// expects the value to be saved in the format Y-m-d
		$format_in = 'Y-m-d';
		$format_out = 'j F Y';
		$date = DateTime::createFromFormat( $format_in, $dmc_get_date );
		$output = '';
		$output .= '<p class="resource-date">' . $date->format( $format_out ) . '</p>';
		echo $output;
	}
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
		$columns, array(
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
