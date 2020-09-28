<?php

if (!defined('ABSPATH'))
    exit;

if (!function_exists('sport_wc_is_activated')) {

	/**
	 * 
	 */
	function sport_wc_is_activated() {
		return class_exists('WooCommerce') ? true : false;
	}
}

if ( ! function_exists( 'sport_wc_cart_available' ) ) {
    
    /**
     * 
     */
	function sport_wc_cart_available() {
		$woo = WC();
		return $woo instanceof \WooCommerce && $woo->cart instanceof \WC_Cart;
	}
}

if (!function_exists('sport_wc_get_cart_count')) {

    /**
     * 
     */
    function sport_wc_get_cart_count() {
        if (!sport_wc_cart_available())
            return 0;
            
        return WC()->cart->get_cart_contents_count();
    }
}

if (!function_exists('sport_wc_the_cart_count')) {

    /**
     * 
     */
    function sport_wc_the_cart_count() {
        echo sport_wc_get_cart_count();
    }
}

if ( ! function_exists( 'sport_wc_get_cart_subtotal' ) ) {
    
    /**
     * 
     */
	function sport_wc_get_cart_subtotal() {
		if (!sport_wc_cart_available())
            return 0;
            
        // return wp_kses_post(WC()->cart->get_cart_subtotal());
        // return WC()->cart->get_total();
        return WC()->cart->total;
	}
}

if ( ! function_exists( 'sport_wc_the_cart_subtotal' ) ) {
    
    /**
     * 
     */
	function sport_wc_the_cart_subtotal() {            
        echo sport_wc_get_cart_subtotal();
	}
}

if ( ! function_exists( 'sport_wc_get_cart_url' ) ) {
    
    /**
     * 
     */
	function sport_wc_get_cart_url() {
		if (!sport_wc_cart_available())
            return '#';
            
        return esc_url(wc_get_cart_url());
	}
}

if ( ! function_exists( 'sport_wc_the_cart_url' ) ) {
    
    /**
     * 
     */
	function sport_wc_the_cart_url() {
        echo sport_wc_get_cart_url();
	}
}

// Скрытие нулей после запятой в цене
add_filter('woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1);
function wc_hide_trailing_zeros($trim) {
    return false;
}