<?php
/**
 * Template part for displaying single post content
 *
 * @package Mojo_Bootstrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post bg-white p-4 p-md-5 rounded shadow-sm border mb-4' ); ?>>
    <header class="entry-header mb-4">
        <div class="entry-meta text-muted small mb-2 d-flex flex-wrap align-items-center gap-2">
            <span><?php esc_html_e( 'Published:', 'mojo-bootstrap' ); ?> <?php echo esc_html( get_the_date() ); ?></span>
            <span>&bull;</span>
            <span><?php esc_html_e( 'By', 'mojo-bootstrap' ); ?> <?php the_author_posts_link(); ?></span>
            <?php if ( has_category() ) : ?>
                <span>&bull;</span>
                <span><?php the_category( ', ' ); ?></span>
            <?php endif; ?>
        </div>

        <h1 class="entry-title display-6 fw-bold mb-3"><?php the_title(); ?></h1>

        <?php
        $job_loc   = get_post_meta( get_the_ID(), '_mojo_job_location', true );
        $job_quota = get_post_meta( get_the_ID(), '_mojo_job_quota', true );
        $job_yen   = get_post_meta( get_the_ID(), '_mojo_job_salary_yen', true );
        $job_idr   = get_post_meta( get_the_ID(), '_mojo_job_salary_idr', true );
        $wa_num    = get_theme_mod( 'mojo_whatsapp', '+62 812-3456-7890' );
        $wa_clean  = function_exists( 'mojo_clean_whatsapp_number' ) ? mojo_clean_whatsapp_number( $wa_num ) : preg_replace( '/[^0-9]/', '', $wa_num );
        $wa_msg    = 'Halo Admin Mojo Global Talent, saya tertarik melamar lowongan: ' . get_the_title() . ' (' . get_permalink() . ')';
        $wa_url    = function_exists( 'mojo_get_whatsapp_url' ) ? mojo_get_whatsapp_url( $wa_msg, $wa_num ) : ( 'https://wa.me/' . $wa_clean . '?text=' . rawurlencode( $wa_msg ) );

        if ( ! empty( $job_yen ) || ! empty( $job_loc ) || ! empty( $job_quota ) || ! empty( $job_idr ) ) :
        ?>
        <div class="job-spec-box bg-light p-4 rounded-4 border my-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3 pb-3 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-danger rounded-pill px-3 py-2 small fw-bold letter-spacing-1">
                        <i class="bi bi-briefcase-fill me-1"></i>Spesifikasi Job Order
                    </span>
                    <span class="badge bg-white text-dark border rounded-pill px-3 py-2 small fw-semibold">
                        <i class="bi bi-patch-check-fill text-success me-1"></i>Resmi Kemnaker
                    </span>
                </div>
                <div>
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" class="btn btn-japan btn-sm px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm" title="Lamar Lowongan via WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                        <span>Lamar Lowongan via WhatsApp</span>
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <?php if ( ! empty( $job_loc ) ) : ?>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border h-100">
                            <div class="small text-muted mb-1 d-flex align-items-center gap-1">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                <span class="fw-semibold">Lokasi Penempatan:</span>
                            </div>
                            <div class="fw-bold text-dark" style="word-break: break-word; line-height: 1.5;">
                                <?php echo esc_html( $job_loc ); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $job_quota ) ) : ?>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border h-100">
                            <div class="small text-muted mb-1 d-flex align-items-center gap-1">
                                <i class="bi bi-people-fill text-primary"></i>
                                <span class="fw-semibold">Kuota Kebutuhan:</span>
                            </div>
                            <div class="fw-bold text-dark" style="word-break: break-word; line-height: 1.5;">
                                <?php echo esc_html( $job_quota ); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $job_yen ) ) : ?>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border h-100">
                            <div class="small text-muted mb-1 d-flex align-items-center gap-1">
                                <i class="bi bi-currency-yen text-success"></i>
                                <span class="fw-semibold">Standar Gaji Pokok (Yen):</span>
                            </div>
                            <div class="fw-bold text-success fs-5">
                                <?php echo esc_html( $job_yen ); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $job_idr ) ) : ?>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border h-100">
                            <div class="small text-muted mb-1 d-flex align-items-center gap-1">
                                <i class="bi bi-cash-stack text-success"></i>
                                <span class="fw-semibold">Estimasi Pendapatan Bulanan:</span>
                            </div>
                            <div class="fw-bold text-dark fs-5">
                                <?php echo esc_html( $job_idr ); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-featured-image mb-4">
            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid rounded w-100 shadow-sm' ) ); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content mb-4 lh-lg">
        <?php
        the_content();

        wp_link_pages( array(
            'before'      => '<div class="page-links mt-4 pt-3 border-top"><span class="page-links-title me-2 fw-semibold">' . esc_html__( 'Pages:', 'mojo-bootstrap' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span class="badge bg-primary me-1">',
            'link_after'  => '</span>',
        ) );
        ?>
    </div>

    <footer class="entry-footer border-top pt-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <?php if ( has_tag() ) : ?>
            <div class="tags-links">
                <span class="fw-semibold me-2"><?php esc_html_e( 'Tags:', 'mojo-bootstrap' ); ?></span>
                <?php the_tags( '<span class="badge bg-light text-dark border me-1">', '</span> <span class="badge bg-light text-dark border me-1">', '</span>' ); ?>
            </div>
        <?php endif; ?>
    </footer>
</article>

<!-- Author Box -->
<div class="author-bio card border-0 shadow-sm mb-4 p-3 bg-light">
    <div class="d-flex align-items-center gap-3">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 64, '', '', array( 'class' => 'rounded-circle shadow-sm' ) ); ?>
        <div>
            <h6 class="mb-1 fw-bold"><?php the_author(); ?></h6>
            <p class="small text-muted mb-0"><?php echo esc_html( get_the_author_meta( 'description' ) ? get_the_author_meta( 'description' ) : __( 'Author at ' . get_bloginfo( 'name' ), 'mojo-bootstrap' ) ); ?></p>
        </div>
    </div>
</div>
