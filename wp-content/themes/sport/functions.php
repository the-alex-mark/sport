<?php

// Описание темы
$theme = wp_get_theme('sport');

// Подключение необходимых файлов
$sport = (object)[
    
    // Описание темы
    'theme' => [
        'name'        => $theme['Name'],
        'description' => $theme['Description'],
        'version'     => $theme['Version'],
    ],

    // Функционал
    'main'        => require 'includes/sport-class.php',
    'functions'   => require 'includes/sport-functions.php'
];