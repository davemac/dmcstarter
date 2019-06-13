<?php

/**
 * Copies a file from the a subdirectory of the root of the WordPress installation
 * into the uploads directory, attaches it to the given post ID, and adds it to
 * the Media Library.
 *
 * @param    int      $post_id    The ID of the post to which the image is attached.
 * @param    string   $filename   The name of the file to copy and to add to the Media Library
 */
function acme_add_file_to_media_uploader( $post_id, $filename ) {

	// Locate the file in a subdirectory of the root of the installation
	$file = trailingslashit( ABSPATH ) . 'fups/' . $filename;
	// If the file doesn't exist, then write to the error log and duck out
	if ( ! file_exists( $file ) || 0 === strlen( trim( $filename ) ) ) {
		error_log( 'The file you are attempting to upload, ' . $file . ', does not exist.' );
		return;
	}

	/* Read the contents of the upload directory. We need the
	 * path to copy the file and the URL for uploading the file.
	 */
	$uploads     = wp_upload_dir();
	$uploads_dir = $uploads['path'];
	$uploads_url = $uploads['url'];

	// Copy the file from the root directory to the uploads directory
	copy( $file, trailingslashit( $uploads_dir ) . $filename );
	/* Get the URL to the file and grab the file and load
	 * it into WordPress (and the Media Library)
	 */
	$url    = trailingslashit( $uploads_url ) . $filename;
	$result = media_sideload_image( $url, $post_id, $filename, 'id' );

	// set as featured image
	set_post_thumbnail( $post_id, $result );

	// If there's an error, then we'll write it to the error log.
	if ( is_wp_error( $result ) ) {
		error_log( print_r( $result, true ) );
	}
}


/**
 * Copies a file URL from a csv file in the root of the WordPress installation
 * into the uploads directory, attaches it to the given post ID as a featured image
 * and adds it to the Media Library.
 *
 * @param    int      $post_id    The ID of the post to which the image is attached.
 * @param    string   $url      The url of the file to add to the Media Library and attached as featured image
 */
function dmc_sideload_featured_img_url() {

	$rows   = array_map( 'str_getcsv', file( 'products.csv' ) );
	$header = array_shift( $rows );

	$csv = array();

	foreach ( $rows as $row ) {
		// $csv[] = array_combine( $header, $row );
		$post_id = $row[0];
		$url     = $row[1];

		// download the url into WordPress, saved temporarly for now
		$tmp = download_url( $url );

		// build an array of file information about the url, getting the files name using basename()

		$file_array = array(
			'name'     => basename( $url ),
			'tmp_name' => $tmp,
		);

		// Check for download errors, if there are error unlink the temp file name

		if ( is_wp_error( $tmp ) ) {
			@unlink( $file_array['tmp_name'] );
			return $tmp;
		}

		/**
		 * now we can actually use media_handle_sideload
		 * we pass it the file array of the file to handle
		 * and the post id of the post to attach it to
		 * $post_id can be set to '0' to not attach it to any particular post
		 */
		// $post_id = '0';

		// $id = media_handle_sideload( $file_array, $post_id );
		$result = media_sideload_image( $url, $post_id, $file_array['name'], 'id' );

		/**
		 * check for handle sideload errors
		 * if errors again unlink the file
		 */
		if ( is_wp_error( $result ) ) {
			@unlink( $file_array['tmp_name'] );
			return $id;
		}

		/**
		 * get the url from the newly upload file
		 * $value now contians the file url in WordPress
		 * $id is the attachment id
		 */

		// $value = wp_get_attachment_url( $id );
		// set as featured image
		set_post_thumbnail( $post_id, $result );

	}

}
