<?php
function dmc_gtm_tracking_code() {
	if ( ! is_admin() ) :
		?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TKS4Q5R');</script>
		<!-- End Google Tag Manager -->
		<?php
	endif;
}


function dmc_gtm_tracking_code_nojs() {
	if ( ! is_admin() ) :
		?>
		<!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="//www.googletagmanager.com/ns.html?id=GTM-TKS4Q5R"
		height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->
		<?php
	endif;
}
