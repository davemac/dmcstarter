<?php

add_filter( 'gform_pre_render_23', 'dmc_set_gf_readonly_fields' );

function dmc_set_gf_readonly_fields( $form ) {
	?>
	<script>
		jQuery(function ($) {
			$('.dmc-read-only input').attr('readonly','readonly');
		});
	</script>
	<?php
	return $form;
}
