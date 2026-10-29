<?php
/**
 * Main template file for Mojo Bootstrap - Halaman Berita & Job Orders
 *
 * @package Mojo_Bootstrap
 */

get_header();
?>

<div class="container py-4">
    <!-- Header Judul Berita -->
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-4">
        <span class="badge bg-danger-subtle text-danger fw-bold px-3 py-2 rounded-pill mb-2">Informasi & Update Resmi</span>
        <h1 class="display-6 fw-bold text-dark mb-2"><?php esc_html_e( 'Berita, Job Order & Pengumuman Seleksi', 'mojo-bootstrap' ); ?></h1>
        <p class="text-muted mb-0"><?php esc_html_e( 'Ikuti informasi terbaru seputar pembukaan lowongan kerja ke Jepang, tips wawancara kerja, dan regulasi visa resmi.', 'mojo-bootstrap' ); ?></p>
    </div>

    <div class="row">
        <!-- Main News Column -->
        <div class="col-lg-8">
            <?php if ( have_posts() ) : ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
                    endwhile;
                    ?>
                </div>

                <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                    <?php mojo_bootstrap_pagination(); ?>
                </div>
            <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>
        </div>

        <!-- Sidebar Berita (Pencarian, Kategori, Pos Terbaru) -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                <aside class="sidebar-widget-area">
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </aside>
            <?php else : ?>
                <!-- Default News Sidebar Fallback -->
                <aside class="sidebar-widget-area">
                    <div class="card p-4 border rounded-4 shadow-sm bg-white mb-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark">Cari Berita & Lowongan</h5>
                        <?php get_search_form(); ?>
                    </div>

                    <div class="card p-4 border rounded-4 shadow-sm bg-white mb-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark">Kategori Program</h5>
                        <ul class="list-unstyled mb-0 small">
                            <li class="py-2 border-bottom"><a href="#" class="text-decoration-none text-secondary">Tokutei Ginou / SSW</a></li>
                            <li class="py-2 border-bottom"><a href="#" class="text-decoration-none text-secondary">Magang TITP Jepang</a></li>
                            <li class="py-2 border-bottom"><a href="#" class="text-decoration-none text-secondary">Pelatihan Bahasa Jepang</a></li>
                            <li class="py-2"><a href="#" class="text-decoration-none text-secondary">Jadwal Seleksi & Interview</a></li>
                        </ul>
                    </div>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
