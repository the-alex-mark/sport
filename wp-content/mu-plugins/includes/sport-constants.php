<?php

if (!defined('ABSPATH'))
    exit;

// Корневая директория
define('SPORT_PLUGIN',                   dirname(dirname(__FILE__)));
define('SPORT_PLUGIN_URL',               plugin_dir_url(dirname(__FILE__)));

// Расположение файлов в папке "assets"
define('SPORT_PLUGIN_ASSETS',            SPORT_PLUGIN_URL       . 'assets');
define('SPORT_PLUGIN_STYLES',            SPORT_PLUGIN_ASSETS    . '/styles');
define('SPORT_PLUGIN_SCRIPTS',           SPORT_PLUGIN_ASSETS    . '/scripts');
define('SPORT_PLUGIN_PLUGINS',           SPORT_PLUGIN_ASSETS    . '/plugins');
define('SPORT_PLUGIN_FONTS',             SPORT_PLUGIN_ASSETS    . '/fonts');
define('SPORT_PLUGIN_RESOURCES',         SPORT_PLUGIN_ASSETS    . '/resources');

// Расположение файлов шаблонов
define('SPORT_PLUGIN_TEMPLATES',         SPORT_PLUGIN           . '/templates');
define('SPORT_PLUGIN_TEMPLATES_CONTENT', SPORT_PLUGIN_TEMPLATES . '/content');
define('SPORT_PLUGIN_TEMPLATES_GLOBAL',  SPORT_PLUGIN_TEMPLATES . '/global');
define('SPORT_PLUGIN_TEMPLATES_PAGES',   SPORT_PLUGIN_TEMPLATES . '/pages');
define('SPORT_PLUGIN_TEMPLATES_PARTS',   SPORT_PLUGIN_TEMPLATES . '/parts');