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
define( 'MOJO_BOOTSTRAP_VERSION', '1.3.9' );
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
 * Displays: Beranda, Lowongan Kerja, Tentang Kami, Berita, Kebijakan Privasi
 */
function mojo_bootstrap_default_primary_menu() {
    // Detect lowongan kerja page
    $jobs_page = get_page_by_path( 'lowongan-kerja' );
    if ( ! $jobs_page ) {
        $jobs_page = get_page_by_title( 'Lowongan Kerja', OBJECT, 'page' );
    }
    if ( ! $jobs_page ) {
        $jobs_page = get_page_by_title( 'LOWONGAN KERJA', OBJECT, 'page' );
    }
    $jobs_url = $jobs_page ? get_permalink( $jobs_page ) : home_url( '/lowongan-kerja/' );

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
    $is_jobs    = ( $jobs_page && is_page( $jobs_page->ID ) ) || is_page( 'lowongan-kerja' );
    $is_about   = ( $about_page && is_page( $about_page->ID ) ) || is_page( 'tentang-kami' );
    $is_news    = ( is_home() && ! is_front_page() ) || ( $news_page && is_page( $news_page->ID ) ) || is_singular( 'post' ) || is_category() || is_tag();
    $is_privacy = ( function_exists( 'is_privacy_policy' ) && is_privacy_policy() ) || is_page( 'kebijakan-privasi' );

    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">';
    echo '<li class="nav-item"><a class="nav-link' . ( $is_home ? ' active" aria-current="page"' : '"' ) . ' href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Beranda', 'mojo-bootstrap' ) . '</a></li>';
    echo '<li class="nav-item"><a class="nav-link' . ( $is_jobs ? ' active" aria-current="page"' : '"' ) . ' href="' . esc_url( $jobs_url ) . '">' . esc_html__( 'Lowongan Kerja', 'mojo-bootstrap' ) . '</a></li>';
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
        'lowongan-kerja' => array(
            'title'   => 'Lowongan Kerja',
            'content' => '',
        ),
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
            if ( $slug === 'lowongan-kerja' ) {
                update_post_meta( $page_id, '_wp_page_template', 'page-lowongan-kerja.php' );
            }
            $page_ids[ $slug ] = $page_id;
        } else {
            $page_ids[ $slug ] = $existing_page->ID;
            if ( $slug === 'lowongan-kerja' ) {
                update_post_meta( $existing_page->ID, '_wp_page_template', 'page-lowongan-kerja.php' );
            }
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
            'menu-item-title'    => __( 'Beranda', 'mojo-bootstrap' ),
            'menu-item-url'      => home_url( '/' ),
            'menu-item-status'   => 'publish',
            'menu-item-position' => 1,
        ) );

        // 2. Lowongan Kerja
        $jobs_url = ! empty( $page_ids['lowongan-kerja'] ) ? get_permalink( $page_ids['lowongan-kerja'] ) : home_url( '/lowongan-kerja/' );
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'     => __( 'Lowongan Kerja', 'mojo-bootstrap' ),
            'menu-item-url'       => $jobs_url,
            'menu-item-object'    => 'page',
            'menu-item-object-id' => ! empty( $page_ids['lowongan-kerja'] ) ? $page_ids['lowongan-kerja'] : 0,
            'menu-item-type'      => ! empty( $page_ids['lowongan-kerja'] ) ? 'post_type' : 'custom',
            'menu-item-status'    => 'publish',
            'menu-item-position'  => 2,
        ) );

        // 3. Tentang Kami
        $about_url = ! empty( $page_ids['tentang-kami'] ) ? get_permalink( $page_ids['tentang-kami'] ) : home_url( '/tentang-kami/' );
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'     => __( 'Tentang Kami', 'mojo-bootstrap' ),
            'menu-item-url'       => $about_url,
            'menu-item-object'    => 'page',
            'menu-item-object-id' => ! empty( $page_ids['tentang-kami'] ) ? $page_ids['tentang-kami'] : 0,
            'menu-item-type'      => ! empty( $page_ids['tentang-kami'] ) ? 'post_type' : 'custom',
            'menu-item-status'    => 'publish',
            'menu-item-position'  => 3,
        ) );

        // 4. Berita
        $news_url = ! empty( $page_ids['berita'] ) ? get_permalink( $page_ids['berita'] ) : home_url( '/berita/' );
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'     => __( 'Berita', 'mojo-bootstrap' ),
            'menu-item-url'       => $news_url,
            'menu-item-object'    => 'page',
            'menu-item-object-id' => ! empty( $page_ids['berita'] ) ? $page_ids['berita'] : 0,
            'menu-item-type'      => ! empty( $page_ids['berita'] ) ? 'post_type' : 'custom',
            'menu-item-status'    => 'publish',
            'menu-item-position'  => 4,
        ) );

        // 5. Kebijakan Privasi
        $privacy_url = ! empty( $page_ids['kebijakan-privasi'] ) ? get_permalink( $page_ids['kebijakan-privasi'] ) : ( function_exists( 'get_privacy_policy_url' ) && get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/kebijakan-privasi/' ) );
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'     => __( 'Kebijakan Privasi', 'mojo-bootstrap' ),
            'menu-item-url'       => $privacy_url,
            'menu-item-object'    => 'page',
            'menu-item-object-id' => ! empty( $page_ids['kebijakan-privasi'] ) ? $page_ids['kebijakan-privasi'] : 0,
            'menu-item-type'      => ! empty( $page_ids['kebijakan-privasi'] ) ? 'post_type' : 'custom',
            'menu-item-status'    => 'publish',
            'menu-item-position'  => 5,
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
 * Memastikan halaman "Lowongan Kerja" selalu ada dan otomatis terdaftar di Menu Navigasi
 */
function mojo_bootstrap_ensure_lowongan_page() {
    $slug = 'lowongan-kerja';
    $jobs_page = get_page_by_path( $slug );
    if ( ! $jobs_page ) {
        $jobs_page = get_page_by_title( 'Lowongan Kerja', OBJECT, 'page' );
    }
    if ( ! $jobs_page ) {
        $jobs_page = get_page_by_title( 'LOWONGAN KERJA', OBJECT, 'page' );
    }

    if ( ! $jobs_page ) {
        $page_id = wp_insert_post( array(
            'post_title'   => 'Lowongan Kerja',
            'post_name'    => $slug,
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ) );
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', 'page-lowongan-kerja.php' );
            $jobs_page = get_post( $page_id );
        }
    } else {
        $current_tpl = get_post_meta( $jobs_page->ID, '_wp_page_template', true );
        if ( empty( $current_tpl ) || $current_tpl === 'default' ) {
            update_post_meta( $jobs_page->ID, '_wp_page_template', 'page-lowongan-kerja.php' );
        }
    }

    // Tambahkan otomatis ke Menu Navigasi jika belum terdaftar
    if ( $jobs_page ) {
        $locations = get_theme_mod( 'nav_menu_locations' );
        $menu_id   = ( is_array( $locations ) && ! empty( $locations['primary'] ) ) ? $locations['primary'] : 0;

        if ( ! $menu_id ) {
            $menu_obj = wp_get_nav_menu_object( 'Menu Utama' );
            if ( $menu_obj ) {
                $menu_id = $menu_obj->term_id;
            }
        }

        if ( $menu_id ) {
            $menu_items = wp_get_nav_menu_items( $menu_id );
            $already_in_menu = false;
            if ( ! empty( $menu_items ) ) {
                foreach ( $menu_items as $item ) {
                    if ( (int) $item->object_id === (int) $jobs_page->ID || strtolower( trim( $item->title ) ) === 'lowongan kerja' || strpos( $item->url, 'lowongan-kerja' ) !== false ) {
                        $already_in_menu = true;
                        break;
                    }
                }
            }

            if ( ! $already_in_menu ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'     => __( 'Lowongan Kerja', 'mojo-bootstrap' ),
                    'menu-item-url'       => get_permalink( $jobs_page->ID ),
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $jobs_page->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => 2,
                ) );
            }
        }
    }
}
add_action( 'init', 'mojo_bootstrap_ensure_lowongan_page' );

