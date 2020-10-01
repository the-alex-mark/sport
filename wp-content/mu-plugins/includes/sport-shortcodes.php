<?php

if (!defined('ABSPATH'))
    exit;

// Шорткод для вывода руководителей проекта "Стек-Спорт"
add_shortcode('staff', function ($args) {
    ob_start();
    require SPORT_PLUGIN_TEMPLATES_PARTS . '/staff.php';
    $part = ob_get_contents();
    ob_end_clean();
    
    return $part;
});