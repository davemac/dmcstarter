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

		<div class="meta-holder">
			<span>
				<?php echo get_the_date(); ?>
			</span>
			<span>
				<?php
				$post_type_label = get_post_type_object( $post_type_name );
				echo esc_html( $post_type_label->labels->singular_name );
				?>
			</span>
		</div>

	</div>
</div>

