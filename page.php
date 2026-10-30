<?php
/**
 * Page template - Full-Width Clean & Seamless (No Card, No Overlap)
 *
 * @package Mojo_Bootstrap
 */

// Otomatis arahkan ke template Tentang Kami yang profesional jika halaman ini adalah Tentang Kami
if ( is_page( 'tentang-kami' ) || is_page( 'about-us' ) || is_page( 'about' ) || is_page( 'profil' ) ) {
    get_template_part( 'page-tentang-kami' );
    return;
}

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
