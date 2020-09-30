<?php

if (!defined('ABSPATH'))
	exit;

global $product;

if (!$product->is_purchasable())
	return;

?>

<form class="product-order_card cart" action="<?php echo apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink()); ?>" method="post" enctype='multipart/form-data'>
	<button type="submit" name="add-to-cart" value="<?php echo $product->get_id(); ?>" class="single_add_to_cart_button button alt">Добавить в корзину</button>
</form>
