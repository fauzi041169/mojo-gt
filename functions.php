<?php
/**
 * Mojo Bootstrap Theme Functions and definitions
 *
 * @package Mojo_Bootstrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define theme constants
define( 'MOJO_BOOTSTRAP_VERSION', '1.1.9' );
define( 'MOJO_BOOTSTRAP_DIR', get_template_directory() );
define( 'MOJO_BOOTSTRAP_URI', get_template_directory_uri() );

/**
 * Include Bootstrap 5 Nav Walker.
 */
require_once MOJO_BOOTSTRAP_DIR . '/inc/class-bootstrap-navwalker.php';

/**
 * Setup theme features.
 */
function mojo_bootstrap_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 675, true ); // 16:9 ratio

    // Register navigation menus.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'mojo-bootstrap' ),
        'footer'  => esc_html__( 'Footer Menu', 'mojo-bootstrap' ),
    ) );

    // Switch default core markup to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Custom logo support.
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // Responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    // Gutenberg wide alignment support.
    add_theme_support( 'align-wide' );

    // Editor styles.
    add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'mojo_bootstrap_setup' );

/**
 * Set content width.
 */
function mojo_bootstrap_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'mojo_bootstrap_content_width', 1140 );
}
add_action( 'after_setup_theme', 'mojo_bootstrap_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function mojo_bootstrap_scripts() {
    // Bootstrap 5 CSS via CDN
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );

    // Bootstrap Icons via CDN
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3' );

    // Theme main stylesheet
    wp_enqueue_style( 'mojo-bootstrap-style', get_stylesheet_uri(), array( 'bootstrap-css' ), MOJO_BOOTSTRAP_VERSION );

    // Theme custom CSS
    if ( file_exists( MOJO_BOOTSTRAP_DIR . '/assets/css/main.css' ) ) {
        wp_enqueue_style( 'mojo-bootstrap-custom', MOJO_BOOTSTRAP_URI . '/assets/css/main.css', array( 'mojo-bootstrap-style' ), MOJO_BOOTSTRAP_VERSION );
    }

    // Bootstrap 5 Bundle JS (includes Popper)
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );

    // Theme custom JS
    if ( file_exists( MOJO_BOOTSTRAP_DIR . '/assets/js/main.js' ) ) {
        wp_enqueue_script( 'mojo-bootstrap-script', MOJO_BOOTSTRAP_URI . '/assets/js/main.js', array( 'bootstrap-js' ), MOJO_BOOTSTRAP_VERSION, true );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'mojo_bootstrap_scripts' );

/**
 * Register widget area.
 */
function mojo_bootstrap_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Main Sidebar', 'mojo-bootstrap' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in the blog sidebar.', 'mojo-bootstrap' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s card mb-4 border rounded-4 shadow-sm p-4 bg-white">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title fw-bold mb-3 border-bottom pb-2 text-dark">',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'mojo-bootstrap' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Widgets in this area will be shown in the first footer column.', 'mojo-bootstrap' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4 text-white">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget-title fw-bold text-white mb-3 text-uppercase small">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'mojo-bootstrap' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Widgets in this area will be shown in the second footer column.', 'mojo-bootstrap' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-4 text-white">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget-title fw-bold text-white mb-3 text-uppercase small">',
        'after_title'   => '</h6>',
    ) );
}
add_action( 'widgets_init', 'mojo_bootstrap_widgets_init' );

/**
 * Custom excerpt length and more string.
 */
function mojo_bootstrap_excerpt_length( $length ) {
    return 24;
}
add_filter( 'excerpt_length', 'mojo_bootstrap_excerpt_length', 999 );

function mojo_bootstrap_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'mojo_bootstrap_excerpt_more' );

/**
 * Bootstrap 5 styled pagination.
 */
