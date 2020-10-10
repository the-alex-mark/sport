<?php

if (!defined('ABSPATH'))
    exit;

// Подключение стилей
add_action('admin_enqueue_scripts', function () {

	// Подключение плагинов
	wp_enqueue_style('bootstrap-grid', SPORT_PLUGIN_PLUGINS . '/bootstrap/bootstrap-grid.css');

	// Подключение стилей
	wp_enqueue_style('php',            SPORT_PLUGIN_STYLES  . '/phpinfo.css');
	wp_enqueue_style('main',           SPORT_PLUGIN_STYLES  . '/main.css');
	wp_enqueue_style('adaptive',       SPORT_PLUGIN_STYLES  . '/adaptive.css');
});