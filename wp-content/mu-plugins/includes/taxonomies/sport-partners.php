<?php

if (!defined('ABSPATH'))
    exit;

// Добавление пользовательского типа записи "Партнёры" и таксономий к ней
add_action('init', function () {

    // Создание пользовательского типа записи "Партнёры"
	register_post_type('partners', [
		'label'                  => null,
		'labels'                 => [
			'name'               => __('Партнёры', 'sport'),
            'singular_name'      => __('Партнёр', 'sport'),
            'all_items'          => __('Все партнёры', 'sport'),
			'add_new'            => __('Добавить нового', 'sport'),
			'add_new_item'       => __('Добавление партнёра', 'sport'),
			'edit_item'          => __('Редактирование партнёра', 'sport'),
			'new_item'           => __('Новый партнёр', 'sport'),
			'view_item'          => __('Смотреть партнёра', 'sport'),
			'search_items'       => __('Поиск партнёров', 'sport'),
			'not_found'          => __('Не найдено', 'sport'),
			'not_found_in_trash' => __('Не найдено', 'sport'),
			'menu_name'          => __('Партнёры', 'sport'),
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
		'menu_position'          => 8,
		'menu_icon'              => 'dashicons-admin-site',
		'hierarchical'           => false,
		'supports'               => [ 'title', 'editor', 'thumbnail' ],
		'taxonomies'             => [ ],
		'has_archive'            => false,
		'rewrite'                => [
			'slug'               => 'partners',
			'with_front'         => false,
			'hierarchical'       => false
		]
	]);
});

// Добавление дополнительных колонок
add_filter('manage_edit-partners_columns', function ($columns) {
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
add_filter('manage_edit-partners_sortable_columns', function () {
    $columns['title'] = 'title_title';
    $columns['id'] = 'id_id';
	return $columns;
});

// Создание дополнительных полей для таксономии "Партнёры"
add_action('add_meta_boxes', function () {

	// Создание блока полей "Дополнительно"
	add_meta_box(
		'additional_info',
		__('Дополнительно', 'sport'),
		'additional_info__callback',
		'partners',
		'side'
	);
});

function additional_info__callback($post, $meta) {
	wp_nonce_field(plugin_basename(__FILE__), 'sport_nonce');
	$partner_url = get_post_meta($post->ID, 'partner_url', 1);

	echo '<label for="partner_url" style="display: inline-block; margin-top: 5px; margin-bottom: 5px; font-weight: 600;">' . _e('Сайт партнёра', 'sport') . '</label> ';
	echo '<input type="text" id="partner_url" name="partner_url" value="'. $partner_url .'" style="width: 100%">';
}

// Сохранение созданных дополнительных полей
add_action('save_post', function ($post_id) {
	if (!isset($_POST['partner_url']))
		return;

	if (!wp_verify_nonce($_POST['sport_nonce'], plugin_basename(__FILE__)))
		return;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	if (!current_user_can('edit_post', $post_id))
		return;
		
	$partner_url = sanitize_text_field($_POST['partner_url']);
	update_post_meta($post_id, 'partner_url', $partner_url);
});