<?php
/**
 * Template part for displaying posts (Berita, Dokumentasi & Job Orders)
 *
 * @package Mojo_Bootstrap
 */

$is_job     = function_exists( 'mojo_is_job_post' ) ? mojo_is_job_post( get_the_ID() ) : false;
$categories = get_the_category();
$cat_name   = ! empty( $categories ) ? $categories[0]->name : ( $is_job ? 'Lowongan Kerja' : 'Berita' );

// Format tanggal aman bahasa Indonesia (mencegah format huruf kanji Jepang muncul di teks Indonesia)
$post_date  = get_the_date( 'd M Y' );
?>

<div class="col">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'card h-100 shadow-sm border rounded-4 overflow-hidden post-card' ); ?>>
        <!-- Thumbnail / Placeholder (Tinggi Konsisten & Proporsional 200px) -->
        <div class="post-card-thumb position-relative overflow-hidden" style="height: 200px; min-height: 200px; max-height: 200px;">
            <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="d-block w-100 h-100 text-decoration-none">
                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-100 h-100 object-fit-cover hover-zoom post-card-img' ) ); ?>
                </a>
            <?php else : ?>
                <?php if ( $is_job ) : ?>
                    <!-- Placeholder Khusus Lowongan Kerja -->
                    <div class="post-thumb-placeholder bg-primary bg-gradient d-flex flex-column align-items-center justify-content-center text-white text-center p-3 w-100 h-100">
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3 rounded-pill px-2.5 py-1 small">RESMI JEPANG</span>
                        <i class="bi bi-briefcase-fill display-5 mb-2 text-warning"></i>
                        <span class="small fw-semibold text-uppercase letter-spacing-1">Job Order &bull; SSW</span>
                    </div>
                <?php else : ?>
                    <!-- Placeholder Khusus Berita & Dokumentasi -->
                    <div class="post-thumb-placeholder bg-light d-flex flex-column align-items-center justify-content-center text-secondary text-center p-3 w-100 h-100 border-bottom">
                        <i class="bi bi-newspaper display-5 mb-2 text-danger opacity-75"></i>
                        <span class="small fw-semibold text-muted text-uppercase letter-spacing-1">Berita & Informasi</span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Category Badge di Atas Gambar -->
            <span class="badge <?php echo $is_job ? 'bg-danger text-white' : 'bg-dark bg-opacity-75 text-white'; ?> position-absolute top-0 start-0 m-3 rounded-pill px-3 py-1.5 small fw-semibold shadow-sm">
                <?php echo esc_html( $cat_name ); ?>
            </span>
        </div>

        <!-- Card Body -->
        <div class="card-body d-flex flex-column p-4">
            <!-- Meta Date & Type -->
            <div class="post-meta text-muted small mb-2 d-flex align-items-center gap-2">
                <span><i class="bi bi-calendar3 text-danger me-1"></i><?php echo esc_html( $post_date ); ?></span>
                <span>&bull;</span>
                <?php if ( $is_job ) : ?>
                    <span class="badge bg-danger-subtle text-danger small fw-semibold">Tokutei Ginou (SSW)</span>
                <?php else : ?>
                    <span class="badge bg-light text-secondary border small fw-medium">Artikel & Dokumentasi</span>
                <?php endif; ?>
            </div>

            <!-- Title -->
            <h2 class="card-title h5 mb-3 fw-bold post-card-title">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark hover-danger">
                    <?php the_title(); ?>
                </a>
            </h2>

            <!-- Excerpt -->
            <div class="card-text text-secondary mb-3 small flex-grow-1">
                <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?>
            </div>

            <!-- Bottom CTA Button (Disesuaikan Jenis Konten) -->
            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                <?php if ( $is_job ) : ?>
                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-japan fw-semibold px-3 py-1.5 d-inline-flex align-items-center gap-1">
                        <span>Detail Lowongan</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <span class="badge bg-success-subtle text-success small fw-semibold d-inline-flex align-items-center gap-1">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Pendaftaran Buka</span>
                    </span>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-danger fw-semibold px-3 py-1.5 d-inline-flex align-items-center gap-1">
                        <span>Baca Selengkapnya</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <span class="text-muted small d-inline-flex align-items-center gap-1">
                        <i class="bi bi-book"></i>
                        <span>Info Resmi</span>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </article>
</div>
