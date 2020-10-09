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
			'installing'                      => __('Установка плагина: %s', 'sport'),
			'updating'                        => __('Обновление плагина: %s', 'sport'),
			'oops'                            => __('Что-то пошло не так с API плагина.', 'sport'),
			'notice_can_install_required'     => _n_noop(
				'Для этой темы требуется следующий плагин: %1$s.',
				'Для этой темы требуются следующие плагины: %1$s.',
				'sport'
			),
			'notice_can_install_recommended'  => _n_noop(
				'Эта тема рекомендует следующий плагин: %1$s.',
				'Эта тема рекомендует следующие плагины: %1$s.',
				'sport'
			),
			'notice_ask_to_update'            => _n_noop(
				'Следующий плагин должен быть обновлен до последней версии, чтобы обеспечить максимальную совместимость с этой темой: %1$s.',
				'Следующие плагины должны быть обновлены до последней версии, чтобы обеспечить максимальную совместимость с этой темой: %1$s.',
				'sport'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'Доступно обновление для: %1$s.',
				'Доступны обновления для следующих плагинов: %1$s.',
				'sport'
			),
			'notice_can_activate_required'    => _n_noop(
				'Следующий необходимый плагин в настоящее время неактивен: %1$s.',
				'Следующие необходимые плагины в настоящее время неактивны: %1$s.',
				'sport'
			),
			'notice_can_activate_recommended' => _n_noop(
				'Следующий рекомендуемый плагин в настоящее время неактивен: %1$s.',
				'Следующие рекомендуемые плагины в настоящее время неактивны: %1$s.',
				'sport'
			),
			'install_link'                    => _n_noop(
				'Установить плагин',
				'Установить плагины',
				'sport'
			),
			'update_link' 					  => _n_noop(
				'Обновить плагин',
				'Обновить плагины',
				'sport'
			),
			'activate_link'                   => _n_noop(
				'Активировать плагин',
				'Активировать плагины',
				'sport'
			),
			'return'                          => __('Вернуться к установке необходимых плагинов', 'sport'),
			'plugin_activated'                => __('Плагин успешно активирован.', 'sport'),
			'activated_successfully'          => __('Следующий плагин был успешно активирован:', 'sport'),
			'plugin_already_active'           => __('Никаких действий не предпринималось. Плагин %1$s уже был активен.', 'sport'),
			'plugin_needs_higher_version'     => __('Плагин не активирован. Для этой темы необходима более высокая версия %s. Пожалуйста, обновите плагин.', 'sport'),
			'complete'                        => __('Все плагины успешно установлены и активированы. %1$s', 'sport'),
			'dismiss'                         => __('Закрыть это уведомление', 'sport'),
			'notice_cannot_install_activate'  => __('Существует один или несколько обязательных или рекомендуемых плагинов для установки, обновления или активации.', 'sport'),
			'contact_admin'                   => __('Пожалуйста, обратитесь за помощью к администратору этого сайта.', 'sport'),

			// Тип уведомления администратора ('updated', 'update-nag', 'notice-warning', 'notice-info' или 'error')
			'nag_type'                        => ''
		]
	];

    tgmpa($plugins, $config);
});