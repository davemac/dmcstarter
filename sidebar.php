<aside id="sidebar">

	<?php if ( is_front_page() ) : ?>

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Homepage sidebar' ) ) : ?>
		<?php endif; ?>

	<?php elseif ( is_page( 33 ) ) : ?>

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'About Us sidebar' ) ) : ?>
		<?php endif; ?>

	<?php elseif ( is_post_type_archive( 'jetpack-portfolio' ) ) : ?>

		<!-- placeholder -->

	<?php elseif ( is_singular( 'jetpack-portfolio' ) ) : ?>

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Single Projects sidebar' ) ) : ?>
		<?php endif; ?>

	<?php elseif ( is_home() || is_single() || is_archive() ) : ?>

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'News Sidebar' ) ) : ?>
		<?php endif; ?>

	<?php elseif ( is_page( 53 ) ) : ?>

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Contact sidebar' ) ) : ?>
		<?php endif; ?>

	<?php endif; ?>

</aside>
