<?php get_header(); ?>

<section class="page-hero featured-image" <?php dmc_display_acf_img_bg(); ?>>
	<!-- <div class="blend-overlay"></div> -->
</section> 

<div class="flex-row" id="content">

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="main"> 

		<ul class="cards">
			<?php
			while ( $display_home_content->have_posts() ) :
				$display_home_content->the_post();
				get_template_part( 'content', 'card' );
			endwhile;
			?>
		</ul>

		<?php dmc_display_pagination(); ?>

	</article>

	<?php
	get_sidebar();
	?>

</div>

<?php
get_footer();
