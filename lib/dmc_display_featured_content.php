<?php

// displays featured content from any post type
function dmc_display_featured_content( $dmc_featured_content ) {
	?>

	<div class="cards post-cards posts-slider">

		<?php
		global $post;
		foreach ( $dmc_featured_content as $post ) :
			setup_postdata( $post );

			get_template_part( 'content', 'card-slider' );

		endforeach;
		wp_reset_postdata();
		?>

	</div>

	<?php
}


// displays homepage featured jobs
function dmc_display_featured_jobs_home() {

	$dmc_featured_jobs = get_field( 'dmc_featured_jobs' );
	if ( $dmc_featured_jobs ) :
		?>

		<div class="featured-item">
			<h2>
				Hot Jobs
			</h2>

			<?php
			foreach ( $dmc_featured_jobs as $job ) :
				setup_postdata( $job );
				?>

				<div class="card-new featured side" <?php dmc_display_featured_img_bg( $job->ID ); ?>>
					<div class="entry-meta">

						<h3 class="heading">
							<a href="<?php echo esc_url( get_the_permalink( $job->ID ) ); ?>">
								<?php echo esc_attr( get_the_title( $job->ID ) ); ?>
							</a>
						</h3>
					</div>
				</div>

				<?php
			endforeach;
			wp_reset_postdata();
			?>
		</div>

		<?php
	endif;
}


// displays latest news
function dmc_display_latest_news() {

	$home_news = new WP_Query(
		array(
			'posts_per_page' => 3,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);
	if ( $home_news->have_posts() ) :
		?>
		<section class="latest-news">
			<div class="flex-row">
				<ul class="cards cards--blog">
					<?php
					while ( $home_news->have_posts() ) :
						$home_news->the_post();
						get_template_part( 'content-card-blog' );
					endwhile;
					?>
				</ul>
			</div>
		</section>
		<?php
	endif;
}
