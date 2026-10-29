<?php
/**
 * Front page template - Clean & Simple Premium Japanese Recruitment Corporate
 * Concept: Kanso (Simplicity) & Shibui (Subtle Elegance)
 *
 * @package Mojo_Bootstrap
 */

$wa_number      = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
$wa_clean       = preg_replace( '/[^0-9]/', '', $wa_number );
$izin_text      = get_theme_mod( 'mojo_izin_kemnaker', 'KEP.000/MEN/2024' );
$alamat_jakarta = get_theme_mod( 'mojo_alamat_jakarta', 'Gedung Talent Center Lt. 3, Jl. Gatot Subroto Kav. 88, Jakarta Selatan' );
$alamat_tokyo   = get_theme_mod( 'mojo_alamat_tokyo', 'Chiyoda-ku, Tokyo 101-0021, Japan' );

// Hero Customizer Settings
$hero_badge    = get_theme_mod( 'mojo_hero_badge', 'Sending Organization Resmi Berizin Kemnaker RI No: ' . $izin_text );
$hero_title    = get_theme_mod( 'mojo_hero_title', 'Raih Karir Profesional & Masa Depan di <span class="text-danger position-relative">Jepang</span>' );
$hero_subtitle = get_theme_mod( 'mojo_hero_subtitle', 'Lembaga pengirim resmi (*Sending Organization*) dan *Job Matching Specialist* terpercaya. Menghubungkan talenta kompeten Indonesia dengan ratusan perusahaan terkemuka di Jepang melalui program <strong>Tokutei Ginou (SSW)</strong> dan <strong>Magang (TITP)</strong>.' );
$btn1_text     = get_theme_mod( 'mojo_hero_btn1_text', 'Lihat Job Order Terbaru' );
$btn1_url      = get_theme_mod( 'mojo_hero_btn1_url', '#job-orders' );
$btn2_text     = get_theme_mod( 'mojo_hero_btn2_text', 'Konsultasi WhatsApp Cepat' );

// Program Settings
$program_sec_title = get_theme_mod( 'mojo_program_section_title', 'Pilih Jalur Karir yang Sesuai untuk Anda' );

// SSW
$ssw_title    = get_theme_mod( 'mojo_ssw_title', 'Tokutei Ginou (SSW)' );
$ssw_desc     = get_theme_mod( 'mojo_ssw_desc', 'Pekerja Berketerampilan Spesifik (特定技能) dengan standar hak, perlindungan kerja, dan gaji setara dengan tenaga kerja lokal Jepang.' );
$ssw_gaji_yen = get_theme_mod( 'mojo_ssw_gaji_yen', '¥190,000 – ¥260,000' );
$ssw_gaji_idr = get_theme_mod( 'mojo_ssw_gaji_idr', 'Rp 20.000.000 – Rp 28.000.000 / bln' );
$ssw_sektor   = get_theme_mod( 'mojo_ssw_sektor', 'Kaigo (Perawat Lansia), Pengolahan Makanan, Pertanian Modern, Restoran & Perhotelan' );

// TITP
$titp_title    = get_theme_mod( 'mojo_titp_title', 'Magang Jepang (TITP)' );
$titp_desc     = get_theme_mod( 'mojo_titp_desc', 'Program Pemagangan Teknis (技能実習) untuk alih teknologi industri manufaktur termaju, didukung sertifikat resmi dan dana purna magang.' );
$titp_gaji_yen = get_theme_mod( 'mojo_titp_gaji_yen', '¥150,000 – ¥190,000' );
$titp_gaji_idr = get_theme_mod( 'mojo_titp_gaji_idr', 'Rp 16.000.000 – Rp 20.000.000 / bln' );
$titp_sektor   = get_theme_mod( 'mojo_titp_sektor', 'Manufaktur & Mesin, Teknik Pengelasan (Welding), Konstruksi Bangunan, Tekstil & Garmen' );

