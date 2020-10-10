<?php

if (!defined('ABSPATH'))
    exit;

add_action('tgmpa_register', function () {

    // Список необходимых плагинов
    $plugins = [
        [
            'name'               => __('WooCommerce', 'sport'),
            'slug'               => 'woocommerce',
            'required'           => true
        ],
        [
            'name'               => __('WooCommerce Checkout Fields', 'sport'),
            'slug'               => 'woo-checkout-field-editor-pro',
            'required'           => true
        ],
        [
            'name'               => __('Contact Form 7', 'sport'),
			'slug'               => 'contact-form-7',
            'required'           => false
        ],
        [
            'name'               => __('Advanced Custom Fields', 'sport'),
			'slug'               => 'advanced-custom-fields',
            'required'           => false
        ],
    ];

    // Конфигурация скрипта
    $config = [
		'id'                     => 'sport-classic',
		'default_path'           => '',
		'menu'                   => 'install-required-plugins',
		'parent_slug'            => 'themes.php',
		'capability'             => 'edit_theme_options',
		'has_notices'            => true,
		'dismissable'            => true,
		'dismiss_msg'            => '',
		'is_automatic'           => false,
		'message'                => '',

		'strings'                => [
			'menu_title'         => __('Plugins'),
		]
	];

    tgmpa($plugins, $config);
});