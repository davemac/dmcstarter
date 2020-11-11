<?php

// get posts via WP REST API
function dmc_get_posts_via_rest( $url, $count = 2, $imgsize = 'medium' ) {

	$response = wp_remote_get( $url . '/wp-json/wp/v2/posts?per_page=' . $count . '&_embed' );

	if ( is_wp_error( $response ) ) {
		echo 'Error' . $response;
		return;
	}

	$posts = json_decode( wp_remote_retrieve_body( $response ) );

	if ( empty( $posts ) ) :
		return;
	else :
		?>

		<ul class="cards">

		<?php
		foreach ( $posts as $post ) :

			$fetch_content_img = $post->_embedded->{'wp:featuredmedia'}[0]->media_details->sizes->$imgsize->source_url;
			$fallback          = '/wp-content/themes/hisense-2-5/img/placeholder.png';
			$img_url           = $fetch_content_img ? $fetch_content_img : $fallback;
			?>

			<li class="card-new">
				<div class="card-img">
					<img src="<?php echo esc_url( $img_url ); ?>" class="img-card">
				</div>

				<div class="entry-meta">
					<h3>
						<a href="<?php echo $post->link; ?>">
							<?php echo esc_html( $post->title->rendered ); ?>
						</a>
					</h3>

					<?php
					$content = $post->content->rendered;
					if ( $content ) {
						?>
						<p>
							<?php echo esc_html( wp_trim_words( $content, 20 ) ); ?>
						</p>
						<?php
					}
					?>

					<span class="solid-button highlight green">
						Read more
					</span>
				</div>
			</li>

			<?php
		endforeach;
		?>

		</ul>

		<?php
	endif;
}
