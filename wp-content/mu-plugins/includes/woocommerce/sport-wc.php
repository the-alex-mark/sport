<?php

if (!defined('ABSPATH'))
    exit;

// Скрытие нулей после запятой в цене
add_filter('woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1);
function wc_hide_trailing_zeros($trim) {
    return false;
}