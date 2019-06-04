<?php

// display post type label for different templates
function dmc_display_post_type_label() {

	$post      = get_queried_object();
	$post_type = get_post_type_object( get_post_type( $post ) );

	// is this a taxonomy term template?
	$current_tax = get_query_var( 'taxonomy' );
	if ( $current_tax ) {
		$tax_object = get_taxonomy( $current_tax );
		// just get the first associated post type
		$post_type_array = $tax_object->object_type[0];
		// get the post type object, so we can get post type name for display
		$post_object    = get_post_type_object( $post_type_array );
		$post_type_name = $post_object->label;
	}

	// is this a post type template?
	if ( $post_type ) {

		$post_type_label = '';
		if ( is_home() || is_singular( 'post' ) || is_category() ) :
			$post_type_label = 'News';
		elseif ( is_singular() ) :
			$post_type_label = $post_type->label;

		elseif ( is_post_type_archive() ) :
			$post_type_label = post_type_archive_title( false );

		elseif ( is_author() ) :
			$post_type_label = 'Articles by ';

		elseif ( is_tax() ) :
			$post_type_label = $post_type_name;
		endif;

		ob_start();

		if ( is_category() ) :
			?>
			<span>
				: <?php single_cat_title(); ?>
			</span>
			<?php
		elseif ( is_tax() ) :
			?>
			<span>
				: <?php single_term_title(); ?>
			</span>
			<?php
		elseif ( is_author() ) :
			?>
			<span>
				<?php the_author(); ?>
			</span>
			<?php
		elseif ( is_tag() ) :
			?>
			<span>
				Archive for tag '<?php single_tag_title(); ?>'
			</span>
			<?php
		elseif ( is_date() ) :
			?>
			<span>
				Date Archive for <?php single_month_title( ' ' ); ?>
			</span>
			<?php
		elseif ( is_search() ) :
			?>
			<span>
				<?php esc_html_e( 'Search Results for', 'dmcstarter' ); ?> "<?php echo get_search_query(); ?>"
			</span>
			<?php
	endif;

		$template_type = ob_get_clean();
		echo esc_html( $post_type_label );
		echo $template_type;
	};

}


function dmc_display_post_tax_terms() {
	global $post;
	$taxonomy_name = get_object_taxonomies( $post );
	$post_terms    = wp_get_object_terms( $post->ID, $taxonomy_name[0] );
	$raw_termlist  = '';
	$termlist      = '';
	$separator     = ', ';
	$output        = '';

	if ( ! empty( $post_terms ) ) {
		if ( ! is_wp_error( $post_terms ) ) {
			ob_start();
			?>

			<div class="post-cats">
				<?php
				foreach ( $post_terms as $term ) {
					$raw_termlist .= '<a href="' . esc_url( get_term_link( $term->slug, $taxonomy_name[0] ) ) . '">' . esc_html( $term->name ) . '</a>' . $separator;
				}
				$termlist .= trim( $raw_termlist, $separator );
				echo $termlist;
				?>
			</div>

			<?php
			$output = ob_get_clean();
			echo $output;
		}
	}
}


function dmc_get_post_tax_single_topic() {
	global $post;
	$taxonomy_pull         = get_object_taxonomies( $post );
	if ( $taxonomy_pull ) {
		$current_tax_name_slug = $taxonomy_pull[0];
		$post_terms            = wp_get_object_terms( $post->ID, $current_tax_name_slug );
		$output                = '';
		// $output = $post_terms_test[0]->slug;
		foreach ( $post_terms as $term ) {
			$output .= $term->slug . ' ';
		}
		return $output;
	}
}


function dmc_display_tax_terms_links() {
	global $post;

	$taxonomy = get_object_taxonomies( $post );
	if ( ! empty( $taxonomy ) ) {

		$terms    = get_terms( $taxonomy[0] );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

			ob_start();
			?>

			<ul id="terms-filter">  
				<li class="left hide-for-small-only">
					Categories:
				</li>  
				<?php
				foreach ( $terms as $term ) {
				?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
							<?php echo esc_attr( $term->name ); ?>
						</a>
					</li>
				<?php
				}
				?>
			</ul>

			<?php
		}

	}
}


function dmc_tax_terms_filter() {

	$args      = array(
		'taxonomy' => 'jetpack-portfolio-type',
		'parent'   => 0,
	);
	$tax_terms = get_terms( $args );

	if ( $tax_terms ) {
		?>

		<ul class="inline-list" id="terms-filter">  
			<li class="left hide-for-small-only">
				<strong>
					Filter services by:
				</strong>
			</li>  
			<li>
				<a href="#" class="selected" data-filter="*">All</a>
			</li>

			<?php
			$count = count( $tax_terms );
			if ( $count > 0 ) {

				foreach ( $tax_terms as $tax_term ) {
					$term_slug = $tax_term->slug;
					$term_name = $tax_term->name;
					?>
					<li>
						<a href="#" data-filter="<?php echo esc_url( $term_slug ); ?>">
							<?php echo esc_attr( $term_name ); ?>
						</a>
					</li>
					<?php
				}
			}
			?>
		</ul>
		<?php
	}
}


