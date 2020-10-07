<?php

if (!defined('ABSPATH'))
    exit;

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

    // Новое расположение страницы
    if (count($templates) < 4) {
        foreach ($temp as $item)
            array_unshift($templates, SPORT_TEMPLATES_PAGES . "/$item");
    }
    
	return $templates;
}