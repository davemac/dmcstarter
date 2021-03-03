<aside id="sidebar">

	<?php if ( is_front_page() ) : ?>

		<?php dynamic_sidebar( 'Homepage sidebar' ); ?>

	<?php elseif ( is_page( 33 ) ) : ?>

		<?php dynamic_sidebar( 'About Us sidebar' ); ?>

	<?php elseif ( is_post_type_archive( 'jetpack-testimonial' ) ) : ?>

		<!-- placeholder -->

	<?php elseif ( is_singular( 'jetpack-testimonial' ) ) : ?>

		<?php dynamic_sidebar( 'Single Projects sidebar' ); ?>

	<?php elseif ( is_home() || is_single() || is_archive() ) : ?>

		<?php dynamic_sidebar( 'News Sidebar' ); ?>

	<?php elseif ( is_page( 53 ) ) : ?>

		<?php dynamic_sidebar( 'Contact sidebar' ); ?>

	<?php endif; ?>

</aside>
