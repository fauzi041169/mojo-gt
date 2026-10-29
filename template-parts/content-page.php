<?php
/**
 * Template part for displaying page content in page.php
 * Seamless full-width layout without card wrapping or forced title headers
 *
 * @package Mojo_Bootstrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-entry' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail mb-4 overflow-hidden rounded-3">
            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid w-100 shadow-sm' ) ); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content lh-lg text-secondary fs-6">
        <?php
        the_content();

        wp_link_pages( array(
            'before'      => '<div class="page-links mt-4 pt-3 border-top"><span class="page-links-title me-2 fw-semibold">' . esc_html__( 'Pages:', 'mojo-bootstrap' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span class="badge bg-danger me-1">',
            'link_after'  => '</span>',
        ) );
        ?>
    </div>
</article>
