<?php

// Slick/ACF homepage image slider
if ( ! function_exists( 'dmc_hero_slider' ) ) {
	function dmc_hero_slider() {

		if ( have_rows( 'dmc_hero_sliders' ) ) : ?>
			<?php
			while ( have_rows( 'dmc_hero_sliders' ) ) :
				the_row();
				?>

				<div>
					<?php
					if ( get_sub_field( 'dmc_slide_image_links_to' ) ) :
						?>
						<a href="<?php the_sub_field( 'dmc_slide_image_links_to' ); ?>">
						<?php
					endif;
					?>

					<div class="hero" style="background-image: url('<?php the_sub_field( 'dmc_slide_image' ); ?>')"> 

						<div class="slider-meta">
							<h1>
								<?php the_sub_field( 'dmc_slide_main_tagline' ); ?>
							</h1>
							<?php
							if ( get_sub_field( 'dmc_slide_second_tagline' ) ) :
								?>
								<p>
									<?php the_sub_field( 'dmc_slide_second_tagline' ); ?>
								</p>
								<?php
							endif;
							?>
						</div>

					</div>

					<?php
					if ( get_sub_field( 'dmc_slide_image_links_to' ) ) :
						?>
						</a>
						<?php
					endif
					?>
				</div>

				<?php
			endwhile;
		endif;

	}
}


// Slick latest posts slider
function dmc_latest_posts_slider() {

	$latest_news = new WP_Query(
		array(
			'post_type'      => 'post',
			'posts_per_page' => 3,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);
	if ( $latest_news ) :
		?>
		<div id="blog-slider">
			<?php
			while ( $latest_news->have_posts() ) :
				$latest_news->the_post();
				?>

				<div>
					<a href="<?php the_permalink(); ?>" class="flex-holder">
						<?php
						the_post_thumbnail(
							'homepage-blog',
							array(
								'class' => 'alignnone',
							)
						);
						?>
						<div class="holder">
							<h3>
								<?php the_title(); ?>
							</h3>
							<?php the_excerpt(); ?>
						</div>
					</a>
				</div>

				<?php
			endwhile;
			?>
		</div>
		<?php
	endif;
	wp_reset_postdata();

}


// Slick/Woocommerce featured products slider
function dmc_featured_products_slider() {

	global $post;
	global $woocommerce;
	$dmc_featured_products = get_field( 'dmc_featured_products' );

	if ( $dmc_featured_products ) :
		?>

		<div class="woocommerce woocommerce-custom">
			<ul class="products" id="item-slider">
			<?php
			foreach ( $dmc_featured_products as $post ) :
				setup_postdata( $post );
				// the_title();
				wc_get_template_part( 'content', 'product' );
			endforeach;
			?>
			</ul>
		</div>

		<?php
		wp_reset_postdata();
	endif;

}


// Slick/ACF item slider
function dmc_item_slider() {

	if ( have_rows( 'dmc_brochures' ) ) :
		while ( have_rows( 'dmc_brochures' ) ) :
			the_row();
			?>
			<div>
			<a href="<?php the_sub_field( 'brochure_file' ); ?>">
				<?php
				$brochure_image = get_sub_field( 'brochure_image' );
				if ( $brochure_image ) {
					?>
					<img src="<?php echo esc_url( $brochure_image['url'] ); ?>" alt="<?php echo esc_attr( $brochure_image['alt'] ); ?>" />
					<?php
				}
				?>
			</a>
			</div>
			<?php
		endwhile;
	endif;
}
