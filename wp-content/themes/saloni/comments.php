<?php
/**
 * The template for displaying comments
 *
 * @package Saloni
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area m-t30">
    <?php if (have_comments()): ?>
        <h4 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(esc_html__('1 Comment', 'saloni'));
            } else {
                printf(
                    esc_html(_n('%s Comment', '%s Comments', $comments_number, 'saloni')),
                    number_format_i18n($comments_number)
                );
            }
            ?>
        </h4>

        <ol class="comment-list p-a30 bg-gray">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'callback' => 'saloni_comment_callback',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

    endif;
    ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')):
        ?>
        <p class="no-comments">
            <?php esc_html_e('Comments are closed.', 'saloni'); ?>
        </p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply' => esc_html__('Leave a Reply', 'saloni'),
        'title_reply_to' => esc_html__('Leave a Reply to %s', 'saloni'),
        'cancel_reply_link' => esc_html__('Cancel Reply', 'saloni'),
        'label_submit' => esc_html__('Post Comment', 'saloni'),
        'class_submit' => 'site-button site-btn-effect',
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'saloni') . '</label><textarea id="comment" name="comment" class="form-control" rows="5" required></textarea></p>',
        'fields' => array(
            'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Name', 'saloni') . '</label><input id="author" name="author" type="text" class="form-control" required /></p>',
            'email' => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'saloni') . '</label><input id="email" name="email" type="email" class="form-control" required /></p>',
            'url' => '<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'saloni') . '</label><input id="url" name="url" type="url" class="form-control" /></p>',
        ),
    ));
    ?>
</div>