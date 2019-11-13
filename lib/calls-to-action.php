<?php

function dmc_display_calls_to_action() {

	if ( get_sub_field( 'value_statement_title' ) ) :
		?>
		<h2 class="heading">
			<?php the_sub_field( 'value_statement_title' ); ?>
		</h2>
		<?php
	endif;

	if ( have_rows( 'calls_to_action' ) ) :
		?>
		<div class="dmc-ctas">
			<?php
			while ( have_rows( 'calls_to_action' ) ) :
				the_row();
				?>
				<div class="dmc-cta">
					<?php
					if ( get_sub_field( 'title' ) ) :
						?>
						<h3>
							<?php the_sub_field( 'title' ); ?>
						</h3>
						<?php
					endif;

					if ( get_sub_field( 'icon' ) ) :
						?>
							<img src="<?php the_sub_field( 'icon' ); ?>" />
						<?php
					endif;
					?>

					<p>
						<?php the_sub_field( 'content' ); ?>
					</p>

					<?php
					$button = get_sub_field( 'button' );
					if ( $button ) :
						?>
						<a href="<?php echo esc_url( $button['url'] ); ?>" <?php echo esc_attr( $button['target'] ); ?> > 
							<?php echo esc_html( $button['text'] ); ?>
						</a>
						<?php
					endif;
					?>
				</div>
				<?php
			endwhile;
			?>
		</div>
		<?php
	endif;
}
