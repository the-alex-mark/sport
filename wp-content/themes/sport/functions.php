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

    // Функционал
    'constants'   => require 'includes/sport-constants.php',
    'setup'       => require 'includes/sport-setup.php',
    'main'        => require 'includes/sport-functions.php',
    'shortcodes'  => require 'includes/sport-shortcodes.php',
    'woocommerce' => require 'includes/woocommerce/sport-woocommerce.php'
];