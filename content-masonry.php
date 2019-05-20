
<li class="masonry-entry">
	<article class="index-card">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php if ( is_post_type_archive( 'dmc-staff' ) ) : ?>
					<?php the_post_thumbnail( 'masonry-thumb circle' ); ?>
				<?php else : ?>
					<?php the_post_thumbnail( 'masonry-thumb' ); ?>
				<?php endif; ?>
			<?php endif; ?>
			<div class="entry-meta">
				<h2><?php the_title(); ?></h2>
			</div>
		</a>
	</article>
</li>
