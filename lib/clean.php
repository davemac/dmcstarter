<?php
// theme setup

if ( ! isset( $content_width ) ) {
	$content_width = 580;
}

// start all the functions
add_action( 'after_setup_theme', 'dmcstarter_startup' );

function dmcstarter_startup() {
	// launching operation cleanup
	add_action( 'init', 'dmcstarter_head_cleanup' );
	// remove WP version from RSS
	add_filter( 'the_generator', 'dmcstarter_rss_version' );

	// tracking pixels
	// add_action( 'wp_head', 'dmc_linkedin_pixel' );
	// add_action( 'wp_head', 'dmc_facebook_pixel' );
	// add_action( 'wp_head', 'dmc_gtm_tracking_code' );
	// add_action( 'wp_body_open', 'dmc_gtm_tracking_code_nojs' );

	// Get Site Control
	// add_action( 'wp_footer', 'dmc_gsc_helper' );
}


// Add theme supports
function dmcstarter_theme_support() {
	// Add language supports.
	load_theme_textdomain( 'dmcstarter', get_template_directory() . '/languages' );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// custom logo
	$defaults = array(
		'height'      => 50,
		'width'       => 400,
		'flex-height' => false,
		'flex-width'  => false,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	add_theme_support( 'custom-logo', $defaults );

	// add excerpts to these post types
	$types = array( 'page', 'jetpack-portfolio' );
	foreach ( $types as $type ) {
		add_post_type_support( $type, 'excerpt' );
	}

	// Add post thumbnail supports
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'dmc-article-hero', 580, 450 );
	add_image_size( 'dmc-logo', 400, 50 ); // for site logo @2x
	add_image_size( 'dmc-hero', 1440, 600 );

	// rss feed
	add_theme_support( 'automatic-feed-links' );

	// Add post formats support
	add_theme_support( 'post-formats', array( 'video' ) );

	// Add menu support
	register_nav_menus(
		array(
			'primary'    => __( 'Primary Navigation', 'dmcstarter' ),
			'additional' => __( 'Additional Navigation', 'dmcstarter' ),
			'utility'    => __( 'Utility Navigation', 'dmcstarter' ),
		)
	);

	// Jetpack Infinite Scroll, preset to button click
	add_theme_support(
		'infinite-scroll',
		array(
			'container'      => 'dmc-infinite',
			// 'footer'		=> 'page',
			'type'           => 'click',
			// 'footer_widgets' => false,
			'wrapper'        => false,
			// 'render'         => 'dmc_infinite_scroll_render',
			'posts_per_page' => 3,
		)
	);
}
add_action( 'after_setup_theme', 'dmcstarter_theme_support' );


// wp_head cleanup
function dmcstarter_head_cleanup() {
	// removeWP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'dmcstarter_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'dmcstarter_remove_wp_ver_css_js', 9999 );

}


// remove WP version from RSS
function dmcstarter_rss_version() {
	return '';
}


// remove WP version from scripts
function dmcstarter_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}


function dmc_change_post_object_labels() {
	global $wp_post_types;
	$labels                     = &$wp_post_types['post']->labels;
	$labels->name               = 'Articles';
	$labels->singular_name      = 'Article';
	$labels->add_new            = 'Add New Article';
	$labels->add_new_item       = 'Add New Article';
	$labels->edit_item          = 'Edit Article';
	$labels->new_item           = 'New Article';
	$labels->view_item          = 'View Article';
	$labels->search_items       = 'Search Articles';
	$labels->not_found          = 'No Articles found';
	$labels->not_found_in_trash = 'No Articles found in Trash';
	$labels->all_items          = 'All Articles';
	$labels->menu_name          = 'Articles';
	$labels->name_admin_bar     = 'Articles';
}
add_action( 'init', 'dmc_change_post_object_labels' );
