<?php

if (!defined('ABSPATH'))
    exit;

global $product;

?>

<div class="single-product-info">
	<div class="single-product_col col-image">
		<?php do_action('woocommerce_before_single_product_summary'); ?>
		<?php /* show_product_images(); */ ?>
		<?php /* woocommerce_show_product_images(); */ ?>
		<?php /* woocommerce_show_product_thumbnails(); */ ?>
	</div>

	<div class="single-product_col col-info">
		<div class="product-info_title">
			<h1 class="product-info_name"><?php the_title(); ?></h1>
			<span class="product-info_price"><?php echo round($product->price); ?> руб.</span>
		</div>

		<!-- <span class="product-info_rating">1 2 3 4 5</span> -->
		<span class="product-info_rating">
			<?php /* do_action('woocommerce_product_get_rating_html'); */ ?>
		</span>

		<div class="product-info_reviews">
			<a href="#" class="product-info_reviews-count">Отзывов (0)</a>
			<span class="product-reviews_delimiter">|</span>
			<a href="#" class="product-info_reviews-add">Добавьте ваш отзыв</a>
		</div>

		<?php
			$availability_flag = 'no-stock';
			$availability_message = 'Нет в наличии';

			if ($product->is_in_stock()) {
				$availability_flag = 'in-stock';
				$availability_message = 'Есть в наличии';
			}
		?>
		<span class="product-info_availability <?php echo $availability_flag; ?>">
			<?php echo $availability_message; ?>
		</span>

		<div class="product-info_short-description">
			<?php the_excerpt(); ?>
		</div>
	</div>

	<?php if ($product->is_in_stock()): ?>

		<div class="single-product_col col-order">
			<div class="product-order_purchase">
				<button class="product-order_order">Заказать</button>
				<button class="product-order_topay">Оплатить</button>
			</div>

			<?php get_template_part(SPORT_TEMPLATES_PARTS . '/product', 'add_to_cart'); ?>
		</div>

	<?php endif; ?>
</div>

<div class="tab-control">
	<ul class="tab-list">
		<li class="tab-item open">
			<a href="#" class="tab-button">Описание</a>
			<div class="tab-content">
				<?php the_content(); ?>
			</div>
		</li>

		<li class="tab-item">
			<a href="#" class="tab-button">Характеристики</a>
			<div class="tab-content">
				<?php $product->list_attributes(); ?>
			</div>
		</li>

		<li class="tab-item">
			<a href="#" class="tab-button">Видео</a>
			<div class="tab-content">

			</div>
		</li>

		<li class="tab-item">
			<a href="#" class="tab-button">Документация</a>
			<div class="tab-content">
				
			</div>
		</li>

		<li class="tab-item">
			<a href="#" class="tab-button">Отзывы (<span class="reviews-count">0</span>)</a>
			<div class="tab-content">
				
			</div>
		</li>

		<li class="tab-item">
			<a href="#" class="tab-button">Cопутствующие товары</a>
			<div class="tab-content">
				
			</div>
		</li>
	</ul>
</div>



<?php do_action('woocommerce_before_single_product'); ?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
	<?php do_action('woocommerce_before_single_product_summary'); ?>
		<div class="summary entry-summary">
			<?php do_action('woocommerce_single_product_summary'); ?>
		</div>
	<?php do_action('woocommerce_after_single_product_summary'); ?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>