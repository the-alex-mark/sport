<?php

if (!defined('ABSPATH'))
    exit;

/**
 * 
 */
class sport {

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

        // Частичное отключение стилей плагина "WooCommerce"
        // add_filter('woocommerce_enqueue_styles', function ($styles) {
        //     unset($styles['woocommerce-general']);     // Основной
        //     unset($styles['woocommerce-layout']);      // Макет
        //     unset($styles['woocommerce-smallscreen']); // Адаптив

        //     return $styles;
        // });

        // Полное отключение стилей плагина "WooCommerce"
        // add_filter('woocommerce_enqueue_styles', '__return_false');
    }

    /**
     * 
     */
    public function widgets() {

        // Регистрация боковой панели магазина
        register_sidebar([
            'name'          => 'Боковая панель',
            'id'            => "sidebar_shop",
            'description'   => 'Боковая панель для магазина',
            'class'         => 'sidebar-shop',
            'before_widget' => '<div id="%1$s" class="sidebar-filter no-select %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<span class="filter-title">',
            'after_title'   => '</span>',
        ]);
    }

    /**
     * 
     */
    public function assets() {
        
        // Подключение шрифтов
        wp_enqueue_style('font-fontello',   SPORT_ASSETS_FONTS    . '/fontello/stylesheet.css');
        wp_enqueue_style('font-probapro',   SPORT_ASSETS_FONTS    . '/probapro/stylesheet.css');
        wp_enqueue_style('font-peacesans',  SPORT_ASSETS_FONTS    . '/peacesans/stylesheet.css');

        // Подключение стилей
        wp_enqueue_style('slick',           SPORT_ASSETS_PLUGINS  . '/slick/slick.css');
        
        wp_enqueue_style('normalize',       SPORT_ASSETS_STYLES   . '/normalize.css');
        wp_enqueue_style('woocommerce',     SPORT_ASSETS_STYLES   . '/woocommerce.css');
        wp_enqueue_style('style',           get_stylesheet_uri());
        wp_enqueue_style('dashicons');
        wp_enqueue_style('main',            SPORT_ASSETS_STYLES   . '/main.css');
        wp_enqueue_style('adaptive',        SPORT_ASSETS_STYLES   . '/adaptive.css');
        
        // Подключение Скриптов
        // wp_deregister_script('jquery');
        wp_enqueue_script('jquery-migrate',                  '//code.jquery.com/jquery-migrate-1.2.1.min.js', [], null, true);
        wp_enqueue_script('slick',          SPORT_ASSETS_PLUGINS  . '/slick/slick.min.js', [], null, true);
        wp_enqueue_script('main',           SPORT_ASSETS_SCRIPTS  . '/main.js', [], null, true);
    }
}

return new sport();