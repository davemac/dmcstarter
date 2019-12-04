<?php
get_header();

while ( have_posts() ) :
	the_post();
?>

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

<section class="featured-products woocommerce">
	<div class="content-holder">
		<h2 class="section-heading">
			Featured Products
		</h2>
		<?php dmc_display_featured_products(); ?>
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

<section class="latest-news">
	<div class="content-holder">
		<h2>
			Latest News
		</h2>
		<?php dmc_latest_posts_slider(); ?>
	</div>
</section>

<?php
$home_news = new WP_Query(
	array(
		'posts_per_page' => 3,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);
if ( $home_news->have_posts() ) :
	?>

	<section class="news">
		<div class="row">

			<div class="large-12 columns">
				<h4 class="block-title"><a href="/news">News</a></h4>
			</div>

			<div class="medium-12 columns">
				<ul class="medium-block-grid-1">
					<?php
					while ( $home_news->have_posts() ) :
						$home_news->the_post();
						?>
						<li class="index-card">
							<div class="bg">
								<a href="<?php the_permalink(); ?>">
									<?php
									the_post_thumbnail(
										'medium',
										array(
											'class' => 'img-featured',
										)
									);
									?>
									<h2><?php the_title(); ?></h2>
									<?php the_excerpt(); ?>
								</a>
							</div>
						</li>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</ul>
				<span class="more"><a href="/news">Read more news</a></span>
			</div>

		</div>
	</section>

<?php endif; ?>

<?php
endwhile;
get_footer();
