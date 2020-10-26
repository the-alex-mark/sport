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
    'constants'     => require 'includes/sport-constants.php',
    'setup'         => require 'includes/sport-setup.php',
    'plugins'       => require 'includes/plugins/sport-plugins.php',
    'locale'        => require 'includes/sport-locale.php',
    'main'          => require 'includes/sport-functions.php',
    'templates'     => require 'includes/sport-templates.php',
    'shortcodes'    => require 'includes/sport-shortcodes.php',

    // Хуки
    'hook_actions' => require 'includes/hooks/sport-actions.php',
    'hook_filters' => require 'includes/hooks/sport-filters.php',

    // Плагин "WooCommerce"
    'wc'             => require 'includes/woocommerce/sport-wc.php',
    'wc_functions'   => require 'includes/woocommerce/sport-wc-functions.php'
];

add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
function kama_reorder_comment_fields($fields) {
    $new_fields = [];
    $new_order  = [ 'rating', 'author', 'email', 'comment', 'cookies' ];
    
    unset($fields['cookies']);
	foreach ($new_order as $key) {
        $new_fields[$key] = $fields[$key];
        unset($fields[$key]);
	}

	if ($fields) {
        foreach ($fields as $key => $value)
            $new_fields[$key] = $value;
    }
    
	return $new_fields;
}