// return entry meta information for posts, used by multiple loops
function dmcstarter_entry_meta() {

	$output  = '';
	$output .= '<div class="entry-meta">';

	$output .= '<span class="byline author vcard">';

	// if Co-authors Plus plugin is active, get the co-author posts link
	if ( function_exists( 'coauthors_posts_links' ) ) {
		$output .= coauthors_posts_links( ', ', ' & ', 'by ', '', false );
	} else {
		// get WP author posts link
		$output .= 'by ' . get_the_author_posts_link();
	};
	$output .= '</span>';

	$output .= ' on <time class="updated" datetime="' . get_the_time( 'c' ) . '" pubdate>' . sprintf( __( '%s', 'dmcstarter' ), get_the_date(), get_the_date() ) . '</time> ';

	if ( is_single() || is_front_page() || is_post_type_archive( 'post' ) || is_search() ) :

		$output .= dmc_display_post_tax_terms();

		$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
		if ( comments_open() ) {
			if ( '0' === $num_comments ) {
				$comments = __( '<span class="comment-result no-comments">Make a comment</span>' );
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __( ' comments' );
			} else {
				$comments = __( '<span class="comment-result">1 comment</span>' );
			}
			$write_comments = '<a href="' . get_comments_link() . '"><span class="icon small icon-forum"></span> ' . $comments . '</a>';
		} else {
			$write_comments = __( '<span class="comment-result">Comments off</span>' );
		}
		$output .= '<span class="comments comment-results right">' . $write_comments . '</span>';
	endif;

	$output .= '</div>';
	echo $output;
}

// display calendar date for posts
function dmc_display_cal_date() {

	ob_start();
	?>

	<div class="cal-date">
		<time class="updated" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>" pubdate>
			<?php echo esc_html( sprintf( __( '%s', 'dmcstarter' ), get_the_time( 'j' ), get_the_time() ) ); ?>
		</time>

		<span class="date month">
			<?php echo esc_html( get_the_time( 'M' ) ); ?>
		</span>

		<span class="date year">
			<?php echo esc_html( get_the_time( 'Y' ) ); ?>
		</span>
	</div>

	<?php
	$output = ob_get_clean();
	echo $output;

}