function mojo_bootstrap_pagination() {
    global $wp_query;

    $total_pages = $wp_query->max_num_pages;
    if ( $total_pages <= 1 ) {
        return;
    }

    $current_page = max( 1, get_query_var( 'paged' ) );
    $paginate_links = paginate_links( array(
        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'total'     => $total_pages,
        'current'   => $current_page,
        'type'      => 'array',
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
    ) );

    if ( is_array( $paginate_links ) ) {
        echo '<nav aria-label="' . esc_attr__( 'Page navigation', 'mojo-bootstrap' ) . '">';
        echo '<ul class="pagination pagination-md mb-0">';
        foreach ( $paginate_links as $link ) {
            $is_active = strpos( $link, 'current' ) !== false;
            $class = 'page-item' . ( $is_active ? ' active' : '' );
            $link = str_replace( 'page-numbers', 'page-link', $link );
            echo '<li class="' . esc_attr( $class ) . '">' . $link . '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
}

/**
 * Fallback callback for Primary Menu
 * Displays: Beranda, Tentang Kami, Berita, Kebijakan Privasi
 */
function mojo_bootstrap_default_primary_menu() {
    // Detect about page by path or title (case-insensitive)
    $about_page = get_page_by_path( 'tentang-kami' );
    if ( ! $about_page ) {
        $about_page = get_page_by_title( 'Tentang Kami', OBJECT, 'page' );
    }
    if ( ! $about_page ) {
        $about_page = get_page_by_title( 'TENTANG KAMI', OBJECT, 'page' );
    }
    $about_url = $about_page ? get_permalink( $about_page ) : home_url( '/tentang-kami/' );

    // Detect news page by path, option, or title
    $news_page = get_page_by_path( 'berita' );
    if ( ! $news_page ) {
        $news_page = get_page_by_title( 'Berita', OBJECT, 'page' );
    }
    if ( ! $news_page ) {
        $news_page = get_page_by_title( 'BERITA', OBJECT, 'page' );
    }
    $news_url = $news_page ? get_permalink( $news_page ) : ( get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/berita/' ) );

    $privacy_url = function_exists( 'get_privacy_policy_url' ) && get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/kebijakan-privasi/' );

    $is_home    = is_front_page();
    $is_about   = ( $about_page && is_page( $about_page->ID ) ) || is_page( 'tentang-kami' );
    $is_news    = ( is_home() && ! is_front_page() ) || ( $news_page && is_page( $news_page->ID ) ) || is_singular( 'post' ) || is_category() || is_tag();
    $is_privacy = ( function_exists( 'is_privacy_policy' ) && is_privacy_policy() ) || is_page( 'kebijakan-privasi' );

    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">';
    echo '<li class="nav-item"><a class="nav-link' . ( $is_home ? ' active" aria-current="page"' : '"' ) . ' href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Beranda', 'mojo-bootstrap' ) . '</a></li>';
    echo '<li class="nav-item"><a class="nav-link' . ( $is_about ? ' active" aria-current="page"' : '"' ) . ' href="' . esc_url( $about_url ) . '">' . esc_html__( 'Tentang Kami', 'mojo-bootstrap' ) . '</a></li>';
    echo '<li class="nav-item"><a class="nav-link' . ( $is_news ? ' active" aria-current="page"' : '"' ) . ' href="' . esc_url( $news_url ) . '">' . esc_html__( 'Berita', 'mojo-bootstrap' ) . '</a></li>';
    echo '<li class="nav-item"><a class="nav-link' . ( $is_privacy ? ' active" aria-current="page"' : '"' ) . ' href="' . esc_url( $privacy_url ) . '">' . esc_html__( 'Kebijakan Privasi', 'mojo-bootstrap' ) . '</a></li>';
    echo '</ul>';
}

/**
 * Automatically create default pages and setup primary menu on theme activation
 * Only runs if pages do not already exist to prevent duplicates.
 */
function mojo_bootstrap_create_default_menu_and_pages() {
    // If setup has already completed once, never duplicate pages
    if ( get_option( 'mojo_bootstrap_setup_completed' ) ) {
        return;
    }

    $default_pages = array(
        'tentang-kami' => array(
            'title'   => 'Tentang Kami',
            'content' => 'PT. Mojo Global Talent adalah Lembaga Pengirim Resmi (Sending Organization) dan Job Matching Agency berizin Kemnaker RI yang menghubungkan tenaga kerja profesional Indonesia dengan ratusan perusahaan terkemuka di Jepang.',
        ),
        'berita' => array(
            'title'   => 'Berita',
            'content' => '',
        ),
        'kebijakan-privasi' => array(
            'title'   => 'Kebijakan Privasi',
            'content' => 'Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi kandidat saat menggunakan layanan pendaftaran kerja ke Jepang di situs ini.',
        ),
    );

    $page_ids = array();
    foreach ( $default_pages as $slug => $page_data ) {
        // Check by slug first
        $existing_page = get_page_by_path( $slug );
        
        // Check by title (both standard & UPPERCASE)
        if ( ! $existing_page ) {
            $existing_page = get_page_by_title( $page_data['title'], OBJECT, 'page' );
        }
        if ( ! $existing_page ) {
            $existing_page = get_page_by_title( strtoupper( $page_data['title'] ), OBJECT, 'page' );
        }

        if ( ! $existing_page ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $page_data['title'],
                'post_name'    => $slug,
                'post_content' => $page_data['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );
            $page_ids[ $slug ] = $page_id;
        } else {
            $page_ids[ $slug ] = $existing_page->ID;
        }
    }

    // Set privacy policy page option in WP if not set
    if ( ! empty( $page_ids['kebijakan-privasi'] ) && ! get_option( 'wp_page_for_privacy_policy' ) ) {
        update_option( 'wp_page_for_privacy_policy', $page_ids['kebijakan-privasi'] );
    }

    // Set page for posts to Berita
    if ( ! empty( $page_ids['berita'] ) && ! get_option( 'page_for_posts' ) ) {
        update_option( 'page_for_posts', $page_ids['berita'] );
    }

    // Create Navigation Menu if not exists
    $menu_name = 'Menu Utama';
    $menu_exists = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );

        // 1. Beranda
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'  => __( 'Beranda', 'mojo-bootstrap' ),
            'menu-item-url'    => home_url( '/' ),
            'menu-item-status' => 'publish',
        ) );

        // 2. Tentang Kami
        $about_url = ! empty( $page_ids['tentang-kami'] ) ? get_permalink( $page_ids['tentang-kami'] ) : home_url( '/tentang-kami/' );
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'     => __( 'Tentang Kami', 'mojo-bootstrap' ),
            'menu-item-url'       => $about_url,
            'menu-item-object'    => 'page',
            'menu-item-object-id' => ! empty( $page_ids['tentang-kami'] ) ? $page_ids['tentang-kami'] : 0,
            'menu-item-type'      => ! empty( $page_ids['tentang-kami'] ) ? 'post_type' : 'custom',
            'menu-item-status'    => 'publish',
        ) );

        // 3. Berita
        $news_url = ! empty( $page_ids['berita'] ) ? get_permalink( $page_ids['berita'] ) : home_url( '/berita/' );
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'     => __( 'Berita', 'mojo-bootstrap' ),
            'menu-item-url'       => $news_url,
            'menu-item-object'    => 'page',
            'menu-item-object-id' => ! empty( $page_ids['berita'] ) ? $page_ids['berita'] : 0,
            'menu-item-type'      => ! empty( $page_ids['berita'] ) ? 'post_type' : 'custom',
            'menu-item-status'    => 'publish',
        ) );

        // 4. Kebijakan Privasi
        $privacy_url = ! empty( $page_ids['kebijakan-privasi'] ) ? get_permalink( $page_ids['kebijakan-privasi'] ) : ( function_exists( 'get_privacy_policy_url' ) && get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/kebijakan-privasi/' ) );
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'     => __( 'Kebijakan Privasi', 'mojo-bootstrap' ),
            'menu-item-url'       => $privacy_url,
            'menu-item-object'    => 'page',
            'menu-item-object-id' => ! empty( $page_ids['kebijakan-privasi'] ) ? $page_ids['kebijakan-privasi'] : 0,
            'menu-item-type'      => ! empty( $page_ids['kebijakan-privasi'] ) ? 'post_type' : 'custom',
            'menu-item-status'    => 'publish',
        ) );

        // Assign menu locations
        $locations = get_theme_mod( 'nav_menu_locations' );
        if ( ! is_array( $locations ) ) {
            $locations = array();
        }
        $locations['primary'] = $menu_id;
        $locations['footer']  = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    // Mark setup as completed so it never creates duplicate pages again
    update_option( 'mojo_bootstrap_setup_completed', true );
}
add_action( 'after_switch_theme', 'mojo_bootstrap_create_default_menu_and_pages' );

