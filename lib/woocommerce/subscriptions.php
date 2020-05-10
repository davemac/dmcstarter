<?php

function dmc_has_active_subscription( $user_id = null ) {
	// When a $user_id is not specified, get the current user Id
	// if ( $user_id && is_user_logged_in() === null ) :
	// 	$user_id = get_current_user_id();
	// 	// User not logged in we return false
	// elseif ( 0 === $user_id ) :
	// 	return false;
	// endif;

	global $wpdb;

	// Get active subscriptions count for a user ID
	$count_subscriptions = $wpdb->get_var(
		$wpdb->prepare(
			"
			SELECT count(p.ID)
			FROM {$wpdb->prefix}posts as p
			JOIN {$wpdb->prefix}postmeta as pm
				ON p.ID = pm.post_id
			WHERE p.post_type = 'shop_subscription'
			AND p.post_status = 'wc-active'
			AND pm.meta_key = '_customer_user'
			AND pm.meta_value > 0
			AND pm.meta_value = '$user_id'
			"
		)
	);

	return $count_subscriptions == 0 ? false : true;
}
