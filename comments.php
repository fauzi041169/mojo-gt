<?php
/**
 * Comments template
 *
 * @package Mojo_Bootstrap
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area bg-white p-4 p-md-5 rounded shadow-sm border mb-4">
    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title h4 fw-bold mb-4 border-bottom pb-2">
            <?php
            $mojo_comment_count = get_comments_number();
            if ( '1' === $mojo_comment_count ) {
                printf(
                    /* translators: 1: title. */
                    esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'mojo-bootstrap' ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: comment count number, 2: title. */
                    esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $mojo_comment_count, 'comments title', 'mojo-bootstrap' ) ),
                    number_format_i18n( $mojo_comment_count ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h3>

        <ol class="comment-list list-unstyled mb-4">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
                'callback'    => function( $comment, $args, $depth ) {
                    ?>
                    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'card mb-3 border-0 bg-light p-3' ); ?>>
                        <article class="comment-body">
                            <div class="comment-meta d-flex align-items-center gap-3 mb-2">
                                <?php echo get_avatar( $comment, 48, '', '', array( 'class' => 'rounded-circle' ) ); ?>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?php comment_author_link(); ?></h6>
                                    <div class="small text-muted">
                                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="text-decoration-none text-muted">
                                            <time datetime="<?php comment_time( 'c' ); ?>">
                                                <?php printf( esc_html__( '%1$s at %2$s', 'mojo-bootstrap' ), get_comment_date(), get_comment_time() ); ?>
                                            </time>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="comment-content text-secondary">
                                <?php comment_text(); ?>
                            </div>

                            <div class="reply mt-2">
                                <?php
                                comment_reply_link( array_merge( $args, array(
                                    'add_below' => 'comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'reply_text'=> __( 'Reply &rarr;', 'mojo-bootstrap' ),
                                    'reply_class' => 'btn btn-sm btn-outline-primary',
                                ) ) );
                                ?>
                            </div>
                        </article>
                    <?php
                },
            ) );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments alert alert-secondary mb-0"><?php esc_html_e( 'Comments are closed.', 'mojo-bootstrap' ); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields = array(
        'author' => '<div class="row g-3 mb-3"><div class="col-md-6"><label for="author" class="form-label">' . esc_html__( 'Name', 'mojo-bootstrap' ) . ( $req ? ' <span class="text-danger">*</span>' : '' ) . '</label><input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="col-md-6"><label for="email" class="form-label">' . esc_html__( 'Email', 'mojo-bootstrap' ) . ( $req ? ' <span class="text-danger">*</span>' : '' ) . '</label><input id="email" name="email" type="email" class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
        'url'    => '<div class="mb-3"><label for="url" class="form-label">' . esc_html__( 'Website', 'mojo-bootstrap' ) . '</label><input id="url" name="url" type="url" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );

    comment_form( array(
        'fields'        => $fields,
        'comment_field' => '<div class="mb-3"><label for="comment" class="form-label">' . esc_html__( 'Comment', 'mojo-bootstrap' ) . ' <span class="text-danger">*</span></label><textarea id="comment" name="comment" class="form-control" rows="5" required></textarea></div>',
        'class_submit'  => 'btn btn-primary px-4',
        'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        'title_reply'   => esc_html__( 'Leave a Comment', 'mojo-bootstrap' ),
        'title_reply_to'=> esc_html__( 'Leave a Reply to %s', 'mojo-bootstrap' ),
    ) );
    ?>
</div>
