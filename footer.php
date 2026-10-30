<?php
/**
 * Footer template for Mojo Bootstrap - Japan Recruitment Corporate
 *
 * @package Mojo_Bootstrap
 */

$wa_number      = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
$wa_clean       = function_exists( 'mojo_clean_whatsapp_number' ) ? mojo_clean_whatsapp_number( $wa_number ) : preg_replace( '/[^0-9]/', '', $wa_number );
$wa_url         = function_exists( 'mojo_get_whatsapp_url' ) ? mojo_get_whatsapp_url( 'Halo Admin Mojo Global Talent, saya ingin konsultasi seputar kerja di Jepang.' ) : ( 'https://wa.me/' . $wa_clean );
$izin_text      = get_theme_mod( 'mojo_izin_kemnaker', 'KEP.000/MEN/2024' );
$alamat_jakarta = get_theme_mod( 'mojo_alamat_jakarta', 'Gedung Talent Center Lt. 3, Jl. Gatot Subroto Kav. 88, Jakarta Selatan' );
$alamat_tokyo   = get_theme_mod( 'mojo_alamat_tokyo', 'Chiyoda-ku, Tokyo 101-0021, Japan' );

// Customizer Footer Settings
$footer_bg_color     = get_theme_mod( 'mojo_footer_bg_color', '#c9182b' );
$footer_bg_color_end = get_theme_mod( 'mojo_footer_bg_color_end', '#a01020' );
$footer_text_color   = get_theme_mod( 'mojo_footer_text_color', '#ffffff' );
$footer_desc         = get_theme_mod( 'mojo_footer_desc', 'Lembaga Pengirim Resmi (Sending Organization) dan Job Matching Agency terpercaya yang menghubungkan talenta terampil Indonesia dengan perusahaan terkemuka di Jepang melalui program <strong>Tokutei Ginou (SSW)</strong>.' );
$footer_col2_heading = get_theme_mod( 'mojo_footer_col2_heading', 'Tautan Cepat' );
$footer_col3_heading = get_theme_mod( 'mojo_footer_col3_heading', 'Sektor Lowongan SSW' );
$default_sectors     = "Kaigo (Perawat Lansia Tokyo)\nPengolahan Makanan (Osaka)\nPertanian Modern (Hokkaido)\nManufaktur & Mesin (Nagoya)\nRestoran & Food Service\nKonstruksi Bangunan";
$footer_col3_items   = get_theme_mod( 'mojo_footer_col3_items', $default_sectors );
$footer_col4_heading = get_theme_mod( 'mojo_footer_col4_heading', 'Kontak & Kantor' );
$footer_copyright    = get_theme_mod( 'mojo_footer_copyright', 'Hak Cipta Dilindungi Undang-Undang.' );

// Resolusi Halaman-Halaman Dinamis
$jobs_page = get_page_by_path( 'lowongan-kerja' );
if ( ! $jobs_page ) {
    $jobs_page = get_page_by_title( 'Lowongan Kerja', OBJECT, 'page' );
}
if ( ! $jobs_page ) {
    $jobs_page = get_page_by_title( 'LOWONGAN KERJA', OBJECT, 'page' );
}
$jobs_url = $jobs_page ? get_permalink( $jobs_page->ID ) : home_url( '/lowongan-kerja/' );

$about_page = get_page_by_path( 'tentang-kami' );
if ( ! $about_page ) {
    $about_page = get_page_by_title( 'Tentang Kami', OBJECT, 'page' );
}
if ( ! $about_page ) {
    $about_page = get_page_by_title( 'TENTANG KAMI', OBJECT, 'page' );
}
$about_url = $about_page ? get_permalink( $about_page->ID ) : home_url( '/tentang-kami/' );

