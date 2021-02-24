<?php

// remove yoast seo post lists columns
// add_filter( 'manage_edit-{$post_type}_columns', 'custom_remove_yseo_columns', 10, 1 ); replacing {$post_type} with the name of the custom post type.
function dmc_yoast_seo_admin_remove_columns( $columns ) {
	unset( $columns['wpseo-score'] );
	unset( $columns['wpseo-score-readability'] );
	unset( $columns['wpseo-title'] );
	unset( $columns['wpseo-metadesc'] );
	unset( $columns['wpseo-focuskw'] );
	unset( $columns['wpseo-links'] );
	unset( $columns['wpseo-linked'] );
	return $columns;
}
// add_filter( 'manage_edit-post_columns', 'dmc_yoast_seo_admin_remove_columns', 10, 1 );
add_filter( 'manage_edit-product_columns', 'dmc_yoast_seo_admin_remove_columns', 10, 1 );
// add_filter( 'manage_edit-page_columns', 'dmc_yoast_seo_admin_remove_columns', 10, 1 );


// remove yoast seo dropdown filters
function dmc_remove_yoast_seo_admin_filters() {
	global $wpseo_meta_columns;
	if ( $wpseo_meta_columns ) {
		remove_action( 'restrict_manage_posts', array( $wpseo_meta_columns, 'posts_filter_dropdown' ) );
		remove_action( 'restrict_manage_posts', array( $wpseo_meta_columns, 'posts_filter_dropdown_readability' ) );
	}
}
add_action( 'admin_init', 'dmc_remove_yoast_seo_admin_filters', 20 );
