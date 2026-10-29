<?php
/**
 * Page template - Full-Width Clean & Seamless (No Card, No Overlap)
 *
 * @package Mojo_Bootstrap
 */

get_header();
?>

<div class="site-page-container py-4 py-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content', 'page' );

                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                endwhile;
                ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
