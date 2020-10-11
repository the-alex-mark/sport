<?php

if (!defined('ABSPATH'))
    exit;

global $product;

$product_image_url         = sport_wc_image_url_from_id($product->get_image_id());
$product_gallery_ids       = $product->get_gallery_image_ids();
$product_name              = $product->get_name();
$product_description       = $product->get_description();
$product_short_description = $product->get_short_description();
$product_price             = $product->get_price_html();
$product_availability      = $product->is_in_stock();
$product_rating            = $product->get_average_rating();
$product_reviews_count     = $product->get_review_count();
$product_add_to_cart_url   = do_shortcode('[add_to_cart_url id="' . $product->get_id() . '"]');
$product_sellable          = true;

$category_ids = $product->get_category_ids();
foreach ($category_ids as $id) {
	$term = get_term($id, 'product_cat');
	if ($term->slug == 'import')
		$product_sellable = false;
}

?>

<div class="product">
	<div class="product-info">
		<div class="product-col gallery">
			<div class="product-image">
				<div class="product-image-large">
					<img src="<?php echo $product_image_url; ?>" alt="">
				</div>

				<?php if ($product_gallery_ids): ?>
					<div class="product-gallery grid">

						<a id="<?php echo $product->get_image_id(); ?>" href="#" class="product-image-small product-gallery-item grid-item">
							<img src="<?php echo $product_image_url; ?>" alt="">
						</a>

						<?php foreach ($product_gallery_ids as $gallery_id): ?>
							<a id="<?php echo $gallery_id; ?>" href="#" class="product-image-small product-gallery-item grid-item">
								<img src="<?php echo sport_wc_image_url_from_id($gallery_id); ?>" alt="">
							</a>
						<?php endforeach; ?>

					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="product-col general">
			<div class="product-header">
				<h1 class="product-title"><?php echo $product_name; ?></h1>
				<span class="product-price"><?php echo $product_price; ?></span>
			</div>
			
			<div class="product-row">
				<?php
				if ($product_rating > 0)
					sport_wc_star_rating([ 'rating' => $product_rating ]);
				?>
			</div>

			<div class="product-row">
				<div class="product-reviews">
					<a href="" class="reviews-count">Отзывы <span class="count">(<?php echo $product_reviews_count; ?>)</span></a>
					<span class="reviews-separator">|</span>
					<a href="" class="reviews-add">Добавьте ваш отзыв</a>
				</div>
			</div>

			<div class="product-row">
				<?php
					$availability_flag = 'no-stock';
					$availability_message = 'Нет в наличии';

					if ($product_availability) {
						$availability_flag = 'in-stock';
						$availability_message = 'Есть в наличии';
					}
				?>

				<span class="product-availability <?php echo $availability_flag; ?>"><? echo $availability_message; ?></span>
			</div>

			<div class="product-desc">
				<?php echo $product_short_description; ?>
			</div>
		</div>

		<div class="product-col action">
			<div class="product-actions">
				<?php if ($product_sellable): ?>
					<a href="<?php echo $product_add_to_cart_url; ?>" class="button action-add-cart">Добавить в корзину</a>
				<?php endif; ?>
				
				
				<div class="product-compare">
					<i class="fas fa-balance-scale-left"></i>
					<?php do_action('sport_wc_add_compare_link'); ?>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part(SPORT_TEMPLATES_PARTS . '/tabs'); ?>
</div>