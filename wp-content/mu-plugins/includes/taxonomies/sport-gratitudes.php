<?php

if (!defined('ABSPATH'))
    exit;

// Добавление пользовательского типа записи "Благодарности" и таксономий к ней
add_action('init', function () {

    // Создание пользовательского типа записи "Благодарности"
	register_post_type('gratitudes', [
		'label'                  => null,
		'labels'                 => [
			'name'               => 'Благодарности',
            'singular_name'      => 'Благодарность',
            'all_items'          => 'Все благодарности',
			'add_new'            => 'Добавить новую',
			'add_new_item'       => 'Добавление благодарности',
			'edit_item'          => 'Редактирование благодарности',
			'new_item'           => 'Новая благодарность',
			'view_item'          => 'Смотреть благодарность',
			'search_items'       => 'Поиск благодарностей',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено',
			'menu_name'          => 'Благодарности',
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
		'menu_position'          => 7,
		'menu_icon'              => 'dashicons-awards',
		'hierarchical'           => false,
		'supports'               => [ 'title', 'editor', 'thumbnail' ],
		'taxonomies'             => [ ],
		'has_archive'            => false,
		'rewrite'                => [
			'slug'               => 'gratitudes',
			'with_front'         => false,
			'hierarchical'       => false
		]
	]);
});

// Добавление дополнительных колонок
add_filter('manage_edit-gratitudes_columns', function ($columns) {
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
add_filter('manage_edit-gratitudes_sortable_columns', function () {
    $columns['title'] = 'title_title';
    $columns['id'] = 'id_id';
	return $columns;
});