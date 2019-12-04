<?php
function dmc_display_content_type_cards( $post_type_name ) {
	$display_cards = new WP_Query(
		array(
			'post_type'      => $post_type_name,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'posts_per_page' => 3,
		)
	);

	if ( $display_cards->have_posts() ) :
		$post_type_obj = get_post_type_object( $post_type_name );

		if ( 'post' === $post_type_name ) {
			$archive_url = 'articles';
		} else {
			$archive_url = $post_type_obj->rewrite['slug'];
		}
		?>

		<ul class="flex-row dmc-max-four cards latest">

			<li class="card-new <?php echo esc_attr( $post_type_name ); ?> description">
				<div class="card-img"></div>
				<div class="entry-meta">
					<h1>
						<a href="/<?php echo esc_attr( $archive_url ); ?>">
							<?php
							// using labels as 'Posts' has been renamed to "Articles'
							$post_type_label = get_post_type_object( $post_type_name );
							echo esc_html( $post_type_label->labels->name );
							?>
						</a>
					</h1>
					<p>
						<?php dmc_content_type_description( $post_type_name ); ?>
					</p>

					<span class="button small">
						<?php dmc_display_content_type_cta( $post_type_name ); ?>
					</span>
				</div>
			</li>

			<?php
			while ( $display_cards->have_posts() ) :
				$display_cards->the_post();

				set_query_var( 'post_type_name', $post_type_name );
				get_template_part( 'content', 'card' );

			endwhile;
			?>
		</ul>
		<?php
	endif;
	wp_reset_postdata();
}


function dmc_display_content_type_cta( $post_type_name ) {
	switch ( $post_type_name ) {
		case 'dmc-event':
			echo 'Book ';
			break;
		case 'dmc-course':
			echo 'Read ';
			break;
		case 'dmc-video':
			echo 'Watch ';
			break;
		case 'dmc-article':
			echo 'Read ';
			break;
		case 'dmc-factsheet':
			echo 'Read ';
			break;
		case 'dmc-presentation':
			echo 'Watch ';
			break;
		default:
			echo 'Read ';
	}
}


function dmc_display_featured_single_card() {
	global $post;
	if ( have_rows( 'dmc_featured_single' ) ) :
		?>

		<section class="featured-content">
			<div class="flex-row cards featured-item">
				<h2 class="section-heading">
					Upcoming events:
				</h2>
				<?php
				while ( have_rows( 'dmc_featured_single' ) ) :
					the_row();

					$dmc_featured_content_item = get_sub_field( 'dmc_featured_content_item' );

					if ( $dmc_featured_content_item ) :
						$post = $dmc_featured_content_item;

						setup_postdata( $post );
						$post_type_name = $post[0]->post_type;

						// make these variables available to the template part
						set_query_var( 'post_type_name', $post_type_name );

						get_template_part( 'content', 'dmc-featured-single' );

						wp_reset_postdata();
					endif;

				endwhile;
				?>
			</div>
		</section>

		<?php
	endif;
}


function dmc_display_featured_cards() {
	global $post;
	if ( have_rows( 'dmc_featured_content' ) ) :
		?>

		<section class="featured-content multiple">
			<h2 class="section-heading">
				Featured Content:
			</h2>
			<div class="flex-row dmc-max-three cards featured-items">

				<?php
				while ( have_rows( 'dmc_featured_content' ) ) :
					the_row();

					$dmc_featured_content_item = get_sub_field( 'dmc_featured_content_item' );
					if ( $dmc_featured_content_item ) :
						foreach ( $dmc_featured_content_item as $post ) :

							setup_postdata( $post );
							$post_type_name = $post->post_type;

							// make these variables available to the template part
							set_query_var( 'post_type_name', $post_type_name );

							get_template_part( 'content', 'card' );
						endforeach;
						wp_reset_postdata();
					endif;

				endwhile;
				?>

			</div>
		</section>

		<?php
	endif;
}


function dmc_display_featured_products() {
	global $post;
	if ( have_rows( 'dmc_featured_content' ) ) :
		?>

			<div class="dmc-max-three cards">

				<?php
				while ( have_rows( 'dmc_featured_content' ) ) :
					the_row();

					$dmc_featured_content_item = get_sub_field( 'dmc_featured_content_item' );
					if ( $dmc_featured_content_item ) :
						foreach ( $dmc_featured_content_item as $post ) :

							setup_postdata( $post );
							wc_get_template_part( 'content', 'product' );

						endforeach;
						wp_reset_postdata();
					endif;

				endwhile;
				?>

			</div>

		<?php
	endif;
}


function dmc_display_featured_cards_by_term() {
	global $post;
	if ( have_rows( 'dmc_featured_content_term' ) ) :
		while ( have_rows( 'dmc_featured_content_term' ) ) :
			the_row();
			?>

			<section class="featured-content cards-by-taxonomy">

				<?php dmc_display_term_heading(); ?>

				<div class="flex-row dmc-max-three cards featured-items">
					<?php
					if ( get_sub_field( 'dmc_manually_feature_content' ) == 1 ) {
						// echo 'true';
					} else {
						// echo 'false';
					}

					$dmc_featured_content_item = get_sub_field( 'dmc_featured_content_item' );
					if ( $dmc_featured_content_item ) :
						foreach ( $dmc_featured_content_item as $post ) :

							setup_postdata( $post );

							$post_type_name = $post->post_type;

							$obj             = get_post_type_object( $post_type_name );
							$post_type_label = $obj->labels->singular_name;

							// make these variables available to the template part
							set_query_var( 'post_type_name', $post_type_name );
							set_query_var( 'post_type_label', $post_type_label );

							get_template_part( 'content', 'card-by-term' );
						endforeach;
						wp_reset_postdata();
					endif;
					?>
				</div>

			</section>

			<?php
		endwhile;
	endif;
}


function dmc_display_term_heading() {
	$dmc_which_term_ids = get_sub_field( 'dmc_which_term' );

	$term      = get_term( $dmc_which_term_ids );
	$term_link = get_term_link( $dmc_which_term_ids );

	if ( ! is_wp_error( $term_link ) && ! empty( $term_link ) ) {
		ob_start();
		?>
		<div class="term-heading">
			<h2>
				<a href="<?php echo esc_url( $term_link ); ?>">
					<?php echo esc_attr( $term->name ); ?>
				</a>
			</h2>
			<p>
				<a href="<?php echo esc_url( $term_link ); ?>" class="more-link">
					More from <?php echo esc_attr( $term->name ); ?>
				</a>
			</p>
			<?php
			$output = ob_get_clean();
			echo $output;
			?>
		</div>
		<?php
	}
}


function dmc_display_featured_cards_term_archive() {

	global $post;
	$term = get_queried_object();
	$dmc_featured_content_items = get_field( 'dmc_featured_content_term_archive', $term );

	if ( $dmc_featured_content_items ) : ?>

		<section class="featured-archive-content cards-by-taxonomy">
			<div class="flex-row dmc-max-three cards featured-items hide-last-name">

				<?php
				foreach ( $dmc_featured_content_items as $post ) :

					setup_postdata( $post );					

					$post_type_name = $post->post_type;

					$obj             = get_post_type_object( $post_type_name );
					$post_type_label = $obj->labels->singular_name;

					// make these variables available to the template part
					set_query_var( 'post_type_name', $post_type_name );
					set_query_var( 'post_type_label', $post_type_label );

					get_template_part( 'content', 'card-by-term' );

				endforeach;
				wp_reset_postdata();
				?>

			</div>
		</section>

		<?php
	endif;

}
