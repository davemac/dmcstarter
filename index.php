<?php
get_header();
?>

	<section class="page-hero" <?php dmc_display_featured_img_bg( 6 ); ?>>
		<h1 class="page-title">
			<?php echo get_the_title( 6 ); ?>
		</h1>
	</section> 

	<div class="flex-row" id="content">

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="main"> 

			<header>
				<h1 class="archive-title">
					Latest News
					<?php if ( is_category() ) : ?>
						<span>
							Articles categorised '<?php single_cat_title(); ?>'
						</span>
					<?php elseif ( is_author() ) : ?>
						<span>
							Articles by <?php the_author(); ?>
						</span>
					<?php elseif ( is_tag() ) : ?>
						<span>
							Archive for tag '<?php single_tag_title(); ?>'
						</span>
					<?php elseif ( is_archive() ) : ?>
						<span>
							Archive for <?php single_month_title( ' ' ); ?>
						</span>
					<?php endif; ?>
				</h1>
			</header>

			<section class="dmc-max-three">

				<?php
				if ( have_posts() ) :

					while ( have_posts() ) :
						the_post();
						get_template_part( 'content', get_post_format() );
					endwhile;

					else :
						get_template_part( 'content', 'none' );

				endif; // end have_posts() check
				?>

			</section>

			<?php
			if ( function_exists( 'dmcstarter_pagination' ) ) {
				dmcstarter_pagination();
			} elseif ( is_paged() ) {
			?>

				<nav id="post-nav">
					<div class="post-previous">
						<?php next_posts_link( __( '&larr; Older posts', 'dmcstarter' ) ); ?>
					</div>
					<div class="post-next">
						<?php previous_posts_link( __( 'Newer posts &rarr;', 'dmcstarter' ) ); ?>
					</div>
				</nav>

			<?php
			};
			?>

		</article>

		<?php
		get_sidebar();
		?>

	</div>

<?php

get_footer();
