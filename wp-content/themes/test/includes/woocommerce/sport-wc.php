<?php

if (!defined('ABSPATH'))
    exit;

// Обновление количества добавленных товаров в корзину (без перезагрузки страницы)
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?><span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span><?php
    $fragments['li a span.cart-count'] = ob_get_clean();

    return $fragments;
});

// "База категорий товара" == "База магазина с категорией"
add_filter('init', 'devvn_product_category_base_same_shop_base');
function devvn_product_category_base_same_shop_base($flash = false) {
    $terms = get_terms([
        'taxonomy'   => 'product_cat',
        'post_type'  => 'product',
        'hide_empty' => false,
    ]);

    if ($terms && !is_wp_error($terms)) {
        $siteurl = esc_url(home_url('/'));
        foreach ($terms as $term) {
            $term_slug = $term->slug;
            $baseterm = str_replace($siteurl, '', get_term_link($term->term_id, 'product_cat'));
            add_rewrite_rule($baseterm . '?$','index.php?product_cat=' . $term_slug,'top');
            add_rewrite_rule($baseterm . 'page/([0-9]{1,})/?$', 'index.php?product_cat=' . $term_slug . '&paged=$matches[1]','top');
            add_rewrite_rule($baseterm . '(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?product_cat=' . $term_slug . '&feed=$matches[1]','top');
        }
    }

    if ($flash == true)
        flush_rewrite_rules(false);
}

// Ограничение по количеству вывода списка товаров
add_filter('loop_shop_per_page', function ($cols) { return 12; }, 20);

// Выбор количества отображаемых постов на странице списка товаров
add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_per_page', 26);
function woocommerce_catalog_per_page() {
    $per_page = filter_input(INPUT_GET, 'per_page', FILTER_SANITIZE_NUMBER_INT);

    $orderby_options = [
        '12' => '12',
        '24' => '24',
        '36' => '36'
    ];

    echo '<form method="get" class="form-option option-count">';
    echo '<label for="select-count">Показать:</label>';
    echo '<select name="count" id="select-count" class="product-show-count" onchange="if (this.value) window.location.href=this.value">';

    foreach ($orderby_options as $value => $label)
        echo '<option ' . selected($per_page, $value) . ' value="?per_page=' . $value . '">' . $label . '</option>';
    
    echo '</select>';
    echo '</form>';
}

add_action('pre_get_posts', 'pre_get_products_query');
function pre_get_products_query($query) {
    $per_page = filter_input(INPUT_GET, 'per_page', FILTER_SANITIZE_NUMBER_INT);

    if ($query->is_main_query() && !is_admin() && is_post_type_archive('product'))
        $query->set('posts_per_page', $per_page);
}

// Сортировка по названию
add_filter('woocommerce_get_catalog_ordering_args', 'add_custom_sort_by_name');
function add_custom_sort_by_name($args) {

    $orderby_value = isset($_GET['orderby'])
        ? wc_clean($_GET['orderby'])
        : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

	if ('name' == $orderby_value) {
		$args['orderby']  = 'name';
		$args['order']    = 'ASC';
		$args['meta_key'] = '';
    }

	if ('name-desc' == $orderby_value) {
		$args['orderby']  = 'name';
		$args['order']    = 'DESC';
		$args['meta_key'] = '';
    }
    
	return $args;
}

// Сортировка по наличию
add_filter('woocommerce_get_catalog_ordering_args', 'add_custom_sort_by_availability');
function add_custom_sort_by_availability($args) {

    $orderby_value = isset($_GET['orderby'])
        ? wc_clean($_GET['orderby'])
        : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

	if ('availability' == $orderby_value) {
		$args['orderby']  = 'meta_value_num wp_posts.ID';
		$args['order']    = 'ASC';
		$args['meta_key'] = '_stock';
    }
    
	if ('availability-desc' == $orderby_value) {
		$args['orderby']  = 'meta_value_num wp_posts.ID';
		$args['order']    = 'DESC';
		$args['meta_key'] = '_stock';
	}

	return $args;
}

// Редактирование вариантов сортировки
add_filter('woocommerce_default_catalog_orderby_options', 'edit_custom_sort');
add_filter('woocommerce_catalog_orderby', 'edit_custom_sort');
function edit_custom_sort($orderby) {

    // Удаление вариантов сортировок по умолчанию
    unset($orderby["menu_order"]);
    unset($orderby["popularity"]);
    unset($orderby["rating"]);
    unset($orderby["date"]);
    unset($orderby["price-desc"]);

    // Присвоение имён вариантам сортировки
    $orderby = [
        'name'       => 'Название',
        'name-desc'  => 'Название (по убыванию)',
        'price'      => 'Цена',
        'price-desc' => 'Цена (по убыванию)'
    ];

    return $orderby;
}