<?php
/**
 * Front page template - Clean & Simple Premium Japanese Recruitment Corporate
 * Concept: Kanso (Simplicity) & Shibui (Subtle Elegance)
 *
 * @package Mojo_Bootstrap
 */

$wa_number      = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
$wa_clean       = function_exists( 'mojo_clean_whatsapp_number' ) ? mojo_clean_whatsapp_number( $wa_number ) : preg_replace( '/[^0-9]/', '', $wa_number );
$izin_text      = get_theme_mod( 'mojo_izin_kemnaker', 'KEP.000/MEN/2024' );
$alamat_jakarta = get_theme_mod( 'mojo_alamat_jakarta', 'Gedung Talent Center Lt. 3, Jl. Gatot Subroto Kav. 88, Jakarta Selatan' );
$alamat_tokyo   = get_theme_mod( 'mojo_alamat_tokyo', 'Chiyoda-ku, Tokyo 101-0021, Japan' );

// Hero Customizer Settings
$hero_badge     = get_theme_mod( 'mojo_hero_badge', 'Sending Organization Resmi Berizin Kemnaker RI No: ' . $izin_text );
$hero_title     = get_theme_mod( 'mojo_hero_title', 'Raih Karir Profesional & Masa Depan di <span class="text-danger position-relative">Jepang</span>' );
$hero_subtitle  = get_theme_mod( 'mojo_hero_subtitle', 'Lembaga pengirim resmi (*Sending Organization*) dan *Job Matching Specialist* terpercaya. Menghubungkan talenta kompeten Indonesia dengan ratusan perusahaan terkemuka di Jepang melalui program <strong>Tokutei Ginou (SSW)</strong>.' );
$btn1_text      = get_theme_mod( 'mojo_hero_btn1_text', 'Lihat Job Order Terbaru' );
$btn1_url       = get_theme_mod( 'mojo_hero_btn1_url', '#job-orders' );
$btn2_text      = get_theme_mod( 'mojo_hero_btn2_text', 'Konsultasi WhatsApp Cepat' );
$hero_wa_custom = get_theme_mod( 'mojo_hero_btn2_wa', '' );
$hero_wa_url    = function_exists( 'mojo_get_whatsapp_url' ) ? mojo_get_whatsapp_url( 'Halo Admin Mojo Global Talent, saya tertarik untuk konsultasi program kerja Tokutei Ginou (SSW) ke Jepang.', $hero_wa_custom ) : ( 'https://wa.me/' . $wa_clean );

// Stats Settings
$stat1_num   = get_theme_mod( 'mojo_stat1_num', '180+' );
$stat1_label = get_theme_mod( 'mojo_stat1_label', 'Mitra Perusahaan Jepang' );
$stat2_num   = get_theme_mod( 'mojo_stat2_num', '98.4%' );
$stat2_label = get_theme_mod( 'mojo_stat2_label', 'Kelulusan JLPT / JFT Basic' );
$stat3_num   = get_theme_mod( 'mojo_stat3_num', '47' );
$stat3_label = get_theme_mod( 'mojo_stat3_label', 'Prefektur Penempatan Kerja' );

// B2B & Kemitraan Settings (Bahasa Indonesia Default)
$b2b_title      = get_theme_mod( 'mojo_b2b_title', 'Kemitraan Resmi & Penyaluran Tenaga Kerja Kompeten ke Jepang' );
$b2b_desc       = get_theme_mod( 'mojo_b2b_desc', 'Kami menyeleksi dan membina talenta terbaik Indonesia dengan etos kerja tinggi, kedisiplinan, serta penguasaan bahasa & budaya Jepang. Melalui program Tokutei Ginou (SSW) di sektor Kaigo, Pengolahan Makanan, Pertanian, Manufaktur, dan Perhotelan, kami memastikan proses penempatan yang transparan, aman, dan terpercaya dengan dukungan kantor kami di Indonesia dan Tokyo.' );
$b2b_btn1_text  = get_theme_mod( 'mojo_b2b_btn1_text', 'Konsultasi Kemitraan & Penempatan →' );
$b2b_btn1_url   = get_theme_mod( 'mojo_b2b_btn1_url', '#konsultasi' );
$b2b_btn2_text  = get_theme_mod( 'mojo_b2b_btn2_text', 'Profil Perusahaan (Tentang Kami)' );
$b2b_card_title = get_theme_mod( 'mojo_b2b_card_title', 'Keunggulan Layanan Kami' );
$b2b_item1      = get_theme_mod( 'mojo_b2b_item1', '<strong>Seleksi Ketat & Transparan:</strong> Menilai kepribadian, kesehatan fisik, dan kesiapan mental kerja.' );
$b2b_item2      = get_theme_mod( 'mojo_b2b_item2', '<strong>Pendidikan Bahasa Intensif:</strong> Pemantapan standar JLPT / JFT A2 dengan fokus percakapan aktif.' );
$b2b_item3      = get_theme_mod( 'mojo_b2b_item3', '<strong>Dukungan di Jepang:</strong> Kantor representatif di Tokyo siap memfasilitasi kebutuhan dan adaptasi pekerja.' );

