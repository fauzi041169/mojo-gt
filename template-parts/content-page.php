<?php
/**
 * Template part for displaying page content in page.php
 * Seamless full-width layout without card wrapping
 *
 * @package Mojo_Bootstrap
 */

$content_raw = get_the_content();
$title_clean = trim( strtolower( get_the_title() ) );
$has_title_in_content = false;
if ( preg_match( '/<h[12][^>]*>(.*?)<\/h[12]>/i', $content_raw, $matches ) ) {
    if ( trim( strtolower( strip_tags( $matches[1] ) ) ) === $title_clean ) {
        $has_title_in_content = true;
    }
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-entry' ); ?>>
    <?php if ( ! $has_title_in_content ) : ?>
        <header class="entry-header mb-4 pb-3 border-bottom">
            <h1 class="entry-title fw-bold display-6 text-dark"><?php the_title(); ?></h1>
        </header>
    <?php endif; ?>

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
