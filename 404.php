<?php
get_header();
?>

<div class="flex-row" id="content">

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h1 class="page-title">
			Page Not Found
		</h1>
		<div class="entry-content">
			<div class="error">
				<p>
					The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
				</p>
			</div>
		</div>
	</article>

</div>

<?php
get_footer();
