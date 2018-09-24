<?php
get_header();
?>

<section class="page-hero featured-image" <?php dmc_display_acf_img_bg(); ?>>

	<div class="sub-title ">
		<p>
			<?php the_field( 'dmc_page_hero_sub_title' ); ?>
			<span><?php the_field( 'dmc_page_hero_sub_title_end' ); ?></span>
		</p>
	</div>
	<!-- <div class="blend-overlay"></div> -->
</section>

<div class="container" role="document">

	<div class="flex-row" id="content">

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="main"> 

			<h1 class="page-title">
				<?php esc_html_e( 'Search Results for', 'dmcstarter' ); ?> "<?php echo get_search_query(); ?>"
			</h1>

			<?php
			if ( have_posts() ) :
			?>
				<section class="flex-row dmc-max-four cards">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'content-page-children' );
					endwhile;
					?>
				</section>
			<?php
			else :
				get_template_part( 'content', 'none' );
			endif; // end have_posts() check
			?>

			<?php
			if ( function_exists( 'dmcstarter_pagination' ) ) {
				dmcstarter_pagination();
			} elseif ( is_paged() ) {
				?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'dmcstarter' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'dmcstarter' ) ); ?></div>
				</nav>
			<?php
			}
			?>

		</article>

		<?php get_sidebar(); ?>

	</div>

<?php
get_footer();
