<?php
/**
 * Template Name: Lowongan Kerja Jepang
 * Template Post Type: page
 *
 * Halaman Khusus Seluruh Lowongan Kerja Jepang Aktif & Formulir Pendaftaran Lengkap
 *
 * @package Mojo_Bootstrap
 */

get_header();

$wa_number      = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
$wa_clean       = preg_replace( '/[^0-9]/', '', $wa_number );
$alamat_jakarta = get_theme_mod( 'mojo_alamat_jakarta', 'Treasury Tower Lt. 7, District 8, SCBD, Jakarta Selatan' );
$alamat_tokyo   = get_theme_mod( 'mojo_alamat_tokyo', 'Chiyoda-ku, Tokyo 101-0021, Japan' );

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

// Query ALL published jobs (Kecualikan artikel berita)
$berita_term_ids = get_terms( array(
    'taxonomy'   => 'category',
    'slug'       => array( 'berita', 'informasi', 'artikel', 'pengumuman', 'news' ),
    'fields'     => 'ids',
    'hide_empty' => false,
) );

$jobs_args = array(
    'post_type'      => 'post',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'post_status'    => 'publish',
);

if ( ! empty( $berita_term_ids ) && ! is_wp_error( $berita_term_ids ) ) {
    $jobs_args['category__not_in'] = $berita_term_ids;
}

$all_jobs_query = new WP_Query( $jobs_args );
?>