/**
 * Membersihkan dan memformat nomor WhatsApp ke standar internasional wa.me (misal: 6281234567890)
 * Mendukung format: 0812..., +62 812..., 62812..., 0812-xxxx, spasi, tanda strip, dsb.
 *
 * @param string $number Nomor telepon yang diinput.
 * @return string Nomor WhatsApp valid untuk URL wa.me.
 */
function mojo_clean_whatsapp_number( $number = '' ) {
    if ( empty( $number ) ) {
        $number = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
    }
    // Hapus semua karakter non-angka
    $clean = preg_replace( '/[^0-9]/', '', (string) $number );

    // Jika diawali 0 (misal format lokal: 081234567890), ganti 0 dengan 62
    if ( strpos( $clean, '0' ) === 0 ) {
        $clean = '62' . substr( $clean, 1 );
    } elseif ( strpos( $clean, '8' ) === 0 && strlen( $clean ) >= 9 && strlen( $clean ) <= 13 ) {
        // Jika user hanya mengetik 81234567890 tanpa 0 dan tanpa 62
        $clean = '62' . $clean;
    }

    // Fallback jika kosong atau tidak valid
    if ( empty( $clean ) ) {
        $clean = '6281234567890';
    }

    return $clean;
}

/**
 * Mendapatkan link WhatsApp (wa.me) lengkap dengan pesan awal
 *
 * @param string $message Pesan pembuka teks yang ingin dikirim.
 * @param string $custom_number Nomor kustom jika ingin override.
 * @return string URL WhatsApp lengkap.
 */
function mojo_get_whatsapp_url( $message = '', $custom_number = '' ) {
    $clean_num = mojo_clean_whatsapp_number( $custom_number );
    $url = 'https://wa.me/' . $clean_num;
    if ( ! empty( $message ) ) {
        $url .= '?text=' . rawurlencode( $message );
    }
    return $url;
}

/**
 * Register Theme Customizer settings
 * Memberikan kontrol visual di Tampilan -> Sesuaikan untuk mengedit teks Hero Beranda, WhatsApp, Email, dan Legalitas
 */
