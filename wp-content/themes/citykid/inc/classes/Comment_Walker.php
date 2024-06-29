<?php
namespace Citykid;
class Comment_Walker extends \Walker_Comment {

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {

		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = esc_attr__( 'Your comment is awaiting moderation.', 'citykid' );
		} else {
			$moderation_note = esc_attr__( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'citykid' );
		}
		?>
		<<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>

			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body mb-30" data-id="<?php comment_ID(); ?>">
				<div class="comment-author vcard d-flex align-items-center gap-15">
					<?php
					if ( 0 != $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'], NULL, NULL, ['class' => 'rounded-circle'] );
					}
					?>						
				
				<!-- <div class="w-100"> -->
					<div class="comment-meta d-lg-flex align-items-start gap-10 mb-10">
						

						<div class="comment-metadata d-grid">
							<?php
							$comment_author = get_comment_author_link( $comment );

							if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
								$comment_author = get_comment_author( $comment );
							}

							printf(
								/* translators: %s: Comment author link. */
								'<span class="author-name">%s <span class="says">%s</span></span>',
								sprintf( '<b class="fn">%s</b>', $comment_author ),
								esc_attr__('says:', 'citykid')
							);
							?>
							<?php
							printf(
								'<a href="%s"><time datetime="%s">%s</time></a>',
								esc_url( get_comment_link( $comment, $args ) ),
								get_comment_time( 'c' ),
								sprintf(
									/* translators: 1: Comment date, 2: Comment time. */
									esc_attr__( '%1$s at %2$s', 'citykid' ),
									get_comment_date( '', $comment ),
									get_comment_time()
								)
							);
							
							?>
							
						</div><!-- .comment-metadata -->
						

						<div class="ms-lg-auto d-flex gap-15">
							<?php                  
							$edit_text = __( 'Edit', 'citykid' );
							if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) {
								edit_comment_link( $edit_text, ' <span class="edit-link">', '</span>' );
							}                      
							if ( '1' == $comment->comment_approved || $show_pending_links ) {
								comment_reply_link(
									array_merge(
										$args,
										array(
											'add_below' => 'div-comment',
											'depth'     => $depth,
											'max_depth' => $args['max_depth'],
											'before'    => '<div class="reply">',
											'after'     => '</div>',
										)
									)
								);
							}
							?>
						<!-- </div> -->
						</div><!-- .comment-meta -->
					</div><!-- .comment-author -->

					
				</div>

				<div class="comment-content">
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="review-awaiting-moderation comment-awaiting-moderation"><?php echo wp_kses_post($moderation_note); ?></em>
					<?php endif; ?> 
					<?php comment_text(); ?>     
								
				</div><!-- .comment-content -->
				
			</div><!-- .comment-body -->
		<?php
	}
}