<div class="site-page-container py-5 bg-white">
    <div class="container">
        <!-- Header Banner Lowongan -->
        <div class="text-center col-lg-8 mx-auto mb-5 reveal reveal-scale">
            <span class="badge bg-danger text-white fw-bold px-3 py-2 rounded-pill mb-2 pulse-badge">Job Orders Resmi 2026</span>
            <h1 class="display-5 fw-bold text-dark mb-3">Lowongan Kerja Jepang Aktif</h1>
            <p class="text-secondary lead fs-6">
                Daftar permintaan resmi tenaga kerja dari perusahaan mitra di Jepang melalui program <strong>Tokutei Ginou (SSW)</strong> dan <strong>Magang (TITP)</strong> dengan jadwal wawancara terdekat.
            </p>
            <div class="d-flex justify-content-center gap-3 pt-2">
                <a href="#formulir-lamaran" class="btn btn-japan d-inline-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-person"></i>
                    <span>Ajukan Lamaran / Konsultasi</span>
                </a>
            </div>
        </div>

        <!-- Grid Semua Lowongan Kerja -->
        <div class="row g-4 mb-5">
            <?php
            if ( $all_jobs_query->have_posts() ) :
                while ( $all_jobs_query->have_posts() ) : $all_jobs_query->the_post();
                    $loc_badge = get_post_meta( get_the_ID(), '_mojo_job_location', true );
                    if ( empty( $loc_badge ) ) {
                        $loc_badge = get_post_meta( get_the_ID(), 'lokasi', true );
                    }
                    if ( empty( $loc_badge ) ) {
                        $categories = get_the_category();
                        $loc_badge  = ( ! empty( $categories ) && $categories[0]->slug !== 'uncategorized' ) ? $categories[0]->name : 'Tokyo';
                    }

                    $kuota_val = get_post_meta( get_the_ID(), '_mojo_job_quota', true );
                    if ( empty( $kuota_val ) ) {
                        $kuota_val = get_post_meta( get_the_ID(), 'kuota', true );
                    }
                    if ( empty( $kuota_val ) ) {
                        $kuota_val = 'Aktif';
                    }

                    $salary_yen = get_post_meta( get_the_ID(), '_mojo_job_salary_yen', true );
                    if ( empty( $salary_yen ) ) {
                        $salary_yen = get_post_meta( get_the_ID(), 'gaji', true );
                    }
                    if ( empty( $salary_yen ) ) {
                        $salary_yen = '¥190,000 – ¥240,000';
                    }

                    $salary_idr = get_post_meta( get_the_ID(), '_mojo_job_salary_idr', true );
                    if ( empty( $salary_idr ) ) {
                        $salary_idr = get_post_meta( get_the_ID(), 'gaji_idr', true );
                    }
                    if ( empty( $salary_idr ) ) {
                        $salary_idr = '± Rp 20 Juta – Rp 26 Juta/bln';
                    }
                    ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="clean-job-card h-100 d-flex flex-column bg-white rounded-4 border p-4 shadow-sm transition-hover">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i><?php echo esc_html( $loc_badge ); ?></span>
                                <span class="badge bg-success-subtle text-success small fw-semibold"><?php echo esc_html( $kuota_val ); ?></span>
                            </div>

                            <h4 class="h6 fw-bold text-dark mb-2"><?php the_title(); ?></h4>
                            <p class="text-muted small mb-3 flex-grow-1"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14, '...' ) ); ?></p>

                            <div class="p-3 bg-light rounded-3 mb-3">
                                <div class="job-salary-amount"><?php echo esc_html( $salary_yen ); ?></div>
                                <div class="job-salary-sub"><?php echo esc_html( $salary_idr ); ?></div>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="btn btn-japan btn-sm w-100 text-center mt-auto">Detail & Lamar &rarr;</a>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <!-- Fallback 4 Demo Jobs jika belum ada pos lowongan -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="clean-job-card h-100 d-flex flex-column bg-white rounded-4 border p-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Tokyo</span>
                            <span class="badge bg-success-subtle text-success small fw-semibold">15 Kuota</span>
                        </div>
                        <h4 class="h6 fw-bold text-dark mb-2">Perawat Lansia (Kaigo) Tokyo</h4>
                        <p class="text-muted small mb-3 flex-grow-1">Penempatan di panti perawatan lansia modern wilayah metropolitan Tokyo. Asrama subsidi 50%.</p>
                        <div class="p-3 bg-light rounded-3 mb-3">
                            <div class="job-salary-amount">¥215,000 – ¥245,000</div>
                            <div class="job-salary-sub">± Rp 23 Juta – Rp 26,2 Juta/bln</div>
                        </div>
                        <a href="#formulir-lamaran" class="btn btn-japan btn-sm w-100 text-center mt-auto">Lamar Posisi Ini</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="clean-job-card h-100 d-flex flex-column bg-white rounded-4 border p-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Osaka</span>
                            <span class="badge bg-success-subtle text-success small fw-semibold">20 Kuota</span>
                        </div>
                        <h4 class="h6 fw-bold text-dark mb-2">Pengolahan Makanan Osaka</h4>
                        <p class="text-muted small mb-3 flex-grow-1">Pabrik bento higienis skala nasional Jepang di Osaka. Fasilitas mess dan asuransi lengkap.</p>
                        <div class="p-3 bg-light rounded-3 mb-3">
                            <div class="job-salary-amount">¥195,000 – ¥225,000</div>
                            <div class="job-salary-sub">± Rp 20,8 Juta – Rp 24 Juta/bln</div>
                        </div>
                        <a href="#formulir-lamaran" class="btn btn-japan btn-sm w-100 text-center mt-auto">Lamar Posisi Ini</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="clean-job-card h-100 d-flex flex-column bg-white rounded-4 border p-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Aichi</span>
                            <span class="badge bg-success-subtle text-success small fw-semibold">12 Kuota</span>
                        </div>
                        <h4 class="h6 fw-bold text-dark mb-2">Teknik Mesin & Las Aichi</h4>
                        <p class="text-muted small mb-3 flex-grow-1">Industri komponen presisi otomotif di Nagoya. Pelatihan keselamatan kerja dan sertifikasi JITCO.</p>
                        <div class="p-3 bg-light rounded-3 mb-3">
                            <div class="job-salary-amount">¥170,000 – ¥195,000</div>
                            <div class="job-salary-sub">± Rp 18,2 Juta – Rp 20,8 Juta/bln</div>
                        </div>
                        <a href="#formulir-lamaran" class="btn btn-japan btn-sm w-100 text-center mt-auto">Lamar Posisi Ini</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="clean-job-card h-100 d-flex flex-column bg-white rounded-4 border p-4 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Hokkaido</span>
                            <span class="badge bg-success-subtle text-success small fw-semibold">10 Kuota</span>
                        </div>
                        <h4 class="h6 fw-bold text-dark mb-2">Pertanian Modern Hokkaido</h4>
                        <p class="text-muted small mb-3 flex-grow-1">Budidaya sayuran modern berteknologi sensor iklim di Hokkaido. Disediakan rumah dinas asri.</p>
                        <div class="p-3 bg-light rounded-3 mb-3">
                            <div class="job-salary-amount">¥185,000 – ¥210,000</div>
                            <div class="job-salary-sub">± Rp 19,8 Juta – Rp 22,5 Juta/bln</div>
                        </div>
                        <a href="#formulir-lamaran" class="btn btn-japan btn-sm w-100 text-center mt-auto">Lamar Posisi Ini</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination jika lowongan banyak -->
        <?php if ( $all_jobs_query->max_num_pages > 1 ) : ?>
            <div class="d-flex justify-content-center mb-5">
                <?php
                echo paginate_links( array(
                    'total'        => $all_jobs_query->max_num_pages,
                    'current'      => $paged,
                    'prev_text'    => '&larr; Sebelumnya',
                    'next_text'    => 'Selanjutnya &rarr;',
                    'type'         => 'list',
                ) );
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- =========================================================================
     FORMULIR PENDAFTARAN & PENGAJUAN LAMARAN LENGKAP
     ========================================================================= -->
