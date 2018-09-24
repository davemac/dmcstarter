<?php

/**
 * Registers the `dmc_job` post type.
 */
function dmc_job_init() {

	$rewrite = array(
		'slug'       => 'jobs',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type( 'dmc-job', array(
		'labels'                => array(
			'name'                  => __( 'Jobs', 'dmcstarter' ),
			'singular_name'         => __( 'Jobs', 'dmcstarter' ),
			'all_items'             => __( 'All Jobs', 'dmcstarter' ),
			'archives'              => __( 'Jobs Archives', 'dmcstarter' ),
			'attributes'            => __( 'Jobs Attributes', 'dmcstarter' ),
			'insert_into_item'      => __( 'Insert into Jobs', 'dmcstarter' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Jobs', 'dmcstarter' ),
			'featured_image'        => _x( 'Featured Image', 'dmc-job', 'dmcstarter' ),
			'set_featured_image'    => _x( 'Set featured image', 'dmc-job', 'dmcstarter' ),
			'remove_featured_image' => _x( 'Remove featured image', 'dmc-job', 'dmcstarter' ),
			'use_featured_image'    => _x( 'Use as featured image', 'dmc-job', 'dmcstarter' ),
			'filter_items_list'     => __( 'Filter Jobs list', 'dmcstarter' ),
			'items_list_navigation' => __( 'Jobs list navigation', 'dmcstarter' ),
			'items_list'            => __( 'Jobs list', 'dmcstarter' ),
			'new_item'              => __( 'New Jobs', 'dmcstarter' ),
			'add_new'               => __( 'Add New', 'dmcstarter' ),
			'add_new_item'          => __( 'Add New Jobs', 'dmcstarter' ),
			'edit_item'             => __( 'Edit Jobs', 'dmcstarter' ),
			'view_item'             => __( 'View Jobs', 'dmcstarter' ),
			'view_items'            => __( 'View Jobs', 'dmcstarter' ),
			'search_items'          => __( 'Search Jobs', 'dmcstarter' ),
			'not_found'             => __( 'No Jobs found', 'dmcstarter' ),
			'not_found_in_trash'    => __( 'No Jobs found in trash', 'dmcstarter' ),
			'parent_item_colon'     => __( 'Parent Jobs:', 'dmcstarter' ),
			'menu_name'             => __( 'Jobs', 'dmcstarter' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor', 'excerpt' ),
		'has_archive'           => true,
		'rewrite'               => $rewrite,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'dmc-job',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'dmc_job_init' );

/**
 * Sets the post updated messages for the `dmc_job` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `dmc_job` post type.
 */
function dmc_job_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-job'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Jobs updated. <a target="_blank" href="%s">View Jobs</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Jobs updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Jobs restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Jobs published. <a href="%s">View Jobs</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Jobs saved.', 'dmcstarter' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Jobs submitted. <a target="_blank" href="%s">Preview Jobs</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Jobs scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Jobs</a>', 'dmcstarter' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Jobs draft updated. <a target="_blank" href="%s">Preview Jobs</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_job_updated_messages' );
