<?php

if (!defined('ABSPATH'))
    exit;

// Добавление разделителей меню
add_action('admin_init', function () {
    add_menu_separator(1);
});

// Добавление пункта меню "Организация"
add_action('admin_menu', function () {

	// Подключение стилей
	wp_enqueue_style('bootstrap-grid',  SPORT_PLUGIN_PLUGINS . '/bootstrap/css/bootstrap-grid.min.css');
	wp_enqueue_style('main',            SPORT_PLUGIN_STYLES  . '/main.css');
	wp_enqueue_style('adaptive',        SPORT_PLUGIN_STYLES  . '/adaptive.css');

	// **************************************************************************

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
		'Основная информация',
		'Информация',
		'manage_options',
		'org_info',
		function () {
			add_option('org_info__name');
			add_option('org_info__desc');
			add_option('org_info__phone1');
			add_option('org_info__phone2');
			add_option('org_info__phone3');
			add_option('org_info__address');
			add_option('org_info__email');
			add_option('org_info__skype');
			add_option('org_info__forum');

			require SPORT_PLUGIN_TEMPLATES_PAGES . '/org_info.php';
		}
	);

	// Подпункт "Реквизиты"
    add_submenu_page(
		'sport_org.php',
		'Реквизиты',
		'Реквизиты',
		'manage_options',
		'org_requisites',
		function () {
			add_option('org_requisites__inn');
			add_option('org_requisites__okopf');
			add_option('org_requisites__kpp');
			add_option('org_requisites__okfs');
			add_option('org_requisites__okpo');
			add_option('org_requisites__okdp');
			add_option('org_requisites__ogrn');
			add_option('org_requisites__okato');
			add_option('org_requisites__okved');
			add_option('org_requisites__rs');
			add_option('org_requisites__bank');

			require SPORT_PLUGIN_TEMPLATES_PAGES . '/org_requisites.php';
		}
	);
});

// Удаление страницы "Организация"
add_action('admin_menu', function () {
    remove_submenu_page('sport_org.php', 'sport_org.php');
}, 9999);