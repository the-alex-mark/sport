<?php

if (!defined('ABSPATH'))
    exit;

// Заголовок
add_action('page_content__before', function($name) {
    
    if (get_template_part(SPORT_TEMPLATES_GLOBAL . '/header', $name) == false)
        get_header($name);

    ?><main class="container"><?php
});

// Боковая панель
add_action('page_content__sidebar', function($name) {
    
    if (get_template_part(SPORT_TEMPLATES_GLOBAL . '/sidebar', $name) == false)
        get_sidebar($name);
});

// Хлебные крошки
add_action('page_content__breadcrumb', function () {

    if (!is_404())
        get_breadcrumb();
});

// Подвал
add_action('page_content__after', function($name) {

    ?></main><?php
    
    if (get_template_part(SPORT_TEMPLATES_GLOBAL . '/footer', $name) == false)
        get_footer($name);
});

// index
// 404
// archive
// author
// category
// tag
// taxonomy
// date
// home
// embed
// frontpage
// page
// paged
// search
// single
// singular
// attachment

// Новое расположение для поиска файлов страниц
add_filter('index_template_hierarchy', 'edit_locate_template');
add_filter('404_template_hierarchy', 'edit_locate_template');
add_filter('archive_template_hierarchy', 'edit_locate_template');
add_filter('category_template_hierarchy', 'edit_locate_template');
add_filter('home_template_hierarchy', 'edit_locate_template');
add_filter('frontpage_template_hierarchy', 'edit_locate_template');
add_filter('page_template_hierarchy', 'edit_locate_template');
add_filter('single_template_hierarchy', 'edit_locate_template');
function edit_locate_template($templates) {
    $temp = array_reverse($templates);

    // Новое расположение страницы
    if (count($templates) < 4) {
        foreach ($temp as $item)
            array_unshift($templates, SPORT_TEMPLATES_PAGES . "/$item");
    }

    // dd($templates);
	return $templates;
}