<?php
get_header()
?>

<div class="flex-row" id="content">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>

				<?php dmc_display_image_with_caption(); ?>

				<div class="meta-holder">
					<?php dmcstarter_entry_meta(); ?>
					<?php dmc_display_share(); ?>
				</div>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<p class="entry-tags"><?php the_tags(); ?></p>

			<div class="entry-author panel">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 95 ); ?>
				<div class="holder">
					<h4>
						<?php the_author_posts_link(); ?>
					</h4>
					<p class="cover-description">
						<?php the_author_meta( 'description' ); ?>
					</p>
				</div>
			</div>

			<?php comments_template(); ?>

			<?php display_prev_next(); ?>

		</article>

		<?php
	endwhile;

	get_sidebar();
	?>

</div>

<?php
get_footer();
