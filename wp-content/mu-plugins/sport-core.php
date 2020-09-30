<?php
/**
 * Plugin Name: Фирма "Стек-Спорт" Core
 * Description: Основной функционал сайта фирмы "Стек-Спорт"
 * Version:     1.0
 * Author:      Компания "Стек"
 * Author URI:  https://stack-it.ru
 */

// Подключение необходимых файлов
$sport = (object)[

    // Функционал
    'constants'         => require 'includes/sport-constants.php',
    'helpers'           => require 'includes/sport-helpers.php',
    'main'              => require 'includes/sport-functions.php',
    'shortcodes'        => require 'includes/sport-shortcodes.php',

    // Настройка панели администратора
    'admin'             => require 'includes/admin/sport-admin.php',
    'admin_security'    => require 'includes/admin/sport-security.php',

    // Пользовательское меню панели администратора
    'menu_organization' => require 'includes/admin/menu/sport-organization.php',
    'menu_tools'        => require 'includes/admin/menu/sport-tools.php',

    // Пользовательские таксономии
    'taxonomy_staff'    => require 'includes/taxonomies/sport-staff.php',
    'taxonomy_faq'      => require 'includes/taxonomies/sport-faq.php',

    // Плагин "WooCommerce"
    'wc'                => require 'includes/woocommerce/sport-wc.php',
    'wc_functions'      => require 'includes/woocommerce/sport-wc-functions.php'
];