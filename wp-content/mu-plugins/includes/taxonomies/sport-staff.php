<?php

if (!defined('ABSPATH'))
    exit;

// Добавление пользовательского типа записи "Персонал" и таксономий к ней
add_action('init', function () {

    // Создание пользовательского типа записи "Персонал"
	register_post_type('staff', [
		'label'                  => null,
		'labels'                 => [
			'name'               => __('Персонал', 'sport'),
            'singular_name'      => __('Сотрудник', 'sport'),
            'all_items'          => __('Все сотрудники', 'sport'),
			'add_new'            => __('Добавить нового', 'sport'),
			'add_new_item'       => __('Добавление сотрудника', 'sport'),
			'edit_item'          => __('Редактирование сотрудника', 'sport'),
			'new_item'           => __('Новый сотрудник', 'sport'),
			'view_item'          => __('Смотреть сотрудника', 'sport'),
			'search_items'       => __('Поиск сотрудников', 'sport'),
			'not_found'          => __('Не найдено', 'sport'),
			'not_found_in_trash' => __('Не найдено', 'sport'),
			'menu_name'          => __('Персонал', 'sport'),
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
		'menu_position'          => 3,
		'menu_icon'              => 'dashicons-groups',
		'hierarchical'           => false,
		'supports'               => [ 'title', 'editor', 'thumbnail' ],
		'taxonomies'             => [ 'position', 'department' ],
		'has_archive'            => false,
		'rewrite'                => [
			'slug'               => 'staff',
			'with_front'         => false,
			'hierarchical'       => false
		]
	]);

	// Создание пользовательской таксономии "Должности"
	register_taxonomy_for_object_type('position', 'staff');
    register_taxonomy('position', [ 'staff' ], [ 
		'label'                  => null,
		'labels'                 => [
			'name'               => __('Должности', 'sport'),
			'singular_name'      => __('Должность', 'sport'),
			'search_items'       => __('Поиск должностей', 'sport'),
			'all_items'          => __('Все должности', 'sport'),
			'view_item'          => __('Просмотреть должность', 'sport'),
			'parent_item'        => __('Родительская должность', 'sport'),
			'parent_item_colon'  => __('Родительская должность:', 'sport'),
			'edit_item'          => __('Редактировать должность', 'sport'),
			'update_item'        => __('Обновить должность', 'sport'),
			'add_new_item'       => __('Добавить новую должность', 'sport'),
            'new_item_name'      => __('Новое имя должности', 'sport'),
            'not_found'          => __('Не найдено', 'sport'),
			'not_found_in_trash' => __('Не найдено', 'sport'),
			'menu_name'          => __('Должности', 'sport'),
		],
		'description'            => '',
		'public'                 => true,
        'hierarchical'           => true,
		'show_admin_column'      => true,
        'rewrite'                => true
    ]);
});

// Добавление дополнительных колонок
add_filter('manage_edit-staff_columns', function ($columns) {
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
add_filter('manage_edit-staff_sortable_columns', function () {
    $columns['title'] = 'title_title';
    $columns['id'] = 'id_id';
    $columns['taxonomy-position'] = 'taxonomy-position_taxonomy-position';
    $columns['taxonomy-department'] = 'taxonomy-department_taxonomy-department';
	return $columns;
});

// Правка ширины колонок через CSS
add_action('admin_head', function () {
	if (get_current_screen()->base == 'edit') {
        echo '<style type="text/css"> .column-taxonomy-position { width: 12%; } </style>';
        echo '<style type="text/css"> .column-taxonomy-department { width: 12%; } </style>';    
    }
});