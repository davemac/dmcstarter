<div class="dmc-tabs">
	<?php
	// first loop for tab nav
	$count = 1;
	foreach ( $tab_repeater as $item ) {
		$tab_title = $item['name'];
		$tab_id    = $count;
		?>

		<input id="tab<?php echo $tab_id; ?>" type="radio" name="tabs" 
								 <?php
									if ( $count == 1 ) {
										echo ' checked'; }
									?>
		>
		<label for="tab<?php echo $tab_id; ?>">
			<?php echo $tab_title; ?>
		</label>

		<?php
		$count++;
	}

	// second loop for tab content
	$count = 1;
	foreach ( $tab_repeater as $item ) {
		$tab_title   = $item['name'];
		$tab_content = $item['biography'];
		$position    = $item['title'];
		$image       = $item['headshot'];
		$tab_id      = $count;
		?>
		<section id="content<?php echo $tab_id; ?>">
			<?php if ( $image ) { ?>
				<?php echo wp_get_attachment_image( $image, 'medium' ); ?>
			<?php } ?>
			<div class="holder">
				<h3>
					<?php echo $tab_title; ?>
				</h3>
				<h4>
					<?php echo $position; ?>
				</h4>
				<?php echo $tab_content; ?>
			</div>
		</section>

		<?php
		$count++;
	}
	?>
</div>
