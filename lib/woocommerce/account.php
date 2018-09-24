<?php

// add WooCommerce account login/logout link to utility nav

add_filter( 'wp_nav_menu_items', 'add_login_logout_link', 10, 2 );
function add_login_logout_link( $items, $args ) {

	ob_start();

	$theme_location = $args->theme_location;

	if ( 'utility' === $theme_location ) {

		if ( is_user_logged_in() ) {
		?>

			<li class="menu-item">
				<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>">
					Account
				</a>
			</li>
			<li class="menu-item">
				<a href="<?php echo esc_url( wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) ); ?>">
					Log Out
				</a>
			</li>
		<?php

		} elseif ( ! is_user_logged_in() ) {
		?>

			<!-- <li class="menu-item">
				<a href="<?php // echo esc_url( wp_registration_url() ); ?> ">
					Join Now
				</a>
			</li> -->
			<li class="menu-item">
				<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>">
					Customer Login
				</a>
			</li>

		<?php
		}
	}

	$items .= ob_get_clean();
	return $items;
}


// display generic WooCommerce account login/logout/register links

function dmc_display_wc_account_links() {

	ob_start();

	if ( is_user_logged_in() ) {
	?>

		<a href="<?php echo esc_url( wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) ); ?>" class="link">
			Log Out
		</a>

		<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>">
			Your Account
		</a class="link">

	<?php
	} elseif ( ! is_user_logged_in() ) {
	?>

		<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="link">
			Login
		</a>

		<a href="<?php echo esc_url( wp_registration_url() ); ?> " class="link">
			Create account
		</a>

	<?php
	}

	$items .= ob_get_clean();
	return $items;
}