//  Add author bio box to posts, accomodates guest authors
//  http://bekarice.com/adding-co-authors-plus-support-theme/
function dmc_user_profile() {

	if ( function_exists( 'coauthors_posts_links' ) ) {

		$output    = '';
		$coauthors = get_coauthors();

		foreach ( $coauthors as $coauthor ) {

			if ( isset( $coauthor->type ) && 'guest-author' === $coauthor->type ) {

				$author_id                 = $coauthor->ID;
				$author_name_first         = $coauthor->first_name;
				$author_name_last          = $coauthor->last_name;
				$author_url                = $coauthor->website;
				$author_email              = $coauthor->user_email;
				$author_bio                = $coauthor->description;
				$dmc_author_twitter_check  = get_field( 'dmc_twitter', $author_id );
				$dmc_author_linkedin_check = get_field( 'dmc_linkedin', $author_id );
				$dmc_author_position       = get_field( 'dmc_position', $author_id );
				$dmc_author_post_links     = coauthors_posts_links( ', ', ' & ', '', '', false );
				$archive_link              = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
				$link_title                = 'Articles by ' . $coauthor->first_name;
				$profile_image             = '';
				$display_profile_image     = coauthors_get_avatar( $coauthor, '130' );

			} else {

				$author_id                 = $coauthor->ID;
				$author_name_first         = get_the_author_meta( 'first_name', $author_id );
				$author_name_last          = get_the_author_meta( 'last_name', $author_id );
				$author_url                = get_the_author_meta( 'user_url', $author_id );
				$author_email              = get_the_author_meta( 'user_email', $author_id );
				$author_bio                = get_the_author_meta( 'description', $author_id );
				$dmc_author_twitter_check  = get_field( 'dmc_twitter', 'user_' . $author_id );
				$dmc_author_linkedin_check = get_field( 'dmc_linkedin', 'user_' . $author_id );
				$dmc_author_position       = get_field( 'dmc_position', 'user_' . $author_id );
				$archive_link              = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
				$link_title                = 'Articles by ' . get_the_author_meta( 'first_name', $author_id );
				$profile_image             = get_field( 'dmc_profile_image', 'user_' . $author_id );
				$display_profile_image     = wp_get_attachment_image( $profile_image, 'thumbnail' );
			}
			?>

				<div class="author-info">
					<div class="media">
						<div class="holder">

							<?php
							if ( $profile_image ) {
								echo $display_profile_image;

							} elseif ( function_exists( 'coauthors_posts_links' ) ) {
								?>
								<a href="<?php echo esc_url( $archive_link ); ?>" class="author-link" title="<?php echo esc_attr( $link_title ); ?>">
									<?php echo $display_profile_image; ?>
								</a>
								<?php
							}
							?>

							<ul class="social__wrap inline-list">
							<?php
							if ( $dmc_author_twitter_check ) :
								?>
								<li class="social__item">
									<a class="social__link--twitter" href="http://twitter.com/<?php echo esc_html( $dmc_author_twitter_check ); ?>" title="View <?php echo esc_html( $author_name_first ); ?>'s Twitter feed">
										<span class="social__link--text">twitter</span>
									</a>
								</li>
								<?php
							endif;

							if ( $dmc_author_linkedin_check ) :
								?>
								<li class="social__item">
									<a class="social__link--linkedin" href="<?php echo esc_url( $dmc_author_linkedin_check ); ?>" title="View <?php echo esc_html( $author_name_first ); ?>'s LinkedIn page">
										<span class="social__link--text">linkedin</span>
									</a>
								</li>
								<?php
							endif;

							if ( $author_email ) :
								?>
								<!-- <li class="link__item">
									<a href="mailto:<?php // echo antispambot( $author_email ); ?>">
										<?php // echo antispambot( $author_email ); ?>
									</a>
								</li> -->
								<?php
							endif;

							if ( $author_url ) :
								?>
								<li class="link__item">
									<a href="mailto:<?php echo esc_url( $author_url ); ?>">
										<?php echo esc_html( $author_name_first ); ?>'s website
									</a>
								</li>
								<?php
							endif;
							?>
							</ul>

						</div>

						<div class="media-body">
							<h5>
								<?php echo esc_html( $author_name_first ); ?> <?php echo esc_html( $author_name_last ); ?>
							</h5>

							<h6>
								<?php echo esc_html( $dmc_author_position ); ?> 
							</h6>

							<p>
								<?php echo esc_html( $author_bio ); ?>
							</p>

							<a href="<?php echo esc_url( $archive_link ); ?>" title="<?php esc_attr( $link_title ); ?>">
								<?php echo esc_html( $link_title ); ?>
							</a>
						</div>
					</div>
				</div>

			<?php

		} // End foreach().
	} // End if().

}


function dmc_display_image_with_caption() {
	?>
	<div class="wp-caption">
	<?php
		the_post_thumbnail(
			'large', array(
				'class' => 'img-featured',
			)
		);
		$get_description = get_post( get_post_thumbnail_id() )->post_excerpt;
	if ( ! empty( $get_description ) ) {
		echo '<p class="wp-caption-text">' . esc_attr( $get_description ) . '</p>';
	}
	?>
	</div>
	<?php
}


//  smaller user profile box
function dmc_user_profile_small() {

	$output = '';
	if ( function_exists( 'coauthors_posts_links' ) ) {

		$coauthors = get_coauthors();
		foreach ( $coauthors as $coauthor ) {

			if ( isset( $coauthor->type ) && 'guest-author' == $coauthor->type ) {
				$author_id                 = $coauthor->ID;
				$author_name               = $coauthor->first_name;
				$author_url                = $coauthor->website;
				$author_email              = $coauthor->user_email;
				$author_bio                = $coauthor->description;
				$dmc_author_post_links     = coauthors_posts_links( ', ', ' & ', '', '', false );
				$archive_link              = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
				$link_title                = 'Articles by ' . $coauthor->first_name;
				$profile_image             = '';
				$dmc_author_linkedin_check = get_field( 'dmc_linkedin', $author_id );
			} else {
				$author_id                 = get_the_author_meta( 'ID' );
				$author_name               = get_the_author_meta( 'first_name' );
				$author_url                = get_the_author_meta( 'user_url' );
				$author_email              = get_the_author_meta( 'user_email' );
				$author_bio                = get_the_author_meta( 'description' );
				$dmc_author_post_links     = get_the_author_posts_link();
				$archive_link              = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$link_title                = 'Articles by ' . get_the_author_meta( 'first_name' );
				$profile_image             = get_field( 'dmc_profile_image', 'user_' . $author_id );
				$dmc_author_linkedin_check = get_field( 'dmc_linkedin', 'user_' . $author_id );
			}

				$output  = '';
				$output .= '<div class="entry-meta">';
				$output .= '<div class="byline author vcard">';

			if ( $profile_image ) {
				$output .= wp_get_attachment_image( $profile_image, 'thumbnail' );
				// else check for guest-author image
			} elseif ( function_exists( 'coauthors_posts_links' ) ) {
				$output .= '<a href="' . esc_url( $archive_link ) . '" class="author-profile-image" title="' . esc_attr( $link_title ) . '">' . coauthors_get_avatar( $coauthor, 'thumbnail' ) . '</a>';
			}

				$output .= '<div class="holder">';
				$output .= $dmc_author_post_links;

				$output .= '<time class="updated" datetime="' . get_the_time( 'c' ) . '" pubdate>' . sprintf( __( '%s', 'dmcstarter' ), get_the_date(), get_the_date() ) . '</time> ';

			if ( $dmc_author_linkedin_check ) {
				$output .= '<span class="social__item"><a class="social__link--linkedin" href="' . $dmc_author_linkedin_check . '" title="View ' . $author_name . 's LinkedIn profile"><span class="social__link--text">twitter</span></a></span>';
			}

				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';

		}// End foreach().
	}// End if().
	echo $output;
}


