<?php

/// add foundation responsive flex video to embeds
function wpse_embed_oembed_html( $cache, $url, $attr, $post_ID ) {

	$classes     = array();
	$classes_all = array(
		'flex-video widescreen',
	);

	// Check for different providers and add appropriate classes.
	if ( false !== strpos( $url, 'vimeo.com' ) ) {
		$classes[] = 'vimeo';
	}

	if ( false !== strpos( $url, 'youtube.com' ) ) {
		$classes[] = 'youtube';
	}

	$classes = array_merge( $classes, $classes_all );

	return '<div class="' . esc_attr( implode( $classes, ' ' ) ) . '">' . $cache . '</div>';
}
add_filter( 'embed_oembed_html', 'wpse_embed_oembed_html', 99, 4 );


// modify default embed size
// function dmc_modify_embed_defaults() {
// 	return array(
// 		'width'  => 760,
// 		'height' => 506
// 	);
// }
// add_filter( 'embed_defaults', 'dmc_modify_embed_defaults' );


// display acf emed using foundation flex video
// do not display related videos
function dmc_show_featured_video( $dmc_field = 'dmc_video' ) {
	?>

<div class="flex-video youtube">
	<?php
		// get iframe HTML
		$iframe = get_field( $dmc_field );

		// use preg_match to find iframe src
		preg_match( '/src="(.+?)"/', $iframe, $matches );
		$src = $matches[1];

		// add extra params to iframe src
		$params = array(
			'rel' => 0,
			// 'controls'    => 0,
			// 'hd'        => 1,
			// 'autohide'    => 1,
			// 'showinfo' => 0,
		);

		$new_src = add_query_arg( $params, $src );

		$iframe = str_replace( $src, $new_src, $iframe );

		// add extra attributes to iframe html
		$attributes = 'frameborder="0"';

		$iframe = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $iframe );

		echo $iframe;
		?>
</div>

	<?php
}