// Stats Settings
$stat1_num   = get_theme_mod( 'mojo_stat1_num', '180+' );
$stat1_label = get_theme_mod( 'mojo_stat1_label', 'Mitra Perusahaan Jepang' );
$stat2_num   = get_theme_mod( 'mojo_stat2_num', '98.4%' );
$stat2_label = get_theme_mod( 'mojo_stat2_label', 'Kelulusan JLPT / JFT Basic' );
$stat3_num   = get_theme_mod( 'mojo_stat3_num', '47' );
$stat3_label = get_theme_mod( 'mojo_stat3_label', 'Prefektur Penempatan Kerja' );

get_header();
?>

<!-- =========================================================================
     1. HERO SECTION - CLEAN, SPACIOUS, PREMIUM
     ========================================================================= -->
<section class="clean-hero text-center">
    <div class="container">
        <!-- Trust Status Pill -->
        <div class="mb-4 reveal reveal-scale">
            <span class="hero-pill-badge pulse-badge">
                <i class="bi bi-patch-check-fill text-danger"></i> Lembaga Pengirim Resmi &bull; Kemnaker RI & OTIT Jepang
            </span>
        </div>

        <!-- Main Title -->
        <h1 class="hero-main-title mb-4 reveal reveal-up delay-100">
            <?php echo wp_kses_post( $hero_title ); ?>
        </h1>

        <!-- Subtitle -->
        <p class="hero-lead-text mb-5 reveal reveal-up delay-200">
            <?php echo wp_kses_post( $hero_subtitle ); ?>
        </p>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-center gap-3 flex-column flex-sm-row mb-5 reveal reveal-up delay-300">
            <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn btn-japan btn-lg px-4 py-3 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-briefcase-fill"></i>
                <span><?php echo esc_html( $btn1_text ); ?></span>
                <i class="bi bi-arrow-right"></i>
            </a>
            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=Halo%20Admin%20Mojo%20Global%20Talent,%20saya%20tertarik%20untuk%20konsultasi%20program%20kerja%20ke%20Jepang." target="_blank" class="btn btn-japan-outline btn-lg px-4 py-3 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-whatsapp text-success fs-5"></i>
                <span><?php echo esc_html( $btn2_text ); ?></span>
            </a>
        </div>

        <!-- Trust Badges Line -->
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-4 text-secondary small pt-2 reveal reveal-fade delay-400">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-danger"></i>
                <span class="fw-medium">Terakreditasi LA-LPK</span>
            </div>
            <span class="text-muted d-none d-sm-inline">&bull;</span>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-shield-fill-check text-danger"></i>
                <span class="fw-medium">Mitra Resmi OTIT & JITCO Jepang</span>
            </div>
            <span class="text-muted d-none d-sm-inline">&bull;</span>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-building-check text-danger"></i>
                <span class="fw-medium">Jaringan 180+ Kumiai / Kaisha</span>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     2. STATS COUNTER STRIP
     ========================================================================= -->
<section class="py-4">
    <div class="container">
        <div class="stats-clean-strip reveal reveal-scale">
            <div class="row text-center g-3">
                <div class="col-6 col-md-3 stat-clean-item">
                    <div class="stat-clean-number">1,250<span class="text-danger">+</span></div>
                    <div class="stat-clean-label">Pekerja Diberangkatkan</div>
                </div>
                <div class="col-6 col-md-3 stat-clean-item">
                    <div class="stat-clean-number"><?php echo esc_html( $stat1_num ); ?></div>
                    <div class="stat-clean-label"><?php echo esc_html( $stat1_label ); ?></div>
                </div>
                <div class="col-6 col-md-3 stat-clean-item">
                    <div class="stat-clean-number"><?php echo esc_html( $stat2_num ); ?></div>
                    <div class="stat-clean-label"><?php echo esc_html( $stat2_label ); ?></div>
                </div>
                <div class="col-6 col-md-3 stat-clean-item">
                    <div class="stat-clean-number"><?php echo esc_html( $stat3_num ); ?></div>
                    <div class="stat-clean-label"><?php echo esc_html( $stat3_label ); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     3. PROGRAM UTAMA - FOKUS 2 JALUR KARIR BESAR
     ========================================================================= -->
