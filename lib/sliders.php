<?php

// Flickity/ACF homepage image slider
function dmc_hero_slider() {

	if ( have_rows( 'dmc_hero_sliders' ) ) : ?>
		<?php
		while ( have_rows( 'dmc_hero_sliders' ) ) :
			the_row();
			?>

			<div class="carousel-cell">
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


// Flickity latest posts slider
function dmc_latest_posts_slider() {

	$latest_news = new WP_Query(
		array(
			'post_type'      => 'post',
			'posts_per_page' => 4,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);
	if ( $latest_news ) :
		?>

		<h1 class="section-heading">
			Insights
		</h1>

		<div class="posts-slider">
			<?php
			while ( $latest_news->have_posts() ) :
				$latest_news->the_post();

					get_template_part( 'content', 'card-slider' );

			endwhile;
			?>
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


function dmc_testimonial_slider( $dmc_testimonial_slider_testimonials ) {
	?>

	<div class="testimonial-slider-wrap">

		<?php
		$heading = get_field( 'dmc_testimonial_slider_heading' );
		echo ( $heading ? '<h1 class="section-heading">' . $heading . '</h1>' : '' );
		?>

		<div class="testimonial-slider">

			<?php
			foreach ( $dmc_testimonial_slider_testimonials as $testimonial ) :
				?>

				<div class="carousel-cell testimonial">
					<blockquote>
						<p>
							<?php echo esc_textarea( $testimonial->post_content ); ?>
						</p>
					</blockquote>

					<?php if ( has_post_thumbnail( $testimonial->ID ) ) { ?>
						<div class="image">
							<?php echo get_the_post_thumbnail( $testimonial->ID, 'dmc-thumbnail-square' ); ?>
						</div>
					<?php } ?>

					<div class="author">
						<?php echo esc_attr( $testimonial->post_title ); ?>
					</div>

					<div class="position">
						<?php echo get_field( 'dmc_position', $testimonial->ID ); ?>
					</div>

					<div class="company">
						<?php echo get_field( 'dmc_company', $testimonial->ID ); ?>
					</div>
				</div>

				<?php
			endforeach;
			?>

		</div>

		<?php
		wp_reset_postdata();
		?>

	</div>
	<?php
}
