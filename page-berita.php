<?php
/**
 * Template Name: Halaman Berita & Job Order
 * Template for Berita page (with Search & Category Sidebar)
 *
 * @package Mojo_Bootstrap
 */

get_header();
?>

<div class="container py-4">
    <!-- Header Judul Berita -->
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-4">
        <span class="badge bg-danger-subtle text-danger fw-bold px-3 py-2 rounded-pill mb-2">Pusat Informasi Resmi</span>
        <h1 class="display-6 fw-bold text-dark mb-2"><?php esc_html_e( 'Berita, Lowongan & Pengumuman Seleksi', 'mojo-bootstrap' ); ?></h1>
        <p class="text-muted mb-0"><?php esc_html_e( 'Informasi terkini jadwal wawancara kerja ke Jepang, job order baru, dan regulasi visa kerja resmi.', 'mojo-bootstrap' ); ?></p>
    </div>

    <div class="row">
        <!-- Main News Column -->
        <div class="col-lg-8">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $news_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'paged'          => $paged,
            ) );

            if ( $news_query->have_posts() ) :
                ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php
                    while ( $news_query->have_posts() ) : $news_query->the_post();
                        get_template_part( 'template-parts/content', get_post_format() );
                    endwhile;
                    ?>
                </div>

                <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                    <?php
                    echo paginate_links( array(
                        'total'     => $news_query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                    ) );
                    ?>
                </div>
                <?php
                wp_reset_postdata();
            else :
                ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>
        </div>

        <!-- Sidebar Berita (Khusus Halaman Berita) -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <aside class="sidebar-widget-area">
                <!-- Search Card -->
                <div class="card p-4 border rounded-4 shadow-sm bg-white mb-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark">
                        <i class="bi bi-search text-danger me-2"></i>Pencarian
                    </h5>
                    <?php get_search_form(); ?>
                </div>

                <!-- Categories Card -->
                <div class="card p-4 border rounded-4 shadow-sm bg-white mb-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark">
                        <i class="bi bi-tags-fill text-danger me-2"></i>Kategori Lowongan
                    </h5>
                    <ul class="list-unstyled mb-0 small">
                        <?php
                        $categories = get_categories();
                        if ( ! empty( $categories ) ) :
                            foreach ( $categories as $category ) :
                                ?>
                                <li class="py-2 border-bottom d-flex justify-content-between align-items-center">
                                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="text-decoration-none text-secondary">
                                        <?php echo esc_html( $category->name ); ?>
                                    </a>
                                    <span class="badge bg-light text-dark border"><?php echo esc_html( $category->count ); ?></span>
                                </li>
                                <?php
                            endforeach;
                        else :
                            ?>
                            <li class="py-2 border-bottom"><a href="#" class="text-decoration-none text-secondary">Tokutei Ginou (SSW)</a></li>
                            <li class="py-2 border-bottom"><a href="<?php echo esc_url( home_url( '/lowongan-kerja/' ) ); ?>" class="text-decoration-none text-secondary">Lowongan Kerja (SSW)</a></li>
                            <li class="py-2 border-bottom"><a href="#" class="text-decoration-none text-secondary">Pelatihan Bahasa Jepang</a></li>
                            <li class="py-2"><a href="#" class="text-decoration-none text-secondary">Jadwal Seleksi Interview</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Recent Posts / Job Orders -->
                <div class="card p-4 border rounded-4 shadow-sm bg-white mb-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark">
                        <i class="bi bi-fire text-danger me-2"></i>Lowongan Terpopuler
                    </h5>
                    <ul class="list-unstyled mb-0 small">
                        <?php
                        $popular_posts = new WP_Query( array(
                            'posts_per_page' => 4,
                            'post_status'    => 'publish',
                        ) );
                        while ( $popular_posts->have_posts() ) : $popular_posts->the_post();
                            ?>
                            <li class="py-2 border-bottom">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark fw-semibold d-block text-truncate">
                                    <?php the_title(); ?>
                                </a>
                                <span class="text-muted small"><?php echo esc_html( get_the_date() ); ?></span>
                            </li>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>

<?php
get_footer();