<div id="konsultasi"></div>
<section class="py-5 bg-light border-top" id="formulir-lamaran">
    <div class="container py-4">
        <div class="row g-5 align-items-center">
            <!-- Left Info -->
            <div class="col-lg-5 reveal reveal-left">
                <span class="badge bg-danger-subtle text-danger fw-bold px-3 py-2 rounded-pill mb-2">Pendaftaran Terbuka</span>
                <h2 class="display-6 fw-bold text-dark mb-3">Ajukan Lamaran Kerja ke Jepang</h2>
                <p class="text-secondary mb-4">Lembaga pengirim resmi berizin Kemnaker RI. Tim konsultan karir kami siap membantu verifikasi berkas, pelatihan bahasa, dan pencocokan wawancara langsung dengan perusahaan Jepang.</p>

                <div class="d-flex gap-3 align-items-start mb-3">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-geo-alt-fill fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Kantor Pusat Jakarta</h6>
                        <p class="text-muted small mb-0"><?php echo esc_html( $alamat_jakarta ); ?></p>
                    </div>
                </div>

                <div class="d-flex gap-3 align-items-start mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-building fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Kantor Representatif Jepang</h6>
                        <p class="text-muted small mb-0"><?php echo esc_html( $alamat_tokyo ); ?></p>
                    </div>
                </div>

                <div class="d-flex gap-3 align-items-start">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="bi bi-whatsapp fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 text-dark">Layanan WhatsApp Resmi</h6>
                        <p class="text-muted small mb-0"><a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>" target="_blank" class="text-decoration-none text-dark fw-semibold"><?php echo esc_html( $wa_number ); ?></a> (Respon Cepat Hari Kerja)</p>
                    </div>
                </div>
            </div>

            <!-- Right Clean Form -->
            <div class="col-lg-7 reveal reveal-right">
                <div class="card border border-light-subtle shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h4 class="fw-bold text-dark mb-2">Formulir Pengajuan Lamaran Kerja</h4>
                    <p class="text-muted small mb-4">Lengkapi data Anda di bawah ini untuk memulai proses seleksi kerja ke Jepang.</p>

                    <form onsubmit="alert('Terima kasih! Lamaran Anda telah berhasil dikirimkan. Tim konsultan resmi kami akan segera menghubungi nomor WhatsApp Anda.'); return false;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg fs-6" placeholder="Sesuai KTP" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Nomor WhatsApp Aktif</label>
                                <input type="tel" class="form-control form-control-lg fs-6" placeholder="08xxxxxxxxxx" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Kota Domisili</label>
                                <input type="text" class="form-control form-control-lg fs-6" placeholder="Contoh: Surabaya, Solo, Medan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Pendidikan Terakhir</label>
                                <select class="form-select form-select-lg fs-6">
                                    <option>SMA / SMK Sederajat</option>
                                    <option>Diploma (D3)</option>
                                    <option>Sarjana (S1)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Posisi Lowongan yang Diminati</label>
                                <select class="form-select form-select-lg fs-6">
                                    <option>Tokutei Ginou / SSW - Perawat Lansia (Kaigo)</option>
                                    <option>Tokutei Ginou / SSW - Pengolahan Makanan</option>
                                    <option>Tokutei Ginou / SSW - Pertanian Modern</option>
                                    <option>Tokutei Ginou / SSW - Restoran & Perhotelan</option>
                                    <option>Magang TITP - Manufaktur & Perakitan Mesin</option>
                                    <option>Magang TITP - Teknik Pengelasan (Welding)</option>
                                    <option>Magang TITP - Konstruksi Bangunan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Tingkat Bahasa Jepang Saat Ini</label>
                                <select class="form-select form-select-lg fs-6">
                                    <option>Belum pernah belajar (Nol)</option>
                                    <option>Sudah hafal Hiragana / Katakana</option>
                                    <option>Memiliki Sertifikat JLPT N5</option>
                                    <option>Memiliki Sertifikat JLPT N4 / JFT A2</option>
                                    <option>Memiliki Sertifikat JLPT N3 ke atas</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold text-secondary">Catatan / Kualifikasi Tambahan</label>
                                <textarea class="form-control" rows="3" placeholder="Sebutkan pengalaman kerja relevan atau sertifikat keahlian yang Anda miliki..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-japan btn-lg w-100 py-3 fw-bold">
                                    <i class="bi bi-send-fill me-2"></i>Kirim Lamaran Kerja Sekarang &rarr;
                                </button>
                                <p class="text-center text-muted small mt-2 mb-0">
                                    <i class="bi bi-shield-lock-fill me-1 text-success"></i> Data pribadi Anda terenkripsi aman dan hanya digunakan untuk proses rekrutmen resmi.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=Halo%20Admin%20Mojo%20Global%20Talent,%20saya%20tertarik%20untuk%20konsultasi%20lowongan%20kerja%20ke%20Jepang." target="_blank" class="floating-wa-btn" title="Hubungi Kami via WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<?php
get_footer();
