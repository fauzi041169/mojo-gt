<?php
/**
 * Template Name: Halaman Tentang Kami (Corporate Profile)
 * Description: Template khusus halaman Tentang Kami yang profesional, elegan, dan berstandar korporat Jepang.
 *
 * @package Mojo_Bootstrap
 */

get_header();

// Informasi Kontak & Legalitas Terintegrasi dari Customizer
$wa_number      = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
$izin_text      = get_theme_mod( 'mojo_izin_kemnaker', 'KEP.000/MEN/2024' );
$alamat_jakarta = get_theme_mod( 'mojo_alamat_jakarta', 'Treasury Tower Lt. 7, District 8, Jl. Jenderal Sudirman Kav. 52-53, Jakarta 12190' );
$alamat_tokyo   = get_theme_mod( 'mojo_alamat_tokyo', 'Chiyoda-ku, Tokyo 101-0021, Japan' );
$wa_url         = function_exists( 'mojo_get_whatsapp_url' ) ? mojo_get_whatsapp_url( 'Halo Admin Mojo Global Talent, saya ingin konsultasi profil perusahaan dan kemitraan Tokutei Ginou (SSW).' ) : '#konsultasi';

// Data Pengaturan Halaman Tentang Kami
$about_badge     = get_theme_mod( 'mojo_about_hero_badge', 'Profil Perusahaan • 会社概要' );
$about_title     = get_theme_mod( 'mojo_about_hero_title', 'Membangun Ekosistem Kerja Global yang <span class="text-danger">Aman, Legal & Terpercaya</span>' );
$about_desc      = get_theme_mod( 'mojo_about_hero_desc', '<strong>PT. MOJO Global Talent</strong> menghubungkan talenta kompeten Indonesia dengan ratusan perusahaan terkemuka di Jepang melalui program resmi <strong>Tokutei Ginou (Specified Skilled Worker / SSW)</strong> dengan standar integritas dan pendampingan menyeluruh.' );
$about_mojo_desc = get_theme_mod( 'mojo_about_mojo_desc', 'Lahir dari filosofi <em>"Move to Job"</em> — sebuah komitmen mendalam untuk memfasilitasi mobilitas tenaga kerja lintas batas negara secara bermartabat, aman, dan memberi masa depan lebih cerah.' );

$misi_text       = get_theme_mod( 'mojo_about_misi_text', 'Membangun ekosistem kerja lintas negara yang terus berkembang di seluruh dunia dengan menciptakan peluang kerja yang lebih aman, lebih mudah, dan di lokasi yang paling tepat bagi para pencari kerja internasional.' );
$visi_text       = get_theme_mod( 'mojo_about_visi_text', 'Menjadi jembatan karier global terdepan dan tepercaya antara Indonesia dan Jepang yang memadukan keunggulan teknologi digital dengan pelayanan kemanusiaan yang berkesinambungan.' );
$nilai_text      = get_theme_mod( 'mojo_about_nilai_text', 'Bisnis yang kami jalankan bukan semata-mata mencari keuntungan finansial, melainkan berfokus pada pemenuhan kebutuhan masyarakat — memastikan setiap pekerja terlindungi haknya dan perusahaan Jepang memperoleh talenta terbaik.' );

$director_name   = get_theme_mod( 'mojo_about_director_name', 'Aditya Muriza Pratama' );
$director_role   = get_theme_mod( 'mojo_about_director_role', 'President Director' );
$director_photo  = get_theme_mod( 'mojo_about_director_photo', '' );
$director_title  = get_theme_mod( 'mojo_about_director_title', 'Mendampingi Langkah Nyata Talenta Indonesia Menuju Panggung Global' );
$director_msg    = get_theme_mod( 'mojo_about_director_msg', "Pekerja lintas negara (migran internasional) berjumlah sekitar 169 juta orang berdasarkan data statistik dunia, setara dengan 5% dari total angkatan kerja global. Peningkatan populasi lanjut usia dan penurunan angka kelahiran di negara-negara maju seperti Jepang telah menciptakan urgensi kebutuhan tenaga kerja yang sangat nyata.\n\nDi Jepang sendiri, kebutuhan tenaga kerja terampil asing terus meningkat pesat dan diproyeksikan membutuhkan hingga 4,19 juta pekerja pada tahun 2030. Namun, proses bekerja ke luar negeri sering kali menghadapi tantangan berat seperti kendala transparansi, biaya yang tidak wajar, hingga adaptasi bahasa dan budaya.\n\nMOJO Global Talent hadir sebagai solusi konkret: berdiri bersama talenta Indonesia, membina kompetensi bahasa dan teknis, serta memberikan pendampingan langsung baik sebelum berangkat maupun saat telah menetap dan berkarier di Jepang." );

