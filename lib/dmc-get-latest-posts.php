<?php
function dmc_get_latest_posts( $count = 2, $imgsize = 'medium' ) {
	$dmc_recent_posts = new WP_Query(
		array(
			'posts_per_page' => $count,
		)
	);
	if ( $dmc_recent_posts->have_posts() ) :
		?>

		<ul class="cards">

		<?php
		while ( $dmc_recent_posts->have_posts() ) :
			$dmc_recent_posts->the_post();
			get_template_part( 'content' );
		endwhile;
		wp_reset_postdata();
		?>

		</ul>

		<?php
	endif;
}
