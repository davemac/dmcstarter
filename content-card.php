
<li class="card-new">

	<div class="card-img">
		<?php
		the_post_thumbnail(
			'fd-sm',
			array(
				// 'width'  => 380,
				// 'height' => 280,
				'crop'  => 'true',
				'class' => 'img-card',
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
		<?php the_excerpt(); ?>

		<span class="button small">
			Read more
		</span>
	</div>

</li>
