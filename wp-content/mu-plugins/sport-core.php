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
    'constants'           => require 'includes/sport-constants.php',
    'helpers'             => require 'includes/sport-helpers.php',
    'main'                => require 'includes/sport-functions.php',
    'shortcodes'          => require 'includes/sport-shortcodes.php',

    // Хуки
    'hook_actions'        => require 'includes/hooks/sport-actions.php',
    'hook_filters'        => require 'includes/hooks/sport-filters.php',

    // Дополнительно
    'class_organization'  => require 'includes/classes/sport-class-organization.php',

    // Настройка панели администратора
    'admin'               => require 'includes/admin/sport-admin.php',
    'admin_enqueue'       => require 'includes/admin/sport-enqueue.php',
    'admin_security'      => require 'includes/admin/sport-security.php',
    'menu_organization'   => require 'includes/admin/menu/sport-organization.php',
    'menu_tools'          => require 'includes/admin/menu/sport-tools.php',

    // Пользовательские таксономии
    'taxonomy_staff'      => require 'includes/taxonomies/sport-staff.php',
    'taxonomy_faq'        => require 'includes/taxonomies/sport-faq.php',
    'taxonomy_gratitudes' => require 'includes/taxonomies/sport-gratitudes.php',
    'taxonomy_partners'   => require 'includes/taxonomies/sport-partners.php',

    // Дополнительные поля
    // 'fields_custom_css'   => require 'includes/fields/sport-custom_css.php',

    // Плагин "WooCommerce"
    'wc'                  => require 'includes/woocommerce/sport-wc.php',
    'wc_functions'        => require 'includes/woocommerce/sport-wc-functions.php',
    'wc_links'            => require 'includes/woocommerce/sport-wc-links.php'
];