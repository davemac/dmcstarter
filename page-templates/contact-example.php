<?php
// Contact
get_header();

while ( have_posts() ) :
	the_post();
	?>

	<div <?php post_class(); ?> >

		<section class="page-hero map-holder">

			<!-- container for google map -->
			<div id="map"></div>

		</section>

		<div class="flex-row dmc-max-two" id="content">

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="main"> 

				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			</article>

			<div>
				<?php
				// gravity_form( 1, true, true, false, '', true, 1 );
				?>
			</div>

		</div>	

	</div>

	<?php
endwhile;

get_footer();
