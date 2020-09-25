<?php

if (!defined('ABSPATH'))
    exit;

// Обновление количества добавленных товаров в корзину (без перезагрузки страницы)
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?><span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span><?php
    $fragments['li a span.cart-count'] = ob_get_clean();

    return $fragments;
});

// Сортировка по названию
add_filter('woocommerce_get_catalog_ordering_args', 'add_custom_sort_by_name');
function add_custom_sort_by_name($args) {

    $orderby_value = isset($_GET['orderby'])
        ? wc_clean($_GET['orderby'])
        : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

	if ('name' == $orderby_value) {
		$args['orderby']  = 'name';
		$args['order']    = 'ASC';
		$args['meta_key'] = '';
    }

	if ('name-desc' == $orderby_value) {
		$args['orderby']  = 'name';
		$args['order']    = 'DESC';
		$args['meta_key'] = '';
    }
    
	return $args;
}

// Сортировка по наличию
add_filter('woocommerce_get_catalog_ordering_args', 'add_custom_sort_by_availability');
function add_custom_sort_by_availability($args) {

    $orderby_value = isset($_GET['orderby'])
        ? wc_clean($_GET['orderby'])
        : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

	if ('availability' == $orderby_value) {
		$args['orderby']  = 'meta_value_num wp_posts.ID';
		$args['order']    = 'ASC';
		$args['meta_key'] = '_stock';
    }
    
	if ('availability-desc' == $orderby_value) {
		$args['orderby']  = 'meta_value_num wp_posts.ID';
		$args['order']    = 'DESC';
		$args['meta_key'] = '_stock';
	}

	return $args;
}

// Редактирование вариантов сортировки
add_filter('woocommerce_default_catalog_orderby_options', 'edit_custom_sort');
add_filter('woocommerce_catalog_orderby', 'edit_custom_sort');
function edit_custom_sort($orderby) {

    // Удаление вариантов сортировок по умолчанию
    unset($orderby["menu_order"]);
    unset($orderby["popularity"]);
    unset($orderby["rating"]);
    unset($orderby["date"]);
    unset($orderby["price-desc"]);

    // Присвоение имён вариантам сортировки
    $orderby = [
        'name'       => 'Название',
        'name-desc'  => 'Название (по убыванию)',
        'price'      => 'Цена',
        'price-desc' => 'Цена (по убыванию)'
    ];

    return $orderby;
}