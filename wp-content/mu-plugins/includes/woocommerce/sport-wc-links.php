<?php

if (!defined('ABSPATH'))
    exit;

/**
 * Возвращает ссылку на указанную страницу.
 * 
 * Поддерживаемые страницы:  
 * - `cart`  
 * - `checkout`  
 * - `myaccount`  
 * - `privacy_policy`  
 * - `shop`
 * 
 * @param string $page Страница, для которой требуется получить ссылку.
 * 
 * @return string|bool
 */
function sport_wc_page_url($page) {
    switch (strtolower($page)) {
        case 'cart':
            return sport_wc_cart_url();

        case 'checkout':
            return sport_wc_checkout_url();

        case 'myaccount':
            return sport_wc_myaccount_url();

        case 'privacy_policy':
            return sport_wc_privacy_policy_url();

        case 'shop':
            return sport_wc_shop_url();
    }
}

/**
 * Возвращает ссылку на страницу "Корзина".
 */
function sport_wc_cart_url() {
    if (!sport_wc_cart_available())
        return false;
        
    return esc_url(wc_get_cart_url());
}

/**
 * Возвращает ссылку на страницу "Оформление заказа".
 */
function sport_wc_checkout_url() {
    if (!sport_wc_checkout_available())
        return false;
        
    return esc_url(wc_get_checkout_url());
}

/**
 * Возвращает ссылку на страницу "Мой аккаунт".
 */
function sport_wc_myaccount_url() {
    $url = get_permalink(wc_get_page_id('myaccount'));
    return ($url) ? esc_url($url) : false;
}

/**
 * Возвращает ссылку на страницу "Политика конфиденциальности".
 */
function sport_wc_privacy_policy_url() {
    $wp_url = get_privacy_policy_url();
    $wc_url = get_permalink(wc_privacy_policy_page_id());

    if ($wp_url) {
        return $wp_url;
    }

    elseif ($wc_url) {
        return esc_url($wc_url);
    }

    else {
        return false;
    }
}

/**
 * Возвращает ссылку на страницу "Магазин".
 */
function sport_wc_shop_url() {
    $url = get_permalink(wc_get_page_id('shop'));
    return ($url) ? esc_url($url) : false;
}