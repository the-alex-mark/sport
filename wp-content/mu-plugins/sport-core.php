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
    'constants'                => require 'includes/sport-constants.php',
    'helpers'                  => require 'includes/sport-helpers.php',
    'main'                     => require 'includes/sport-functions.php',
    'shortcodes'               => require 'includes/sport-shortcodes.php',
    'meta_box'                 => require 'includes/fields/sport-meta_box.php',

    // Хуки
    'hook_actions'             => require 'includes/hooks/sport-actions.php',
    'hook_filters'             => require 'includes/hooks/sport-filters.php',

    // Дополнительно
    'class_walker_social'      => require 'includes/classes/walker/sport-walker-social.php',
    'class_organization'       => require 'includes/classes/sport-class-organization.php',
    'class_plugin_activation'  => require 'includes/classes/sport-class-plugin_activation.php',

    // Настройка панели администратора
    'admin'                    => require 'includes/admin/sport-admin.php',
    'admin_locale'             => require 'includes/admin/sport-locale.php',
    'admin_enqueue'            => require 'includes/admin/sport-enqueue.php',
    'admin_security'           => require 'includes/admin/sport-security.php',
    'menu_organization'        => require 'includes/admin/menu/sport-organization.php',
    'menu_tools'               => require 'includes/admin/menu/sport-tools.php',

    // Пользовательские таксономии
    'taxonomy_staff'           => require 'includes/taxonomies/sport-staff.php',
    'taxonomy_faq'             => require 'includes/taxonomies/sport-faq.php',
    'taxonomy_gratitudes'      => require 'includes/taxonomies/sport-gratitudes.php',
    'taxonomy_partners'        => require 'includes/taxonomies/sport-partners.php',

    // Плагин "WooCommerce"
    'wc'                       => require 'includes/woocommerce/sport-wc.php',
    'wc_functions'             => require 'includes/woocommerce/sport-wc-functions.php',
    'wc_links'                 => require 'includes/woocommerce/sport-wc-links.php',
    'wc_fields'                => require 'includes/woocommerce/sport-wc-fields.php'
];