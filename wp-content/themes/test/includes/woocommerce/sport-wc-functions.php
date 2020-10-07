<?php

if (!defined('ABSPATH'))
    exit;

// Переопределение отображения кнопки добавления товара в корзину
remove_filter('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
add_filter('woocommerce_single_product_summary', function () {
    get_template_part(SPORT_TEMPLATES_WOOCOMMERCE . '/product/product', 'add_to_cart');
}, 30);