$est_date        = get_theme_mod( 'mojo_about_est_date', '17 Desember 2024' );
$biz_field       = get_theme_mod( 'mojo_about_biz_field', 'Rekrutmen, Pelatihan Bahasa Intensif, dan Penempatan Resmi Tenaga Kerja ke Jepang (Khusus Program Tokutei Ginou / SSW).' );
?>

<!-- =========================================================================
     1. HERO HEADER: TENTANG KAMI
     ========================================================================= -->
<section class="about-hero-section py-5 position-relative overflow-hidden border-bottom">
    <div class="container py-4 py-lg-5 position-relative">
        <div class="row align-items-center g-4 g-lg-5">
            <!-- Left Info -->
            <div class="col-lg-7 text-center text-lg-start">
                <div class="mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-2 fw-semibold small pulse-badge d-inline-flex align-items-center gap-2">
                        <i class="bi bi-shield-check"></i>
                        <span><?php echo esc_html( $about_badge ); ?></span>
                    </span>
                </div>
                <h1 class="display-5 fw-bold text-dark mb-3">
                    <?php echo wp_kses_post( $about_title ); ?>
                </h1>
                <p class="lead text-secondary fs-6 mb-4 lh-lg">
                    <?php echo wp_kses_post( $about_desc ); ?>
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <a href="#profil-perusahaan" class="btn btn-japan btn-lg px-4 py-3 d-inline-flex align-items-center gap-2 shadow-sm">
                        <i class="bi bi-building"></i>
                        <span>Profil Legalitas</span>
                        <i class="bi bi-arrow-down"></i>
                    </a>
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" class="btn btn-japan-outline btn-lg px-4 py-3 d-inline-flex align-items-center gap-2 shadow-sm">
                        <i class="bi bi-whatsapp text-success fs-5"></i>
                        <span>Hubungi Tim Kami</span>
                    </a>
                </div>
            </div>

            <!-- Right Visual Card -->
            <div class="col-lg-5">
                <div class="about-brand-card p-4 p-md-5 bg-white rounded-4 border shadow-sm text-center">
                    <div class="mb-3 d-inline-block p-3 rounded-circle bg-light border">
                        <i class="bi bi-people-fill text-danger fs-1"></i>
                    </div>
                    <h3 class="fw-bold text-dark mb-2">Arti Nama &ldquo;MOJO&rdquo;</h3>
                    <div class="d-flex justify-content-center align-items-center gap-2 my-3">
                        <span class="badge bg-danger text-white fs-6 px-3 py-2 rounded-pill">MOVE</span>
                        <i class="bi bi-arrow-right text-muted"></i>
                        <span class="badge bg-dark text-white fs-6 px-3 py-2 rounded-pill">JOB</span>
                    </div>
                    <p class="text-muted small mb-0 lh-base">
                        <?php echo wp_kses_post( $about_mojo_desc ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. VISI, MISI & NILAI UTAMA (CARDS GRID)
     ========================================================================= -->
<section class="py-5 bg-light" id="visi-misi">
    <div class="container py-3">
        <div class="text-center col-lg-8 mx-auto mb-5">
            <span class="text-danger fw-bold text-uppercase small letter-spacing-1">Filosofi Perusahaan</span>
            <h2 class="h2 fw-bold text-dark mt-1">Visi, Misi & Prinsip Kerja</h2>
            <p class="text-muted">Landasan integritas kami dalam membina dan mendampingi tenaga kerja Indonesia menuju karier profesional di Jepang.</p>
        </div>

        <div class="row g-4">
            <!-- Misi -->
            <div class="col-lg-4">
                <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-compass-fill fs-4"></i>
                        </div>
                        <h4 class="h5 fw-bold text-dark mb-0">Misi Kami</h4>
                    </div>
                    <p class="text-secondary small lh-lg mb-0 flex-grow-1">
                        <?php echo wp_kses_post( $misi_text ); ?>
                    </p>
                </div>
            </div>

            <!-- Visi -->
            <div class="col-lg-4">
                <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-eye-fill fs-4"></i>
                        </div>
                        <h4 class="h5 fw-bold text-dark mb-0">Visi Kami</h4>
                    </div>
                    <p class="text-secondary small lh-lg mb-0 flex-grow-1">
                        <?php echo wp_kses_post( $visi_text ); ?>
                    </p>
                </div>
            </div>

            <!-- Nilai Inti -->
            <div class="col-lg-4">
                <div class="card h-100 p-4 border rounded-4 shadow-sm bg-white">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-award-fill fs-4"></i>
                        </div>
                        <h4 class="h5 fw-bold text-dark mb-0">Komitmen Layanan</h4>
                    </div>
                    <p class="text-secondary small lh-lg mb-0 flex-grow-1">
                        <?php echo wp_kses_post( $nilai_text ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. PESAN DIREKSI / SAMBUTAN PEMIMPIN (MESSAGE FROM DIRECTOR)
     ========================================================================= -->
<section class="py-5 bg-white border-top border-bottom" id="pesan-direksi">
    <div class="container py-3">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-4 text-center">
                <div class="director-card p-4 rounded-4 bg-light border shadow-sm">
                    <div class="director-avatar-box mx-auto mb-3 rounded-circle overflow-hidden bg-white border shadow-sm d-flex align-items-center justify-content-center" style="width: 170px; height: 170px;">
                        <?php if ( ! empty( $director_photo ) ) : ?>
                            <img src="<?php echo esc_url( $director_photo ); ?>" alt="<?php echo esc_attr( $director_name ); ?>" class="img-fluid w-100 h-100 object-fit-cover">
                        <?php else : ?>
                            <i class="bi bi-person-bounding-box text-secondary" style="font-size: 5rem;"></i>
                        <?php endif; ?>
                    </div>
                    <h5 class="fw-bold text-dark mb-1"><?php echo esc_html( $director_name ); ?></h5>
                    <span class="badge bg-danger-subtle text-danger small fw-semibold"><?php echo esc_html( $director_role ); ?></span>
                    <p class="text-muted small mt-2 mb-0">PT. MOJO Global Talent</p>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="ps-lg-3">
                    <span class="text-danger fw-bold text-uppercase small letter-spacing-1">Pesan Direksi &bull; 代表挨拶</span>
                    <h2 class="h3 fw-bold text-dark mt-1 mb-3"><?php echo esc_html( $director_title ); ?></h2>
                    
                    <div class="lh-lg text-secondary fs-6">
                        <?php echo wpautop( wp_kses_post( $director_msg ) ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     4. DATA INFORMASI LEGALITAS PERUSAHAAN (TABLE)
     ========================================================================= -->
<section class="py-5 bg-light" id="profil-perusahaan">
    <div class="container py-3">
        <div class="col-lg-9 mx-auto">
            <div class="text-center mb-4">
                <span class="text-danger fw-bold text-uppercase small letter-spacing-1">Informasi Korporat</span>
                <h2 class="h3 fw-bold text-dark mt-1">Data Perusahaan & Legalitas Resmi</h2>
                <p class="text-muted small">Transparansi badan hukum resmi PT. MOJO Global Talent di Indonesia dan representasi di Jepang.</p>
            </div>

            <div class="card border rounded-4 shadow-sm bg-white overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 corporate-profile-table">
                        <tbody>
                            <tr>
                                <th scope="row" class="bg-light text-secondary small text-uppercase" style="width: 28%;">Nama Perusahaan</th>
                                <td class="fw-bold text-dark">PT. MOJO Global Talent</td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light text-secondary small text-uppercase">Izin Resmi Kemnaker RI</th>
                                <td>
                                    <span class="badge bg-success-subtle text-success fw-bold px-3 py-1.5 rounded-pill">
                                        <i class="bi bi-patch-check-fill me-1"></i> No: <?php echo esc_html( $izin_text ); ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light text-secondary small text-uppercase">Akreditasi & Afiliasi</th>
                                <td class="small text-secondary">
                                    <div class="mb-1">&bull; Terakreditasi Lembaga Pelatihan Kerja (LA-LPK)</div>
                                    <div class="mb-1">&bull; Terdaftar Sending Organization (SO) OTIT & JITCO Jepang</div>
                                    <div>&bull; Jaringan Kemitraan 180+ Kumiai / Kaisha di 47 Prefektur</div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light text-secondary small text-uppercase">Pimpinan / Direksi</th>
                                <td class="text-dark fw-medium"><?php echo esc_html( $director_name ); ?> (<?php echo esc_html( $director_role ); ?>)</td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light text-secondary small text-uppercase">Tanggal Pendirian</th>
                                <td class="text-dark"><?php echo esc_html( $est_date ); ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light text-secondary small text-uppercase">Bidang Usaha</th>
                                <td class="text-dark">
                                    <?php echo esc_html( $biz_field ); ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light text-secondary small text-uppercase">Alamat Kantor Jakarta</th>
                                <td class="text-dark small lh-base">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                    <?php echo esc_html( $alamat_jakarta ); ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light text-secondary small text-uppercase">Kantor Perwakilan Tokyo</th>
                                <td class="text-dark small lh-base">
                                    <i class="bi bi-building text-primary me-1"></i>
                                    <?php echo esc_html( $alamat_tokyo ); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     5. LOKASI KANTOR & PETA INTERAKTIF
     ========================================================================= -->
<section class="py-5 bg-white border-top" id="lokasi-akses">
    <div class="container py-3">
        <div class="text-center col-lg-8 mx-auto mb-4">
            <span class="text-danger fw-bold text-uppercase small letter-spacing-1">Akses & Lokasi</span>
            <h2 class="h3 fw-bold text-dark mt-1">Kunjungi Kantor Operasional Kami</h2>
            <p class="text-muted small">Terbuka untuk konsultasi langsung kandidat pekerja, keluarga, dan mitra kemitraan industri.</p>
        </div>

        <div class="card border rounded-4 shadow-sm overflow-hidden bg-white">
            <div class="row g-0">
                <div class="col-lg-4 p-4 p-md-5 d-flex flex-column justify-content-center bg-light border-end">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Kantor Pusat Operasional</h5>
                    <p class="text-secondary small lh-lg mb-4">
                        <?php echo esc_html( $alamat_jakarta ); ?>
                    </p>

                    <h6 class="fw-bold text-dark mb-2"><i class="bi bi-clock-fill text-danger me-2"></i>Jam Operasional</h6>
                    <p class="text-muted small mb-4">
                        Senin &ndash; Jumat: 08.30 &ndash; 17.00 WIB<br>
                        Sabtu &amp; Minggu: Tutup (Konsultasi via WhatsApp tetap dilayani)
                    </p>

                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" class="btn btn-japan w-100 py-2.5 d-inline-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-whatsapp"></i>
                        <span>Buat Janji Kunjungan</span>
                    </a>
                </div>

                <div class="col-lg-8">
                    <div class="ratio ratio-16x9 h-100" style="min-height: 380px;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2319.1837098160804!2d106.80525011708332!3d-6.22776698075685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1501c266ded%3A0x64de2dde0e156f4!2zVFJFQVNVUlkgVE9XRVIsIFNlbmF5YW4sIEtlYy4gS2J5LiBCYXJ1LCBLb3RhIEpha2FydGEgU2VsYXRhbiwgRGFlcmFoIEtodXN1cyBJYnVrb3RhIEpha2FydGE!5e0!3m2!1sid!2sid!4v1765526002404!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. EDITABLE GUTENBERG CONTENT FALLBACK
     (Jika admin ingin menambahkan teks kustom via Editor Halaman WP-Admin)
     ========================================================================= -->
<?php
$raw_content = get_the_content();
if ( ! empty( trim( strip_tags( $raw_content ) ) ) ) :
?>
<section class="py-5 bg-light border-top">
    <div class="container">
        <div class="card p-4 p-md-5 border rounded-4 shadow-sm bg-white">
            <div class="entry-content lh-lg text-secondary fs-6">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
get_footer();
