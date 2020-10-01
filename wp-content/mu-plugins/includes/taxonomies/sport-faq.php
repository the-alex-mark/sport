<?php

if (!defined('ABSPATH'))
    exit;

// Добавление пользовательского типа записи "Персонал" и таксономий к ней
add_action('init', function () {

    // Создание пользовательского типа записи "FAQ"
	register_post_type('faq', [
		'label'                  => null,
		'labels'                 => [
			'name'               => 'FAQ',
            'singular_name'      => 'Вопрос',
            'all_items'          => 'Все вопросы',
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавление вопроса',
			'edit_item'          => 'Редактирование вопроса',
			'new_item'           => 'Новый вопрос',
			'view_item'          => 'Смотреть вопрос',
			'search_items'       => 'Поиск вопросов',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено',
			'menu_name'          => 'FAQ',
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
			'name'               => 'Темы',
			'singular_name'      => 'Тема',
			'search_items'       => 'Поиск тем',
			'all_items'          => 'Все темы',
			'view_item'          => 'Просмотреть тему',
			'parent_item'        => 'Родительская тема',
			'parent_item_colon'  => 'Родительская тема:',
			'edit_item'          => 'Редактировать тему',
			'update_item'        => 'Обновить тему',
			'add_new_item'       => 'Добавить новую тему',
            'new_item_name'      => 'Новое имя темы',
            'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено',
			'menu_name'          => 'Темы',
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
        if ($i == 2) $result['thumbnail'] = 'Миниатюра';

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