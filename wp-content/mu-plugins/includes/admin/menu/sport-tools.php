<?php

if (!defined('ABSPATH'))
    exit;

// Изменение страниц пункта "Информация"
add_action('admin_menu', function () {

    // Подключение стилей
	wp_enqueue_style('php', SPORT_PLUGIN_STYLES . '/phpinfo.css');

	// **************************************************************************
    
    // Пункт "Версия PHP"
    add_management_page(
        'PHP ' . phpversion(),
        'Версия PHP',
        'manage_options',
        'php_info',
        function () {
            ob_start();
            phpinfo();
            $php_info = ob_get_contents();
            ob_end_clean();
            
            $php_info = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $php_info);

            echo '<div class="php-info">';
            echo $php_info;
            echo '</div>';
        },
        4
    );
});