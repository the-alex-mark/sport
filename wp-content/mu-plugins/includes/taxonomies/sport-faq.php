<?php

if (!defined('ABSPATH'))
    exit;

// Добавление пользовательского типа записи "Персонал" и таксономий к ней
add_action('init', function () {

    // Создание пользовательского типа записи "FAQ"
	register_post_type('faq', [
		'label'                  => null,
		'labels'                 => [
			'name'               => __('FAQ', 'sport'),
            'singular_name'      => __('Вопрос', 'sport'),
            'all_items'          => __('Все вопросы', 'sport'),
			'add_new'            => __('Добавить новый', 'sport'),
			'add_new_item'       => __('Добавление вопроса', 'sport'),
			'edit_item'          => __('Редактирование вопроса', 'sport'),
			'new_item'           => __('Новый вопрос', 'sport'),
			'view_item'          => __('Смотреть вопрос', 'sport'),
			'search_items'       => __('Поиск вопросов', 'sport'),
			'not_found'          => __('Не найдено', 'sport'),
			'not_found_in_trash' => __('Не найдено', 'sport'),
			'menu_name'          => __('FAQ', 'sport'),
        ],
		'description'            => '',
		'public'                 => true,
		'publicly_queryable'     => true,
		'exclude_from_search'    => false,
		'show_ui'                => true,
		'show_in_nav_menus'      => true,
		'show_in_menu'           => true,
		'show_in_admin_bar'      => true,
		'show_in_rest'           => true,
		'rest_base'              => null,
		'menu_position'          => 6,
		'menu_icon'              => 'dashicons-format-chat', // 'dashicons-editor-help', 'dashicons-warning'
		'hierarchical'           => false,
		'supports'               => [ 'title', 'editor', 'thumbnail' ],
		'taxonomies'             => [ 'themes' ],
		'has_archive'            => false,
		'rewrite'                => [
			'slug'               => 'faq',
			'with_front'         => false,
			'hierarchical'       => false
		]
	]);
	
	// Создание пользовательской таксономии "Должности"
	register_taxonomy_for_object_type('themes', 'faq');
    register_taxonomy('themes', [ 'faq' ], [ 
		'label'                  => null,
		'labels'                 => [
			'name'               => __('Темы', 'sport'),
			'singular_name'      => __('Тема', 'sport'),
			'search_items'       => __('Поиск тем', 'sport'),
			'all_items'          => __('Все темы', 'sport'),
			'view_item'          => __('Просмотреть тему', 'sport'),
			'parent_item'        => __('Родительская тема', 'sport'),
			'parent_item_colon'  => __('Родительская тема:', 'sport'),
			'edit_item'          => __('Редактировать тему', 'sport'),
			'update_item'        => __('Обновить тему', 'sport'),
			'add_new_item'       => __('Добавить новую тему', 'sport'),
            'new_item_name'      => __('Новое имя темы', 'sport'),
            'not_found'          => __('Не найдено', 'sport'),
			'not_found_in_trash' => __('Не найдено', 'sport'),
			'menu_name'          => __('Темы', 'sport'),
		],
		'description'            => '',
		'public'                 => true,
        'hierarchical'           => true,
		'show_admin_column'      => true,
        'rewrite'                => true
    ]);
});

// Добавление дополнительных колонок
add_filter('manage_edit-faq_columns', function ($columns) {
	$result = [];
	foreach ($columns as $column => $name) {
        ++$i;

        // "Миниатюра"
        if ($i == 2) $result['thumbnail'] = __('Миниатюра', 'sport');

        // "ID"
        if ($i == 3) $result['id'] = 'ID';

		$result[$column] = $name;
	}

	return $result;
});

// Сортировка дополнительных колонок
add_filter('manage_edit-faq_sortable_columns', function () {
    $columns['title'] = 'title_title';
    $columns['id'] = 'id_id';
    $columns['taxonomy-themes'] = 'taxonomy-themes_taxonomy-themes';
	return $columns;
});

// Правка ширины колонок через CSS
add_action('admin_head', function () {
	if (get_current_screen()->base == 'edit') {
        echo '<style type="text/css"> .column-taxonomy-themes { width: 12%; } </style>';
    }
});