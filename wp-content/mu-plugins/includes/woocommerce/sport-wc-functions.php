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
        return 0;
        
    return WC()->cart->get_cart_contents_count();
}

/**
 * Возвращает сумарную стоимость добавленных товаров в корзину.
 */
function sport_wc_cart_subtotal() {
    if (!sport_wc_cart_available())
        return 0;
        
    // return wp_kses_post(WC()->cart->get_cart_subtotal());
    // return WC()->cart->get_total();
    return WC()->cart->total;
}

/**
 * Возвращает путь до страницы "Корзина".
 */
function sport_wc_cart_url() {
    if (!sport_wc_cart_available())
        return '#';
        
    return esc_url(wc_get_cart_url());
}

/**
 * Проверяет доступность страницы "Оформление заказа".
 */
function sport_wc_checkout_available() {
    $woo = WC();
    return $woo instanceof \WooCommerce && $woo->checkout instanceof \WC_Checkout;
}

/**
 * Возвращает путь до страницы "Оформление заказа".
 */
function sport_wc_checkout_url() {
    if (!sport_wc_checkout_available())
        return '#';
        
    return esc_url(wc_get_checkout_url());
}

/**
 * Выводит HTML звёздного рейтинга.
 */
function sport_wc_star_rating($args = []) {
	$parsed_args = wp_parse_args($args, [
		'rating'     => 0,
		'type'       => 'rating',
		'count'      => 5,
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
	$stars_empty = $parsed_args['count'] - $stars_full - $stars_half;

    $output  = '<div class="star-rating">';
	$output .= str_repeat('<div class="star star-full" aria-hidden="true"></div>', $stars_full);
	$output .= str_repeat('<div class="star star-half" aria-hidden="true"></div>', $stars_half);
	$output .= str_repeat('<div class="star star-empty" aria-hidden="true"></div>', $stars_empty);
	$output .= '</div>';

	if ($parsed_args['echo'])
		echo $output;

	return $output;
}