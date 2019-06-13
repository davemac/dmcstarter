<?php
// show author profile, including image and bio requires Co-authors Plus plugin
if ( ! function_exists( 'dmc_author_profile' ) ) {
	function dmc_author_profile() {
		$output  = '';
		$output .= '<div class="entry-author panel"><div class="row collapse"><div class="small-2 columns">';
		// get an array of the current co-author data
		if ( function_exists( 'get_coauthors' ) ) {
			$dmc_coauthor = get_coauthors();
		};
		// get co-author ID, name, description, featured image
		$dmc_coauthor_id        = $dmc_coauthor[0]->ID;
		$dmc_coauthor_firstname = $dmc_coauthor[0]->first_name;
		$dmc_coauthor_desc      = $dmc_coauthor[0]->description;
		$dmc_coauthor_website   = $dmc_coauthor[0]->website;
		$dmc_coauthor_pic       = get_the_post_thumbnail(
			$dmc_coauthor_id,
			'thumbnail',
			array(
				'class' => 'authpic',
			)
		);
		// get WP author ID, acf image field and website
		$author_id        = get_the_author_meta( 'ID' );
		$author_firstname = get_the_author_meta( 'first_name' );
		$author_photo     = get_field( 'dmc_author_photo', 'user_' . $author_id );
		$author_website   = get_the_author_meta( 'url' );
		if ( $dmc_coauthor_pic ) {
			 $output .= $dmc_coauthor_pic;
		} else {
			$output .= '<img src="' . $author_photo['url'] . '" alt="' . $author_photo['alt'] . '" class="authpic" />';
		}
		$output .= '</div><div class="small-10 columns"><h4>';
		if ( function_exists( 'coauthors_posts_links' ) ) {
			$output .= coauthors_posts_links( ', ', ' & ', '', '', false );
		}
		$output .= '</h4><p class="desc">';
		if ( get_coauthors() ) {
			$output .= $dmc_coauthor_desc;
		} else {
			get_the_author_meta( 'description' );
		};
		$output .= '</p>';
		if ( $dmc_coauthor_pic ) {
			if ( $dmc_coauthor_website ) {
				$output .= '<p><a href="' . $dmc_coauthor_website . '">View ' . $dmc_coauthor_firstname . '\'s website</p>';
			}
		} else {
			if ( $author_website ) {
				$output .= '<p><a href="' . $author_website . '">View ' . $author_firstname . '\'s website</p>';
			}
		}
		$output .= '</div></div></div>';
		return $output;
	}
}// End if().


// is user if not admin or super admin
if ( ! current_user_can( 'administrator' ) ) {

	/**
	 * Hide Personal Options settings
	 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/admin_print_scripts
	 *
	 * Keyboard Short - .user-comment-shortcuts-wrap
	 * Admin Color Scheme - .user-admin-color-wrap
	 * Visual Editor - .user-rich-editing-wrap
	 * Show Toolbar - .show-admin-bar
	 */
	add_action(
		'admin_print_scripts-profile.php',
		function () {
			?><style>
	  .user-rich-editing-wrap,
	  .user-comment-shortcuts-wrap,
	  .user-admin-color-wrap,
	  .show-admin-bar {
		display: none;
	  }</style>
			<?php
		}
	);


	/**
	 * Remove default user contact fields
	 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods
	 */
	function modify_user_contact_methods( $user_contact ) {
		// Remove user contact methods
		unset( $user_contact['twitter'] );
		unset( $user_contact['facebook'] );
		unset( $user_contact['googleplus'] );
		unset( $user_contact['url'] );

		return $user_contact;
	}
	add_filter( 'user_contactmethods', 'modify_user_contact_methods', 20, 1 );


	// Removes the "About Yourself / Biographical Info" field.
	// http://wordpress.stackexchange.com/questions/94963/removing-website-field-from-the-contact-info
	function remove_website_row_wpse_94963_css() {
		echo '<style>
            tr.user-url-wrap, tr.user-description-wrap{ display: none; };
        </style>';
	}
	add_action( 'admin_head-user-edit.php', 'remove_website_row_wpse_94963_css' );
	add_action( 'admin_head-profile.php', 'remove_website_row_wpse_94963_css' );


	// removes Yoast SEO fields from edit user profile page
	add_action( 'add_meta_boxes', 'yoast_is_toast', 99 );
	function yoast_is_toast() {
		//capability of 'manage_plugins' equals admin, therefore if NOT administrator
		//hide the meta box from all other roles on the following 'post_type'
		//such as post, page, custom_post_type, etc
		if ( ! current_user_can( 'edit_published_posts' ) ) { // show for editor and above
			remove_meta_box( 'wpseo_meta', 'post_type', 'normal' );
			remove_meta_box( 'wpseo_meta', 'dmc-exhibitors', 'normal' ); // remove it from dmc-exhibtors edit screen as well
		}
	}

	// remove items from admin bar
	// https://codex.wordpress.org/Function_Reference/remove_node
	add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
	function remove_wp_logo( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'my-sites' );
		$wp_admin_bar->remove_node( 'comments' );
		$wp_admin_bar->remove_node( 'new-content' );
		$wp_admin_bar->remove_node( 'wpseo-menu' );
	}


	/**
	 * Remove access to the dashboard
	 */
	add_action(
		'admin_init',
		function () {
			global $pagenow; // Get current page

			if ( ! current_user_can( 'edit_published_posts' ) ) { // show for editor and above
				$redirect = get_admin_url( null, 'profile.php' ); // Where to redirect
				if ( $pagenow == 'index.php' ) {
					wp_redirect( $redirect, 301 );
					exit;
				}
			}
		}
	);

	// This filter is used to hide metabox by default, an admin user can then select the ‘Screen Options’ tab in the top right hand corner of the post edit screen and they will see the designated ‘hidden’ metaboxes checked in the list of options.
	// https://developer.wordpress.org/reference/hooks/default_hidden_meta_boxes/
	// add_filter( 'default_hidden_meta_boxes','hide_meta_box', 10,2 );
	// function hide_meta_box( $hidden, $screen ) {
	//     //make sure we are dealing with the correct screen
	//     if ( ( 'post' == $screen->base ) && ( 'dmc-exhibtors' == $screen->id ) ){
	//         //lets hide everything
	//         $hidden = array(
	//             'postexcerpt',
	//             'slugdiv',
	//             'postcustom',
	//             'trackbacksdiv',
	//             'commentstatusdiv',
	//             'commentsdiv',
	//             'authordiv',
	//             'revisionsdiv'
	//         );
	//       // $hidden[] ='my_custom_meta_box';//for custom meta box, enter the id used in the add_meta_box() function.
	//     }
	//     return $hidden;
	// }

}// End if().
