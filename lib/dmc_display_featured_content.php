<?php

// displays homepage featured content
function dmc_display_featured_content_home() {

	$dmc_featured_contents = get_field( 'dmc_featured_content' );
	if ( $dmc_featured_contents ) :

		foreach ( $dmc_featured_contents as $dmc_featured_content ) :
			setup_postdata( $dmc_featured_content );
			?>

			<div class="featured-item">
				<div class="card-new featured main" <?php dmc_display_featured_img_bg( $dmc_featured_content->ID ); ?>>
					<div class="entry-meta">
						<h3 class="heading">
							<a href="<?php echo esc_url( get_the_permalink( $dmc_featured_content->ID ) ); ?>">
								<?php echo esc_attr( get_the_title( $dmc_featured_content->ID ) ); ?>
							</a>
						</h3>
						<p>
							<?php echo esc_textarea( $dmc_featured_content->post_excerpt ); ?>
						</p>
					</div>
					<div class="blend-overlay"></div>
				</div>
			</div>

			<?php
		endforeach;
		wp_reset_postdata();
	endif;
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
