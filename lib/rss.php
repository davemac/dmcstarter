<?php

// Combine post types into one feed for Campaign Monitor RSS template
// function feed_combine_cpt( $qv ) {
//     if ( isset( $qv['feed'] ) && !isset( $qv['post_type'] ) )
//         $qv['post_type'] = array( 'post', 'little_things', 'home_energy', 'renno_res','be_inspired','tips_experts','resources', 'recipe', '17things' );
//     return $qv;
// }
// add_filter( 'request', 'feed_combine_cpt' );


// Insert featured images as post thumbs for Campaign Monitor RSS template
function insert_thumbnail_rss( $content ) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ) {
		$content = '' . get_the_post_thumbnail( $post->ID, 'dmc-wide-large' ) . '' . $content;
	}
	return $content;
}
add_filter( 'the_excerpt_rss', 'insert_thumbnail_rss' );
add_filter( 'the_content_feed', 'insert_thumbnail_rss' );
