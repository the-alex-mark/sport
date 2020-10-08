<?php

if (!defined('ABSPATH'))
    exit;

// Фильтрация товаров на странице
add_action('sport_wc_catalog_filter', 'sport_wc_filter_products', 10);
function sport_wc_filter_products() {
    get_template_part(SPORT_TEMPLATES_PARTS . '/form', 'filter');
}

// Ссылка добавления товара в таблицу сравнеия
if (!is_admin()) {
    add_action('sport_wc_add_compare_link', [ new YITH_Woocompare_Frontend_Premium(), 'add_compare_link' ], 10);
}