<section class="py-5" id="program-kerja">
    <div class="container py-3">
        <div class="text-center col-lg-7 mx-auto mb-5 reveal reveal-up">
            <h2 class="h2 fw-bold text-dark"><?php echo esc_html( $program_sec_title ); ?></h2>
            <p class="text-muted">Proses resmi, transparan, dan terproteksi di bawah pengawasan Kemnaker RI dan Badan Imigrasi Jepang.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Program 1: Tokutei Ginou (SSW) -->
            <div class="col-lg-6 reveal reveal-left">
                <div class="clean-program-card d-flex flex-column h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="program-icon-badge bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-person-workspace"></i>
                        </div>
                        <span class="badge bg-danger text-white rounded-pill px-3 py-2 fw-semibold">Paling Diminati</span>
                    </div>

                    <h3 class="h3 fw-bold mb-2 text-dark"><?php echo esc_html( $ssw_title ); ?></h3>
                    <p class="text-muted mb-4"><?php echo esc_html( $ssw_desc ); ?></p>

                    <div class="p-3 bg-light rounded-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-secondary small fw-medium">Standar Gaji Bulanan:</span>
                            <span class="fw-bold text-success fs-5"><?php echo esc_html( $ssw_gaji_yen ); ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center small">
                            <span class="text-muted">Estimasi Rupiah:</span>
                            <span class="fw-bold text-dark"><?php echo esc_html( $ssw_gaji_idr ); ?></span>
                        </div>
                    </div>

                    <div class="mb-4 flex-grow-1">
                        <h6 class="fw-bold text-dark mb-3 small text-uppercase letter-spacing-1">Sektor Tersedia:</h6>
                        <div class="row g-2 small text-secondary">
                            <?php
                            $ssw_items = array_map( 'trim', explode( ',', $ssw_sektor ) );
                            foreach ( $ssw_items as $item ) :
                                if ( empty( $item ) ) continue;
                            ?>
                                <div class="col-sm-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-check2 text-danger fs-5"></i>
                                    <span><?php echo esc_html( $item ); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="pt-3 border-top d-flex justify-content-between align-items-center mt-auto">
                        <span class="text-muted small"><i class="bi bi-clock-history me-1"></i>Kontrak s/d 5 Tahun</span>
                        <a href="#konsultasi" class="btn btn-japan btn-sm px-4">Daftar Tokutei Ginou &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Program 2: Magang TITP -->
            <div class="col-lg-6 reveal reveal-right">
                <div class="clean-program-card d-flex flex-column h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="program-icon-badge bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-tools"></i>
                        </div>
                        <span class="badge bg-primary text-white rounded-pill px-3 py-2 fw-semibold">Pelatihan Industri</span>
                    </div>

                    <h3 class="h3 fw-bold mb-2 text-dark"><?php echo esc_html( $titp_title ); ?></h3>
                    <p class="text-muted mb-4"><?php echo esc_html( $titp_desc ); ?></p>

                    <div class="p-3 bg-light rounded-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-secondary small fw-medium">Standar Gaji Bulanan:</span>
                            <span class="fw-bold text-success fs-5"><?php echo esc_html( $titp_gaji_yen ); ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center small">
                            <span class="text-muted">Estimasi Rupiah:</span>
                            <span class="fw-bold text-dark"><?php echo esc_html( $titp_gaji_idr ); ?></span>
                        </div>
                    </div>

                    <div class="mb-4 flex-grow-1">
                        <h6 class="fw-bold text-dark mb-3 small text-uppercase letter-spacing-1">Sektor Tersedia:</h6>
                        <div class="row g-2 small text-secondary">
                            <?php
                            $titp_items = array_map( 'trim', explode( ',', $titp_sektor ) );
                            foreach ( $titp_items as $item ) :
                                if ( empty( $item ) ) continue;
                            ?>
                                <div class="col-sm-6 d-flex align-items-center gap-2">
                                    <i class="bi bi-check2 text-primary fs-5"></i>
                                    <span><?php echo esc_html( $item ); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="pt-3 border-top d-flex justify-content-between align-items-center mt-auto">
                        <span class="text-muted small"><i class="bi bi-award me-1"></i>Sertifikasi JITCO & Modal Purna</span>
                        <a href="#konsultasi" class="btn btn-outline-primary btn-sm px-4">Daftar Magang TITP &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     4. JOB ORDERS / LOWONGAN TERBARU (DINAMIS DARI DATABASE WORDPRESS)
     ========================================================================= -->
