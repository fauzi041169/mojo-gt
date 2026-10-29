<?php
/**
 * Bootstrap Search Form Template
 *
 * @package Mojo_Bootstrap
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group">
        <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Cari berita & lowongan...', 'placeholder', 'mojo-bootstrap' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required aria-label="<?php echo esc_attr_x( 'Search for:', 'label', 'mojo-bootstrap' ); ?>">
        <button class="btn btn-danger" type="submit" id="button-search" style="background-color: #c9182b; border-color: #c9182b;">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>
