<?php
function display_prev_next() {
	?>

<div class="prev-next">
	<?php previous_post_link( '<span class="button ghost prev">%link</span>', 'Previous article' ); ?>
	<?php next_post_link( '<span class="button ghost next">%link</span>', 'Next article' ); ?>
</div>

	<?php
}