<section class="py-5 bg-white border-top border-bottom" id="job-orders">
    <div class="container py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 reveal reveal-up">
            <div>
                <h2 class="h2 fw-bold text-dark mb-0">Lowongan Kerja Jepang Terbuka</h2>
                <p class="text-muted mb-0 mt-2">Daftar permintaan tenaga kerja dari perusahaan mitra di Jepang dengan jadwal interview terdekat.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <?php
                $jobs_page = get_page_by_path( 'lowongan-kerja' );
                if ( ! $jobs_page ) {
                    $jobs_page = get_page_by_title( 'Lowongan Kerja', OBJECT, 'page' );
                }
                $jobs_url  = $jobs_page ? get_permalink( $jobs_page ) : home_url( '/lowongan-kerja/' );
                ?>
                <a href="<?php echo esc_url( $jobs_url ); ?>" class="btn btn-japan-outline btn-sm px-4">Daftar Semua Lowongan &rarr;</a>
            </div>
        </div>

        <div class="row g-4">
            <?php
            // Filter: Khusus Lowongan Kerja (Kecualikan kategori berita jika ada)
            $berita_term_ids = get_terms( array(
                'taxonomy'   => 'category',
                'slug'       => array( 'berita', 'informasi', 'artikel', 'pengumuman', 'news' ),
                'fields'     => 'ids',
                'hide_empty' => false,
            ) );

            $jobs_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
            );

            if ( ! empty( $berita_term_ids ) && ! is_wp_error( $berita_term_ids ) ) {
                $jobs_args['category__not_in'] = $berita_term_ids;
            }

            $jobs_query = new WP_Query( $jobs_args );

            if ( $jobs_query->have_posts() ) :
                while ( $jobs_query->have_posts() ) : $jobs_query->the_post();
                    $loc_badge = get_post_meta( get_the_ID(), '_mojo_job_location', true );
                    if ( empty( $loc_badge ) ) {
                        $categories = get_the_category();
                        $loc_badge  = ( ! empty( $categories ) && $categories[0]->slug !== 'uncategorized' ) ? $categories[0]->name : 'Tokyo';
                    }
                    $kuota_val = get_post_meta( get_the_ID(), '_mojo_job_quota', true );
                    if ( empty( $kuota_val ) ) {
                        $kuota_val = 'Aktif';
                    }
                    $salary_yen = get_post_meta( get_the_ID(), '_mojo_job_salary_yen', true );
                    if ( empty( $salary_yen ) ) {
                        $salary_yen = '¥190,000 – ¥240,000';
                    }
                    $salary_idr = get_post_meta( get_the_ID(), '_mojo_job_salary_idr', true );
                    if ( empty( $salary_idr ) ) {
                        $salary_idr = '± Rp 20 Juta – Rp 26 Juta/bln';
                    }
                    ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="clean-job-card h-100 d-flex flex-column">
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
                <!-- Fallback 4 Demo Jobs if no posts published yet -->
                <div class="col-md-6 col-lg-3">
                    <div class="clean-job-card h-100 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Tokyo</span>
                            <span class="badge bg-success-subtle text-success small fw-semibold">15 Kuota</span>
                        </div>
                        <h4 class="h6 fw-bold text-dark mb-2">Perawat Lansia (Kaigo)</h4>
                        <p class="text-muted small mb-3 flex-grow-1">Penempatan di panti perawatan lansia modern wilayah metropolitan Tokyo. Asrama subsidi 50%.</p>
                        <div class="p-3 bg-light rounded-3 mb-3">
                            <div class="job-salary-amount">¥215,000 - ¥245,000</div>
                            <div class="job-salary-sub">&plusmn; Rp 23 Juta - Rp 26,2 Juta/bln</div>
                        </div>
                        <a href="#konsultasi" class="btn btn-japan btn-sm w-100 text-center mt-auto">Lamar Posisi Ini</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="clean-job-card h-100 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Osaka</span>
                            <span class="badge bg-success-subtle text-success small fw-semibold">20 Kuota</span>
                        </div>
                        <h4 class="h6 fw-bold text-dark mb-2">Pengolahan Makanan</h4>
                        <p class="text-muted small mb-3 flex-grow-1">Pabrik bento higienis skala nasional Jepang di Osaka. Fasilitas mess dan asuransi lengkap.</p>
                        <div class="p-3 bg-light rounded-3 mb-3">
                            <div class="job-salary-amount">¥195,000 - ¥225,000</div>
                            <div class="job-salary-sub">&plusmn; Rp 20,8 Juta - Rp 24 Juta/bln</div>
                        </div>
                        <a href="#konsultasi" class="btn btn-japan btn-sm w-100 text-center mt-auto">Lamar Posisi Ini</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="clean-job-card h-100 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Aichi</span>
                            <span class="badge bg-success-subtle text-success small fw-semibold">12 Kuota</span>
                        </div>
                        <h4 class="h6 fw-bold text-dark mb-2">Teknik Mesin & Las</h4>
                        <p class="text-muted small mb-3 flex-grow-1">Industri komponen presisi otomotif di Nagoya. Pelatihan keselamatan kerja dan sertifikasi JITCO.</p>
                        <div class="p-3 bg-light rounded-3 mb-3">
                            <div class="job-salary-amount">¥170,000 - ¥195,000</div>
                            <div class="job-salary-sub">&plusmn; Rp 18,2 Juta - Rp 20,8 Juta/bln</div>
                        </div>
                        <a href="#konsultasi" class="btn btn-japan btn-sm w-100 text-center mt-auto">Lamar Posisi Ini</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="clean-job-card h-100 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="job-prefecture-pill"><i class="bi bi-geo-alt-fill text-danger me-1"></i>Hokkaido</span>
                            <span class="badge bg-success-subtle text-success small fw-semibold">10 Kuota</span>
                        </div>
                        <h4 class="h6 fw-bold text-dark mb-2">Pertanian Greenhouse</h4>
                        <p class="text-muted small mb-3 flex-grow-1">Budidaya sayuran modern berteknologi sensor iklim di Hokkaido. Disediakan rumah dinas asri.</p>
                        <div class="p-3 bg-light rounded-3 mb-3">
                            <div class="job-salary-amount">¥185,000 - ¥210,000</div>
                            <div class="job-salary-sub">&plusmn; Rp 19,8 Juta - Rp 22,5 Juta/bln</div>
                        </div>
                        <a href="#konsultasi" class="btn btn-japan btn-sm w-100 text-center mt-auto">Lamar Posisi Ini</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- =========================================================================
     5. ALUR 5 LANGKAH MENUJU JEPANG
     ========================================================================= -->
