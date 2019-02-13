<?php
if ( ! function_exists( 'dmc_linkedin_pixel' ) ) {
	function dmc_linkedin_pixel() {

		if ( ! is_admin() ) {
			?>
				<script type="text/javascript">
					_linkedin_partner_id = "382059";
					window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
					window._linkedin_data_partner_ids.push(_linkedin_partner_id);
					</script><script type="text/javascript">
					(function(){var s = document.getElementsByTagName("script")[0];
					var b = document.createElement("script");
					b.type = "text/javascript";b.async = true;
					b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
					s.parentNode.insertBefore(b, s);})();
				</script>
				<noscript>
					<img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=382059&fmt=gif" />
				</noscript>
			<?php
		}

	}
}
