<?php

if (!defined('ABSPATH'))
    exit;

/**
 * Вызывает функцию шорткода по имени тега.
 * 
 * @param string $tag     Шорткод
 * @param array  $atts    Атрибуры для передачи в функцию
 * @param array  $content Содержание
 *
 * @return string|bool
 */
function sport_do_shortcode($tag, array $atts = [], $content = null) {
	global $shortcode_tags;

	if (!isset($shortcode_tags[$tag]))
		return false;

	return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
}

/**
 * Возвращает пункты указанного меню.
 * 
 * @param string $slug Имя или ID зарегистрированного меню
 * 
 * @return array
 */
function sport_get_menu($slug) {
    function get_child($slug, $parent_id = 0) {
        $menu = wp_get_nav_menu_items($slug);

        $result = [];
        foreach ($menu as $item) {
            if ($item->menu_item_parent == $parent_id) {

                // Выборка необходимых свойств
                $result[] = [
                    'title'  => $item->title,
                    'url'    => $item->url,
                    'childs' => get_child($slug, $item->ID)
                ];

                // Свойства по умолчанию
                // $item->childs = get_child($slug, $item->ID);
                // $result[] = $item;
            }
        }

        return $result;
    }
    
    return get_child($slug, 0);
}

/**
 * Возвращает ссылку на пользовательский логотип сайта.
 * 
 * @return string|null
 */
function sport_get_logo_url() {
    $logo_id = get_theme_mod('custom_logo');
    $image = wp_get_attachment_image_src($logo_id, 'full');

    return $image[0];
}