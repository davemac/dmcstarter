<?php
/**
 * Copies post_id and term_id from a csv file in the root of the WordPress installation
 * , adds term_id to the given post ID
 *
 * @param    int      $post_id    The ID of the post to which the term is adeed
 * @param    string   $term_id   	The string of the term_id to be added to the post
 * @param    int      $int_term_id    The integer of the term_id to be added to the post
 */
function dmc_set_post_terms() {

	$rows = array_map( 'str_getcsv', file( 'product-terms.csv' ) );
	$header = array_shift( $rows );

	$csv = array();

	foreach ( $rows as $row ) {
		$post_id = $row[0];
		$term_id = $row[1];
		$int_term_id = (int) $term_id;

		$term_taxonomy_ids = wp_set_object_terms( $post_id, $int_term_id, 'prodcat' );

		// If there's an error, then we'll write it to the error log.
		if ( is_wp_error( $term_taxonomy_ids ) ) {
			error_log( print_r( $term_taxonomy_ids, true ) );
		}
	}

}
