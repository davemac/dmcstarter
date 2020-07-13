
<div class="card-new carousel-cell">
	<div class="card-img">
		<?php
		the_post_thumbnail(
			'fd-sm',
			array(
				// 'width'  => 380,
				// 'height' => 280,
				'crop'  => 'true',
				'class' => 'carousel-cell-image',
			),
			array()
		);
		?>
	</div>

	<div class="entry-meta">
		<h1>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h1>

		<div class="date">
			<?php echo get_the_date(); ?>
		</div>

	</div>
</div>
