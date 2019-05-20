<?php
$post_object = get_sub_field( 'dmc_featured_content_item' );
if ( $post_object ) :

	$post = $post_object;
	setup_postdata( $post );
	?> 

	<div <?php post_class( 'card' ); ?> id="post-<?php the_ID(); ?>">
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
				<p>
					<?php the_excerpt(); ?>
				</p>
			</div>
		</a>
	</div>

	<?php
	wp_reset_postdata();
endif;
