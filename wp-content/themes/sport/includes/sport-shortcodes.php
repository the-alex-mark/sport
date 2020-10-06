<?php

if (!defined('ABSPATH'))
    exit;

// Список руководителей проекта
add_shortcode('staff', function ($args) {
    ob_start();
    require SPORT_THEME_DIR . SPORT_TEMPLATES_PARTS . '/staff.php';
    $part = ob_get_contents();
    ob_end_clean();
    
    return $part;
});

// elementor_load_plugin_textdomain

// if (!is_front_page()) {
    // remove_accents('elementor_load_plugin_textdomain');
    // remove_action('elementor_load_plugin_textdomain', 99999);
    // add_action( 'elementor/loaded', function () {
    //     return false;
    // } );

    // remove_action( 'plugins_loaded', 'elementor_load_plugin_textdomain' );
    // remove_all_actions( 'plugins_loaded', 1 );
// }