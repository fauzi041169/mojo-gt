<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Mojo_Bootstrap
 */
?>

<div class="no-results not-found bg-white p-5 rounded shadow-sm border text-center my-4">
    <div class="mb-3 text-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
    </div>

    <h2 class="h3 fw-bold mb-3"><?php esc_html_e( 'Nothing Found', 'mojo-bootstrap' ); ?></h2>

    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
        <p class="text-muted mb-4">
            <?php
            printf(
                wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mojo-bootstrap' ),
                    array( 'a' => array( 'href' => array() ) )
                ),
                esc_url( admin_url( 'post-new.php' ) )
            );
            ?>
        </p>
    <?php elseif ( is_search() ) : ?>
        <p class="text-muted mb-4"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mojo-bootstrap' ); ?></p>
        <div class="col-md-8 mx-auto">
            <?php get_search_form(); ?>
        </div>
    <?php else : ?>
        <p class="text-muted mb-4"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mojo-bootstrap' ); ?></p>
        <div class="col-md-8 mx-auto">
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</div>
