<?php

if (!defined('ABSPATH'))
    exit;

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

    // Функционал темы
    'constants'     => require 'includes/sport-constants.php',
    'setup'         => require 'includes/sport-setup.php',
    'main'          => require 'includes/sport-functions.php',
    'templates'     => require 'includes/sport-templates.php',
    'shortcodes'    => require 'includes/sport-shortcodes.php',

    // Хуки
    'hook_actions' => require 'includes/hooks/sport-actions.php',
    'hook_filters' => require 'includes/hooks/sport-filters.php',

    // Классы изменения меню
    'walker_social'  => require 'includes/walker/sport-walker-social.php',

    // Плагин "WooCommerce"
    'wc'             => require 'includes/woocommerce/sport-wc.php',
    'wc_functions'   => require 'includes/woocommerce/sport-wc-functions.php'
];

add_filter( 'get_terms', 'organicweb_exclude_category', 10, 3 );
function organicweb_exclude_category( $terms, $taxonomies, $args ) {
  $new_terms = array();
  // if a product category and on a page
  if ( in_array( 'product_cat', $taxonomies ) && ! is_admin() && is_page() ) {
    foreach ( $terms as $key => $term ) {
// Enter the name of the category you want to exclude in place of 'uncategorised'
      if ( ! in_array( $term->slug, array( 'uncategorised', 'import_analogue' ) ) ) {
        $new_terms[] = $term;
      }
    }
    $terms = $new_terms;
  }
  return $terms;
}