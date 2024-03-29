<?php
get_header();

while ( have_posts() ) :
	the_post();
?>

<section class="dmc-stack-layout hero-top">
	<?php dmc_display_acf_random_img_bg(); ?>

	<div class="h-internal" id="entry-title-area">
		<h1>
			<?php the_field( 'dmc_header_intro_content' ); ?>
		</h1>
	</div>

	<a href="/contact" class="button">
		Contact
	</a>
</section>

<div id="homepage-slider">
	<?php dmc_hero_slider(); ?>
</div>

<section class="page-hero featured-image" <?php dmc_display_acf_img_bg(); ?>>
	<div class="sub-title ">
		<h1>
			<?php the_field( 'dmc_page_hero_sub_title' ); ?>
		</h1>
	</div>
	<div class="blend-overlay"></div>
</section>

<section class="calls-to-action">
	<div class="content-holder text-center">
		<?php
		if ( have_rows( 'info_strip_dmc_calls_to_action' ) ) :
			while ( have_rows( 'info_strip_dmc_calls_to_action' ) ) :
				the_row();

				dmc_display_calls_to_action();

			endwhile;
		endif;
		?>
	</div>
</section>

<section class="home-intro">
	<div class="content-holder full-width text-center">
		<?php the_content(); ?>
		<a href="#" class="button">
			Read More
		</a>
	</div>
</section>

<section class="calls-to-action">
	<div class="content-holder">
		<?php
		$dmc_testimonial_slider_testimonials = get_field( 'homepage_dmc_testimonial_slider_testimonials' );
		if ( $dmc_testimonial_slider_testimonials ) :
			dmc_testimonial_slider( $dmc_testimonial_slider_testimonials );
		endif;
		?>
	</div>
</section>

<section class="featured-products woocommerce">
	<div class="content-holder">
		<h2 class="section-heading">
			Featured Products
		</h2>
		<?php // dmc_display_featured_products(); ?>
	</div>
</section>

<section class="featured-products featured-prods product_tag">
	<div class="cards">
		<?php // dmc_display_featured_product_tags(); ?>
	</div>
</section>

<section class="featured-products featured-prods product_cat">
	<h2 class="section-heading">
		Featured Categories:
	</h2>
	<div class="cards">
		<?php // dmc_display_featured_product_cats( $dmc_id ); ?>
	</div>
</section>

<section class="insta">
	<div class="content-holder text-center">
		<h2 class="section-heading">
			Follow us on Instagram
		</h2>

		<?php echo do_shortcode( '[instagram-feed]' ); ?>
	</div>
</section>

<section class="latest-news-slider">
	<div class="content-holder">
		<?php dmc_latest_posts_slider(); ?>
	</div>
</section>

<section class="latest-news">
	<div class="content-holder">
		<?php dmc_get_latest_posts( 3, 'medium' ); ?>
	</div>
</section>

<?php
endwhile;

get_footer();
