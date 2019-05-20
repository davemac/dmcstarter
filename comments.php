<?php
defined( 'ABSPATH' ) || die( esc_html_e( 'Please do not load this page directly. Thanks!', 'dmcstarter' ) );
?>

<?php
// callback to modify comments layout
function dmc_format_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<article>
			<section class="comment-author">
				<?php
				echo get_avatar( $comment, $size = '48' );
				?>
			</section>

			<section class="comment-body">

				<div class="author-meta">
					<?php printf( __( '<cite class="fn">%s</cite>', 'dmcstarter' ), get_comment_author_link() ); ?>
					<time datetime="<?php echo comment_date( 'c' ); ?>">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php printf( __( '%1$s' ), get_comment_date(), get_comment_time() ); ?>
						</a>
					</time>
					<?php edit_comment_link( __( '(Edit)', 'dmcstarter' ), '', '' ); ?>
				</div>

				<?php
				if ( '0' === $comment->comment_approved ) :
					?>
					<div class="notice">
						<p>
							<?php esc_html_e( 'Your comment is awaiting moderation.', 'dmcstarter' ); ?>
						</p>
					</div>
					<?php
				endif;

				comment_text();
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						)
					)
				);
	?>
			</section>
		</article>
	<?php
}
?>

<section id="comments" class="comments-area">

<?php
if ( have_comments() ) :

	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() ) {
		return;
	}
	?>

	<h4 class="comments-title">
		<?php
		$comments_number = get_comments_number();
		if ( '1' === $comments_number ) {
			/* translators: %s: post title */
			printf( _x( 'One Response to &ldquo;%s&rdquo;', 'comments title', 'dmcstarter' ), get_the_title() );
		} else {
			printf(
				/* translators: 1: number of comments, 2: post title */
				_nx(
					'%1$s Responses to &ldquo;%2$s&rdquo;',
					'%1$s Responses to &ldquo;%2$s&rdquo;',
					$comments_number,
					'comments title',
					'dmcstarter'
				),
				number_format_i18n( $comments_number ),
				get_the_title()
			);
		}
		?>
	</h4>

	<ol class="comment-list">
		<?php
		wp_list_comments(
			array(
				'type'        => 'comment',
				'avatar_size' => 48,
				'style'       => 'ol',
				'short_ping'  => true,
				'callback'    => 'dmc_format_comments',
			)
		);
		?>
	</ol>

	<?php
	the_comments_pagination();

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments">
			<?php esc_html_e( 'Comments are closed.', 'dmcstarter' ); ?>
		</p>
		<?php
	endif;

endif;

if ( comments_open() ) {

	$comments_args = array(
		'label_submit' => 'Make a Comment',
		'class_submit' => 'small radius button',
	);

	comment_form( $comments_args );
}
?>

</section>