//  Show staff social media links & icons
function dmc_show_staff_socials() {

	$dmc_staff_linkedin_check = get_field( 'dmc_linkedin_url' );
	$dmc_staff_twitter_check  = get_field( 'dmc_twitter_url' );
	$dmc_staff_facebook_check = get_field( 'dmc_facebook_url' );

	ob_start();

	if ( $dmc_staff_linkedin_check ) {
		?>

		<div class="flex-item social__item">
			<a class="social__link--linkedin" href="<?php echo $dmc_staff_linkedin_check; ?>" title="View 	<?php echo get_the_title(); ?>'s LinkedIn profile">
				<span class="social__link--text">LinkedIn</span>
			</a>
		</div>

		<?php
	};

	if ( $dmc_staff_twitter_check ) {
		?>

		<div class="flex-item social__item">
			<a class="social__link--twitter" href="<?php echo $dmc_staff_twitter_check; ?>" title="View 	<?php echo get_the_title(); ?>'s Twitter profile">
				<span class="social__link--text">Twitter</span>
			</a>
		</div>

		<?php
	};

	if ( $dmc_staff_facebook_check ) {
		?>

		<div class="flex-item social__item">
			<a class="social__link--facebook" href="<?php echo $dmc_staff_facebook_check; ?>" title="View 	<?php echo get_the_title(); ?>'s Facebook page">
				<span class="social__link--text">Facebook</span>
			</a>
		</div>

		<?php
	};

	$output = ob_get_clean();
	return $output;

}


// display nicely formatted course dates
function dmc_display_nice_course_dates() {

	// get the course start and end date
	$dmc_cal_start_date = get_sub_field( 'dmc_start_date_time' );

	// Create PHP DateTime object from Date/Time Picker Value
	// expects the value to be saved in the format Y-m-d
	$format_in          = 'Y-m-d H:i';
	$display_format_out = 'j F Y';

	$display_start_date = DateTime::createFromFormat( $format_in, $dmc_cal_start_date );
	echo $display_start_date->format( $display_format_out );

}


/**
	* Shortcode to insert ACF dmc_pullquotes repeater field content from current post.
	*
	* @param array $atts  chooses row to use in the dmc_pullquotes repeater
	* @param string $content  null
	*
	* @return string  the pullquote content wrapped in a container class
	*/
function dmc_acf_pullquote_shortcode( $atts, $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'row' => '1',
		),
		$atts,
		'pullquote'
	);

	if ( isset( $atts['row'] ) ) {
		// user's row index count starts at 1, not 0
		$dmc_row = ( $atts['row'] - 1 );
	} else {
		// if no row attribute, set it to 1
		$dmc_row = 1;
	}

	// get all the pullquotes repeater fields for the page
	$rows = get_field( 'dmc_pullquotes' );
	// get the chosen pullquote repeater row

	$pullquote = $rows[ $dmc_row ];

	// get field values from the chosen repeater row
	$pullquote_image       = $pullquote['pullquote_image'];
	$pullquote_content     = $pullquote['pullquote_content'];
	$pullquote_attribution = $pullquote['pullquote_attribution'];

	ob_start();
	?>

	<div class="pullquote media">

		<?php if ( $pullquote_image ) { ?>
			<div class="bdrh">
				<img class="media-figure" src="<?php echo $pullquote_image['url']; ?>" alt="<?php echo $pullquote_image['alt']; ?>" />
			</div>
			<?php
};
?>

		<div class="media-body">
			<p><?php echo wp_kses_post( $pullquote_content ); ?></p>
		</div>
	</div>

	<?php
	$output = ob_get_clean();

	return $output;
}
add_shortcode( 'pullquote', 'dmc_acf_pullquote_shortcode' );
