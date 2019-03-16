<div class="dmc-tabs">
	<?php
	// first loop for tab nav
	$count = 1;
	foreach ( $tab_repeater as $item ) {
		$tab_title = $item['name'];
		$tab_id = $count;
		?>

		<input id="tab<?= $tab_id ?>" type="radio" name="tabs" <?php if ( $count == 1 ) { echo ' checked'; } ?>>
		<label for="tab<?= $tab_id ?>">
			<?= $tab_title ?>
		</label>

		<?php
		$count++;
	}

	// second loop for tab content
	$count = 1;
	foreach ( $tab_repeater as $item ) {
		$tab_title = $item['name'];
		$tab_content = $item['biography'];
		$tab_id = $count;
	?>
		<section id="content<?= $tab_id ?>">
			<?= $tab_title ?>
			<?php the_sub_field( 'title' ); ?>
			<?= $tab_content ?>
			<?php $headshot = get_sub_field( 'headshot' ); ?>
			<?php if ( $headshot ) { ?>
				<?php echo wp_get_attachment_image( $headshot, 'medium' ); ?>
			<?php } ?>
		</section>

		<?php
		$count++;
	}
	?>
</div>