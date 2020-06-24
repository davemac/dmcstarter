
<div <?php post_class( 'flex-item card' ); ?> id="post-<?php the_ID(); ?>">
	<a href="<?php the_permalink(); ?>">

		<?php
		$dmc_second_featured_image = get_field( 'dmc_second_featured_image' );
		if ( $dmc_second_featured_image ) :
			echo wp_get_attachment_image( $dmc_second_featured_image, 'dmc-rect-md' );
		endif;
		?>

		<div class="entry-meta">
			<h2>
				<?php the_title(); ?>
			</h2>
		</div>

	</a>
</div>