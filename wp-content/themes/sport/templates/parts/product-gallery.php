<?php

if (!defined('ABSPATH'))
    exit;

if (!function_exists('wc_get_gallery_image_html'))
	return;

global $product;

$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	[
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ($product->get_image_id() ? 'with-images' : 'without-images'),
		'woocommerce-product-gallery--columns-' . absint($columns),
		'images',
	]
);

?>

<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">

		<?php
			$html = ($product->get_image_id())
				? wc_get_gallery_image_html($post_thumbnail_id, true)
				: wc_get_gallery_image_html(get_option('woocommerce_placeholder_image', 0), true);

			echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id);
			do_action('woocommerce_product_thumbnails');
		?>

	</figure>
</div>
