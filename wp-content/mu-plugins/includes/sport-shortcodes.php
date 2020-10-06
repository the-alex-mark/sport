<?php

if (!defined('ABSPATH'))
    exit;

// Калькулятор расчёта доставки
add_shortcode('calculation_of_shipping', function ($args) {
    ob_start();
    require SPORT_PLUGIN_TEMPLATES_PARTS . '/calculation_of_shipping.php';
    $part = ob_get_contents();
    ob_end_clean();

    return $part;
});

// Калькулятор расчёта доставки
add_shortcode('calculation_of_shipping', function ($args) {
    ob_start();
    require SPORT_PLUGIN_TEMPLATES_PARTS . '/calculation_of_shipping.php';
    $part = ob_get_contents();
    ob_end_clean();

    return $part;
});