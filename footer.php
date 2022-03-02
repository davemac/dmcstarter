
</div>

<footer class="footer" role="contentinfo">

	<div class="dmc-max-three calls">

		<div class="item">
			<h4>
				<?php echo esc_html( bloginfo( 'name' ) ); ?>
			</h4>

			<p>
				63 - 65 Maffra Street<br />
				Coolaroo Victoria 3048<br />
				Australia
			</p>
			<p>
				<a href="tel:+61393094822"">
					(+613) 9309 4822
				</a>
			</p>
			<p>
				Fax: (+613) 9309 0069<br />
			</p>

		</div>

		<div class="flex-row footer-links">
			<?php dynamic_sidebar( 'Footer widgets' ); ?>
		</div>

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