$news_page = get_page_by_path( 'berita' );
if ( ! $news_page ) {
    $news_page = get_page_by_title( 'Berita', OBJECT, 'page' );
}
if ( ! $news_page ) {
    $news_page = get_page_by_title( 'BERITA', OBJECT, 'page' );
}
$news_url = $news_page ? get_permalink( $news_page->ID ) : ( get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/berita/' ) );

$privacy_url = function_exists( 'get_privacy_policy_url' ) && get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/kebijakan-privasi/' );
?>
</main><!-- #main-content -->

<footer class="site-footer pt-5 pb-4 mt-auto" style="background: linear-gradient(135deg, <?php echo esc_attr( $footer_bg_color ); ?> 0%, <?php echo esc_attr( $footer_bg_color_end ); ?> 100%) !important; color: <?php echo esc_attr( $footer_text_color ); ?> !important;">
    <div class="container">
        <div class="row g-4 pb-4">
            <!-- Col 1: About & Legalitas -->
            <div class="col-lg-4 col-md-6 reveal reveal-up delay-100 is-visible">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; font-size: 1.1rem;">
                        JP
                    </div>
                    <span class="fs-5 fw-bold text-white"><?php bloginfo( 'name' ); ?></span>
                </div>
                <div class="text-white text-opacity-90 small mb-3">
                    <?php echo wp_kses_post( $footer_desc ); ?>
                </div>
                <div class="p-3 rounded-3 bg-black bg-opacity-20 border border-white border-opacity-25 small text-white">
                    <div class="fw-bold mb-1"><i class="bi bi-shield-check text-warning me-1"></i> Legalitas Resmi:</div>
                    <div class="text-white text-opacity-90 small">&bull; Izin Kemnaker RI No: <?php echo esc_html( $izin_text ); ?></div>
                    <div class="text-white text-opacity-90 small">&bull; Terdaftar OTIT Jepang (送出し機関番号: IDN000xxx)</div>
                    <div class="text-white text-opacity-90 small">&bull; Akreditasi Lembaga Pelatihan Kerja (LA-LPK)</div>
                </div>
            </div>

            <!-- Col 2: Heading & Tautan Cepat -->
            <div class="col-lg-2 col-md-6 reveal reveal-up delay-200 is-visible">
                <h6 class="text-white fw-bold mb-3 text-uppercase small letter-spacing-1"><?php echo esc_html( $footer_col2_heading ); ?></h6>
                <?php
                if ( has_nav_menu( 'footer' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'list-unstyled small mb-0 footer-nav-menu',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ) );
                else :
                ?>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-link">Beranda</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( $jobs_url ); ?>" class="footer-link">Lowongan Kerja (SSW)</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#alur-proses' ) ); ?>" class="footer-link">Alur & Syarat Proses</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( ( is_front_page() || is_page( 'lowongan-kerja' ) ) ? '#konsultasi' : home_url( '/#konsultasi' ) ); ?>" class="footer-link">Konsultasi Pendaftaran</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( $news_url ); ?>" class="footer-link">Berita & Informasi</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( $about_url ); ?>" class="footer-link">Tentang Kami</a></li>
                    <li><a href="<?php echo esc_url( $privacy_url ); ?>" class="footer-link">Kebijakan Privasi</a></li>
                </ul>
                <?php endif; ?>
            </div>

            <!-- Col 3: Heading & Sektor Lowongan Dinamis -->
            <div class="col-lg-3 col-md-6 reveal reveal-up delay-300 is-visible">
                <h6 class="text-white fw-bold mb-3 text-uppercase small letter-spacing-1"><?php echo esc_html( $footer_col3_heading ); ?></h6>
                <ul class="list-unstyled small mb-0">
                    <?php
                    $sector_lines = array_filter( array_map( 'trim', explode( "\n", str_replace( "\r", '', $footer_col3_items ) ) ) );
                    foreach ( $sector_lines as $sector_line ) :
                        $clean_term = trim( preg_replace( '/\s*\(.*?\)/', '', $sector_line ) );
                        $sector_url = esc_url( add_query_arg( 's', rawurlencode( $clean_term ), $jobs_url ) );
                    ?>
                        <li class="mb-2">
                            <a href="<?php echo esc_url( $sector_url ); ?>" class="footer-link d-inline-flex align-items-center gap-1">
                                <i class="bi bi-chevron-right text-warning small" style="font-size: 0.75rem;"></i>
                                <span><?php echo esc_html( $sector_line ); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Col 4: Heading & Alamat/Kontak -->
            <div class="col-lg-3 col-md-6 reveal reveal-up delay-400 is-visible">
                <h6 class="text-white fw-bold mb-3 text-uppercase small letter-spacing-1"><?php echo esc_html( $footer_col4_heading ); ?></h6>
                
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill text-warning"></i>
                    <div>
                        <strong class="text-white d-block small">Kantor Pusat Jakarta:</strong>
                        <span class="small text-white text-opacity-90"><?php echo esc_html( $alamat_jakarta ); ?></span>
                    </div>
                </div>

                <div class="footer-contact-item">
                    <i class="bi bi-building text-warning"></i>
                    <div>
                        <strong class="text-white d-block small">Kantor Representatif Jepang:</strong>
                        <span class="small text-white text-opacity-90"><?php echo esc_html( $alamat_tokyo ); ?></span>
                    </div>
                </div>

                <div class="footer-contact-item">
                    <i class="bi bi-whatsapp text-success"></i>
                    <div>
                        <strong class="text-white d-block small">Hotline WhatsApp Resmi:</strong>
                        <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" class="text-white text-decoration-none fw-semibold" title="Buka Chat WhatsApp"><?php echo esc_html( $wa_number ); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-white border-opacity-25 my-3">

        <div class="row align-items-center small text-white text-opacity-80">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <p class="mb-0">
                    &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <strong class="text-white"><?php bloginfo( 'name' ); ?></strong> &bull; <?php echo esc_html( $footer_copyright ); ?>
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="me-3"><a href="<?php echo esc_url( $privacy_url ); ?>" class="text-white text-decoration-none">Kebijakan Privasi</a></span>
                <span class="me-3"><a href="<?php echo esc_url( $about_url ); ?>" class="text-white text-decoration-none">Tentang Kami</a></span>
                <span><a href="<?php echo esc_url( $jobs_url ); ?>" class="text-white text-decoration-none">Lowongan Kerja</a></span>
            </div>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Button (Aktif di Semua Halaman) -->
<a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" class="floating-wa-btn" title="Hubungi Kami via WhatsApp" aria-label="Konsultasi WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<?php wp_footer(); ?>
</body>
</html>
