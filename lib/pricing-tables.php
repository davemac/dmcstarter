<?php
function dmc_pricing_table() {
	if ( have_rows( 'dmc_pricing_tables' ) ) :
		?>
		<div class="pricing-tables">
			<?php
			while ( have_rows( 'dmc_pricing_tables' ) ) :
				the_row();
				$plan_freq = get_field( 'plan_frequency' );
				?>
				<div class="pricing-table">

					<h3>
						<a href="<?php the_sub_field( 'plan_url' ); ?>">
							<?php the_sub_field( 'plan_title' ); ?>
						</a>
					</h3>

					<div class="plan-meta">
						<?php
						if ( $plan_freq ) :
							?>
							<span class="plan-freq">
								<?php the_sub_field( 'plan_frequency' ); ?>
							</span>
							<?php
						endif;
						?>

						<span class="plan-price">
							<strong>$</strong>
							<?php the_sub_field( 'plan_price' ); ?>
						</span>

						<?php
						if ( have_rows( 'plan_features' ) ) :
							?>
							<ul class="checklist">
								<?php
								while ( have_rows( 'plan_features' ) ) :
									the_row();
									?>
										<li>
											<?php the_sub_field( 'plan_feature' ); ?>
										</li>
									<?php
								endwhile;
								?>
							</ul>
							<?php
						endif;
						?>

						<p>
							<?php the_sub_field( 'plan_content' ); ?>
						</p>
					</div>

					<span class="plan-button">
						Purchase
					</span>

				</div>
				<?php
			endwhile;
			?>
		</div>
		<?php
	endif;
}

/**
	* Shortcode to insert ACF dmc_pricing_tables repeater field content into current post.
	*
	* @param array $atts  chooses row to use in the dmc_pricing_tables repeater
	* @param string $content  null
	*
	* @return string  the pricing table content wrapped in a container class
	*/
function dmc_pricing_tables_shortcode( $atts, $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'items' => '1',
		),
		$atts,
		'pricingtable'
	);

	if ( isset( $atts['row'] ) ) {
		// user's row index count starts at 1, not 0
		$dmc_items = $atts['row'];
	} else {
		$dmc_items = 4;
	}

	if ( have_rows( 'dmc_pricing_tables', 'option' ) ) :
		ob_start();
		?>

		<div class="pricing-tables">
			<?php
			while ( have_rows( 'dmc_pricing_tables', 'option' ) ) :
				the_row();
				$plan_freq = get_field( 'plan_frequency' );
				?>
					<div class="pricing-table">

						<h3>
							<a href="<?php the_sub_field( 'plan_url' ); ?>">
							<?php the_sub_field( 'plan_title' ); ?>
							</a>
						</h3>

						<div class="plan-meta">
						<?php
						if ( $plan_freq ) :
							?>
								<span class="plan-freq">
								<?php the_sub_field( 'plan_frequency' ); ?>
								</span>
								<?php
							endif;
						?>

							<span class="plan-price">
								<strong>$</strong>
							<?php the_sub_field( 'plan_price' ); ?>
							</span>

							<?php
							if ( have_rows( 'plan_features' ) ) :
								?>
								<ul class="checklist">
									<?php
									while ( have_rows( 'plan_features' ) ) :
										the_row();
										?>
											<li>
												<?php the_sub_field( 'plan_feature' ); ?>
											</li>
										<?php
									endwhile;
									?>
								</ul>
								<?php
							endif;
							?>

							<p>
							<?php the_sub_field( 'plan_content' ); ?>
							</p>
						</div>

						<span class="plan-button">
							Purchase
						</span>

					</div>
				<?php
			endwhile;
			?>
		</div>

		<?php
		endif;
	$output = ob_get_clean();

	return $output;
}
add_shortcode( 'pricingtable', 'dmc_pricing_tables_shortcode' );
