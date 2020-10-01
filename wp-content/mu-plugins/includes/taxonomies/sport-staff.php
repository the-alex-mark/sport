<?php

if (!defined('ABSPATH'))
    exit;

// Добавление пользовательского типа записи "Персонал" и таксономий к ней
add_action('init', function () {

    // Создание пользовательского типа записи "Персонал"
	register_post_type('staff', [
		'label'                  => null,
		'labels'                 => [
			'name'               => 'Персонал',
            'singular_name'      => 'Сотрудник',
            'all_items'          => 'Все сотрудники',
			'add_new'            => 'Добавить нового',
			'add_new_item'       => 'Добавление сотрудника',
			'edit_item'          => 'Редактирование сотрудника',
			'new_item'           => 'Новый сотрудник',
			'view_item'          => 'Смотреть сотрудника',
			'search_items'       => 'Поиск сотрудников',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено',
			'menu_name'          => 'Персонал',
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
			'name'               => 'Должности',
			'singular_name'      => 'Должность',
			'search_items'       => 'Поиск должностей',
			'all_items'          => 'Все должности',
			'view_item'          => 'Просмотреть должность',
			'parent_item'        => 'Родительская должность',
			'parent_item_colon'  => 'Родительская должность:',
			'edit_item'          => 'Редактировать должность',
			'update_item'        => 'Обновить должность',
			'add_new_item'       => 'Добавить новую должность',
            'new_item_name'      => 'Новое имя должности',
            'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено',
			'menu_name'          => 'Должности',
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
        if ($i == 2) $result['thumbnail'] = 'Миниатюра';

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