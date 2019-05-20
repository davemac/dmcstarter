
<div <?php post_class( 'card' ); ?> id="post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>" class="media">

		<?php
		the_post_thumbnail(
			'medium',
			array(
				'class' => 'media-figure',
			)
		);
		?>

		<div class="entry-meta media-body">
			<h2>
				<?php the_title(); ?>
			</h2>
			<p>
				<?php the_excerpt(); ?>
			</p>
		</div>

	</a>
</div>
