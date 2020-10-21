<?php

// displays featured content from any post type
function dmc_display_featured_content( $dmc_featured_content ) {
	?>

	<div class="cards post-cards posts-slider">

		<?php
		global $post;
		foreach ( $dmc_featured_content as $post ) :
			setup_postdata( $post );

			$post_type_name = $post->post_type;
			// make these variables available to the template part
			set_query_var( 'post_type_name', $post_type_name );

			get_template_part( 'content', 'card-slider' );

		endforeach;
		wp_reset_postdata();
		?>

	</div>

	<?php
}


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


function dmc_display_featured_product_tags() {

	if ( have_rows( 'dmc_featured_product_tags' ) ) :
		while ( have_rows( 'dmc_featured_product_tags' ) ) :
			the_row();

			$product_tag_term = get_sub_field( 'product_tag' );

			$taxonomy_prefix = 'product_tag';
			$term_id = $product_tag_term->term_taxonomy_id;
			$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;

			if ( $product_tag_term ) :
				?>

					<div class="card-new">

						<a href="<?php echo get_term_link( $term_id ); ?>">
							<h3>
								<?php echo $product_tag_term->name; ?>:
							</h3>

							<?php
							$dmc_image = get_field( 'dmc_image', $term_id_prefixed );
							if ( $dmc_image ) :
								?>
								<div class="card-img">
									<img src="<?php echo esc_url( $dmc_image['url'] ); ?>" class="img-card" />
								</div>
								<?php
							endif;
							?>
							<span class="button">
								View More
							</span>
						</a>

					</div>

				<?php
			endif;
		endwhile;
	endif;
}


function dmc_display_featured_product_cats( $dmc_id ) {

	if ( have_rows( 'dmc_featured_product_cats', $dmc_id ) ) :
		while ( have_rows( 'dmc_featured_product_cats', $dmc_id ) ) :
			the_row();

			$product_cat_term = get_sub_field( 'product_cat' );

			$taxonomy_prefix = 'product_cat';
			$term_id = $product_cat_term->term_taxonomy_id;
			$term_id_prefixed = $taxonomy_prefix .'_'. $term_id;

			if ( $product_cat_term ) :
				?>

					<div class="card-new">

						<a href="<?php echo get_term_link( $term_id ); ?>">
							<h3>
								<?php echo esc_attr( $product_cat_term->name ); ?>:
							</h3>

							<?php
							$thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
							$dmc_image = wp_get_attachment_image_src( $thumbnail_id, 'woocommerce_thumbnail' );
							if ( $dmc_image ) :
								?>
								<div class="card-img">
									<img src="<?php echo esc_url( $dmc_image[0] ); ?>" class="img-card" />
								</div>
								<?php
							endif;
							?>
							<span class="button">
								View More
							</span>
						</a>

					</div>

				<?php
			endif;
		endwhile;
	endif;
}
