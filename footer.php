<?php
/**
 * Footer template for Mojo Bootstrap - Japan Recruitment Corporate
 *
 * @package Mojo_Bootstrap
 */

$wa_number      = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
$wa_clean       = preg_replace( '/[^0-9]/', '', $wa_number );
$izin_text      = get_theme_mod( 'mojo_izin_kemnaker', 'KEP.000/MEN/2024' );
$alamat_jakarta = get_theme_mod( 'mojo_alamat_jakarta', 'Gedung Talent Center Lt. 3, Jl. Gatot Subroto Kav. 88, Jakarta Selatan' );
$alamat_tokyo   = get_theme_mod( 'mojo_alamat_tokyo', 'Chiyoda-ku, Tokyo 101-0021, Japan' );
?>
</main><!-- #main-content -->

<footer class="site-footer pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row g-4 pb-4">
            <!-- Col 1: About & Legal -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 38px; height: 38px; font-size: 1.1rem;">
                        JP
                    </div>
                    <span class="fs-5 fw-bold text-white"><?php bloginfo( 'name' ); ?></span>
                </div>
                <p class="text-white text-opacity-90 small mb-3">
                    Lembaga Pengirim Resmi (Sending Organization) dan Job Matching Agency terpercaya yang menghubungkan talenta terampil Indonesia dengan perusahaan terkemuka di Jepang melalui program <strong>Tokutei Ginou (SSW)</strong>.
                </p>
                <div class="p-3 rounded-3 bg-black bg-opacity-20 border border-white border-opacity-25 small text-white">
                    <div class="fw-bold mb-1"><i class="bi bi-shield-check text-warning me-1"></i> Legalitas Resmi:</div>
                    <div class="text-white text-opacity-90 small">&bull; Izin Kemnaker RI No: <?php echo esc_html( $izin_text ); ?></div>
                    <div class="text-white text-opacity-90 small">&bull; Terdaftar OTIT Jepang (送出し機関番号: IDN000xxx)</div>
                    <div class="text-white text-opacity-90 small">&bull; Akreditasi Lembaga Pelatihan Kerja (LA-LPK)</div>
                </div>
            </div>

            <!-- Col 2: Program & Tautan Cepat -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase small letter-spacing-1">Tautan Cepat</h6>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/lowongan-kerja/' ) ); ?>" class="footer-link">Lowongan Kerja (SSW)</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#job-orders' ) ); ?>" class="footer-link">Job Order Terbaru</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#alur-proses' ) ); ?>" class="footer-link">Alur & Syarat Proses</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#konsultasi' ) ); ?>" class="footer-link">Konsultasi Pendaftaran</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/berita/' ) ); ?>" class="footer-link">Berita & Informasi</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/tentang-kami/' ) ); ?>" class="footer-link">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Col 3: Sektor Pekerjaan -->
            <div class="col-lg-3 col-md-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase small letter-spacing-1">Sektor Lowongan</h6>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#job-orders' ) ); ?>" class="footer-link">Kaigo (Perawat Lansia Tokyo)</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#job-orders' ) ); ?>" class="footer-link">Pengolahan Makanan (Osaka)</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#job-orders' ) ); ?>" class="footer-link">Pertanian Modern (Hokkaido)</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#job-orders' ) ); ?>" class="footer-link">Manufaktur & Mesin (Nagoya)</a></li>
                    <li class="mb-2"><a href="<?php echo esc_url( home_url( '/#job-orders' ) ); ?>" class="footer-link">Konstruksi & Pengelasan</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#job-orders' ) ); ?>" class="footer-link">Restoran & Pelayanan Makanan</a></li>
                </ul>
            </div>

            <!-- Col 4: Alamat & Kontak -->
            <div class="col-lg-3 col-md-6">
                <h6 class="text-white fw-bold mb-3 text-uppercase small letter-spacing-1">Kontak & Kantor</h6>
                
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <div>
                        <strong class="text-white d-block">Kantor Pusat Jakarta:</strong>
                        <span><?php echo esc_html( $alamat_jakarta ); ?></span>
                    </div>
                </div>

                <div class="footer-contact-item">
                    <i class="bi bi-building"></i>
                    <div>
                        <strong class="text-white d-block">Kantor Cabang Jepang:</strong>
                        <span><?php echo esc_html( $alamat_tokyo ); ?></span>
                    </div>
                </div>

                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <div>
                        <strong class="text-white d-block">Hotline & WhatsApp:</strong>
                        <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>" target="_blank" class="text-white text-decoration-none fw-semibold"><?php echo esc_html( $wa_number ); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-white border-opacity-25 my-3">

        <div class="row align-items-center small text-white text-opacity-80">
            <div class="col-md-7 text-center text-md-start mb-2 mb-md-0">
                <p class="mb-0">
                    &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <strong class="text-white"><?php bloginfo( 'name' ); ?></strong> &bull; Hak Cipta Dilindungi Undang-Undang.
                </p>
            </div>
            <div class="col-md-5 text-center text-md-end">
                <span class="me-3"><a href="<?php echo esc_url( home_url( '/kebijakan-privasi/' ) ); ?>" class="text-white text-decoration-none">Kebijakan Privasi</a></span>
                <span><a href="<?php echo esc_url( home_url( '/tentang-kami/' ) ); ?>" class="text-white text-decoration-none">Tentang Kami</a></span>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
