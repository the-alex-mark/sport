<?php

if (!defined('ABSPATH'))
    exit;

// Обновление количества добавленных товаров в корзину
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?><span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span><?php
    $fragments['li a span.cart-count'] = ob_get_clean();

    return $fragments;
});

// Добавление варианта сортировки товаров по названию
add_filter('woocommerce_get_catalog_ordering_args', 'custom_sort_by_name_args');
function custom_sort_by_name_args($args) {

    $orderby_value = isset($_GET['orderby'])
        ? wc_clean($_GET['orderby'])
        : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

	if ('name' == $orderby_value) {
		$args['orderby'] = 'name';
		$args['order'] = 'ASC';
		$args['meta_key'] = '';
    }
    
	return $args;
}

// Редактирование вариантов сортировки
add_filter('woocommerce_default_catalog_orderby_options', 'edit_sort');
add_filter('woocommerce_catalog_orderby', 'edit_sort', 1);
function edit_sort($orderby) {

    // Удаление сортировок по умолчанию
    unset($orderby["menu_order"]);
    unset($orderby["popularity"]);
    unset($orderby["rating"]);
    unset($orderby["date"]);
    unset($orderby["price-desc"]);

    // Задание элементам имён
    $orderby['name'] = 'Название';
    $orderby['price'] = 'Цена';

    // Смена элементов местами
    // list($orderby['price'], $orderby['name']) = [ $orderby['name'], $orderby['price'] ];
    
	return $orderby;
}