<?php

if (!defined('ABSPATH'))
    exit;

// Поддержка локализации темы
add_action('after_setup_theme', function () {
    load_theme_textdomain('sport', get_template_directory() . '/languages');
});