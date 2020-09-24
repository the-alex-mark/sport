<?php

// Работа шорткодов
add_filter('the_content', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');
add_filter('the_content', 'do_shortcode', 11);
add_filter('widget_text', 'shortcode_unautop');


add_filter('get_terms', 'filter_terms', 10, 4);
function filter_terms($terms, $taxonomies, $args, $term_query) {
    
    $exclude = [ 'uncategorized', 'compare' ];
    foreach ($terms as $key => $item) {
        if (in_array($terms[$key]->slug, $exclude))
            unset($terms[$key]);
    }

    return $terms;
}