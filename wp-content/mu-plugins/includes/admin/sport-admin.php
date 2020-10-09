<?php

if (!defined('ABSPATH'))
    exit;

// Отображение дополнительных полей у различных типов записей
add_action('init', function () {
    add_post_type_support('page', [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ]);
    add_post_type_support('post', [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ]);
});

// Удаление колонок
add_filter('manage_posts_columns', 'del_column', 5);
add_filter('manage_pages_columns', 'del_column', 5);
function del_column($columns) {
    
    // Удаление колонки "Автор"
    unset($columns['author']);

	return $columns;
}

// Создание дополнительных колонок у типа записи "Страница"
add_filter('manage_edit-page_columns', function ($columns) {
    $result = [];
	foreach ($columns as $column => $name) {
        ++$i;

        // "ID"
        if ($i == 3) $result['id'] = 'ID';

		$result[$column] = $name;
	}

	return $result;
});

// Создание дополнительных колонок у типа записи "Пост"
add_filter('manage_edit-post_columns', function ($columns) {
    
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

// Заполнение колонок данными
add_filter('manage_posts_column', 'fill_column');
add_filter('manage_posts_custom_column', 'fill_column', 5, 2);
add_filter('manage_pages_column', 'fill_column');
add_filter('manage_pages_custom_column', 'fill_column', 5, 2);
function fill_column($column_name, $post_id) {

    // "Миниатюра"
    if ($column_name === 'thumbnail') 
        echo '<a href="' . get_edit_post_link($post_id, '') . '" target="_blank"><img src="' . get_the_post_thumbnail_url() . '" style="display: block;"></a>';
    
    // "ID"
    if ($column_name === 'id')
        echo '<b>' . $post_id . '</b>';
}

// Правка ширины колонок через CSS
add_action('admin_head', 'edit_column_css');
function edit_column_css() {
	if (get_current_screen()->base == 'edit') {

        // "Миниатюра"
        echo '<style type="text/css"> .column-thumbnail { width: 100px; } </style>';
        echo '<style type="text/css"> .column-thumbnail img { width: 100%; } </style>';

        // "ID"
        echo '<style type="text/css"> .column-id { width: 8%; } </style>';
    }
}

// Сортировка колонок
add_filter('manage_edit-post_sortable_columns', 'sortable_column');
add_filter('manage_edit-page_sortable_columns', 'sortable_column');
function sortable_column($columns) {
	$columns['id'] = 'id_id';
	return $columns;
}