<section class="py-5" id="alur-proses">
    <div class="container py-3">
        <div class="text-center col-lg-7 mx-auto mb-5 reveal reveal-up">
            <h2 class="h2 fw-bold text-dark">5 Langkah Pasti Berangkat ke Jepang</h2>
            <p class="text-muted">Pendampingan terarah dari tahap awal hingga Anda resmi tiba dan bekerja di Jepang.</p>
        </div>

        <div class="row g-3">
            <div class="col-md-4 col-lg">
                <div class="clean-step-card">
                    <div class="clean-step-circle">1</div>
                    <h6 class="fw-bold mb-2">Pendaftaran & MCU</h6>
                    <p class="text-muted small mb-0">Pemeriksaan kesehatan awal dan verifikasi berkas administrasi.</p>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="clean-step-card">
                    <div class="clean-step-circle">2</div>
                    <h6 class="fw-bold mb-2">Diklat Bahasa</h6>
                    <p class="text-muted small mb-0">Pembelajaran intensif JLPT N4 / JFT dan sertifikasi bidang.</p>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="clean-step-card">
                    <div class="clean-step-circle">3</div>
                    <h6 class="fw-bold mb-2">Matching & Interview</h6>
                    <p class="text-muted small mb-0">Pencocokan job order dan wawancara (*Menyetsu*) dengan Kaisha.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg">
                <div class="clean-step-card">
                    <div class="clean-step-circle">4</div>
                    <h6 class="fw-bold mb-2">COE & Visa</h6>
                    <p class="text-muted small mb-0">Penerbitan izin tinggal Imigrasi Jepang dan Visa Kerja resmi.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg">
                <div class="clean-step-card">
                    <div class="clean-step-circle">5</div>
                    <h6 class="fw-bold mb-2">Terbang ke Jepang</h6>
                    <p class="text-muted small mb-0">Pelepasan resmi dan penyambutan langsung oleh staf kami di Jepang.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     5B. BERITA & INFORMASI TERBARU (BAGIAN KHUSUS ARTIKEL / BERITA)
     ========================================================================= -->
