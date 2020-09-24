<?php

if (!defined('ABSPATH'))
    exit;

if (!function_exists('get_breadcrumb')) {

    /**
     * Вывод хлебных крошек
     */
    function get_breadcrumb($args = array()) {
        $args = wp_parse_args(
            $args,
            apply_filters(
                'woocommerce_breadcrumb_defaults',
                array(
                    'delimiter'   => '&nbsp;&#47;&nbsp;',
                    'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                    'wrap_after'  => '</nav>',
                    'before'      => '',
                    'after'       => '',
                    'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
                )
            )
        );

        $breadcrumbs = new WC_Breadcrumb();

        if (!empty( $args['home'])) {
            $breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        // do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

        wc_get_template( 'parts\breadcrumb.php', $args, '', TEMPLATES );
    }
}

/**
 * 
 */
function sport_catalog_ordering() {
    if (!wc_get_loop_prop('is_paginated') || !woocommerce_products_will_display())
        return;

    $show_default_orderby    = 'menu_order' === apply_filters('woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
    $catalog_orderby_options = apply_filters(
        'woocommerce_catalog_orderby',
        array(
            'menu_order' => __( 'Default sorting', 'woocommerce' ),
            'popularity' => __( 'Sort by popularity', 'woocommerce' ),
            'rating'     => __( 'Sort by average rating', 'woocommerce' ),
            'date'       => __( 'Sort by latest', 'woocommerce' ),
            'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
            'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
        )
    );

    $default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', '' ) );
    $orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby;

    if ( wc_get_loop_prop( 'is_search' ) ) {
        $catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );

        unset( $catalog_orderby_options['menu_order'] );
    }

    if ( ! $show_default_orderby ) {
        unset( $catalog_orderby_options['menu_order'] );
    }

    if ( ! wc_review_ratings_enabled() ) {
        unset( $catalog_orderby_options['rating'] );
    }

    if ( ! array_key_exists( $orderby, $catalog_orderby_options ) ) {
        $orderby = current( array_keys( $catalog_orderby_options ) );
    }

    wc_get_template(
        'parts/orderby.php',
        [
            'catalog_orderby_options' => $catalog_orderby_options,
            'orderby'                 => $orderby,
            'show_default_orderby'    => $show_default_orderby,
        ],
        '',
        TEMPLATES
    );
}