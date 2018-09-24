<?php

// change name and email address for admin emails

add_filter( 'wp_mail_from', 'dmc_new_mail_from' );

function dmc_new_mail_from( $old ) {
	$dmc_site_email = get_bloginfo( 'admin_email' );
	return $dmc_site_email;
}

add_filter( 'wp_mail_from_name', 'dmc_new_mail_from_name' );

function dmc_new_mail_from_name( $old ) {
	$dmc_site_name = get_bloginfo( 'name' );
	return $dmc_site_name;
}


// customise the user welcome email
add_filter( 'wp_new_user_notification_email', 'dmc_wp_new_user_notification_email', 10, 3 );
function dmc_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {

	$wp_new_user_notification_email['subject'] = sprintf( '%s, here is your user account login to the %s website.', $user->first_name, $blogname );

	$message = __( 'You are receiving this email because you signed up for an account at ' ) . network_site_url() . "\r\n\r\n";

	// $message .= __( 'Welcome to the ' . $blogname . 'Business Toolkit. This service will support you to build your business and deliver aged care advice.' ) . "\r\n\r\n";

	$dmckey = get_password_reset_key( $user );

	$message .= __( 'To set your password, please visit the following address:' ) . "\r\n\r\n";
	$message .= '<' . network_site_url( "wp-login.php?action=rp&key=$dmckey&login=" . rawurlencode( $user->user_login ), 'login' ) . ">\r\n\r\n";

	$message .= sprintf( __( 'Your username is: %s' ), $user->user_login ) . "\r\n\r\n";

	$message .= __( 'If you have any issues, please contact us at ' ) . network_site_url() . '/contact/' . "\r\n\r\n";

	$wp_new_user_notification_email['headers'] = "From: ' . $blogname . ' <info@agedcaresteps.com.au>";

	$wp_new_user_notification_email['message'] = $message;

	return $wp_new_user_notification_email;

}


/**
	* Hide email from Spam Bots using a shortcode.
	*
	* @param array  $atts    Shortcode attributes. Not used.
	* @param string $content The shortcode content. Should be an email address.
	*
	* @return string The obfuscated email address.
	*/
function wpcodex_hide_email_shortcode( $atts, $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}
	add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );

	// Allow shortcodes in widget_text
	add_filter( 'widget_text', 'shortcode_unautop' );
	add_filter( 'widget_text', 'do_shortcode' );
