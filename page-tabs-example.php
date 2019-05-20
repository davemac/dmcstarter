<?php
// Board Members
get_header();

while ( have_posts() ) :
	the_post();
	?>

<div <?php post_class(); ?> >

	<section class="static-page-hero">
			<h1 class="page-title">
				<?php the_title(); ?>
			</h1>
		<!-- <div class="blend-overlay"></div> -->
	</section> 

	<div class="flex-row" id="content">

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="main">
			<div class="entry-content">

				<?php the_content(); ?>

				<?php
				$tab_repeater = get_field( 'dmc_board_members' );

				if ( $tab_repeater ) {
					require_once get_template_directory() . '/lib/tabs.php';
				}
				?>

			</div>
		</article>

	</div>
</div>

	<?php
endwhile;

get_footer();
