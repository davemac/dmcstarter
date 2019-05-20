<?php
get_header();
?>

<?php
if ( have_posts() ) :
	?>

	<section class="flex-row dmc-max-three portfolio" id="dmc-infinite">

		<header>
			<h1 class="entry-title"><?php post_type_archive_title(); ?></h1>
		</header>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php
			// Using Jetpack Infinite scroll, which creates the loop. Could use content.php template, but we wont here
			get_template_part( 'content', 'jetpack-portfolio' );
			?>

			<?php
		endwhile;
		?>
	</section>

	<?php
	else :
		get_template_part( 'content', 'none' );
endif; // end have_posts() check
	?>

<?php get_footer(); ?>
