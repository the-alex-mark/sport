<?php

if (!defined('ABSPATH'))
    exit;

// Добавление разделителей меню
add_action('admin_init', function () {
    add_menu_separator(1);
});

// Добавление пункта меню "Организация"
add_action('admin_menu', function () {

    // Основная страница пункта
    add_menu_page(
		'Организация',
		'Организация',
		'manage_options',
		'sport_org.php',
		'sport_org',
		'dashicons-building',
		2
	);

    // Подпункт "Информация"
    add_submenu_page(
		'sport_org.php',
		'Информация об организации',
		'Информация',
		'manage_options',
		'org_info',
		function () {
			add_option('org_info__name');
			add_option('org_info__desc');

			require SPORT_PLUGIN_TEMPLATES_PAGES . '/org_info.php';
		}
	);

    // Подпункт "График работы"
    add_submenu_page(
		'sport_org.php',
		'График работы',
		'График работы',
		'manage_options',
		'org_chart',
		function () {
			require SPORT_PLUGIN_TEMPLATES_PAGES . '/org_chart.php';
		}
	);

	// Подключение стилей
	wp_enqueue_style('bootstrap-grid',  SPORT_PLUGIN_PLUGINS . '/bootstrap/css/bootstrap-grid.min.css');
	wp_enqueue_style('main',            SPORT_PLUGIN_STYLES  . '/main.css');
	wp_enqueue_style('adaptive',        SPORT_PLUGIN_STYLES  . '/adaptive.css');

	// Подключение скриптов
	wp_enqueue_script('main',           SPORT_PLUGIN_SCRIPTS . '/main.js', [], null, true);
});

// Удаление страницы "Организация"
add_action('admin_menu', function () {
    remove_submenu_page('sport_org.php', 'sport_org.php');
}, 9999);