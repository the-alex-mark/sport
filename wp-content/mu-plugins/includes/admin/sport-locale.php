<?php

if (!defined('ABSPATH'))
    exit;

// Поддержка локализации плагина
add_action('mu_plugin_loaded', function ($mu_plugin) {
    load_muplugin_textdomain('sport', 'languages');
    load_muplugin_textdomain('tgmpa', 'languages');
});