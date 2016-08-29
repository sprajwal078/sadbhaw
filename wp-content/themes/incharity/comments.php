<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package incharity
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
$comment_count = get_comment_count(get_the_ID());
$totalComment = $comment_count['total_comments'];
?>
<div id="comments" class="comments">
    <div class="comments-content">
        
        <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
            ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'incharity'); ?></p>
        <?php endif; ?>
        <div class="form-comment">

            <?php
            $req      = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );
            $html_req = ( $req ? " required='required'" : '' );

            $required_text = sprintf( ' ' . esc_html__('Required fields are marked %s','incharity'), '<span class="required">*</span>' );
            comment_form(array(

                $fields = array(
                    'author' => '<div class="row"><div class="col-md-4 col-sm-12 col-xs-12 commentFormField"><input id="author" class="input-text" name="author" placeholder="' . esc_html__('Name*', 'incharity') . '" type="text" value="" size="30" /></div>',
                    'email' => '<div class="col-md-4 col-sm-12 col-xs-12 commentFormField"><input id="email" class="input-text" name="email" placeholder="' . esc_html__('Email*', 'incharity') . '" type="email" value="" size="30" /></div>',
                    'url' => '<div class="col-md-4 col-sm-12 col-xs-12 commentFormField"><input id="url" class="input-text" name="url" placeholder="' . esc_html__('Website', 'incharity') . '" type="url" value="" size="30" /></div></div>',
                ),
                'fields' => apply_filters('comment_form_default_fields', $fields),
                'comment_field' => '<div class="row"><div class="col-xs-12 commentFormField"><textarea id="comment" class="control" placeholder="' . _x('Comment*', 'noun','incharity') . '" name="comment" cols="45" rows="4" aria-required="true"></textarea></div></div>',
                'class_submit' => 'btn-submit button',
                'comment_notes_before' => '<p class="blog-comment-notes"><span id="email-notes">' . esc_html__( 'Your email address will not be published.','incharity' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
                'comment_notes_after' => '',
            )); ?>
        </div>
		
		
		<?php if (have_comments()) : ?>
            <div class="commentList">
                <div class="comments-title">
                    <h5><?php printf(_n('%s review', '%s reviews', $totalComment, 'incharity'), $totalComment); ?></h5>
                </div>
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                    <nav id="comment-nav-above" class="comment-navigation" role="navigation">
                        <div
                            class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'incharity')); ?></div>
                        <div
                            class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'incharity')); ?></div>
                    </nav><!-- #comment-nav-above -->
                <?php endif; // check for comment navigation ?>
                <ul class="comment_list">
                    <?php
                    wp_list_comments(array(
                        'callback' => 'inwave_comment',
                        'short_ping' => true,
                    ));
                    ?>
                </ul>
                <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
                    <nav id="comment-nav-bellow" class="comment-navigation" role="navigation">
                        <div
                            class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'incharity')); ?></div>
                        <div
                            class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'incharity')); ?></div>
                    </nav><!-- #comment-nav-below -->
                <?php endif; // check for comment navigation ?>

            </div>
        <?php endif; // have_comments() ?>
		
		
	<div class="clear"></div>	
    </div>
    <!-- #comments -->
</div><!-- #comments -->
