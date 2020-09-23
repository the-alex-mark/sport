<?php
/**
 * Plugin Name: Sport
 * Description: Основной функционал сайта фирмы "Стек-Спорт"
 * Version:     1.0
 * Author:      Компания "Стек"
 * Author URI:  https://stack-it.ru
 */

// Подключение необходимых файлов
$sport = (object)[
    
    // Функционал
    'main'        => require 'includes/sport-functions.php',
    'helpers'     => require 'includes/sport-helpers.php',
    'admin'       => require 'includes/admin/sport-admin.php',
    'taxonomies'  => require 'includes/admin/sport-taxonomies.php',
    'woocommerce' => require 'includes/woocommerce/sport-woocommerce.php',
];