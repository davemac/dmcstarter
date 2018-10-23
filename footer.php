
	<aside class="right-off-canvas-menu">
		<?php

			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 2,
					'items_wrap'     => '<ul class="off-canvas-list">%3$s</ul>',
					'walker'         => new dmcstarter_walker(
						array(
							'in_top_bar' => true,
							'item_type'  => 'li',
							'menu_type'  => 'main-menu',
						)
					),
				)
			);

		?>
	</aside>

	<a class="exit-off-canvas"></a>

</div>

<footer class="full-width" role="contentinfo">

	<div class="flex-row calls">

		<div class="logo">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?> logo" title="<?php bloginfo( 'name' ); ?>">
		</div>

		<div class="item">
			<h4>
				Heading
			</h4>
			<?php
			// echo dmc_display_wc_account_links();
			?>
		</div>

		<div class="item">
			<h4>
				Heading
			</h4>
			<p>
				<a href="#">
					Example link
				</a>	
			</p>
		</div>
	</div>

	<div class="flex-row footer-links">

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Footer widgets' ) ) : ?>
		<?php endif; ?>

	</div>

</footer>

<div class="credits">
	<p>
		&copy; Copyright <?php bloginfo( 'name' ); ?> 
		<?php echo intval( date( 'Y' ) ); ?>
		<a href="https://dmcweb.com.au">WordPress website development</a> by DMC Web.
	</p>
	<div class="holder">
		<p>
			<a href="/terms">
				Terms &amp; conditions
			</a>
		</p>
		<p>
			<a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">
				Privacy policy
			</a>
		</p>
	</div>
</div>

<?php
wp_footer();
?>

<script>
	( function( $ ) {
		$( document ).foundation();
	})( jQuery );
</script>

</body>
</html>
