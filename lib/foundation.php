<?php

// A fallback when no navigation is selected by default, otherwise it throws some nasty errors

function dmcstarter_menu_fallback() {
	echo '<div class="alert-box secondary">';
	// Translators 1: Link to Menus, 2: Link to Customize
	printf(
		__( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'dmcstarter' ),
		sprintf(
			__( '<a href="%s">Menus</a>', 'dmcstarter' ),
			get_admin_url( get_current_blog_id(), 'nav-menus.php' )
		),
		sprintf(
			__( '<a href="%s">Customize</a>', 'dmcstarter' ),
			get_admin_url( get_current_blog_id(), 'customize.php' )
		)
	);
	echo '</div>';
}


// Add Foundation 'active' class for the current menu item
function dmcstarter_active_nav_class( $classes, $item ) {
	if ( $item->current == 1 || $item->current_item_ancestor == true ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'dmcstarter_active_nav_class', 10, 2 );


/**
 * Use the active class of ZURB Foundation on wp_list_pages output.
 * From required+ Foundation http://themes.required.ch
 */
function dmcstarter_active_list_pages_class( $input ) {

	$pattern = '/current_page_item/';
	$replace = 'current_page_item active';

	$output = preg_replace( $pattern, $replace, $input );

	return $output;
}
add_filter( 'wp_list_pages', 'dmcstarter_active_list_pages_class', 10, 2 );
