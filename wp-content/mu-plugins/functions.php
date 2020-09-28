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
    'constants'   => require 'includes/sport-constants.php',
    'main'        => require 'includes/sport-functions.php',
    'helpers'     => require 'includes/sport-helpers.php',
    'shortcodes'  => require 'includes/sport-shortcodes.php',
    'taxonomies'  => require 'includes/sport-taxonomies.php',
    'admin'       => require 'includes/admin/sport-admin.php',
    'security'    => require 'includes/admin/sport-security.php',
    'menu'        => require 'includes/admin/sport-menu.php',
    'woocommerce' => require 'includes/woocommerce/sport-woocommerce.php',

    'test' => require 'includes/admin/test.php'
];