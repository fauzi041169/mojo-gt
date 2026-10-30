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
            <?php
            $filter       = isset( $_GET['tipe'] ) ? sanitize_key( $_GET['tipe'] ) : 'all';
            $job_cat_ids  = function_exists( 'mojo_get_job_category_ids' ) ? mojo_get_job_category_ids() : array();
            $news_cat_ids = function_exists( 'mojo_get_news_category_ids' ) ? mojo_get_news_category_ids() : array();
            ?>

            <!-- Filter Tabs Kategori & Jenis Informasi -->
            <div class="d-flex flex-wrap gap-2 mb-4">
                <a href="<?php echo esc_url( remove_query_arg( 'tipe' ) ); ?>" class="btn btn-sm <?php echo $filter === 'all' ? 'btn-japan' : 'btn-outline-secondary'; ?> rounded-pill px-3 py-1.5 fw-semibold">
                    <i class="bi bi-grid-fill me-1"></i> Semua Informasi
                </a>
                <a href="<?php echo esc_url( add_query_arg( 'tipe', 'berita' ) ); ?>" class="btn btn-sm <?php echo $filter === 'berita' ? 'btn-japan' : 'btn-outline-secondary'; ?> rounded-pill px-3 py-1.5 fw-semibold">
                    <i class="bi bi-newspaper me-1"></i> Berita & Dokumentasi
                </a>
                <a href="<?php echo esc_url( add_query_arg( 'tipe', 'lowongan' ) ); ?>" class="btn btn-sm <?php echo $filter === 'lowongan' ? 'btn-japan' : 'btn-outline-secondary'; ?> rounded-pill px-3 py-1.5 fw-semibold">
                    <i class="bi bi-briefcase-fill me-1"></i> Lowongan Kerja (SSW)
                </a>
            </div>

            <?php
            // Jika user memilih filter spesifik berita/lowongan
            $custom_query = null;
            if ( $filter !== 'all' ) {
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
                $query_args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 8,
                    'paged'          => $paged,
                    'post_status'    => 'publish',
                );
                if ( $filter === 'berita' && ! empty( $news_cat_ids ) ) {
                    $query_args['category__in'] = $news_cat_ids;
                } elseif ( $filter === 'lowongan' && ! empty( $job_cat_ids ) ) {
                    $query_args['category__in'] = $job_cat_ids;
                }
                $custom_query = new WP_Query( $query_args );
            }

            $the_posts = $custom_query ? $custom_query : $wp_query;

            if ( $the_posts->have_posts() ) :
                ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php
                    while ( $the_posts->have_posts() ) : $the_posts->the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
                    endwhile;
                    ?>
                </div>

                <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                    <?php
                    if ( $custom_query ) {
                        echo paginate_links( array(
                            'total'     => $custom_query->max_num_pages,
                            'current'   => $paged,
                            'prev_text' => '&laquo;',
                            'next_text' => '&raquo;',
                        ) );
                        wp_reset_postdata();
                    } else {
                        mojo_bootstrap_pagination();
                    }
                    ?>
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
                            <li class="py-2 border-bottom"><a href="<?php echo esc_url( home_url( '/lowongan-kerja/' ) ); ?>" class="text-decoration-none text-secondary">Lowongan Kerja (SSW)</a></li>
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