// Dynamic resolution of about page
$about_page = get_page_by_path( 'tentang-kami' );
if ( ! $about_page ) {
    $about_page = get_page_by_title( 'Tentang Kami', OBJECT, 'page' );
}
if ( ! $about_page ) {
    $about_page = get_page_by_title( 'TENTANG KAMI', OBJECT, 'page' );
}
$about_url = $about_page ? get_permalink( $about_page->ID ) : home_url( '/tentang-kami/' );

get_header();
?>

<!-- =========================================================================
     1. HERO SECTION - CLEAN, SPACIOUS, PREMIUM
     ========================================================================= -->
<section class="clean-hero text-center">
    <div class="container">
        <!-- Main Title -->
        <h1 class="hero-main-title mb-4 reveal reveal-up">
            <?php echo wp_kses_post( $hero_title ); ?>
        </h1>

        <!-- Subtitle -->
        <p class="hero-lead-text mb-5 reveal reveal-up delay-100">
            <?php echo wp_kses_post( $hero_subtitle ); ?>
        </p>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-center gap-3 flex-column flex-sm-row mb-5 reveal reveal-up delay-200">
            <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn btn-japan btn-lg px-4 py-3 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-briefcase-fill"></i>
                <span><?php echo esc_html( $btn1_text ); ?></span>
                <i class="bi bi-arrow-right"></i>
            </a>
            <a href="<?php echo esc_url( $hero_wa_url ); ?>" target="_blank" class="btn btn-japan-outline btn-lg px-4 py-3 d-flex align-items-center justify-content-center gap-2" title="Konsultasi via WhatsApp">
                <i class="bi bi-whatsapp text-success fs-5"></i>
                <span><?php echo esc_html( $btn2_text ); ?></span>
            </a>
        </div>

        <!-- Trust Badges Line -->
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-4 text-secondary small pt-2 reveal reveal-fade delay-300">
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
     3. JOB ORDERS / LOWONGAN TERBARU (DINAMIS DARI DATABASE WORDPRESS)
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
            // Ambil pos terbaru dan filter hanya yang valid sebagai Lowongan Kerja
            $all_recent_posts = get_posts( array(
                'post_type'      => 'post',
                'posts_per_page' => 30,
                'post_status'    => 'publish',
            ) );

            $job_posts = array();
            if ( ! empty( $all_recent_posts ) ) {
                foreach ( $all_recent_posts as $p ) {
                    if ( function_exists( 'mojo_is_job_post' ) && mojo_is_job_post( $p->ID ) ) {
                        $job_posts[] = $p;
                        if ( count( $job_posts ) >= 4 ) {
                            break;
                        }
                    }
                }
            }

            if ( ! empty( $job_posts ) ) :
                foreach ( $job_posts as $job_post ) :
                    setup_postdata( $GLOBALS['post'] =& $job_post );
                    $raw_loc = get_post_meta( $job_post->ID, '_mojo_job_location', true );
                    if ( empty( $raw_loc ) ) {
                        $categories = get_the_category( $job_post->ID );
                        $raw_loc    = ( ! empty( $categories ) && $categories[0]->slug !== 'uncategorized' ) ? $categories[0]->name : 'Jepang';
                    }

                    // Pemangkasan aman teks lokasi (maks. 20 karakter) agar tidak merusak kartu
                    $loc_badge = trim( wp_strip_all_tags( $raw_loc ) );
                    if ( preg_match( '/^([^,\.\(\n\r]+)/', $loc_badge, $lm ) && mb_strlen( $lm[1] ) <= 20 ) {
                        $loc_badge = trim( $lm[1] );
                    } elseif ( mb_strlen( $loc_badge ) > 20 ) {
                        $loc_badge = mb_substr( $loc_badge, 0, 18 ) . '...';
                    }

                    $raw_quota = get_post_meta( $job_post->ID, '_mojo_job_quota', true );
                    if ( empty( $raw_quota ) ) {
                        $kuota_val = 'Aktif';
                    } else {
                        $kuota_val = trim( wp_strip_all_tags( $raw_quota ) );
                        // Ambil kuota ringkas jika user mengetik kalimat panjang
                        if ( preg_match( '/(\d+[\s\w]*)/i', $kuota_val, $km ) && mb_strlen( $km[0] ) <= 15 ) {
                            $kuota_val = trim( $km[0] );
                        } elseif ( mb_strlen( $kuota_val ) > 15 ) {
                            $kuota_val = mb_substr( $kuota_val, 0, 13 ) . '...';
                        }
                    }

                    $salary_yen = get_post_meta( $job_post->ID, '_mojo_job_salary_yen', true );
                    if ( empty( $salary_yen ) ) {
                        $salary_yen = '¥190,000 – ¥240,000';
                    } else {
                        $salary_yen = trim( wp_strip_all_tags( $salary_yen ) );
                        if ( mb_strlen( $salary_yen ) > 25 ) {
                            $salary_yen = mb_substr( $salary_yen, 0, 23 ) . '...';
                        }
                    }

                    $salary_idr = get_post_meta( $job_post->ID, '_mojo_job_salary_idr', true );
                    if ( empty( $salary_idr ) ) {
                        $salary_idr = '± Rp 20 Juta – Rp 26 Juta/bln';
                    } else {
                        $salary_idr = trim( wp_strip_all_tags( $salary_idr ) );
                        if ( mb_strlen( $salary_idr ) > 32 ) {
                            $salary_idr = mb_substr( $salary_idr, 0, 30 ) . '...';
                        }
                    }
                    ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="clean-job-card h-100 d-flex flex-column">
                            <div class="clean-job-card-header mb-3">
                                <span class="job-prefecture-pill" title="<?php echo esc_attr( $raw_loc ); ?>"><i class="bi bi-geo-alt-fill text-danger me-1"></i><?php echo esc_html( $loc_badge ); ?></span>
                                <span class="badge bg-success-subtle text-success small fw-semibold" title="<?php echo esc_attr( $raw_quota ); ?>"><?php echo esc_html( $kuota_val ); ?></span>
                            </div>

                            <h4 class="h6 fw-bold text-dark mb-2"><?php the_title(); ?></h4>
                            <p class="text-muted small mb-3 flex-grow-1"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14, '...' ) ); ?></p>

                            <div class="p-3 bg-light rounded-3 mb-3">
                                <div class="job-salary-amount text-truncate"><?php echo esc_html( $salary_yen ); ?></div>
                                <div class="job-salary-sub text-truncate"><?php echo esc_html( $salary_idr ); ?></div>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="btn btn-japan btn-sm w-100 text-center mt-auto">Detail & Lamar &rarr;</a>
                        </div>
                    </div>
                    <?php
                endforeach;
                wp_reset_postdata();
            else :
                ?>
                <div class="col-12 text-center py-4">
                    <div class="p-4 bg-light rounded-4 border d-inline-block text-center" style="max-width: 520px;">
                        <i class="bi bi-briefcase fs-1 text-danger opacity-75 mb-2 d-block"></i>
                        <h5 class="fw-bold text-dark mb-1">Belum Ada Lowongan Kerja Aktif</h5>
                        <p class="text-muted small mb-3">Tulis dan terbitkan pos lowongan baru di WP-Admin dengan memilih <strong>Kategori: Lowongan Kerja</strong>.</p>
                        <?php if ( current_user_can( 'edit_posts' ) ) : ?>
                            <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>" class="btn btn-japan btn-sm px-4">Tambah Lowongan Baru &rarr;</a>
                        <?php endif; ?>
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
            // Ambil pos artikel berita / dokumentasi (yang bukan lowongan kerja)
            $news_posts = array();
            if ( ! empty( $all_recent_posts ) ) {
                foreach ( $all_recent_posts as $p ) {
                    if ( function_exists( 'mojo_is_job_post' ) && ! mojo_is_job_post( $p->ID ) ) {
                        $news_posts[] = $p;
                        if ( count( $news_posts ) >= 3 ) {
                            break;
                        }
                    }
                }
            }

            if ( ! empty( $news_posts ) ) :
                foreach ( $news_posts as $news_post ) :
                    setup_postdata( $GLOBALS['post'] =& $news_post );
                    $cats = get_the_category( $news_post->ID );
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
                endforeach;
                wp_reset_postdata();
            else :
                ?>
                <div class="col-12 text-center py-4">
                    <div class="p-4 bg-light rounded-4 border d-inline-block text-center" style="max-width: 520px;">
                        <i class="bi bi-newspaper fs-1 text-danger opacity-75 mb-2 d-block"></i>
                        <h5 class="fw-bold text-dark mb-1">Belum Ada Artikel Berita</h5>
                        <p class="text-muted small mb-3">Tulis dan terbitkan artikel baru di WP-Admin dengan memilih <strong>Kategori: Berita</strong> agar langsung tampil di bagian ini.</p>
                        <?php if ( current_user_can( 'edit_posts' ) ) : ?>
                            <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>" class="btn btn-japan btn-sm px-4">Tulis Berita Baru &rarr;</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- =========================================================================
     6. B2B SECTION UNTUK PERUSAHAAN & MITRA KERJA
     ========================================================================= -->
