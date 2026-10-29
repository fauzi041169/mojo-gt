<?php
/**
 * Single post template
 *
 * @package Mojo_Bootstrap
 */

get_header();
?>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', 'single' );
                ?>

                <nav class="post-navigation d-flex justify-content-between my-4 p-3 bg-white rounded shadow-sm border">
                    <div class="prev-post text-start">
                        <?php previous_post_link( '<div class="text-muted small">&larr; ' . esc_html__( 'Artikel Sebelumnya', 'mojo-bootstrap' ) . '</div>%link' ); ?>
                    </div>
                    <div class="next-post text-end">
                        <?php next_post_link( '<div class="text-muted small">' . esc_html__( 'Artikel Berikutnya', 'mojo-bootstrap' ) . ' &rarr;</div>%link' ); ?>
                    </div>
                </nav>

                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            endwhile;
            ?>
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
