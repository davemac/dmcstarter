<?php get_header(); ?>

<!-- Row for main content area -->
	<div class="small-12 columns" id="content" role="main">

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="pagename"><?php post_type_archive_title(); ?></h1>
		</header>
		<div class="entry-content">

			<?php
			$staff_content = new WP_Query(
				array(
					'post_type' => 'page',
					'p'         => 26,
				)
			);
			?>
			<?php
			while ( $staff_content->have_posts() ) :
				$staff_content->the_post();
				?>
				<?php the_content(); ?>
				<?php
			endwhile;
			wp_reset_postdata();
			?>

		</div>
	</article>

	<section id="masonry-loop" class="staff"> 
		<ul class="small-block-grid-2 medium-block-grid-3">
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<?php get_template_part( 'content', 'masonry' ); ?>
			<?php endwhile; ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		</ul>
	</section>

	<?php dmc_display_pagination(); ?>

	</div>
	<?php get_sidebar(); ?>

<?php get_footer(); ?>
