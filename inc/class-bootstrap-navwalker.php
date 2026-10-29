<?php
/**
 * Bootstrap 5 Nav Walker for WordPress
 *
 * @package Mojo_Bootstrap
 */

if ( ! class_exists( 'Mojo_Bootstrap_Navwalker' ) ) {
    class Mojo_Bootstrap_Navwalker extends Walker_Nav_Menu {

        /**
         * Starts the list before the elements are added.
         */
        public function start_lvl( &$output, $depth = 0, $args = null ) {
            $indent = str_repeat( "\t", $depth );
            $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        }

        /**
         * Starts the element output.
         */
        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $has_children = in_array( 'menu-item-has-children', $classes, true );

            // Item classes
            $class_names = 'nav-item';
            if ( $has_children ) {
                $class_names .= ' dropdown';
            }
            if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true ) ) {
                $class_names .= ' active';
            }

            $output .= $indent . '<li class="' . esc_attr( $class_names ) . '">';

            // Link attributes
            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

            $link_classes = array();
            if ( $depth === 0 ) {
                $link_classes[] = 'nav-link';
            } else {
                $link_classes[] = 'dropdown-item';
            }

            if ( in_array( 'current-menu-item', $classes, true ) ) {
                $link_classes[] = 'active';
                $atts['aria-current'] = 'page';
            }

            if ( $has_children && $depth === 0 ) {
                $link_classes[] = 'dropdown-toggle';
                $atts['href']           = '#';
                $atts['role']           = 'button';
                $atts['data-bs-toggle'] = 'dropdown';
                $atts['aria-expanded']  = 'false';
            }

            $atts['class'] = implode( ' ', $link_classes );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $title = apply_filters( 'the_title', $item->title, $item->ID );
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        /**
         * Ends the element output, if needed.
         */
        public function end_el( &$output, $item, $depth = 0, $args = null ) {
            $output .= "</li>\n";
        }

        /**
         * Ends the list of after the elements are added.
         */
        public function end_lvl( &$output, $depth = 0, $args = null ) {
            $indent = str_repeat( "\t", $depth );
            $output .= "$indent</ul>\n";
        }
    }
}
