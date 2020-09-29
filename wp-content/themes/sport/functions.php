<?php

if (!defined('ABSPATH'))
    exit;

// Описание темы
$theme = wp_get_theme('sport');

// Подключение необходимых файлов
$sport = (object)[
    
    // Описание темы
    'theme' => [
        'name'        => $theme['Name'],
        'description' => $theme['Description'],
        'version'     => $theme['Version'],
    ],

    // Функционал темы
    'constants'    => require 'includes/sport-constants.php',
    'setup'        => require 'includes/sport-setup.php',
    'main'         => require 'includes/sport-functions.php',
    'templates'    => require 'includes/sport-templates.php',
    'shortcodes'   => require 'includes/sport-shortcodes.php',

    // Плагин "WooCommerce"
    'wc'           => require 'includes/woocommerce/sport-wc.php',
    'wc_functions' => require 'includes/woocommerce/sport-wc-functions.php'
];