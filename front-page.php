<?php
get_header();
?>

<div id="homepage-slider">
	<?php dmc_hero_slider(); ?>
</div>

<section class="page-hero featured-image" <?php dmc_display_acf_random_img_bg(); ?>>
	<div class="sub-title ">
		<h2>
			<?php the_field( 'dmc_page_hero_sub_title' ); ?>
			<span>
				<?php the_field( 'dmc_page_hero_sub_title_end' ); ?>
			</span>
		</h2>
	</div>
	<div class="blend-overlay"></div>
</section>  

<div class="container">

	<section class="content text-center">
		<div class="row">
			<div class="medium-12 columns">
				<header>
					<h1 class="entry-title"><?php the_field( 'dmc_tagline' ); ?></h1>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>

	<?php if ( have_rows( 'dmc_featured_content' ) ) : ?>

		<section class="flex-row dmc-max-three cards featured-items">
			<?php
			while ( have_rows( 'dmc_featured_content' ) ) :
				the_row();
				get_template_part( 'content', 'dmc-featured' );
			endwhile;
			?>
		</section>

	<?php endif; ?>

	<section class="flex-row featured-products">
		<h2>
			Featured Products
		</h2>
		<?php dmc_featured_products_slider(); ?>
		<a href="/shop" class="more">
			View all products
		</a>
	</section>

	<section class="latest-news">
		<h2>
			Latest News
		</h2>
		<?php dmc_latest_posts_slider(); ?>
	</section>

	<?php
	$home_news = new WP_Query(
		array(
			'posts_per_page' => 3,
			'orderby' => 'menu_order',
			'order'     => 'ASC',
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
											'medium', array(
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

</div>

<?php
get_footer();
