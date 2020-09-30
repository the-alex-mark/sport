<?php

if (!defined('ABSPATH'))
    exit;

/**
 * Выводит навигацию, настроенную плагином "WooCommerce".
 */
function sport_wc_breadcrumb($args = []) {
    $breadcrumbs = new WC_Breadcrumb();
    $args = wp_parse_args(
        $args,
        apply_filters(
            'woocommerce_breadcrumb_defaults',
            [
                'delimiter'   => '&nbsp;&#47;&nbsp;',
                'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
                'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
            ]
        )
    );

    if (!empty($args['home']))
        $breadcrumbs->add_crumb($args['home'], apply_filters('woocommerce_breadcrumb_home_url', home_url()));

    $args['breadcrumb'] = $breadcrumbs->generate();

    get_template_part(SPORT_TEMPLATES_GLOBAL . '/breadcrumb', null, $args);
}

/**
 * Выводит форму сортировки товаров, настроенную плагинов "WooCommerce"
 */
function sport_wc_ordering() {
    if (!wc_get_loop_prop('is_paginated') || !woocommerce_products_will_display())
        return;

    $show_default_orderby    = 'menu_order' === apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby', 'menu_order'));
    $catalog_orderby_options = apply_filters(
        'woocommerce_catalog_orderby',
        [
            'menu_order' => __( 'Default sorting', 'woocommerce' ),
            'popularity' => __( 'Sort by popularity', 'woocommerce' ),
            'rating'     => __( 'Sort by average rating', 'woocommerce' ),
            'date'       => __( 'Sort by latest', 'woocommerce' ),
            'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
            'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
        ]
    );

    $default_orderby = wc_get_loop_prop('is_search') ? 'relevance' : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby', ''));
    $orderby = isset($_GET['orderby']) ? wc_clean(wp_unslash($_GET['orderby'])) : $default_orderby;

    if (wc_get_loop_prop('is_search')) {
        $catalog_orderby_options = array_merge(['relevance' => __( 'Relevance', 'woocommerce' )], $catalog_orderby_options);

        unset($catalog_orderby_options['menu_order']);
    }

    if (!$show_default_orderby) {
        unset($catalog_orderby_options['menu_order']);
    }

    if (!wc_review_ratings_enabled()) {
        unset($catalog_orderby_options['rating']);
    }

    if (!array_key_exists( $orderby, $catalog_orderby_options)) {
        $orderby = current(array_keys($catalog_orderby_options));
    }

    foreach ($catalog_orderby_options as $key => $value) {
        if (strpos($key, '-desc'))
            unset($catalog_orderby_options[$key]);
    }

    get_template_part(
        SPORT_TEMPLATES_WOOCOMMERCE . '/product/product', 'orderby',
        [
            'catalog_orderby_options' => $catalog_orderby_options,
            'orderby'                 => $orderby,
            'show_default_orderby'    => $show_default_orderby
        ]
    );
}

/**
 * Выводит пагинацию, настроенную плагином "WooCommerce".
 */
function sport_wc_pagination() {
    if (!wc_get_loop_prop('is_paginated') || !woocommerce_products_will_display())
        return;

    $args = [
        'total'   => wc_get_loop_prop('total_pages'),
        'current' => wc_get_loop_prop('current_page'),
        'base'    => esc_url_raw(add_query_arg('product-page', '%#%', false)),
        'format'  => '?product-page=%#%',
    ];

    if (!wc_get_loop_prop('is_shortcode')) {
        $args['format'] = '';
        $args['base']   = esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
    }
    
    get_template_part(
        SPORT_TEMPLATES_WOOCOMMERCE . '/product/product', 'pagination',
        $args);
}

// Переопределение отображения изображения товара
remove_filter('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
add_filter('woocommerce_before_single_product_summary', function () {
    get_template_part(SPORT_TEMPLATES_WOOCOMMERCE . '/product/product', 'gallery');
}, 20);

// Переопределение отображения кнопки добавления товара в корзину
remove_filter('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
add_filter('woocommerce_single_product_summary', function () {
    get_template_part(SPORT_TEMPLATES_WOOCOMMERCE . '/product/product', 'add_to_cart');
}, 30);