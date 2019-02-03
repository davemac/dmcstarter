<?php

// change Jetpack Infinite Scroll button label
function filter_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load more projects ...', 'dmcstarter' );
	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'filter_jetpack_infinite_scroll_js_settings' );


// remove sharing so it can be added manually into template
// https://jetpack.me/2013/06/10/moving-sharing-icons/
function jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'jptweak_remove_share' );

function dmc_display_share() {
	if ( function_exists( 'sharing_display' ) ) {
		sharing_display( '', true );
	}

	if ( class_exists( 'Jetpack_Likes' ) ) {
		$custom_likes = new Jetpack_Likes();
		echo $custom_likes->post_likes( '' );
	}
}


// remove sharing metaboxes on custom post edit screens that don't need them
if ( is_admin() ) :
	function remove_jetpack_sharing_metabox() {
		remove_meta_box( 'sharing_meta', 'page', 'side' );
		remove_meta_box( 'sharing_meta', 'jetpack-portfolio', 'side' );
		remove_meta_box( 'sharing_meta', 'jetpack-testimonial', 'side' );
		remove_meta_box( 'sharing_meta', 'guest-author', 'side' );
		// remove_meta_box( 'sharing_meta', 'dmc-staff', 'side' );
	}
	add_action( 'do_meta_boxes', 'remove_jetpack_sharing_metabox' );
endif;


// ensure related posts are on posts only
function remove_jetpack_related_posts( $options ) {
	if ( ! is_singular( 'post' ) ) {
		$options['enabled'] = false;
	}
	return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'remove_jetpack_related_posts' );


// remove comments from the carousel
function tweakjp_rm_comments_att( $open, $post_id ) {
	$post = get_post( $post_id );
	if ( 'attachment' === $post->post_type ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'tweakjp_rm_comments_att', 10, 2 );


/**
 * Control the list of modules available under Jetpack > Settings
 * Example: Let's activate 7 specific modules, and nothing more.
 * https://jetpack.com/2016/05/13/hook-month-customize-modules-shortcodes-widgets/
 */
// function jeherve_only_seven_modules( $modules, $min_version, $max_version ) {
//     $my_modules = array(
//         'stats',
//         'photon',
//         'related-posts',
//         'markdown',
//         'sso',
//         'custom-content-types',
//         'custom-css',
//     );
//     return array_intersect_key( $modules, array_flip( $my_modules ) );
// }
// add_filter( 'jetpack_get_available_modules', 'jeherve_only_seven_modules', 20, 3 );
