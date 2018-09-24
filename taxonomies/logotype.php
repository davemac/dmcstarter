<?php

/**
 * Registers the `logotype` taxonomy,
 * for use with 'dmc-logo'.
 */
function logotype_init() {

	$rewrite = array(
		'slug'       => 'logotype',
		'with_front' => false,
		'pages'      => true,
	);

	register_taxonomy( 'logotype', array( 'dmc-logo' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => $rewrite,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'Logo types', 'dmcstarter' ),
			'singular_name'              => _x( 'Logo type', 'taxonomy general name', 'dmcstarter' ),
			'search_items'               => __( 'Search Logo types', 'dmcstarter' ),
			'popular_items'              => __( 'Popular Logo types', 'dmcstarter' ),
			'all_items'                  => __( 'All Logo types', 'dmcstarter' ),
			'parent_item'                => __( 'Parent Logo type', 'dmcstarter' ),
			'parent_item_colon'          => __( 'Parent Logo type:', 'dmcstarter' ),
			'edit_item'                  => __( 'Edit Logo type', 'dmcstarter' ),
			'update_item'                => __( 'Update Logo type', 'dmcstarter' ),
			'view_item'                  => __( 'View Logo type', 'dmcstarter' ),
			'add_new_item'               => __( 'New Logo type', 'dmcstarter' ),
			'new_item_name'              => __( 'New Logo type', 'dmcstarter' ),
			'separate_items_with_commas' => __( 'Separate Logo types with commas', 'dmcstarter' ),
			'add_or_remove_items'        => __( 'Add or remove Logo types', 'dmcstarter' ),
			'choose_from_most_used'      => __( 'Choose from the most used Logo types', 'dmcstarter' ),
			'not_found'                  => __( 'No Logo types found.', 'dmcstarter' ),
			'no_terms'                   => __( 'No Logo types', 'dmcstarter' ),
			'menu_name'                  => __( 'Logo types', 'dmcstarter' ),
			'items_list_navigation'      => __( 'Logo types list navigation', 'dmcstarter' ),
			'items_list'                 => __( 'Logo types list', 'dmcstarter' ),
			'most_used'                  => _x( 'Most Used', 'logotype', 'dmcstarter' ),
			'back_to_items'              => __( '&larr; Back to Logo types', 'dmcstarter' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'logotype',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'logotype_init' );

/**
 * Sets the post updated messages for the `logotype` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `logotype` taxonomy.
 */
function logotype_updated_messages( $messages ) {

	$messages['logotype'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Logo type added.', 'dmcstarter' ),
		2 => __( 'Logo type deleted.', 'dmcstarter' ),
		3 => __( 'Logo type updated.', 'dmcstarter' ),
		4 => __( 'Logo type not added.', 'dmcstarter' ),
		5 => __( 'Logo type not updated.', 'dmcstarter' ),
		6 => __( 'Logo types deleted.', 'dmcstarter' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'logotype_updated_messages' );
