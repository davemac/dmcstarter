<?php get_header(); ?>

<div class="small-12 columns" id="content" role="main">

	<header>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<section>

		<?php

		$images = get_field( 'dmc_project_image_slider' );

		if ( $images ) :
			?>

			<div class="row collapse">
				<div class="medium-10 columns">
					 <div id="projects-slider">
						<?php foreach ( $images as $image ) : ?>
							<div>
								<img src="<?php echo $image['url']; ?>" title="<?php echo $image['alt']; ?>" title="<?php echo $image['description']; ?>"  />
								<?php if ( $image['caption'] ) : ?>
									<p><?php echo $image['caption']; ?></p>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="large-2 medium-2 columns">
					<div class="projects-slider-nav hide-for-small-only">
						<?php foreach ( $images as $image ) : ?>
							 <div>
								<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		<?php endif; ?>

	</section>

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<header>
				<h3>About the Project:</h2>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>

</div>

<section class="related projects">

	<div class="row">
		<div class="twelve columns">

			<h3>Other Projects:</h3>

			<?php
			$other_projects = new WP_Query(
				array(
					'post_type' => 'jetpack-portfolio',
					'order'     => 'ASC',
				)
			);
			?>
			<ul class="small-block-grid-2 medium-block-grid-5">
				<?php
				while ( $other_projects->have_posts() ) :
					$other_projects->the_post();
					?>
					<li>
						<article class="index-card overlay-slide">
							<a href="<?php the_permalink(); ?>">
								<?php
								the_post_thumbnail(
									'medium',
									array(
										'class' => '',
									)
								);
								?>
								<div class="entry-meta">
									<h2><?php the_title(); ?></h2>
								</div>
							</a>
						</article>
					</li>
				<?php endwhile; ?>
			</ul>

		</div>
	</div>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