<section class="py-5" style="background-color: #0f172a; color: #ffffff;">
    <div class="container py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-8 reveal reveal-left">
                <h3 class="h2 fw-bold mb-3 text-white"><?php echo esc_html( $b2b_title ); ?></h3>
                <p class="text-light text-opacity-80 lead fs-6 mb-4">
                    <?php echo wp_kses_post( $b2b_desc ); ?>
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo esc_url( $b2b_btn1_url ); ?>" class="btn btn-japan px-4 py-2"><?php echo esc_html( $b2b_btn1_text ); ?></a>
                    <a href="<?php echo esc_url( $about_url ); ?>" class="btn btn-outline-light px-4 py-2"><?php echo esc_html( $b2b_btn2_text ); ?></a>
                </div>
            </div>

            <div class="col-lg-4 reveal reveal-right">
                <div class="bg-white bg-opacity-10 border border-white border-opacity-20 rounded-4 p-4 text-start">
                    <h6 class="fw-bold text-warning mb-3"><i class="bi bi-star-fill me-2"></i><?php echo esc_html( $b2b_card_title ); ?></h6>
                    <ul class="list-unstyled small text-light text-opacity-90 mb-0">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><?php echo wp_kses_post( $b2b_item1 ); ?></li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i><?php echo wp_kses_post( $b2b_item2 ); ?></li>
                        <li><i class="bi bi-check-circle text-success me-2"></i><?php echo wp_kses_post( $b2b_item3 ); ?></li>
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
                        <p class="text-muted small mb-0"><a href="<?php echo esc_url( mojo_get_whatsapp_url( 'Halo Admin Mojo Global Talent, saya ingin konsultasi program Tokutei Ginou (SSW) ke Jepang.' ) ); ?>" target="_blank" class="text-decoration-none text-dark fw-semibold" title="Buka Chat WhatsApp Resmi"><?php echo esc_html( $wa_number ); ?></a> (Respon Cepat Hari Kerja)</p>
                    </div>
                </div>
            </div>

            <!-- Right Clean Form -->
            <div class="col-lg-7 reveal reveal-right">
                <div class="card border border-light-subtle shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h4 class="fw-bold text-dark mb-2">Formulir Pendaftaran & Konsultasi</h4>
                    <p class="text-muted small mb-4">Lengkapi data di bawah ini. Formulir akan langsung terhubung ke WhatsApp resmi konsultan kami.</p>

                    <form id="mojoFrontConsultForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Nama Lengkap</label>
                                <input type="text" id="fc_name" class="form-control form-control-lg fs-6" placeholder="Sesuai KTP" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Nomor WhatsApp Aktif</label>
                                <input type="tel" id="fc_phone" class="form-control form-control-lg fs-6" placeholder="08xxxxxxxxxx" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Kota Domisili</label>
                                <input type="text" id="fc_city" class="form-control form-control-lg fs-6" placeholder="Contoh: Surabaya, Solo, Medan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Pendidikan Terakhir</label>
                                <select id="fc_edu" class="form-select form-select-lg fs-6">
                                    <option>SMA / SMK Sederajat</option>
                                    <option>Diploma (D3)</option>
                                    <option>Sarjana (S1)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Minat Program</label>
                                <select id="fc_program" class="form-select form-select-lg fs-6">
                                    <option>Tokutei Ginou / SSW (Caregiver/Kaigo)</option>
                                    <option>Tokutei Ginou / SSW (Pengolahan Makanan)</option>
                                    <option>Tokutei Ginou / SSW (Pertanian)</option>
                                    <option>Tokutei Ginou / SSW (Manufaktur Pabrik)</option>
                                    <option>Tokutei Ginou / SSW (Restoran & Perhotelan)</option>
                                    <option>Kelas Intensif Bahasa Jepang (N4 / JFT A2)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-secondary">Kemampuan Bahasa Jepang</label>
                                <select id="fc_nihongo" class="form-select form-select-lg fs-6">
                                    <option>Belum pernah belajar (Nol)</option>
                                    <option>Sudah hafal Hiragana / Katakana</option>
                                    <option>Memiliki Sertifikat JLPT N5</option>
                                    <option>Memiliki Sertifikat JLPT N4 / JFT A2</option>
                                    <option>Memiliki Sertifikat JLPT N3 ke atas</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold text-secondary">Catatan / Pertanyaan Tambahan</label>
                                <textarea id="fc_note" class="form-control" rows="3" placeholder="Tuliskan pertanyaan Anda seputar proses, biaya resmi, atau seleksi..."></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-japan btn-lg w-100 py-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-whatsapp fs-5"></i>
                                    <span>Kirim Pendaftaran via WhatsApp &rarr;</span>
                                </button>
                                <p class="text-center text-muted small mt-2 mb-0">
                                    <i class="bi bi-shield-lock-fill me-1 text-success"></i> Privasi Anda terjaga. Data langsung terhubung ke konsultan resmi Mojo Global Talent.
                                </p>
                            </div>
                        </div>
                    </form>

                    <script>
                    (function() {
                        var form = document.getElementById('mojoFrontConsultForm');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                e.preventDefault();
                                var name = document.getElementById('fc_name').value.trim();
                                var phone = document.getElementById('fc_phone').value.trim();
                                var city = document.getElementById('fc_city').value.trim();
                                var edu = document.getElementById('fc_edu').value;
                                var prog = document.getElementById('fc_program').value;
                                var nihongo = document.getElementById('fc_nihongo').value;
                                var note = document.getElementById('fc_note').value.trim();

                                var text = 'Halo Admin Mojo Global Talent, saya ingin konsultasi & mendaftar program Tokutei Ginou (SSW) Jepang:\n\n' +
                                    '*Nama Lengkap:* ' + name + '\n' +
                                    '*No. WhatsApp:* ' + phone + '\n' +
                                    '*Kota Domisili:* ' + city + '\n' +
                                    '*Pendidikan:* ' + edu + '\n' +
                                    '*Pilihan Program:* ' + prog + '\n' +
                                    '*Kemampuan Bahasa:* ' + nihongo + '\n';
                                if (note) {
                                    text += '*Catatan:* ' + note + '\n';
                                }
                                text += '\nMohon informasi jadwal seleksi dan persyaratannya. Terima kasih!';

                                var targetUrl = 'https://wa.me/<?php echo esc_js( $wa_clean ); ?>?text=' + encodeURIComponent(text);
                                window.open(targetUrl, '_blank');
                            });
                        }
                    })();
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
