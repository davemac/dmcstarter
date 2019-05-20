<div <?php post_class( 'card' ); ?> id="post-<?php the_ID(); ?>">

	<?php dmc_display_post_tax_terms(); ?>

	<a href="<?php the_permalink(); ?>">

		<?php
		the_post_thumbnail(
			'medium',
			array(
				'class' => 'attachment-masonry-thumb',
			)
		);
		?>

		<div class="entry-meta">
			<h2>
				<?php the_title(); ?>
			</h2>
			<?php the_excerpt(); ?>
		</div>

	</a>
</div>
