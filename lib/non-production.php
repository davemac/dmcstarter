<?php
/**
 *  Non-production environment functionality.
 */

if ( 'production' !== wp_get_environment_type() ) :
	// Block crawling.
	add_filter( 'robots_txt', 'dmc_block_crawling', 999 );

	// Enable "Discourage search engines from indexing this site" option.
	add_filter( 'pre_option_blog_public', '__return_zero', 999 );
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
