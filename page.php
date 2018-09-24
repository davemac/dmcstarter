<?php
get_header();

while ( have_posts() ) :
	the_post();
?>

	<div <?php post_class(); ?> >

		<section class="page-hero" <?php dmc_display_featured_img_bg(); ?>>
			<!-- <div class="sub-title ">
				<h1 class="page-title">
					<?php // the_title(); ?>
				</h1>
			</div> -->
			<!-- <div class="blend-overlay"></div> -->
		</section> 

		<div class="flex-row" id="content">

			<article id="post-<?php the_ID(); ?>" role="main"> 

				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<?php
				$list_children = new WP_Query(
					array(
						'post_type'   => 'page',
						'orderby'     => 'menu_order',
						'order'       => 'ASC',
						'post_parent' => $post->ID,
					)
				);
				if ( $list_children->have_posts() ) :
				?>

					<section class="flex-row dmc-max-four cards">
						<?php
						while ( $list_children->have_posts() ) :
							$list_children->the_post();

							// Using Jetpack Infinite scroll, which creates the loop. Could use content.php template, but we wont here
							get_template_part( 'content-page-children-media' );

						endwhile;
						?>
					</section>
				<?php endif; ?>   

			</article>

			<?php
			get_sidebar();
			?>

		</div>

	</div>

<?php
endwhile;

get_footer();
