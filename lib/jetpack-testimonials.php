<?php

// display chosen Jetpack testimonials for page
// $page_id = page to get the testimonial repeater values from
// $testiomnial_row = the specific testimonial repeater row to retrieve
if ( ! function_exists( 'dmc_show_hero_testimonial' ) ) {
	function dmc_show_hero_testimonial( $page_id = 2, $testiomnial_row = 0 ) {
		?>

		<div class="flex-row testimonials">

			<?php
			$rows = get_field( 'dmc_testimonials_display', $page_id );
			// get the required row
			$dmc_testimonial  = $rows[ $testiomnial_row ]['dmc_testimonial'];
			$dmc_test_id      = $dmc_testimonial->ID;
			$dmc_test_title   = $dmc_testimonial->post_title;
			$dmc_test_content = $dmc_testimonial->post_content;
			// apply the content filters to the raw, unfiltered post content
			$dmc_test_content_filtered = apply_filters( 'the_content', $dmc_test_content );
			?>


			<blockquote class="highlight pullquote">
				<?php echo $dmc_test_content_filtered; ?>
				<h4>
					<span class="author">
						<span class="position">
							<?php the_field( 'dmc_position', $dmc_test_id ); ?>
						</span>
					</span>
				</h4>
			</blockquote>

		</div>

		<?php
	}
} // End if().


// display chosen jetpack testimonials for current page
if ( ! function_exists( 'dmc_show_page_testimonials' ) ) {
	function dmc_show_page_testimonials() {

		$dmc_post_id = get_the_ID();

		if ( have_rows( 'dmc_testimonials_display', $dmc_post_id ) ) :

			while ( have_rows( 'dmc_testimonials_display', $dmc_post_id ) ) :
				the_row();

				$post_object = get_sub_field( 'dmc_testimonial' );
				if ( $post_object ) :

					$dmc_testimonial_id = $post_object->ID;

					// override $post
					$post = $post_object;
					setup_postdata( $post );

					$postcontent = apply_filters( 'the_content', $post_object->post_content );
					?>
					<div class="testimonial">
						<?php
						echo get_the_post_thumbnail( $dmc_testimonial_id, 'thumbnail', array( 'class' => 'alignright' ) );
						?>
						<blockquote>
							<?php echo $postcontent; ?>
						</blockquote>
						<h4>
							<span class="author">
								<?php echo esc_html( get_the_title( $dmc_testimonial_id ) ); ?>
								<span class="position">
									<?php the_field( 'dmc_position', $dmc_testimonial_id ); ?>, 
									<?php the_field( 'dmc_company', $dmc_testimonial_id ); ?>
								</span>
							</span>
						</h4>
					</div>
					<?php
				endif;
				wp_reset_postdata();

			endwhile;
		endif;
	}
}// End if().
