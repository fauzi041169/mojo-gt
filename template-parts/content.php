<?php
/**
 * Template part for displaying posts (Job Orders & Berita)
 *
 * @package Mojo_Bootstrap
 */
?>

<div class="col">
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'card h-100 shadow-sm border rounded-4 overflow-hidden post-card' ); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" class="overflow-hidden">
                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-img-top object-fit-cover post-card-img' ) ); ?>
            </a>
        <?php else : ?>
            <div class="bg-primary bg-gradient p-4 text-white text-center position-relative">
                <span class="badge bg-danger position-absolute top-0 end-0 m-3 rounded-pill px-2 py-1 small">RESMI JEPANG</span>
                <i class="bi bi-briefcase-fill display-4 d-block mb-2 text-warning"></i>
                <span class="small text-white-50 text-uppercase fw-semibold">Job Order &bull; 募集要項</span>
            </div>
        <?php endif; ?>

        <div class="card-body d-flex flex-column p-4">
            <div class="post-meta text-muted small mb-2 d-flex align-items-center gap-2">
                <span><i class="bi bi-calendar3 text-danger"></i> <?php echo esc_html( get_the_date() ); ?></span>
                <span>&bull;</span>
                <span class="badge bg-light text-dark border">Penempatan Jepang</span>
            </div>

            <h2 class="card-title h5 mb-3 fw-bold">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                    <?php the_title(); ?>
                </a>
            </h2>

            <div class="card-text text-secondary mb-3 small flex-grow-1">
                <?php the_excerpt(); ?>
            </div>

            <div class="mt-auto pt-2 border-top d-flex justify-content-between align-items-center">
                <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-danger fw-semibold">
                    Detail Lowongan &rarr;
                </a>
                <span class="text-success small fw-bold"><i class="bi bi-check-circle-fill me-1"></i>Interview Terbuka</span>
            </div>
        </div>
    </article>
</div>
