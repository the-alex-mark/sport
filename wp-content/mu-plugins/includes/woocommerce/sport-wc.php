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