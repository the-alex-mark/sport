<?php

if (!defined('ABSPATH'))
    exit;

// Корневая директория
define('SPORT_THEME_DIR',             get_template_directory());
define('SPORT_THEME_URL',             get_template_directory_uri());

// Расположение файлов в папке "assets"
define('SPORT_ASSETS',                SPORT_THEME_URL . '/assets');
define('SPORT_ASSETS_STYLES',         SPORT_ASSETS    . '/styles');
define('SPORT_ASSETS_SCRIPTS',        SPORT_ASSETS    . '/scripts');
define('SPORT_ASSETS_PLUGINS',        SPORT_ASSETS    . '/plugins');
define('SPORT_ASSETS_FONTS',          SPORT_ASSETS    . '/fonts');
define('SPORT_ASSETS_RESOURCES',      SPORT_ASSETS    . '/resources');

// Расположение файлов шаблонов
define('SPORT_TEMPLATES',                               '/templates');
define('SPORT_TEMPLATES_CONTENT',     SPORT_TEMPLATES . '/content');
define('SPORT_TEMPLATES_GLOBAL',      SPORT_TEMPLATES . '/global');
define('SPORT_TEMPLATES_PAGES',       SPORT_TEMPLATES . '/pages');
define('SPORT_TEMPLATES_PARTS',       SPORT_TEMPLATES . '/parts');
define('SPORT_TEMPLATES_WOOCOMMERCE', SPORT_TEMPLATES . '/woocommerce');