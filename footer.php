
</div>

<footer class="footer" role="contentinfo">

	<div class="dmc-max-three calls">

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

		<?php dynamic_sidebar( 'Footer widgets' ); ?>

	</div>

</footer>

<div class="credits">
	<div class="holder">
		<p>
			&copy; Copyright <?php bloginfo( 'name' ); ?>
			<?php echo intval( gmdate( 'Y' ) ); ?>
			<a href="https://dmcweb.com.au">WordPress website development</a> by DMC Web.
		</p>
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

</body>
</html>
