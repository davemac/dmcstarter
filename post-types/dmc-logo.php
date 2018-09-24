<?php

/**
 * Registers the `dmc_logo` post type.
 */
function dmc_logo_init() {

	$rewrite = array(
		'slug'       => 'our-partners',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type( 'dmc-logo', array(
		'labels'                => array(
			'name'                  => __( 'Partners', 'dmcstarter' ),
			'singular_name'         => __( 'Partner', 'dmcstarter' ),
			'all_items'             => __( 'All Partners', 'dmcstarter' ),
			'archives'              => __( 'Partner Archives', 'dmcstarter' ),
			'attributes'            => __( 'Partner Attributes', 'dmcstarter' ),
			'insert_into_item'      => __( 'Insert into Partner', 'dmcstarter' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Partner', 'dmcstarter' ),
			'featured_image'        => _x( 'Featured Image', 'dmc-logo', 'dmcstarter' ),
			'set_featured_image'    => _x( 'Set featured image', 'dmc-logo', 'dmcstarter' ),
			'remove_featured_image' => _x( 'Remove featured image', 'dmc-logo', 'dmcstarter' ),
			'use_featured_image'    => _x( 'Use as featured image', 'dmc-logo', 'dmcstarter' ),
			'filter_items_list'     => __( 'Filter Partners list', 'dmcstarter' ),
			'items_list_navigation' => __( 'Partners list navigation', 'dmcstarter' ),
			'items_list'            => __( 'Partners list', 'dmcstarter' ),
			'new_item'              => __( 'New Partner', 'dmcstarter' ),
			'add_new'               => __( 'Add New', 'dmcstarter' ),
			'add_new_item'          => __( 'Add New Partner', 'dmcstarter' ),
			'edit_item'             => __( 'Edit Partner', 'dmcstarter' ),
			'view_item'             => __( 'View Partner', 'dmcstarter' ),
			'view_items'            => __( 'View Partners', 'dmcstarter' ),
			'search_items'          => __( 'Search Partners', 'dmcstarter' ),
			'not_found'             => __( 'No Partners found', 'dmcstarter' ),
			'not_found_in_trash'    => __( 'No Partners found in trash', 'dmcstarter' ),
			'parent_item_colon'     => __( 'Parent Partner:', 'dmcstarter' ),
			'menu_name'             => __( 'Partners', 'dmcstarter' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'thumbnail' ),
		'has_archive'           => true,
		'rewrite'               => $rewrite,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'dmc-logo',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'dmc_logo_init' );

/**
 * Sets the post updated messages for the `dmc_logo` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `dmc_logo` post type.
 */
function dmc_logo_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-logo'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Partner updated. <a target="_blank" href="%s">View Partner</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Partner updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Partner restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Partner published. <a href="%s">View Partner</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Partner saved.', 'dmcstarter' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Partner submitted. <a target="_blank" href="%s">Preview Partner</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Partner scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Partner</a>', 'dmcstarter' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Partner draft updated. <a target="_blank" href="%s">Preview Partner</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_logo_updated_messages' );
