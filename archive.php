<?php
/**
 * Archive template
 *
 * @package Mojo_Bootstrap
 */

get_header();
?>

<div class="container">
    <header class="archive-header bg-light p-4 rounded mb-4 shadow-sm border">
        <?php
        the_archive_title( '<h1 class="archive-title fw-bold h3 mb-2">', '</h1>' );
        the_archive_description( '<div class="archive-description text-muted mb-0">', '</div>' );
        ?>
    </header>

    <div class="row">
        <div class="col-lg-8">
            <?php if ( have_posts() ) : ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
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
