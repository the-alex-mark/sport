<?php

if (!defined('ABSPATH'))
    exit;

/**
 * Проверяет доступность плагина "WooCommerce".
 */
function sport_wc_is_activated() {
    return class_exists('WooCommerce') ? true : false;
}

/**
 * Проверяет доступность страницы "Корзина".
 */
function sport_wc_cart_available() {
    $woo = WC();
    return $woo instanceof \WooCommerce && $woo->cart instanceof \WC_Cart;
}

/**
 * Возвращает сумарное количество добавленных товаров в корзину.
 */
function sport_wc_cart_count() {
    if (!sport_wc_cart_available())
        return false;
        
    return WC()->cart->get_cart_contents_count();
}

/**
 * Возвращает `ПОДИТОГ` товаров в корзине.
 */
function sport_wc_cart_subtotal() {
    if (!sport_wc_cart_available())
        return false;
        
    return WC()->cart->subtotal;
}

/**
 * Возвращает `ИТОГ` товаров в корзине.
 */
function sport_wc_cart_total() {
    if (!sport_wc_cart_available())
        return false;
    
    return WC()->cart->total;
}

/**
 * Проверяет доступность страницы "Оформление заказа".
 */
function sport_wc_checkout_available() {
    $woo = WC();
    return $woo instanceof \WooCommerce && $woo->checkout instanceof \WC_Checkout;
}

/**
 * Возвращает изображение товара по ID  
 * В случае отсутствия изображения вернёт плейсхолдер.
 */
function sport_wc_image_url_from_id($id) {
    return (wp_get_attachment_url($id))
        ? wp_get_attachment_url($id)
        : woocommerce_placeholder_img_src();
}

/**
 * Выводит HTML звёздного рейтинга.
 */
function sport_wc_star_rating($args = []) {
	$parsed_args = wp_parse_args($args, [
		'rating'     => 0,
		'rating_max' => 5,
		'type'       => 'rating',
        'echo'       => true,
    ]);

	// Преобразование значения рейтинга при строчном представлении
	$rating = (float)str_replace(',', '.', $parsed_args['rating']);

    // Преобразование процента в звёздный рейтинг (0..5) с шагом 5
	if ('percent' === $parsed_args['type'])
		$rating = round($rating / 10, 0) / 2;

    // Вычисление количества звезд каждого типа
	$stars_full  = floor($rating);
	$stars_half  = ceil($rating - $stars_full);
	$stars_empty = $parsed_args['rating_max'] - $stars_full - $stars_half;

    $output  = '<div class="star-rating">';
	$output .= str_repeat('<div class="star star-full" aria-hidden="true"></div>', $stars_full);
	$output .= str_repeat('<div class="star star-half" aria-hidden="true"></div>', $stars_half);
	$output .= str_repeat('<div class="star star-empty" aria-hidden="true"></div>', $stars_empty);
	$output .= '</div>';

	if ($parsed_args['echo'])
		echo $output;

	return $output;
}