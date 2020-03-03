<?php

// content blocks, using ACF flexible content field
function dmc_display_content_blocks() {

	ob_start();

	if ( have_rows( 'dmc_content_blocks' ) ) :
		while ( have_rows( 'dmc_content_blocks' ) ) :
			the_row();

			// if the flexible content field is 'grey_content_block', add a class
			$contentclass = '';
			$contentclass = ( get_row_layout() == 'grey_content_block' ) ? 'alternate' : 'standard';

			if ( get_row_layout() == 'grey_content_block' ) : ?>

				<section class="content text-center <?php echo $contentclass; ?>">
					<div class="row">
						<div class="medium-12 columns">
							<article>
								<div class="entry-content">
									<?php the_sub_field( 'content' ); ?>
								</div>
							</article>
						</div>
					</div>
				</section>

			<?php elseif ( get_row_layout() == 'white_content_block' ) : ?>

				<section class="content text-center <?php echo $contentclass; ?>">
					<div class="row">
						<div class="medium-12 columns">
							<article>
								<div class="entry-content">
									<?php the_sub_field( 'content' ); ?>
								</div>
							</article>
						</div>
					</div>
				</section>

			<?php elseif ( get_row_layout() == 'cards_layout' ) : ?>

				<section class="content text-center alternate">
					<div class="row">
						<div class="medium-12 columns">
							<div class="entry-content">

								<?php if ( have_rows( 'cards' ) ) : ?>
								<div class="masonry-loop">
									<ul class="medium-block-grid-2">

										<?php
										while ( have_rows( 'cards' ) ) :
											the_row();
											?>
										<li class="masonry-entry hanging">
											<div class="card">

												<div class="holder">
													<h3><?php the_sub_field( 'title' ); ?></h3>
													<?php the_sub_field( 'content' ); ?>
												</div>
												<?php if ( get_sub_field( 'image' ) ) { ?>
													<img src="<?php the_sub_field( 'image' ); ?>" class="img-featured" />
												<?php } ?>

											</div>
										</li>
										<?php endwhile; ?>

									</ul>
								</div>
								<?php else : ?>
																		<?php endif; ?>

							</div>
						</div>
					</div>
				</section>

				<?php elseif ( get_row_layout() == 'full_width_image' ) : ?>

					<section class="content text-center image-full">

						<?php $image = get_sub_field( 'image' ); ?>
						<?php if ( $image ) { ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<?php } ?>

					</section>

					<?php
			endif;

		endwhile;
		else :
			// no dmc_content_blocks layouts found
	endif;

		$output = ob_get_clean();

		echo $output;

}

