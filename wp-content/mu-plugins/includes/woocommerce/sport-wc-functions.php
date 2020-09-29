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