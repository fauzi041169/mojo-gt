<?php
/**
 * Page template - Full-Width Clean & Minimalist (Without Sidebar & Breadcrumb)
 *
 * @package Mojo_Bootstrap
 */

get_header();
?>

<div class="container py-4">
    <!-- Clean Full-Width / Centered Layout -->
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
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

<?php
get_footer();
