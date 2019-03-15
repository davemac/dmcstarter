<?php
function dmc_display_pagination() {
	if ( function_exists( 'dmcstarter_pagination' ) ) {
		dmcstarter_pagination();
	} elseif ( is_paged() ) {
		?>

		<nav id="post-nav">
			<div class="post-previous">
				<?php next_posts_link( __( '&larr; Older posts', 'dmcstarter' ) ); ?>
			</div>
			<div class="post-next">
				<?php previous_posts_link( __( 'Newer posts &rarr;', 'dmcstarter' ) ); ?>
			</div>
		</nav>

		<?php
	};
}


// Pagination
function dmcstarter_pagination() {
	global $wp_query;

	$big = 999999999; // This needs to be an unlikely integer

	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links(
		array(
			'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'mid_size'  => 5,
			'prev_next' => true,
			'prev_text' => __( '&laquo;' ),
			'next_text' => __( '&raquo;' ),
			'type'      => 'list',
		)
	);

	// Display the pagination if more than one page is found
	if ( $paginate_links ) {
		echo '<div class="pagination">';
		echo $paginate_links;
		echo '</div>';
	}
}
