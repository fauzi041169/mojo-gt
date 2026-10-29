<?php
/**
 * Search results page
 *
 * @package Mojo_Bootstrap
 */

get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <header class="page-header bg-light p-4 rounded shadow-sm border mb-4">
                <h1 class="page-title h4 mb-1">
                    <?php
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'mojo-bootstrap' ), '<span class="text-primary">&ldquo;' . esc_html( get_search_query() ) . '&rdquo;</span>' );
                    ?>
                </h1>
                <p class="text-muted small mb-0">
                    <?php
                    global $wp_query;
                    printf(
                        /* translators: %d: number of results. */
                        esc_html( _n( 'Found %d result', 'Found %d results', (int) $wp_query->found_posts, 'mojo-bootstrap' ) ),
                        (int) $wp_query->found_posts
                    );
                    ?>
                </p>
            </header>

            <?php if ( have_posts() ) : ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', get_post_type() );
                    endwhile;
                    ?>
                </div>

                <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                    <?php mojo_bootstrap_pagination(); ?>
                </div>
            <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                <aside class="sidebar-widget-area">
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
