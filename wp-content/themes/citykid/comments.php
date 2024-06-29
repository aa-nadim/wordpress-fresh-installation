<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Citykid
 * @since Citykid 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$citykid_comment_count = get_comments_number();
?>

<div id="comments" class="comments-area d-grid gap-30 <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">

	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php if ( '1' === $citykid_comment_count ) : ?>
				<?php printf(esc_html__( '1 comment on "%s"', 'citykid' ), get_the_title()); ?>
			<?php else : ?>
				<?php
				printf(
					/* translators: %s: Comment count number. */
					esc_html( _nx( '%s comment on "%s"', '%s comments on "%s"', $citykid_comment_count, 'Comments title', 'citykid' ) ),
					esc_html( number_format_i18n( $citykid_comment_count ) ),
					get_the_title()
				);
				?>
			<?php endif; ?>
		</h2><!-- .comments-title -->

		<ol class="comment-list list-unstyled overflow-hidden">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 80,
					'style'       => 'ol',
					'short_ping'  => true,
					'depth' => 3,
					'walker' => new Citykid\Comment_Walker()
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_pagination(
			array(
				'before_page_number' => esc_html__( 'Page', 'citykid' ) . ' ',
				'mid_size'           => 0,
				'prev_text'          => sprintf(
					'<span class="nav-prev-text">previous</span>'
				),
				'next_text'          => sprintf(
					'<span class="nav-next-text">next</span>'
				),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'citykid' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply'        => esc_html__( 'Leave a comment', 'citykid' ),
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h3>',
			'class_container' => 'comment-respond card',
			'submit_field'         => '<p class="form-submit mb-0">%1$s %2$s</p>',
		)
	);
	?>

</div><!-- #comments -->