<section class="py-5 bg-white border-top border-bottom" id="berita-terbaru">
    <div class="container py-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 reveal reveal-up">
            <div>
                <h2 class="h2 fw-bold text-dark mb-0">Berita & Informasi Terbaru</h2>
                <p class="text-muted mb-0 mt-2">Seputar regulasi kerja resmi ke Jepang, tips seleksi wawancara (Menyetsu), dan dokumentasi kegiatan.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <?php
                $news_page = get_page_by_path( 'berita' );
                $news_url  = $news_page ? get_permalink( $news_page ) : ( get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/berita/' ) );
                ?>
                <a href="<?php echo esc_url( $news_url ); ?>" class="btn btn-outline-secondary btn-sm px-4">Semua Berita &rarr;</a>
            </div>
        </div>

        <div class="row g-4">
            <?php
            // Query khusus artikel berkategori Berita / Informasi
            $berita_cats = get_terms( array(
                'taxonomy'   => 'category',
                'slug'       => array( 'berita', 'informasi', 'artikel', 'pengumuman', 'news' ),
                'fields'     => 'ids',
                'hide_empty' => false,
            ) );

            $news_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
            );

            if ( ! empty( $berita_cats ) && ! is_wp_error( $berita_cats ) ) {
                $news_args['category__in'] = $berita_cats;
            }

            $news_query = new WP_Query( $news_args );

            if ( $news_query->have_posts() ) :
                while ( $news_query->have_posts() ) : $news_query->the_post();
                    $cats = get_the_category();
                    $cat_label = ! empty( $cats ) ? $cats[0]->name : 'Berita';
                    ?>
                    <div class="col-md-4">
                        <article class="clean-news-card h-100 d-flex flex-column bg-white rounded-4 border overflow-hidden shadow-sm">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="news-card-thumb overflow-hidden" style="height: 190px;">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-100 h-100 object-fit-cover hover-zoom' ) ); ?>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="news-card-thumb-placeholder bg-light d-flex align-items-center justify-content-center border-bottom text-muted" style="height: 170px;">
                                    <i class="bi bi-newspaper fs-1 text-danger opacity-50"></i>
                                </div>
                            <?php endif; ?>

                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                                    <span class="badge bg-danger-subtle text-danger fw-semibold"><?php echo esc_html( $cat_label ); ?></span>
                                    <span>&bull;</span>
                                    <span><i class="bi bi-calendar3 me-1"></i><?php echo esc_html( get_the_date( 'd M Y' ) ); ?></span>
                                </div>

                                <h5 class="fw-bold mb-2 text-dark fs-6">
                                    <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-danger"><?php the_title(); ?></a>
                                </h5>

                                <p class="text-secondary small mb-3 flex-grow-1">
                                    <?php echo esc_html( wp_trim_words( get_the_excerpt(), 14, '...' ) ); ?>
                                </p>

                                <a href="<?php the_permalink(); ?>" class="text-danger fw-semibold small text-decoration-none mt-auto d-inline-flex align-items-center gap-1">
                                    <span>Baca Selengkapnya</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <!-- Fallback 3 Berita Resmi jika belum ada artikel berita -->
                <div class="col-md-4">
                    <article class="clean-news-card h-100 d-flex flex-column bg-white rounded-4 border overflow-hidden shadow-sm p-4">
                        <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                            <span class="badge bg-danger-subtle text-danger fw-semibold">Regulasi</span>
                            <span>&bull;</span>
                            <span><?php echo date( 'd M Y' ); ?></span>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark fs-6">Panduan Lengkap Syarat Visa Tokutei Ginou (SSW) Terbaru 2026</h5>
                        <p class="text-secondary small mb-3 flex-grow-1">Informasi ketentuan tes bahasa JFT Basic A2 dan keahlian spesifik bidang kerja di Jepang.</p>
                        <a href="#konsultasi" class="text-danger fw-semibold small text-decoration-none mt-auto d-inline-flex align-items-center gap-1">Baca Selengkapnya &rarr;</a>
                    </article>
                </div>

                <div class="col-md-4">
                    <article class="clean-news-card h-100 d-flex flex-column bg-white rounded-4 border overflow-hidden shadow-sm p-4">
                        <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                            <span class="badge bg-primary-subtle text-primary fw-semibold">Tips Karir</span>
                            <span>&bull;</span>
                            <span><?php echo date( 'd M Y' ); ?></span>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark fs-6">5 Tips Lolos Wawancara (Menyetsu) dengan User Perusahaan Jepang</h5>
                        <p class="text-secondary small mb-3 flex-grow-1">Tata krama, etika perkenalan diri (Jikoshoukai), dan tips menjawab pertanyaan pewawancara.</p>
                        <a href="#konsultasi" class="text-danger fw-semibold small text-decoration-none mt-auto d-inline-flex align-items-center gap-1">Baca Selengkapnya &rarr;</a>
                    </article>
                </div>

                <div class="col-md-4">
                    <article class="clean-news-card h-100 d-flex flex-column bg-white rounded-4 border overflow-hidden shadow-sm p-4">
                        <div class="d-flex align-items-center gap-2 small text-muted mb-2">
                            <span class="badge bg-success-subtle text-success fw-semibold">Dokumentasi</span>
                            <span>&bull;</span>
                            <span><?php echo date( 'd M Y' ); ?></span>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark fs-6">Pelepasan Keberangkatan Peserta Magang & SSW ke Tokyo & Osaka</h5>
                        <p class="text-secondary small mb-3 flex-grow-1">Dokumentasi resmi pelepasan kandidat yang telah menyelesaikan diklat di Mojo Global Talent.</p>
                        <a href="#konsultasi" class="text-danger fw-semibold small text-decoration-none mt-auto d-inline-flex align-items-center gap-1">Baca Selengkapnya &rarr;</a>
                    </article>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. B2B SECTION UNTUK PERUSAHAAN / KUMIAI JEPANG
     ========================================================================= -->
