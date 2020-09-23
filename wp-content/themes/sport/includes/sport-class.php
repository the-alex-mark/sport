<?php

if (!defined('ABSPATH'))
    exit;

    
// Инициализация глобальных переменных и констант
define('ROOT',      get_template_directory_uri());
define('STYLES',    ROOT . '/assets/styles');
define('SCRIPTS',   ROOT . '/assets/scripts');
define('PLUGINS',   ROOT . '/assets/plugins');
define('FONTS',     ROOT . '/assets/fonts');
define('RESOURCES', ROOT . '/assets/resources');

/**
 * 
 */
class Sport {

    /**
     * 
     */
    public function __construct() {

        add_action('after_setup_theme',  [ $this, 'setup' ]);
        add_action('widgets_init',       [ $this, 'widgets' ]);
        add_action('wp_enqueue_scripts', [ $this, 'assets' ]);
    }

    /**
     * 
     */
    public function setup() {

        // Добавление поддержки загрузки файлов ".svg" и ".ico"
        add_filter('upload_mimes', function ($types) {
            $types['svg'] = 'image/svg+xml';
            $types['ico'] = 'image/vnd.microsoft.icon';

            return $types;
        });

        // Скрытие панели WordPress на сайте
        show_admin_bar(false);

        // Поддержка различных функций на сайте
        add_theme_support('custom-logo');                 // Пользовательский логотип
        add_theme_support('menus');                       // Меню
        add_theme_support('widgets');                     // Виджеты
        add_theme_support('page-thumbnails');             // Миниатюра страниц
        add_theme_support('post-thumbnails');             // Миниатюра постов
        add_theme_support('woocommerce');                 // Поддержка плагина "WooCommerce"
        add_theme_support('wc-product-gallery-zoom');     // 
        add_theme_support('wc-product-gallery-lightbox'); // 
        add_theme_support('wc-product-gallery-slider');   // 

        // Регистрация меню
        register_nav_menu('primary', 'Основное меню');
        register_nav_menu('secondary', 'Дополнительное меню');
        register_nav_menu('handheld', 'Меню для мобильных устройств');
        register_nav_menu('social', 'Социальные сети');

        // Отображение дополнительных полей у различных типов записей
        add_action('init', function () {
            add_post_type_support('page', [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ]);
            add_post_type_support('post', [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ]);
        });

        // Частичное отключение стилей плагина "WooCommerce"
        // add_filter('woocommerce_enqueue_styles', function ($styles) {
        //     unset($styles['woocommerce-general']);     // Основной
        //     unset($styles['woocommerce-layout']);      // Макет
        //     unset($styles['woocommerce-smallscreen']); // Адаптив

        //     return $styles;
        // });

        // Полное отключение стилей плагина "WooCommerce"
        add_filter('woocommerce_enqueue_styles', '__return_false');
    }

    /**
     * 
     */
    public function widgets() {
        
    }

    /**
     * 
     */
    public function assets() {
        
        // Подключение шрифтов
        wp_enqueue_style('font-fontello',  FONTS   . '/fontello/stylesheet.css');
        wp_enqueue_style('font-probapro',  FONTS   . '/probapro/stylesheet.css');
        wp_enqueue_style('font-peacesans', FONTS   . '/peacesans/stylesheet.css');

        // Подключение стилей
        // wp_deregister_style('woocommerce');
        wp_enqueue_style('main',           STYLES  . '/main.css');
        wp_enqueue_style('adaptive',       STYLES  . '/adaptive.css');

        // Подключение Скриптов
        // wp_deregister_script('jquery');
        wp_enqueue_script('main',          SCRIPTS . '/main.js', [], null, true);
    }
}

return new Sport();