/**
 * Register Theme Customizer settings
 * Memberikan kontrol visual di Tampilan -> Sesuaikan untuk mengedit teks Hero Beranda, WhatsApp, Email, dan Legalitas
 */
function mojo_bootstrap_customize_register( $wp_customize ) {
    // ==========================================
    // 1. SECTION: HERO BERANDA (Teks Bagian Atas)
    // ==========================================
    $wp_customize->add_section( 'mojo_hero_section', array(
        'title'       => __( 'Pengaturan Hero Beranda', 'mojo-bootstrap' ),
        'priority'    => 25,
        'description' => __( 'Edit judul utama, subjudul, teks badge resmi, dan tombol di bagian atas Beranda.', 'mojo-bootstrap' ),
    ) );

    // 1.1 Hero Badge Text
    $wp_customize->add_setting( 'mojo_hero_badge', array(
        'default'           => 'Sending Organization Resmi Berizin Kemnaker RI No: KEP.000/MEN/2024',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_badge', array(
        'label'    => __( 'Teks Badge Atas', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    // 1.2 Hero Main Title
    $wp_customize->add_setting( 'mojo_hero_title', array(
        'default'           => 'Raih Karir Profesional & Masa Depan di <span class="text-danger position-relative">Jepang</span>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_title', array(
        'label'       => __( 'Judul Utama Hero (H1)', 'mojo-bootstrap' ),
        'description' => __( 'Bisa menggunakan <span class="text-danger">Kata</span> untuk warna merah', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
        'type'        => 'text',
    ) );

    // 1.3 Hero Subtitle
    $wp_customize->add_setting( 'mojo_hero_subtitle', array(
        'default'           => 'Lembaga pengirim resmi (*Sending Organization*) dan *Job Matching Specialist* terpercaya. Menghubungkan talenta kompeten Indonesia dengan ratusan perusahaan terkemuka di Jepang melalui program Tokutei Ginou (SSW) dan Magang (TITP).',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_subtitle', array(
        'label'    => __( 'Subjudul / Paragraf Deskripsi Hero', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'textarea',
    ) );

    // 1.4 Tombol 1 Teks
    $wp_customize->add_setting( 'mojo_hero_btn1_text', array(
        'default'           => 'Lihat Job Order Terbaru',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_btn1_text', array(
        'label'    => __( 'Teks Tombol 1 (Merah)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    // 1.5 Tombol 1 URL
    $wp_customize->add_setting( 'mojo_hero_btn1_url', array(
        'default'           => '#job-orders',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_btn1_url', array(
        'label'    => __( 'Link Target Tombol 1', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    // 1.6 Tombol 2 Teks (WhatsApp)
    $wp_customize->add_setting( 'mojo_hero_btn2_text', array(
        'default'           => 'Konsultasi WhatsApp Cepat',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_btn2_text', array(
        'label'    => __( 'Teks Tombol 2 (WhatsApp)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    // ==========================================
    // 2. SECTION: KONTAK & INFORMASI PERUSAHAAN
    // ==========================================
    $wp_customize->add_section( 'mojo_contact_section', array(
        'title'       => __( 'Kontak & Legalitas Perusahaan', 'mojo-bootstrap' ),
        'priority'    => 26,
        'description' => __( 'Edit nomor WhatsApp, email resmi, nomor izin Kemnaker, dan alamat kantor.', 'mojo-bootstrap' ),
    ) );

    // 2.1 WhatsApp
    $wp_customize->add_setting( 'mojo_whatsapp', array(
        'default'           => '+62 812-3456-7890',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_whatsapp', array(
        'label'       => __( 'Nomor WhatsApp', 'mojo-bootstrap' ),
        'description' => __( 'Contoh: +62 812-3456-7890 (otomatis terhubung ke tombol chat)', 'mojo-bootstrap' ),
        'section'     => 'mojo_contact_section',
        'type'        => 'text',
    ) );

    // 2.2 Email
    $wp_customize->add_setting( 'mojo_email', array(
        'default'           => 'info@mojoglobaltalent.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_email', array(
        'label'   => __( 'Email Resmi', 'mojo-bootstrap' ),
        'section' => 'mojo_contact_section',
        'type'    => 'email',
    ) );

    // 2.3 Izin Kemnaker
    $wp_customize->add_setting( 'mojo_izin_kemnaker', array(
        'default'           => 'KEP.000/MEN/2024',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_izin_kemnaker', array(
        'label'   => __( 'Nomor SK Izin Kemnaker RI', 'mojo-bootstrap' ),
        'section' => 'mojo_contact_section',
        'type'    => 'text',
    ) );

    // 2.4 Alamat Jakarta
    $wp_customize->add_setting( 'mojo_alamat_jakarta', array(
        'default'           => 'Treasury Tower Lt. 7, District 8, SCBD, Jakarta Selatan',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_alamat_jakarta', array(
        'label'   => __( 'Alamat Kantor Jakarta', 'mojo-bootstrap' ),
        'section' => 'mojo_contact_section',
        'type'    => 'textarea',
    ) );

    // 2.5 Alamat Tokyo
    $wp_customize->add_setting( 'mojo_alamat_tokyo', array(
        'default'           => 'Chiyoda-ku, Tokyo 101-0021, Japan',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_alamat_tokyo', array(
        'label'   => __( 'Alamat Kantor Tokyo', 'mojo-bootstrap' ),
        'section' => 'mojo_contact_section',
        'type'    => 'textarea',
    ) );

    // ==========================================
    // 3. SECTION: PROGRAM KARIR UNGGULAN (SSW & TITP)
    // ==========================================
    $wp_customize->add_section( 'mojo_program_section', array(
        'title'       => __( 'Pengaturan 2 Program Unggulan', 'mojo-bootstrap' ),
        'priority'    => 27,
        'description' => __( 'Edit judul, gaji, deskripsi, dan sektor untuk kartu Tokutei Ginou dan Magang TITP.', 'mojo-bootstrap' ),
    ) );

    // 3.1 Judul Bagian Program
    $wp_customize->add_setting( 'mojo_program_section_title', array(
        'default'           => 'Pilih Jalur Karir yang Sesuai untuk Anda',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_program_section_title', array(
        'label'   => __( 'Judul Bagian Program', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'text',
    ) );

    // --- PROGRAM 1: TOKUTEI GINOU ---
    $wp_customize->add_setting( 'mojo_ssw_title', array(
        'default'           => 'Tokutei Ginou (SSW)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_ssw_title', array(
        'label'   => __( 'Program 1: Judul', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_ssw_desc', array(
        'default'           => 'Pekerja Berketerampilan Spesifik (特定技能) dengan standar hak, perlindungan kerja, dan gaji setara dengan tenaga kerja lokal Jepang.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_ssw_desc', array(
        'label'   => __( 'Program 1: Deskripsi', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'mojo_ssw_gaji_yen', array(
        'default'           => '¥190,000 – ¥260,000',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_ssw_gaji_yen', array(
        'label'   => __( 'Program 1: Gaji Yen', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_ssw_gaji_idr', array(
        'default'           => 'Rp 20.000.000 – Rp 28.000.000 / bln',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_ssw_gaji_idr', array(
        'label'   => __( 'Program 1: Estimasi Rupiah', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_ssw_sektor', array(
        'default'           => 'Kaigo (Perawat Lansia), Pengolahan Makanan, Pertanian Modern, Restoran & Perhotelan',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_ssw_sektor', array(
        'label'       => __( 'Program 1: Sektor Tersedia (Pisahkan dengan koma)', 'mojo-bootstrap' ),
        'section'     => 'mojo_program_section',
        'type'        => 'textarea',
    ) );

    // --- PROGRAM 2: MAGANG TITP ---
    $wp_customize->add_setting( 'mojo_titp_title', array(
        'default'           => 'Magang Jepang (TITP)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_titp_title', array(
        'label'   => __( 'Program 2: Judul', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_titp_desc', array(
        'default'           => 'Program Pemagangan Teknis (技能実習) untuk alih teknologi industri manufaktur termaju, didukung sertifikat resmi dan dana purna magang.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_titp_desc', array(
        'label'   => __( 'Program 2: Deskripsi', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'mojo_titp_gaji_yen', array(
        'default'           => '¥150,000 – ¥190,000',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_titp_gaji_yen', array(
        'label'   => __( 'Program 2: Gaji Yen', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_titp_gaji_idr', array(
        'default'           => 'Rp 16.000.000 – Rp 20.000.000 / bln',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_titp_gaji_idr', array(
        'label'   => __( 'Program 2: Estimasi Rupiah', 'mojo-bootstrap' ),
        'section' => 'mojo_program_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_titp_sektor', array(
        'default'           => 'Manufaktur & Mesin, Teknik Pengelasan (Welding), Konstruksi Bangunan, Tekstil & Garmen',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_titp_sektor', array(
        'label'       => __( 'Program 2: Sektor Tersedia (Pisahkan dengan koma)', 'mojo-bootstrap' ),
        'section'     => 'mojo_program_section',
        'type'        => 'textarea',
    ) );

    // ==========================================
    // 4. SECTION: STATISTIK BERANDA (3 Angka)
    // ==========================================
    $wp_customize->add_section( 'mojo_stats_section', array(
        'title'       => __( 'Pengaturan Statistik Angka', 'mojo-bootstrap' ),
        'priority'    => 28,
        'description' => __( 'Edit 3 angka statistik pencapaian di bawah banner Beranda.', 'mojo-bootstrap' ),
    ) );

    $wp_customize->add_setting( 'mojo_stat1_num', array( 'default' => '180+', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'mojo_stat1_num', array( 'label' => __( 'Angka 1', 'mojo-bootstrap' ), 'section' => 'mojo_stats_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'mojo_stat1_label', array( 'default' => 'Mitra Perusahaan Jepang', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'mojo_stat1_label', array( 'label' => __( 'Keterangan 1', 'mojo-bootstrap' ), 'section' => 'mojo_stats_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'mojo_stat2_num', array( 'default' => '98.4%', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'mojo_stat2_num', array( 'label' => __( 'Angka 2', 'mojo-bootstrap' ), 'section' => 'mojo_stats_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'mojo_stat2_label', array( 'default' => 'Kelulusan JLPT / JFT Basic', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'mojo_stat2_label', array( 'label' => __( 'Keterangan 2', 'mojo-bootstrap' ), 'section' => 'mojo_stats_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'mojo_stat3_num', array( 'default' => '47', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'mojo_stat3_num', array( 'label' => __( 'Angka 3', 'mojo-bootstrap' ), 'section' => 'mojo_stats_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'mojo_stat3_label', array( 'default' => 'Prefektur Penempatan Kerja', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'mojo_stat3_label', array( 'label' => __( 'Keterangan 3', 'mojo-bootstrap' ), 'section' => 'mojo_stats_section', 'type' => 'text' ) );
}
add_action( 'customize_register', 'mojo_bootstrap_customize_register' );

/**
 * =========================================================================
 * 5. JOB ORDER META BOX (KOTAK PENGISIAN DETAIL LOWONGAN KERJA JEPANG)
 * =========================================================================
 * Menambahkan kotak formulir pengisian data lowongan di halaman Post editor WordPress
 */
function mojo_bootstrap_register_job_meta_box() {
    add_meta_box(
        'mojo_job_meta_box',
        __( '💼 Informasi Detail Lowongan Kerja Jepang (Job Order)', 'mojo-bootstrap' ),
        'mojo_bootstrap_render_job_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'mojo_bootstrap_register_job_meta_box' );

function mojo_bootstrap_render_job_meta_box( $post ) {
    wp_nonce_field( 'mojo_job_meta_box_nonce', 'mojo_job_nonce' );
    $loc   = get_post_meta( $post->ID, '_mojo_job_location', true );
    $quota = get_post_meta( $post->ID, '_mojo_job_quota', true );
    $yen   = get_post_meta( $post->ID, '_mojo_job_salary_yen', true );
    $idr   = get_post_meta( $post->ID, '_mojo_job_salary_idr', true );
    ?>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; padding: 12px 0;">
        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 6px;">📍 Lokasi / Prefektur di Jepang:</label>
            <input type="text" name="_mojo_job_location" value="<?php echo esc_attr( $loc ); ?>" placeholder="Contoh: Tokyo, Osaka, Aichi, Hokkaido" style="width: 100%; padding: 8px 12px; border-radius: 6px; border: 1px solid #ccd0d4; font-size: 14px;">
            <p style="color: #666; font-size: 12px; margin: 4px 0 0;">Ditampilkan sebagai lencana kota di pojok kiri kartu lowongan.</p>
        </div>
        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 6px;">👥 Jumlah Kuota Lowongan:</label>
            <input type="text" name="_mojo_job_quota" value="<?php echo esc_attr( $quota ); ?>" placeholder="Contoh: 15 Kuota, 20 Orang, Aktif" style="width: 100%; padding: 8px 12px; border-radius: 6px; border: 1px solid #ccd0d4; font-size: 14px;">
            <p style="color: #666; font-size: 12px; margin: 4px 0 0;">Ditampilkan sebagai lencana status hijau di pojok kanan kartu.</p>
        </div>
        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 6px;">💴 Standar Gaji Bulanan (Yen):</label>
            <input type="text" name="_mojo_job_salary_yen" value="<?php echo esc_attr( $yen ); ?>" placeholder="Contoh: ¥215,000 – ¥245,000" style="width: 100%; padding: 8px 12px; border-radius: 6px; border: 1px solid #ccd0d4; font-size: 14px;">
            <p style="color: #666; font-size: 12px; margin: 4px 0 0;">Nominal gaji pokok di Jepang (Yen).</p>
        </div>
        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 6px;">💵 Estimasi Gaji (Rupiah):</label>
            <input type="text" name="_mojo_job_salary_idr" value="<?php echo esc_attr( $idr ); ?>" placeholder="Contoh: ± Rp 23 Juta – Rp 26,2 Juta/bln" style="width: 100%; padding: 8px 12px; border-radius: 6px; border: 1px solid #ccd0d4; font-size: 14px;">
            <p style="color: #666; font-size: 12px; margin: 4px 0 0;">Estimasi dalam Rupiah per bulan.</p>
        </div>
    </div>
    <?php
}

function mojo_bootstrap_save_job_meta_box( $post_id ) {
    if ( ! isset( $_POST['mojo_job_nonce'] ) || ! wp_verify_nonce( $_POST['mojo_job_nonce'], 'mojo_job_meta_box_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array( '_mojo_job_location', '_mojo_job_quota', '_mojo_job_salary_yen', '_mojo_job_salary_idr' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post', 'mojo_bootstrap_save_job_meta_box' );

/**
 * =========================================================================
 * 6. ONE-CLICK SAMPLE JOBS GENERATOR (UNTUK CONTOH PENGISIAN DI WP-ADMIN)
 * =========================================================================
 */
function mojo_bootstrap_sample_jobs_admin_menu() {
    add_theme_page(
        __( 'Contoh Lowongan Jepang', 'mojo-bootstrap' ),
        __( 'Contoh Lowongan Kerja', 'mojo-bootstrap' ),
        'manage_options',
        'mojo-sample-jobs',
        'mojo_bootstrap_sample_jobs_page'
    );
}
add_action( 'admin_menu', 'mojo_bootstrap_sample_jobs_admin_menu' );

function mojo_bootstrap_sample_jobs_page() {
    if ( isset( $_POST['mojo_generate_sample_jobs'] ) && check_admin_referer( 'mojo_generate_sample_jobs_nonce' ) ) {
        mojo_bootstrap_seed_sample_jobs();
        echo '<div class="notice notice-success is-dismissible"><p><strong>Berhasil!</strong> 4 Contoh Lowongan Kerja Jepang resmi telah dibuat dan dimasukkan ke database WordPress Anda. Silakan cek menu <strong>Pos &rarr; Semua Pos</strong> atau refresh halaman Beranda.</p></div>';
    }
    ?>
    <div class="wrap" style="max-width: 850px; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-top: 20px;">
        <h1 style="margin-top: 0; color: #1e293b;">💼 Generator Contoh Data Lowongan Kerja Jepang</h1>
        <p style="font-size: 15px; color: #475569; line-height: 1.6;">
            Klik tombol di bawah ini untuk membuat <strong>4 pos lowongan kerja contoh</strong> secara otomatis ke database WordPress Anda. 
            Semua lowongan ini sudah dilengkapi dengan <strong>kategori resmi, deskripsi pekerjaan lengkap, persyaratan dokumen, lokasi prefektur (Tokyo, Osaka, Aichi, Hokkaido), jumlah kuota, serta gaji Yen & Rupiah</strong>.
        </p>
        <p style="font-size: 14px; color: #64748b;">
            Setelah data ini terpasang, Anda bisa melihat bagaimana cara mengisi lowongan kerja di menu <strong>Pos &rarr; Semua Pos</strong> dan mengeditnya kapan saja sesuai kebutuhan perusahaan.
        </p>
        <form method="post" style="margin-top: 25px;">
            <?php wp_nonce_field( 'mojo_generate_sample_jobs_nonce' ); ?>
            <button type="submit" name="mojo_generate_sample_jobs" class="button button-primary button-hero" style="background: #c9182b; border-color: #a01020; font-size: 16px; height: auto; padding: 10px 24px;">
                🚀 Pasang 4 Contoh Lowongan Kerja Jepang Sekarang
            </button>
        </form>
    </div>
    <?php
}

function mojo_bootstrap_seed_sample_jobs() {
    require_once ABSPATH . 'wp-admin/includes/taxonomy.php';

    $cat_ssw  = wp_create_category( 'Tokutei Ginou (SSW)' );
    $cat_titp = wp_create_category( 'Magang Jepang (TITP)' );

    $sample_jobs = array(
        array(
            'title'    => 'Job Order: Tokutei Ginou Kaigo (Perawat Lansia) Tokyo & Kanagawa',
            'category' => array( $cat_ssw ),
            'location' => 'Tokyo',
            'quota'    => '15 Kuota',
            'yen'      => '¥215,000 – ¥245,000',
            'idr'      => '± Rp 23 Juta – Rp 26,2 Juta/bln',
            'content'  => "Dibuka kesempatan berkarir di Jepang melalui program Tokutei Ginou (SSW) bidang Perawat Lansia (Kaigo) untuk penempatan di fasilitas perawatan lansia modern wilayah metropolitan Tokyo & Kanagawa.\n\n### Fasilitas & Benefit:\n- Gaji pokok standar pekerja lokal Jepang\n- Subsidi perumahan/apartemen 50%\n- Asuransi kesehatan nasional & ketenagakerjaan lengkap\n- Tiket pesawat keberangkatan ditanggung perusahaan penerima\n\n### Persyaratan:\n1. Pria / Wanita usia 19 - 35 tahun\n2. Memiliki sertifikat kemampuan bahasa Jepang minimal JLPT N4 / JFT Basic A2\n3. Memiliki sertifikat keahlian Kaigo Skill Test & Kaigo Caregiver\n4. Sehat jasmani dan rohani, lolos Medical Check-Up (MCU)",
        ),
        array(
            'title'    => 'Lowongan Tokutei Ginou Pengolahan Makanan (Food Processing) Osaka',
            'category' => array( $cat_ssw ),
            'location' => 'Osaka',
            'quota'    => '20 Kuota',
            'yen'      => '¥195,000 – ¥225,000',
            'idr'      => '± Rp 20,8 Juta – Rp 24 Juta/bln',
            'content'  => "Perusahaan industri makanan kemasan higienis berskala nasional di Osaka membuka kuota 20 tenaga kerja asal Indonesia untuk bagian preparasi, pengolahan, dan pengemasan bento.\n\n### Fasilitas & Benefit:\n- Asrama karyawan ber-AC dan dekat stasiun\n- Uang lembur sesuai UU Standar Ketenagakerjaan Jepang\n- Bimbingan staf penanggung jawab berbahasa Indonesia\n\n### Persyaratan:\n1. Usia 19 - 32 tahun\n2. Sertifikat JLPT N4 / JFT Basic A2\n3. Sertifikat Ujian Keterampilan Pengolahan Makanan (Seizou Test)\n4. Disiplin, jujur, dan bersemangat kerja tinggi",
        ),
        array(
            'title'    => 'Program Magang TITP Manufaktur & Pengelasan Logam Aichi (Nagoya)',
            'category' => array( $cat_titp ),
            'location' => 'Aichi',
            'quota'    => '12 Kuota',
            'yen'      => '¥170,000 – ¥195,000',
            'idr'      => '± Rp 18,2 Juta – Rp 20,8 Juta/bln',
            'content'  => "Peluang magang industri manufaktur dan perakitan komponen otomotif di prefektur Aichi (wilayah industri Nagoya). Program resmi alih teknologi dengan standar keselamatan kerja internasional.\n\n### Fasilitas & Benefit:\n- Sertifikasi kompetensi resmi JITCO Jepang\n- Tabungan dana purna magang saat kembali ke Indonesia\n- Asrama dan perlengkapan kerja lengkap disediakan\n\n### Persyaratan:\n1. Pria usia 18 - 26 tahun, minimal lulusan SMK/SMA sederajat\n2. Tinggi badan min. 162 cm, tidak buta warna, tidak bertato\n3. Lulus seleksi tes fisik dan kesamaptaan di LPK Mojo Global Talent",
        ),
        array(
            'title'    => 'Peluang Kerja Pertanian & Agrikultur Modern Greenhouse di Hokkaido',
            'category' => array( $cat_ssw ),
            'location' => 'Hokkaido',
            'quota'    => '10 Kuota',
            'yen'      => '¥185,000 – ¥210,000',
            'idr'      => '± Rp 19,8 Juta – Rp 22,5 Juta/bln',
            'content'  => "Budidaya sayuran dan buah modern dengan sistem hidroponik dan sensor iklim otomatis di Hokkaido. Udara bersih, lingkungan kerja kondusif, dan perumahan dinas disediakan.\n\n### Fasilitas & Benefit:\n- Rumah dinas berpenghangat ruangan (winter heating)\n- Bonus panen musiman\n- Kesempatan memperpanjang visa hingga 5 tahun penuh\n\n### Persyaratan:\n1. Pria / Wanita usia 19 - 35 tahun\n2. JLPT N4 / JFT Basic A2\n3. Sertifikat Skill Test Pertanian (Nogyo Tokutei Ginou)\n4. Menyukai pekerjaan agrikultur modern",
        ),
    );

    foreach ( $sample_jobs as $job ) {
        $existing = get_page_by_title( $job['title'], OBJECT, 'post' );
        if ( ! $existing ) {
            $post_id = wp_insert_post( array(
                'post_title'    => $job['title'],
                'post_content'  => $job['content'],
                'post_status'   => 'publish',
                'post_type'     => 'post',
                'post_category' => $job['category'],
            ) );
            if ( $post_id && ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_mojo_job_location', $job['location'] );
                update_post_meta( $post_id, '_mojo_job_quota', $job['quota'] );
                update_post_meta( $post_id, '_mojo_job_salary_yen', $job['yen'] );
                update_post_meta( $post_id, '_mojo_job_salary_idr', $job['idr'] );
            }
        } else {
            // Update metadata existing post
            update_post_meta( $existing->ID, '_mojo_job_location', $job['location'] );
            update_post_meta( $existing->ID, '_mojo_job_quota', $job['quota'] );
            update_post_meta( $existing->ID, '_mojo_job_salary_yen', $job['yen'] );
            update_post_meta( $existing->ID, '_mojo_job_salary_idr', $job['idr'] );
        }
    }
}