<section class="py-5" style="background-color: #0f172a; color: #ffffff;">
    <div class="container py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8 reveal reveal-left">
                <h3 class="h2 fw-bold mb-3 text-white">インドネシアの優秀な人材と確かなパートナーシップ</h3>
                <p class="text-light text-opacity-80 lead fs-6 mb-4">
                    当社は、高い就労意欲と日本文化・礼儀作法を身につけた優秀なインドネシア人人材を厳選・育成しております。特定技能（介護、外食、食品製造、農業等）および技能実習生のスムーズな受入れと定着を現地と東京拠点で強力にサポートいたします。
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="mailto:b2b-japan@mojoglobaltalent.com" class="btn btn-japan px-4 py-2">求人票・受入れのご相談 (Inquiry) &rarr;</a>
                    <a href="#konsultasi" class="btn btn-outline-light px-4 py-2">会社案内 (Company Profile)</a>
                </div>
            </div>

            <div class="col-lg-4 reveal reveal-right">
                <div class="bg-white bg-opacity-10 border border-white border-opacity-20 rounded-4 p-4 text-start">
                    <h6 class="fw-bold text-warning mb-3"><i class="bi bi-star-fill me-2"></i>当社の強み (Our Strengths)</h6>
                    <ul class="list-unstyled small text-light text-opacity-90 mb-0">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>厳格な面接選抜:</strong> 人柄と適性を重視</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><strong>日本語教育徹底:</strong> N4/N3会話力重視</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i><strong>日本拠点サポート:</strong> 渡航後も専任が伴走</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     7. FORMULIR PENDAFTARAN & KONSULTASI (DEDICATED SECTION)
     ========================================================================= -->