function mojo_bootstrap_customize_register( $wp_customize ) {
    // ==========================================
    // 1. SECTION: KONTAK & WHATSAPP KANTOR (Prioritas Utama)
    // ==========================================
    $wp_customize->add_section( 'mojo_contact_section', array(
        'title'       => __( 'WhatsApp Kantor & Kontak Resmi', 'mojo-bootstrap' ),
        'priority'    => 20,
        'description' => __( 'Atur nomor WhatsApp kantor aktif, email resmi, nomor izin Kemnaker, dan alamat. Nomor WhatsApp di sini terhubung ke seluruh tombol chat & formulir konsultasi.', 'mojo-bootstrap' ),
    ) );

    // 1.1 WhatsApp Kantor Utama
    $wp_customize->add_setting( 'mojo_whatsapp', array(
        'default'           => '+62 812-3456-7890',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_whatsapp', array(
        'label'       => __( 'Nomor WhatsApp Kantor (Aktif)', 'mojo-bootstrap' ),
        'description' => __( 'Bisa diketik: 0812-3456-7890 atau +62 812-3456-7890. Sistem otomatis mengkonversi ke format internasional resmi WhatsApp.', 'mojo-bootstrap' ),
        'section'     => 'mojo_contact_section',
        'type'        => 'text',
    ) );

    // 1.2 Email
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

    // 1.3 Izin Kemnaker
    $wp_customize->add_setting( 'mojo_izin_kemnaker', array(
        'default'           => 'KEP.000/MEN/2024',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_izin_kemnaker', array(
        'label'       => __( 'Nomor Izin Kemnaker RI', 'mojo-bootstrap' ),
        'description' => __( 'Contoh: KEP.000/MEN/2024', 'mojo-bootstrap' ),
        'section'     => 'mojo_contact_section',
        'type'        => 'text',
    ) );

    // 1.4 Alamat Kantor Jakarta
    $wp_customize->add_setting( 'mojo_alamat_jakarta', array(
        'default'           => 'Gedung Talent Center Lt. 3, Jl. Gatot Subroto Kav. 88, Jakarta Selatan',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_alamat_jakarta', array(
        'label'   => __( 'Alamat Kantor Indonesia (Jakarta)', 'mojo-bootstrap' ),
        'section' => 'mojo_contact_section',
        'type'    => 'text',
    ) );

    // 1.5 Alamat Kantor Tokyo
    $wp_customize->add_setting( 'mojo_alamat_tokyo', array(
        'default'           => 'Chiyoda-ku, Tokyo 101-0021, Japan',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_alamat_tokyo', array(
        'label'   => __( 'Alamat Kantor Representatif Jepang (Tokyo)', 'mojo-bootstrap' ),
        'section' => 'mojo_contact_section',
        'type'    => 'text',
    ) );

    // ==========================================
    // 2. SECTION: HERO & SLIDER BERANDA
    // ==========================================
    $wp_customize->add_section( 'mojo_hero_section', array(
        'title'       => __( 'Pengaturan Hero & Slider Beranda', 'mojo-bootstrap' ),
        'priority'    => 25,
        'description' => __( 'Atur tampilan slider di bagian atas beranda. Anda dapat mengaktifkan multi-slide, mengedit teks, tombol, hingga mengunggah foto latar belakang untuk masing-masing slide.', 'mojo-bootstrap' ),
    ) );

    // 2.0 Aktifkan Slider
    $wp_customize->add_setting( 'mojo_hero_slider_enable', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_slider_enable', array(
        'label'    => __( 'Aktifkan Hero Slider Multi-Slide', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'checkbox',
    ) );

    // 2.0.1 Model Tampilan Layout
    $wp_customize->add_setting( 'mojo_hero_layout', array(
        'default'           => 'split',
        'sanitize_callback' => 'sanitize_key',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_layout', array(
        'label'       => __( 'Model Tampilan Slider', 'mojo-bootstrap' ),
        'description' => __( 'Pilih model visual tampilan slider.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
        'type'        => 'select',
        'choices'     => array(
            'split'    => __( 'Model 2 Kolom (Teks & Foto Ilustrasi Samping - Direkomendasikan)', 'mojo-bootstrap' ),
            'center'   => __( 'Model Minimalis (Teks di Tengah Saja)', 'mojo-bootstrap' ),
            'bg_cover' => __( 'Model Latar Foto Penuh (Full-Width Cover)', 'mojo-bootstrap' ),
        ),
    ) );

    // --- SLIDE 1 ---
    $wp_customize->add_setting( 'mojo_hero_badge', array(
        'default'           => 'Sending Organization Resmi Berizin Kemnaker RI No: KEP.000/MEN/2024',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_badge', array(
        'label'       => __( '[Slide 1] Teks Badge Atas', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_hero_title', array(
        'default'           => 'Raih Karir Profesional & Masa Depan di <span class="text-danger position-relative">Jepang</span>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_title', array(
        'label'       => __( '[Slide 1] Judul Utama (H1)', 'mojo-bootstrap' ),
        'description' => __( 'Gunakan <span class="text-danger">Kata</span> untuk memberi warna merah', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_hero_subtitle', array(
        'default'           => 'Lembaga pengirim resmi (*Sending Organization*) dan *Job Matching Specialist* terpercaya. Menghubungkan talenta kompeten Indonesia dengan ratusan perusahaan terkemuka di Jepang melalui program Tokutei Ginou (SSW).',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_subtitle', array(
        'label'    => __( '[Slide 1] Subjudul / Deskripsi', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'mojo_hero_btn1_text', array(
        'default'           => 'Lihat Job Order Terbaru',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_btn1_text', array(
        'label'    => __( '[Slide 1] Teks Tombol 1 (Merah)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_hero_btn1_url', array(
        'default'           => '#job-orders',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_btn1_url', array(
        'label'    => __( '[Slide 1] Link Target Tombol 1', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_hero_btn2_text', array(
        'default'           => 'Konsultasi WhatsApp Cepat',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_btn2_text', array(
        'label'    => __( '[Slide 1] Teks Tombol 2 (WhatsApp)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_hero_btn2_wa', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_hero_btn2_wa', array(
        'label'       => __( '[Slide 1] Nomor WhatsApp Khusus (Opsional)', 'mojo-bootstrap' ),
        'description' => __( 'Kosongkan jika ingin memakai Nomor WhatsApp Kantor utama.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide1_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mojo_slide1_image', array(
        'label'       => __( '[Slide 1] Foto Samping (Model 2 Kolom)', 'mojo-bootstrap' ),
        'description' => __( 'Unggah foto jika ingin mengganti gambar default slide 1.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
    ) ) );

    $wp_customize->add_setting( 'mojo_slide1_tag_top', array(
        'default'           => 'Program Resmi Tokutei Ginou (SSW)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide1_tag_top', array(
        'label'    => __( '[Slide 1] Teks Badge Atas Foto', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide1_tag_bottom', array(
        'default'           => '1,250+ Talenta Sukses Diberangkatkan',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide1_tag_bottom', array(
        'label'    => __( '[Slide 1] Teks Card Bawah Foto', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide1_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mojo_slide1_bg', array(
        'label'       => __( '[Slide 1] Foto Latar Belakang Penuh (Opsional)', 'mojo-bootstrap' ),
        'description' => __( 'Unggah foto jika ingin latar belakang bergambar penuh (Full-Width), atau biarkan kosong untuk mode 2 kolom.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
    ) ) );

    // --- SLIDE 2 ---
    $wp_customize->add_setting( 'mojo_slide2_badge', array(
        'default'           => 'Program Unggulan Tokutei Ginou (SSW) 2026',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_badge', array(
        'label'    => __( '[Slide 2] Teks Badge Atas', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_title', array(
        'default'           => 'Gaji Standar Jepang & <span class="text-danger position-relative">Hak Perlindungan Penuh</span>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_title', array(
        'label'    => __( '[Slide 2] Judul Utama (H1)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_desc', array(
        'default'           => 'Dapatkan penghasilan setara tenaga kerja lokal Jepang (¥190.000 – ¥260.000 / bln) di sektor Kaigo, Pengolahan Makanan, Pertanian, Manufaktur, dan Restoran dengan kontrak kerja resmi terproteksi.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_desc', array(
        'label'    => __( '[Slide 2] Subjudul / Deskripsi', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_btn1_text', array(
        'default'           => 'Semua Lowongan Kerja Aktif',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_btn1_text', array(
        'label'    => __( '[Slide 2] Teks Tombol 1 (Merah)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_btn1_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_btn1_url', array(
        'label'       => __( '[Slide 2] Link Target Tombol 1 (Kosongkan = otomatis ke halaman lowongan)', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_btn2_text', array(
        'default'           => 'Tanya Info Persyaratan via WA',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_btn2_text', array(
        'label'    => __( '[Slide 2] Teks Tombol 2 (WhatsApp)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_btn2_wa', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_btn2_wa', array(
        'label'       => __( '[Slide 2] Nomor WhatsApp Khusus (Opsional)', 'mojo-bootstrap' ),
        'description' => __( 'Kosongkan jika ingin memakai Nomor WhatsApp Kantor utama.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mojo_slide2_image', array(
        'label'       => __( '[Slide 2] Foto Samping (Model 2 Kolom)', 'mojo-bootstrap' ),
        'description' => __( 'Unggah foto jika ingin mengganti gambar default slide 2.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
    ) ) );

    $wp_customize->add_setting( 'mojo_slide2_tag_top', array(
        'default'           => 'Gaji ¥190.000 – ¥260.000 / Bulan',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_tag_top', array(
        'label'    => __( '[Slide 2] Teks Badge Atas Foto', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_tag_bottom', array(
        'default'           => 'Kontrak Resmi & Jaminan Perlindungan Penuh',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide2_tag_bottom', array(
        'label'    => __( '[Slide 2] Teks Card Bawah Foto', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide2_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mojo_slide2_bg', array(
        'label'       => __( '[Slide 2] Foto Latar Belakang Penuh (Opsional)', 'mojo-bootstrap' ),
        'description' => __( 'Unggah foto jika ingin latar belakang bergambar penuh (Full-Width), atau biarkan kosong untuk mode 2 kolom.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
    ) ) );

    // --- SLIDE 3 ---
    $wp_customize->add_setting( 'mojo_slide3_badge', array(
        'default'           => 'Pendidikan Intensif & Pendampingan Tokyo',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_badge', array(
        'label'    => __( '[Slide 3] Teks Badge Atas', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_title', array(
        'default'           => 'Dari Pelatihan Bahasa Hingga <span class="text-danger position-relative">Penempatan Aman</span>',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_title', array(
        'label'    => __( '[Slide 3] Judul Utama (H1)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_desc', array(
        'default'           => 'Bimbingan intensif ujian JLPT / JFT Basic dan skill teknis di Indonesia, dilanjutkan pendampingan langsung oleh tim representatif resmi kami yang berpusat di Tokyo.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_desc', array(
        'label'    => __( '[Slide 3] Subjudul / Deskripsi', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'textarea',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_btn1_text', array(
        'default'           => 'Daftar Konsultasi Sekarang',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_btn1_text', array(
        'label'    => __( '[Slide 3] Teks Tombol 1 (Merah)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_btn1_url', array(
        'default'           => '#konsultasi',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_btn1_url', array(
        'label'    => __( '[Slide 3] Link Target Tombol 1', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_btn2_text', array(
        'default'           => 'Profil Perusahaan (Tentang Kami)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_btn2_text', array(
        'label'    => __( '[Slide 3] Teks Tombol 2 (Outline)', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_btn2_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_btn2_url', array(
        'label'       => __( '[Slide 3] Link Target Tombol 2 (Kosongkan = otomatis ke Tentang Kami)', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mojo_slide3_image', array(
        'label'       => __( '[Slide 3] Foto Samping (Model 2 Kolom)', 'mojo-bootstrap' ),
        'description' => __( 'Unggah foto jika ingin mengganti gambar default slide 3.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
    ) ) );

    $wp_customize->add_setting( 'mojo_slide3_tag_top', array(
        'default'           => 'Kantor Perwakilan di Tokyo',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_tag_top', array(
        'label'    => __( '[Slide 3] Teks Badge Atas Foto', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_tag_bottom', array(
        'default'           => 'Bimbingan Bahasa JLPT / JFT Terpadu',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_slide3_tag_bottom', array(
        'label'    => __( '[Slide 3] Teks Card Bawah Foto', 'mojo-bootstrap' ),
        'section'  => 'mojo_hero_section',
        'type'     => 'text',
    ) );

    $wp_customize->add_setting( 'mojo_slide3_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mojo_slide3_bg', array(
        'label'       => __( '[Slide 3] Foto Latar Belakang Penuh (Opsional)', 'mojo-bootstrap' ),
        'description' => __( 'Unggah foto jika ingin latar belakang bergambar penuh (Full-Width), atau biarkan kosong untuk mode 2 kolom.', 'mojo-bootstrap' ),
        'section'     => 'mojo_hero_section',
    ) ) );

    // ==========================================
    // 3. SECTION: PENGATURAN FOOTER & HEADING
    // ==========================================
    $wp_customize->add_section( 'mojo_footer_section', array(
        'title'       => __( 'Pengaturan Footer & Warna', 'mojo-bootstrap' ),
        'priority'    => 27,
        'description' => __( 'Atur warna latar, warna teks, judul kolom (heading), deskripsi perusahaan, daftar sektor lowongan, dan hak cipta di bagian bawah website.', 'mojo-bootstrap' ),
    ) );

    // 3.0.1 Warna Latar Footer (Gradien Awal)
    $wp_customize->add_setting( 'mojo_footer_bg_color', array(
        'default'           => '#c9182b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mojo_footer_bg_color', array(
        'label'       => __( 'Warna Latar Footer (Gradien Utama)', 'mojo-bootstrap' ),
        'section'     => 'mojo_footer_section',
        'description' => __( 'Pilih warna dasar footer (default: Merah Korporat Jepang #c9182b).', 'mojo-bootstrap' ),
    ) ) );

    // 3.0.2 Warna Latar Footer (Gradien Akhir)
    $wp_customize->add_setting( 'mojo_footer_bg_color_end', array(
        'default'           => '#a01020',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mojo_footer_bg_color_end', array(
        'label'       => __( 'Warna Latar Footer (Gradien Akhir)', 'mojo-bootstrap' ),
        'section'     => 'mojo_footer_section',
        'description' => __( 'Pilih warna gradien akhir footer (default: Merah Gelap #a01020).', 'mojo-bootstrap' ),
    ) ) );

    // 3.0.3 Warna Teks Footer
    $wp_customize->add_setting( 'mojo_footer_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mojo_footer_text_color', array(
        'label'       => __( 'Warna Teks Footer', 'mojo-bootstrap' ),
        'section'     => 'mojo_footer_section',
        'description' => __( 'Pilih warna teks dan link pada footer (default: Putih #ffffff).', 'mojo-bootstrap' ),
    ) ) );

    // 3.1 Deskripsi Perusahaan di Footer (Kolom 1)
    $wp_customize->add_setting( 'mojo_footer_desc', array(
        'default'           => 'Lembaga Pengirim Resmi (Sending Organization) dan Job Matching Agency terpercaya yang menghubungkan talenta terampil Indonesia dengan perusahaan terkemuka di Jepang melalui program Tokutei Ginou (SSW).',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_footer_desc', array(
        'label'    => __( 'Deskripsi Perusahaan (Kolom 1)', 'mojo-bootstrap' ),
        'section'  => 'mojo_footer_section',
        'type'     => 'textarea',
    ) );

    // 3.2 Heading Kolom 2
    $wp_customize->add_setting( 'mojo_footer_col2_heading', array(
        'default'           => 'Tautan Cepat',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_footer_col2_heading', array(
        'label'    => __( 'Heading Kolom 2 (Tautan Halaman)', 'mojo-bootstrap' ),
        'section'  => 'mojo_footer_section',
        'type'     => 'text',
    ) );

    // 3.3 Heading Kolom 3
    $wp_customize->add_setting( 'mojo_footer_col3_heading', array(
        'default'           => 'Sektor Lowongan SSW',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_footer_col3_heading', array(
        'label'    => __( 'Heading Kolom 3 (Sektor Pekerjaan)', 'mojo-bootstrap' ),
        'section'  => 'mojo_footer_section',
        'type'     => 'text',
    ) );

    // 3.4 Daftar Sektor Lowongan Kolom 3
    $default_sectors = "Kaigo (Perawat Lansia Tokyo)\nPengolahan Makanan (Osaka)\nPertanian Modern (Hokkaido)\nManufaktur & Mesin (Nagoya)\nRestoran & Food Service\nKonstruksi Bangunan";
    $wp_customize->add_setting( 'mojo_footer_col3_items', array(
        'default'           => $default_sectors,
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_footer_col3_items', array(
        'label'       => __( 'Daftar Sektor Lowongan (1 baris per sektor)', 'mojo-bootstrap' ),
        'description' => __( 'Tuliskan nama sektor lowongan (satu per baris). Setiap item otomatis terhubung ke pencarian lowongan kerja aktif.', 'mojo-bootstrap' ),
        'section'     => 'mojo_footer_section',
        'type'        => 'textarea',
    ) );

    // 3.5 Heading Kolom 4
    $wp_customize->add_setting( 'mojo_footer_col4_heading', array(
        'default'           => 'Kontak & Kantor',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_footer_col4_heading', array(
        'label'    => __( 'Heading Kolom 4 (Kontak & Kantor)', 'mojo-bootstrap' ),
        'section'  => 'mojo_footer_section',
        'type'     => 'text',
    ) );

    // 3.6 Teks Copyright Footer
    $wp_customize->add_setting( 'mojo_footer_copyright', array(
        'default'           => 'Hak Cipta Dilindungi Undang-Undang.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_footer_copyright', array(
        'label'    => __( 'Teks Hak Cipta (Copyright)', 'mojo-bootstrap' ),
        'section'  => 'mojo_footer_section',
        'type'     => 'text',
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

    // ==========================================
    // 5. SECTION: KEMITRAAN & B2B (Banner Gelap)
    // ==========================================
    $wp_customize->add_section( 'mojo_b2b_section', array(
        'title'       => __( 'Pengaturan Kemitraan (Banner Gelap)', 'mojo-bootstrap' ),
        'priority'    => 29,
        'description' => __( 'Edit teks dan keunggulan pada bagian banner gelap (Kemitraan & Penempatan).', 'mojo-bootstrap' ),
    ) );

    // 5.1 Judul B2B
    $wp_customize->add_setting( 'mojo_b2b_title', array(
        'default'           => 'Kemitraan Resmi & Penyaluran Tenaga Kerja Kompeten ke Jepang',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_title', array(
        'label'    => __( 'Judul Utama Kemitraan', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'text',
    ) );

    // 5.2 Deskripsi B2B
    $wp_customize->add_setting( 'mojo_b2b_desc', array(
        'default'           => 'Kami menyeleksi dan membina talenta terbaik Indonesia dengan etos kerja tinggi, kedisiplinan, serta penguasaan bahasa & budaya Jepang. Melalui program Tokutei Ginou (SSW) di sektor Kaigo, Pengolahan Makanan, Pertanian, Manufaktur, dan Perhotelan, kami memastikan proses penempatan yang transparan, aman, dan terpercaya dengan dukungan kantor kami di Indonesia dan Tokyo.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_desc', array(
        'label'    => __( 'Deskripsi Kemitraan', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'textarea',
    ) );

    // 5.3 Tombol 1 Teks
    $wp_customize->add_setting( 'mojo_b2b_btn1_text', array(
        'default'           => 'Konsultasi Kemitraan & Penempatan →',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_btn1_text', array(
        'label'    => __( 'Teks Tombol 1 (Merah)', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'text',
    ) );

    // 5.4 Tombol 1 URL
    $wp_customize->add_setting( 'mojo_b2b_btn1_url', array(
        'default'           => '#konsultasi',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_btn1_url', array(
        'label'    => __( 'Link Target Tombol 1', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'text',
    ) );

    // 5.5 Tombol 2 Teks
    $wp_customize->add_setting( 'mojo_b2b_btn2_text', array(
        'default'           => 'Profil Perusahaan (Tentang Kami)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_btn2_text', array(
        'label'    => __( 'Teks Tombol 2 (Outline)', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'text',
    ) );

    // 5.6 Judul Kartu Keunggulan
    $wp_customize->add_setting( 'mojo_b2b_card_title', array(
        'default'           => 'Keunggulan Layanan Kami',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_card_title', array(
        'label'    => __( 'Judul Kartu Keunggulan (Kanan)', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'text',
    ) );

    // 5.7 Poin 1
    $wp_customize->add_setting( 'mojo_b2b_item1', array(
        'default'           => '<strong>Seleksi Ketat & Transparan:</strong> Menilai kepribadian, kesehatan fisik, dan kesiapan mental kerja.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_item1', array(
        'label'    => __( 'Poin Keunggulan 1', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'textarea',
    ) );

    // 5.8 Poin 2
    $wp_customize->add_setting( 'mojo_b2b_item2', array(
        'default'           => '<strong>Pendidikan Bahasa Intensif:</strong> Pemantapan standar JLPT / JFT A2 dengan fokus percakapan kerja aktif.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_item2', array(
        'label'    => __( 'Poin Keunggulan 2', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'textarea',
    ) );

    // 5.9 Poin 3
    $wp_customize->add_setting( 'mojo_b2b_item3', array(
        'default'           => '<strong>Pendampingan di Jepang:</strong> Kantor representatif di Tokyo siap memfasilitasi kebutuhan dan adaptasi pekerja.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'mojo_b2b_item3', array(
        'label'    => __( 'Poin Keunggulan 3', 'mojo-bootstrap' ),
        'section'  => 'mojo_b2b_section',
        'type'     => 'textarea',
    ) );
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
        __( '💼 Detail Lowongan Jepang (Job Order)', 'mojo-bootstrap' ),
        'mojo_bootstrap_render_job_meta_box',
        'post',
        'side',
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
    <div style="padding: 6px 0;">
        <p style="margin-bottom: 12px;">
            <label style="font-weight: 600; display: block; margin-bottom: 4px; font-size: 13px;">📍 Lokasi / Kota Jepang (Singkat):</label>
            <input type="text" name="_mojo_job_location" value="<?php echo esc_attr( $loc ); ?>" placeholder="Contoh: Tokyo, Osaka, Minato-ku, Hokkaido" style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #8c8f94; font-size: 13px; box-sizing: border-box;">
            <span style="color: #646970; font-size: 11px; display: block; margin-top: 3px;">Tuliskan nama kota atau prefektur singkat (maks. 2-3 kata).</span>
        </p>

        <p style="margin-bottom: 12px;">
            <label style="font-weight: 600; display: block; margin-bottom: 4px; font-size: 13px;">👥 Kuota Lowongan (Singkat):</label>
            <input type="text" name="_mojo_job_quota" value="<?php echo esc_attr( $quota ); ?>" placeholder="Contoh: 15 Kuota, 10 Orang" style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #8c8f94; font-size: 13px; box-sizing: border-box;">
            <span style="color: #646970; font-size: 11px; display: block; margin-top: 3px;">Tuliskan angka kuota singkat untuk lencana hijau di pojok kanan kartu.</span>
        </p>

        <p style="margin-bottom: 12px;">
            <label style="font-weight: 600; display: block; margin-bottom: 4px; font-size: 13px;">💴 Standar Gaji (Yen):</label>
            <input type="text" name="_mojo_job_salary_yen" value="<?php echo esc_attr( $yen ); ?>" placeholder="Contoh: ¥215,000 – ¥245,000" style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #8c8f94; font-size: 13px; box-sizing: border-box;">
        </p>

        <p style="margin-bottom: 6px;">
            <label style="font-weight: 600; display: block; margin-bottom: 4px; font-size: 13px;">💵 Estimasi Gaji (Rupiah):</label>
            <input type="text" name="_mojo_job_salary_idr" value="<?php echo esc_attr( $idr ); ?>" placeholder="Contoh: ± Rp 23 Juta – Rp 26 Juta/bln" style="width: 100%; padding: 6px 10px; border-radius: 4px; border: 1px solid #8c8f94; font-size: 13px; box-sizing: border-box;">
        </p>
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
 * Mendapatkan semua ID kategori yang termasuk kelompok Lowongan Kerja
 */
function mojo_get_job_category_ids() {
    $all_cats = get_categories( array( 'hide_empty' => false ) );
    $job_ids = array();
    $target_slugs = array( 'lowongan', 'lowongan-kerja', 'loker', 'job-order', 'jobs', 'job', 'tokutei-ginou', 'magang', 'ssw', 'titp', 'kaigo', 'pertanian', 'pengolahan-makanan', 'manufaktur' );

    foreach ( $all_cats as $cat ) {
        $name_lower = strtolower( $cat->name );
        $slug_lower = strtolower( $cat->slug );

        if ( in_array( $slug_lower, $target_slugs, true ) || strpos( $name_lower, 'lowongan' ) !== false || strpos( $name_lower, 'loker' ) !== false || strpos( $slug_lower, 'lowongan' ) !== false || strpos( $slug_lower, 'job' ) !== false ) {
            $job_ids[] = (int) $cat->term_id;
        }
    }
    return array_unique( $job_ids );
}

/**
 * Mendapatkan semua ID kategori yang termasuk kelompok Berita & Informasi
 */
function mojo_get_news_category_ids() {
    $all_cats = get_categories( array( 'hide_empty' => false ) );
    $news_ids = array();
    $target_slugs = array( 'berita', 'berita-terbaru', 'informasi', 'artikel', 'pengumuman', 'news', 'kegiatan', 'dokumentasi', 'testimoni', 'siswa', 'alumni' );

    foreach ( $all_cats as $cat ) {
        $name_lower = strtolower( $cat->name );
        $slug_lower = strtolower( $cat->slug );

        if ( in_array( $slug_lower, $target_slugs, true ) || strpos( $name_lower, 'berita' ) !== false || strpos( $name_lower, 'artikel' ) !== false || strpos( $name_lower, 'kegiatan' ) !== false || strpos( $name_lower, 'dokumentasi' ) !== false || strpos( $name_lower, 'informasi' ) !== false || strpos( $slug_lower, 'berita' ) !== false || strpos( $slug_lower, 'news' ) !== false ) {
            $news_ids[] = (int) $cat->term_id;
        }
    }
    return array_unique( $news_ids );
}

/**
 * Memeriksa apakah suatu postingan merupakan Lowongan Kerja atau Artikel Berita
 * Digunakan agar pos berita seperti 'Keberangkatan Siswa' tidak tercampur ke dalam daftar lowongan.
 */
function mojo_is_job_post( $post_id = 0 ) {
    $post = get_post( $post_id );
    if ( ! $post ) {
        return false;
    }

    $post_cat_ids = wp_get_post_categories( $post->ID );
    $job_cat_ids  = mojo_get_job_category_ids();
    $news_cat_ids = mojo_get_news_category_ids();

    // 1. Jika terdaftar di kategori Lowongan Kerja -> PASTI LOWONGAN
    if ( ! empty( array_intersect( $post_cat_ids, $job_cat_ids ) ) ) {
        return true;
    }

    // 2. Jika terdaftar di kategori Berita -> PASTI BERITA
    if ( ! empty( array_intersect( $post_cat_ids, $news_cat_ids ) ) ) {
        return false;
    }

    // 3. Cek judul: jika judul tentang keberangkatan/siswa/kegiatan/dokumentasi -> BUKAN LOWONGAN
    $title_lower = strtolower( $post->post_title );
    if ( preg_match( '/\b(keberangkatan|pelepasan|dokumentasi|kisah|testimoni|alumni|kegiatan|wisuda|panduan|tips|syarat visa)\b/i', $title_lower ) ) {
        return false;
    }

    // 4. Cek apakah ada meta khusus lowongan yang diisi
    $loc   = get_post_meta( $post->ID, '_mojo_job_location', true );
    $yen   = get_post_meta( $post->ID, '_mojo_job_salary_yen', true );
    $quota = get_post_meta( $post->ID, '_mojo_job_quota', true );
    if ( ! empty( $loc ) || ! empty( $yen ) || ! empty( $quota ) ) {
        return true;
    }

    // 5. Cek kata kunci lowongan pada judul
    if ( preg_match( '/\b(lowongan|job order|loker|rekrutmen|pertanian|kaigo|pengolahan makanan|manufaktur|ssw|titp)\b/i', $title_lower ) ) {
        return true;
    }

    // Default: jika tidak ada data lowongan sama sekali, jangan masukkan ke daftar lowongan
    return false;
}

/**
 * Memastikan kategori 'Lowongan Kerja' dan 'Berita & Informasi' selalu tersedia di WP-Admin
 * Serta secara otomatis merapikan pos 'Uncategorized' agar langsung masuk ke kategori yang tepat.
 */
function mojo_bootstrap_ensure_default_categories() {
    $job_cat_id = 0;
    $news_cat_id = 0;

    $job_term = get_term_by( 'slug', 'lowongan-kerja', 'category' );
    if ( ! $job_term ) {
        $job_term = get_term_by( 'slug', 'lowongan', 'category' );
    }
    if ( ! $job_term ) {
        $res = wp_insert_term( 'Lowongan Kerja', 'category', array( 'slug' => 'lowongan-kerja' ) );
        if ( ! is_wp_error( $res ) ) {
            $job_cat_id = $res['term_id'];
        }
    } else {
        $job_cat_id = $job_term->term_id;
    }

    $news_term = get_term_by( 'slug', 'berita', 'category' );
    if ( ! $news_term ) {
        $news_term = get_term_by( 'name', 'Berita', 'category' );
    }
    if ( ! $news_term ) {
        $res = wp_insert_term( 'Berita & Informasi', 'category', array( 'slug' => 'berita' ) );
        if ( ! is_wp_error( $res ) ) {
            $news_cat_id = $res['term_id'];
        }
    } else {
        $news_cat_id = $news_term->term_id;
    }

    // Otomatis sinkronisasi pos-pos yang masih 'Uncategorized' agar otomatis terpisah rapi
    $uncat = get_term_by( 'slug', 'uncategorized', 'category' );
    if ( $uncat ) {
        $uncat_posts = get_posts( array(
            'category'       => $uncat->term_id,
            'posts_per_page' => 50,
            'post_status'    => 'publish',
        ) );
        if ( ! empty( $uncat_posts ) ) {
            foreach ( $uncat_posts as $up ) {
                if ( mojo_is_job_post( $up->ID ) && $job_cat_id ) {
                    wp_set_post_categories( $up->ID, array( $job_cat_id ), false );
                } elseif ( $news_cat_id ) {
                    wp_set_post_categories( $up->ID, array( $news_cat_id ), false );
                }
            }
        }
    }
}
add_action( 'init', 'mojo_bootstrap_ensure_default_categories' );

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
