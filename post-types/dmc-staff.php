<?php

/**
 * Registers the `dmc_staff` post type.
 */
function dmc_staff_init() {

	$rewrite = array(
		'slug'       => 'people',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type( 'dmc-staff', array(
		'labels'                => array(
			'name'                  => __( 'People', 'dmcstarter' ),
			'singular_name'         => __( 'People', 'dmcstarter' ),
			'all_items'             => __( 'All People', 'dmcstarter' ),
			'archives'              => __( 'People Archives', 'dmcstarter' ),
			'attributes'            => __( 'People Attributes', 'dmcstarter' ),
			'insert_into_item'      => __( 'Insert into People', 'dmcstarter' ),
			'uploaded_to_this_item' => __( 'Uploaded to this People', 'dmcstarter' ),
			'featured_image'        => _x( 'Featured Image', 'dmc-staff', 'dmcstarter' ),
			'set_featured_image'    => _x( 'Set featured image', 'dmc-staff', 'dmcstarter' ),
			'remove_featured_image' => _x( 'Remove featured image', 'dmc-staff', 'dmcstarter' ),
			'use_featured_image'    => _x( 'Use as featured image', 'dmc-staff', 'dmcstarter' ),
			'filter_items_list'     => __( 'Filter People list', 'dmcstarter' ),
			'items_list_navigation' => __( 'People list navigation', 'dmcstarter' ),
			'items_list'            => __( 'People list', 'dmcstarter' ),
			'new_item'              => __( 'New People', 'dmcstarter' ),
			'add_new'               => __( 'Add New', 'dmcstarter' ),
			'add_new_item'          => __( 'Add New People', 'dmcstarter' ),
			'edit_item'             => __( 'Edit People', 'dmcstarter' ),
			'view_item'             => __( 'View People', 'dmcstarter' ),
			'view_items'            => __( 'View People', 'dmcstarter' ),
			'search_items'          => __( 'Search People', 'dmcstarter' ),
			'not_found'             => __( 'No People found', 'dmcstarter' ),
			'not_found_in_trash'    => __( 'No People found in trash', 'dmcstarter' ),
			'parent_item_colon'     => __( 'Parent People:', 'dmcstarter' ),
			'menu_name'             => __( 'People', 'dmcstarter' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => $rewrite,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'dmc-staff',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'dmc_staff_init' );

/**
 * Sets the post updated messages for the `dmc_staff` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `dmc_staff` post type.
 */
function dmc_staff_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-staff'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'People updated. <a target="_blank" href="%s">View People</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'People updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'People restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'People published. <a href="%s">View People</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'People saved.', 'dmcstarter' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'People submitted. <a target="_blank" href="%s">Preview People</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'People scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview People</a>', 'dmcstarter' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'People draft updated. <a target="_blank" href="%s">Preview People</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_staff_updated_messages' );
