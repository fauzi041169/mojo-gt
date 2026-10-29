<?php
/**
 * 404 Error page
 *
 * @package Mojo_Bootstrap
 */

get_header();
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center py-5">
            <h1 class="display-1 fw-bold text-primary mb-3">404</h1>
            <h2 class="h3 fw-bold mb-3"><?php esc_html_e( 'Page Not Found', 'mojo-bootstrap' ); ?></h2>
            <p class="lead text-muted mb-4">
                <?php esc_html_e( 'Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'mojo-bootstrap' ); ?>
            </p>

            <div class="card p-4 border-0 shadow-sm bg-light mx-auto mb-4" style="max-width: 500px;">
                <label class="form-label text-muted small mb-2"><?php esc_html_e( 'Try searching our website:', 'mojo-bootstrap' ); ?></label>
                <?php get_search_form(); ?>
            </div>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary px-4 py-2">
                <?php esc_html_e( '&larr; Return to Homepage', 'mojo-bootstrap' ); ?>
            </a>
        </div>
    </div>
</div>

<?php
get_footer();
