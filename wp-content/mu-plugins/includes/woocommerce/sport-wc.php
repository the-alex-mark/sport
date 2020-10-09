<?php

if (!defined('ABSPATH'))
    exit;

// Изменение символа валюты
add_filter('woocommerce_currency_symbol', 'sport_wc_currency_symbol', 10, 2);
function sport_wc_currency_symbol($symbol, $currency) {
    switch($currency) {
        case 'RUB': $symbol = ' руб.'; break;
    }
    
    return $symbol;
}

// Скрытие нулей после запятой в цене
add_filter('woocommerce_price_trim_zeros', 'sport_wc_hide_trailing_zeros', 10, 1);
function sport_wc_hide_trailing_zeros($trim) {
    return false;
}

// Русификация сокращения величины веса
add_filter('woocommerce_format_weight', function ($weight) {
    return str_replace('kg', 'кг', $weight);
});

// Русификация сокращения величины размеров
add_filter('woocommerce_format_dimensions', function ($dimensions) {
    return str_replace('cm', 'см', $dimensions);
});

// Скрытие товаров в каталоге магазина из категории "Импортные алалоги"
add_action('woocommerce_product_query', function ($query) {

    $category = get_queried_object();
    if (is_admin() || $category->slug == 'import')
        return;

    $tax_query = (array)$query->get('tax_query');
    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field'    => 'slug',
           'terms'    => [ 'uncategorised', 'import' ],
           'operator' => 'NOT IN'
    );
    $query->set('tax_query', $tax_query);
});