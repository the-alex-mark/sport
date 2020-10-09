<?php

if (!defined('ABSPATH'))
    exit;

add_action('tgmpa_register', function () {

    // Список необходимых плагинов
    $plugins = [
        [
            'name'     => __('WooCommerce', 'sport'),
            'slug'     => 'woocommerce',
            'required' => false
        ],
        [
			'name'               => __('WooCommerce Compare', 'sport'),
			'slug'               => 'wc-compare',
			'source'             => get_template_directory() . '/includes/plugins/wc-compare.zip',
			'version'            => '2.4.1',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false
        ],
        [
			'name'               => __('WooCommerce Payment Промсвязьбанк', 'sport'),
			'slug'               => 'wc-payment-psb',
			'source'             => get_template_directory() . '/includes/plugins/wc-compare.zip',
			'version'            => '1.0.2',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false
        ],
        [
            'name'     => __('Contact Form 7', 'sport'),
            'slug'     => 'contact-form-7',
            'required' => false
        ],
    ];

    // Конфигурация скрипта
    $config = [
		'id'           => 'sport-classic',
		'default_path' => '',
		'menu'         => 'install-required-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',

		'strings'      => [
			'page_title'                      => __('Установка необходимых плагинов', 'sport'),
			'menu_title'                      => __('Плагины', 'sport'),

			// Тип уведомления администратора ('updated', 'update-nag', 'notice-warning', 'notice-info' или 'error')
			// 'nag_type'                        => ''
		]
	];

    tgmpa($plugins, $config);
});