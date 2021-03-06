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
		__('Организация', 'sport'),
		__('Организация', 'sport'),
		'manage_options',
		'sport_org.php',
		'sport_org',
		'dashicons-building',
		2
	);

    // Подпункт "Информация"
    add_submenu_page(
		'sport_org.php',
		__('Основная информация', 'sport'),
		__('Информация', 'sport'),
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

	// Подпункт "Режим работы"
    add_submenu_page(
		'sport_org.php',
		__('Режим работы', 'sport'),
		__('Режим работы', 'sport'),
		'manage_options',
		'org_operating-mode',
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

			require SPORT_PLUGIN_TEMPLATES_PAGES . '/org_operating-mode.php';
		}
	);

	// Подпункт "Реквизиты"
    add_submenu_page(
		'sport_org.php',
		__('Реквизиты', 'sport'),
		__('Реквизиты', 'sport'),
		'manage_options',
		'org_requisites',
		function () {
			add_option('org_time');

			require SPORT_PLUGIN_TEMPLATES_PAGES . '/org_requisites.php';
		}
	);
});

// Удаление страницы "Организация"
add_action('admin_menu', function () {
    remove_submenu_page('sport_org.php', 'sport_org.php');
}, 9999);