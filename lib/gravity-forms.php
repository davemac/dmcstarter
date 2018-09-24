<?php
// populate GF field with values from ACF field
if ( ! is_admin() ) {
	add_filter( 'gform_pre_render_3', 'populate_dropdown' );
	// when changing drop down values, we also need to use the gform_pre_validation so that the new values are available when validating the field.
	add_filter( 'gform_pre_validation_3', 'populate_dropdown' );
	// when changing drop down values, we also need to use the gform_admin_pre_render so that the right values are displayed when editing the entry.
	add_filter( 'gform_admin_pre_render_3', 'populate_dropdown' );
	// this will allow for the labels to be used during the submission process in case values are enabled
	add_filter( 'gform_pre_submission_filter_3', 'populate_dropdown' );

	function populate_dropdown( $form ) {
		// only populating drop down for form id 3
		if ( $form['id'] != 3 ) {
			return $form;
		}
		// get list of custom post types
		$args = array(
			'post_type' => 'dmc-courses',
			'posts_per_page'   => -1,
		);
		$posts = get_posts( $args );
		// Creating drop down item array.
		$items = array();

		// Add initial value.
		$items[] = array(
			'text' => 'Please select ...',
			'value' => '',
		);
		// Add cpt titles to the items array
		foreach ( $posts as $post ) {
			$items[] = array(
				'value' => $post->post_title,
				'text' => $post->post_title,
			);
		}
		// add items to field id 5 in this form
		foreach ( $form['fields'] as &$field ) {
			if ( $field->id == 5 ) {
				$field->choices = $items;
			}
		}
		return $form;
		wp_reset_postdata();
	}
}// End if().

// fill dmc_course_nicename GF field with name of course from URL dmc_cid parameter
add_filter( 'gform_field_value_dmc_course_nicename', 'dmc_set_referred_course' );
function dmc_set_referred_course( $value ) {
	if ( isset( $_GET['dmc_cid'] ) ) {
		$url_course_ID = $_GET['dmc_cid'];
	} else {
		// handle the case where there is no parameter
	}
	$args = array(
		'post_type' => 'dmc-courses',
		'p'   => $url_course_ID,
	);
	$posts = get_posts( $args );

	return $posts[0]->post_title;
	wp_reset_postdata();
}

// fill dmc_course_price field with course pricing
add_filter( 'gform_field_value_dmc_course_price', 'dmc_show_course_price' );
function dmc_show_course_price( $value ) {
	if ( isset( $_GET['dmc_cid'] ) ) {
		$url_course_ID = $_GET['dmc_cid'];
	} else {
		// handle the case where there is no parameter
	}
	$args = array(
		'post_type' => 'dmc-courses',
		'p'   => $url_course_ID,
	);
	$posts = get_posts( $args );
	$dmc_price_standard = '$' . number_format( (get_field( 'dmc_pricing_standard', $url_course_ID ) ), 0, '.', ',' );

	return $dmc_price_standard;
	wp_reset_postdata();
}

/**
<div class="dmc-price">
$dmc_price_standard = '&dollar;' . number_format( (get_field( 'dmc_pricing_standard' ) ), 0, '.', ',' );
echo '<span class="standard"><h4><em>Price:</em>' . $dmc_price_standard . '</h4></span>';
if( get_field( 'dmc_pricing_early' ) ) :
$dmc_price_early = '&dollar;' . number_format( (get_field( 'dmc_pricing_early' ) ), 0, '.', ',' );
echo '<span><h4 class="early"><em>Early Bird Price:</em>' . $dmc_price_early . '</h4></span>';
endif;
</div>
 */

// adds PayPal logo and payment methods after submit button on form 3
add_filter( 'gform_submit_button_3', 'dmc_add_content_after_submit', 10, 2 );
function dmc_add_content_after_submit( $button, $form ) {
	return $button .= '<img src="' . get_template_directory_uri() . '/img/paypal.jpg" class="paypal-types hide-for-small-only">';
}
