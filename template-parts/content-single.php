<?php
/**
 * Template part for displaying single post content
 *
 * @package Mojo_Bootstrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post bg-white p-4 p-md-5 rounded shadow-sm border mb-4' ); ?>>
    <header class="entry-header mb-4">
        <div class="entry-meta text-muted small mb-2 d-flex flex-wrap align-items-center gap-2">
            <span><?php esc_html_e( 'Published:', 'mojo-bootstrap' ); ?> <?php echo esc_html( get_the_date() ); ?></span>
            <span>&bull;</span>
            <span><?php esc_html_e( 'By', 'mojo-bootstrap' ); ?> <?php the_author_posts_link(); ?></span>
            <?php if ( has_category() ) : ?>
                <span>&bull;</span>
                <span><?php the_category( ', ' ); ?></span>
            <?php endif; ?>
        </div>

        <h1 class="entry-title display-6 fw-bold mb-3"><?php the_title(); ?></h1>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-featured-image mb-4">
            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid rounded w-100 shadow-sm' ) ); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content mb-4 lh-lg">
        <?php
        the_content();

        wp_link_pages( array(
            'before'      => '<div class="page-links mt-4 pt-3 border-top"><span class="page-links-title me-2 fw-semibold">' . esc_html__( 'Pages:', 'mojo-bootstrap' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span class="badge bg-primary me-1">',
            'link_after'  => '</span>',
        ) );
        ?>
    </div>

    <footer class="entry-footer border-top pt-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <?php if ( has_tag() ) : ?>
            <div class="tags-links">
                <span class="fw-semibold me-2"><?php esc_html_e( 'Tags:', 'mojo-bootstrap' ); ?></span>
                <?php the_tags( '<span class="badge bg-light text-dark border me-1">', '</span> <span class="badge bg-light text-dark border me-1">', '</span>' ); ?>
            </div>
        <?php endif; ?>
    </footer>
</article>

<!-- Author Box -->
<div class="author-bio card border-0 shadow-sm mb-4 p-3 bg-light">
    <div class="d-flex align-items-center gap-3">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 64, '', '', array( 'class' => 'rounded-circle shadow-sm' ) ); ?>
        <div>
            <h6 class="mb-1 fw-bold"><?php the_author(); ?></h6>
            <p class="small text-muted mb-0"><?php echo esc_html( get_the_author_meta( 'description' ) ? get_the_author_meta( 'description' ) : __( 'Author at ' . get_bloginfo( 'name' ), 'mojo-bootstrap' ) ); ?></p>
        </div>
    </div>
</div>
