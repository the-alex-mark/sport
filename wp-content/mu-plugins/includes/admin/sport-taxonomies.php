<?php

// Добавление разделителей меню
add_action('admin_init', function () {
    add_admin_menu_separator(1);
});

// Добавление пункта меню "Организация"
add_action('admin_menu', function () {

    // Основная страница пункта
    add_menu_page('Организация', 'Организация', 'manage_options', 'org.php', 'org', 'dashicons-building', 2);

    // Подпункт "Информация"
    add_submenu_page('org.php', 'Информация', 'Информация', 'manage_options', 'org_info.php', 'org_info');
    function org_info() {
        echo "<h2>Информация</h2><hr><p>Изменить</p><hr>";
    }

    // Подпункт "График работы"
    add_submenu_page('org.php', 'График работы', 'График работы', 'manage_options', 'org_chart.php', 'org_chart');
    function org_chart() {
        echo "<h2>График работы</h2><hr><p>Изменить</p><hr>";
    }
});

// Удаление страницы "Организация"
add_action('admin_menu', function () {
    remove_submenu_page('org.php', 'org.php');
}, 9999);

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
			'search_items'       => 'Искать сотрудника',
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
		'menu_position'          => 2,
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
    register_taxonomy('position', [ 'staff' ], [ 
		'label'                  => null,
		'labels'                 => [
			'name'               => 'Должности',
			'singular_name'      => 'Должность',
			'search_items'       => 'Поиск должности',
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
        'hierarchical'           => false,
		'show_admin_column'      => true,
        'rewrite'                => true
    ]);
    
    // Привязка таксономии "Должности" к пользовательскому типу записи "Персонал"
    register_taxonomy_for_object_type('position', 'staff');

    // Создание пользовательской таксономии "Отделы"
    register_taxonomy('department', [ 'staff' ], [ 
		'label'                  => null,
		'labels'                 => [
			'name'               => 'Отделы',
			'singular_name'      => 'Отдел',
			'search_items'       => 'Поиск отдела',
			'all_items'          => 'Все отделы',
			'view_item'          => 'Просмотреть отдел',
			'parent_item'        => 'Родительская отдел',
			'parent_item_colon'  => 'Родительская отдел:',
			'edit_item'          => 'Редактировать одтел',
			'update_item'        => 'Обновить отдел',
			'add_new_item'       => 'Добавить новый отдел',
            'new_item_name'      => 'Новое имя отдела',
            'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено',
			'menu_name'          => 'Отделы',
		],
		'description'            => '',
		'public'                 => true,
        'hierarchical'           => false,
        'show_admin_column'      => true,
        'rewrite'                => true,
    ]);
    
    // Привязка таксономии "Отделы" к пользовательскому типу записи "Персонал"
    register_taxonomy_for_object_type('department', 'staff');
});

// Сортировка колонок у пользовательского типа записи "Персонал"
add_filter('manage_edit-toilet_sortable_columns', function () {
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