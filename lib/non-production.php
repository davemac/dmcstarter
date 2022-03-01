<?php
/**
 *  Non-production environment functionality.
 */

if ( 'production' !== wp_get_environment_type() ) :
	// Block crawling.
	add_filter( 'robots_txt', 'dmc_block_crawling', 999 );

	// Enable "Discourage search engines from indexing this site" option.
	add_filter( 'pre_option_blog_public', '__return_zero', 999 );


	// Hide ACF in admin menu for prod/staging URLs
	function dmc_hide_acf_admin() {
		$site_url = get_bloginfo( 'url' );

		$protected_urls = array(
			'https://prod.com.au',
			'https://staging.com.au',
		);

		if ( in_array( $site_url, $protected_urls, true ) ) {
			// Hide the ACF menu item
			return false;

		} else {
			return true;
		}
	}
	add_filter( 'acf/settings/show_admin', 'dmc_hide_acf_admin' );

endif;


/**
 * Filters the robots.txt output to block crawling on non-production environment.
 *
 * @param string $output The robots.txt output.
 */
function dmc_block_crawling( $output ) {

	$output = '# Crawling is blocked for non-production environment' . PHP_EOL;
	$output .= 'User-agent: *' . PHP_EOL;
	$output .= 'Disallow: /';

	return $output;
}
