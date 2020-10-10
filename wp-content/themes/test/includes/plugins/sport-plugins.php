<?php

if (!defined('ABSPATH'))
    exit;

add_action('tgmpa_register', function () {

    // Список необходимых плагинов
    $plugins = [
        [
            'name'               => __('WooCommerce', 'sport'),
            'slug'               => 'woocommerce',
            'version'            => '4.5.2',
            'required'           => true
        ],
        [
			'name'               => __('WooCommerce Checkout Fields', 'sport'),
            'slug'               => 'woo-checkout-field-editor-pro',
			'version'            => '1.4.4',
            'required'           => true
        ],
        [
			'name'               => __('WooCommerce Compare', 'sport'),
			'slug'               => 'yith-woocommerce-compare-premium',
			'source'             => get_template_directory() . '/includes/plugins/wc-compare.zip',
			'version'            => '2.4.1',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => 'stack-sport.ru'
        ],
        [
			'name'               => __('WooCommerce Payment Промсвязьбанк', 'sport'),
			'slug'               => 'wc_psbankpayment',
			'source'             => get_template_directory() . '/includes/plugins/wc-payment-psb.zip',
			'version'            => '1.0.2',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false
        ],
		[
			'name'               => __('Contact Form 7', 'sport'),
			'slug'               => 'contact-form-7',
			'version'            => '5.2.2',
			'required'           => false
		],
        [
			'name'               => __('Advanced Custom Fields', 'sport'),
			'slug'               => 'advanced-custom-fields',
			'version'            => '5.9.1',
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