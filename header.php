<?php
/**
 * Header template for Mojo Bootstrap - Clean Japanese Recruitment Corporate
 *
 * @package Mojo_Bootstrap
 */

$wa_number  = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
$wa_clean   = preg_replace( '/[^0-9]/', '', $wa_number );
$izin_text  = get_theme_mod( 'mojo_izin_kemnaker', 'KEP.000/MEN/2024' );
$email_text = get_theme_mod( 'mojo_email', 'info@mojoglobaltalent.com' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text visually-hidden-focusable" href="#main-content">
    <?php esc_html_e( 'Skip to content', 'mojo-bootstrap' ); ?>
</a>

<!-- Minimalist Top Bar -->
<div class="top-bar py-2 d-none d-md-block">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2 small">
            <span class="text-danger fw-bold"><i class="bi bi-patch-check-fill me-1"></i>RESMI</span>
            <span class="text-secondary">Izin Kemnaker RI No: <?php echo esc_html( $izin_text ); ?> &bull; Terdaftar OTIT Jepang</span>
        </div>

        <div class="d-flex align-items-center gap-3 small">
            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>" target="_blank" class="text-secondary d-flex align-items-center gap-1">
                <i class="bi bi-whatsapp text-success"></i> <?php echo esc_html( $wa_number ); ?>
            </a>
            <span class="text-muted">|</span>
            <a href="mailto:<?php echo esc_attr( $email_text ); ?>" class="text-secondary d-flex align-items-center gap-1">
                <i class="bi bi-envelope"></i> <?php echo esc_html( $email_text ); ?>
            </a>
            <span class="text-muted">|</span>
            <span class="text-muted small">
                <strong class="text-dark">ID</strong> / JP (日本語)
            </span>
        </div>
    </div>
</div>

<!-- Main Navbar -->
<header class="site-header sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container">
            <?php if ( has_custom_logo() ) : ?>
                <div class="navbar-brand-wrapper d-flex align-items-center me-3">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <a class="navbar-brand text-decoration-none d-flex align-items-center gap-2" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; font-weight: 800; font-size: 1.15rem;">
                        JP
                    </div>
                    <div>
                        <div class="brand-title"><?php bloginfo( 'name' ); ?></div>
                        <span class="brand-subtitle">Sending Organization Indonesia &bull; 日本送出し機関</span>
                    </div>
                </a>
            <?php endif; ?>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNavbar" aria-controls="primaryNavbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'mojo-bootstrap' ); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="primaryNavbar">
                <?php
                if ( has_nav_menu( 'primary' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center',
                        'fallback_cb'    => 'mojo_bootstrap_default_primary_menu',
                        'depth'          => 2,
                        'walker'         => new Mojo_Bootstrap_Navwalker(),
                    ) );
                else :
                    mojo_bootstrap_default_primary_menu();
                endif;
                ?>

                <!-- CTA Button -->
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    <a href="#konsultasi" class="btn btn-japan d-flex align-items-center gap-2">
                        <i class="bi bi-send-fill"></i>
                        <span>Daftar / Konsultasi</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main id="main-content" class="site-main">
