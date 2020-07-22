<div class="carousel-cell card-new">
	<div class="card-img">
		<?php
		the_post_thumbnail(
			'medium',
			array(
				'crop'  => 'true',
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

