<?php

if (!defined('ABSPATH'))
    exit;

add_action('init', function () {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
});

// Удаление "/page/" при пагинации
add_filter('generate_rewrite_rules', function ($wp_rewrite) {
	$new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
});

// Удаление "/category/" из постоянных ссылок
add_filter('user_trailingslashit', function ($link) {
	return str_replace("/category/", "/", $link);
});

// Работа шорткодов
add_filter('the_content', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');
add_filter('the_content', 'do_shortcode', 11);
add_filter('widget_text', 'shortcode_unautop');

// Удаление категорий из вывода
add_filter('get_terms', 'filter_terms', 10, 4);
function filter_terms($terms, $taxonomies, $args, $term_query) {
    
    $exclude = [ 'uncategorized', 'compare' ];
    foreach ($terms as $key => $item) {
        if (in_array($terms[$key]->slug, $exclude))
            unset($terms[$key]);
    }

    return $terms;
}