<section class="py-5 bg-light" id="konsultasi">
    <div class="container py-4">
        <div class="row g-5 align-items-center">
            <!-- Left Info -->
            <div class="col-lg-5 reveal reveal-left">
                <h2 class="display-6 fw-bold text-dark mb-3">Siap Memulai Langkah Anda ke Jepang?</h2>
                <p class="text-secondary mb-4">Konsultasikan minat program, syarat dokumen, dan jadwal kelas seleksi dengan tim konsultan karir berpengalaman kami.</p>

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
                    <h4 class="fw-bold text-dark mb-2">Formulir Pendaftaran & Konsultasi</h4>
                    <p class="text-muted small mb-4">Lengkapi data di bawah ini. Konsultan kami akan menghubungi Anda melalui WhatsApp.</p>

                    <form onsubmit="alert('Terima kasih! Data pendaftaran Anda telah berhasil terkirim. Konsultan resmi kami akan segera menghubungi Anda.'); return false;">
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
                                <label class="form-label small fw-semibold text-secondary">Minat Program</label>
                                <select class="form-select form-select-lg fs-6">
                                    <option>Tokutei Ginou / SSW (Caregiver/Kaigo)</option>
                                    <option>Tokutei Ginou / SSW (Pengolahan Makanan)</option>
                                    <option>Tokutei Ginou / SSW (Pertanian)</option>
                                    <option>Magang TITP (Teknik Manufaktur / Mesin)</option>
                                    <option>Kelas Intensif Bahasa Jepang (N4/JFT)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Kemampuan Bahasa Jepang</label>
                                <select class="form-select form-select-lg fs-6">
                                    <option>Belum pernah belajar (Nol)</option>
                                    <option>Sudah hafal Hiragana / Katakana</option>
                                    <option>Memiliki Sertifikat JLPT N5</option>
                                    <option>Memiliki Sertifikat JLPT N4 / JFT A2</option>
                                    <option>Memiliki Sertifikat JLPT N3 ke atas</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold text-secondary">Catatan / Pertanyaan Tambahan</label>
                                <textarea class="form-control" rows="3" placeholder="Tuliskan pertanyaan Anda seputar proses, biaya resmi, atau seleksi..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-japan btn-lg w-100 py-3 fw-bold">
                                    <i class="bi bi-send-fill me-2"></i>Kirim Pendaftaran Sekarang &rarr;
                                </button>
                                <p class="text-center text-muted small mt-2 mb-0">
                                    <i class="bi bi-shield-lock-fill me-1 text-success"></i> Privasi Anda terjaga. Data hanya digunakan untuk keperluan pendaftaran resmi.
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
<a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=Halo%20Admin%20Mojo%20Global%20Talent,%20saya%20tertarik%20untuk%20konsultasi%20program%20kerja%20ke%20Jepang." target="_blank" class="floating-wa-btn" title="Hubungi Kami via WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<?php
get_footer();
