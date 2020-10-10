<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php get_header(); ?>

	<?php get_sidebar(); ?>

    <article class="content">
		<h1 class="content-title"><?php woocommerce_page_title(); ?></h1>

		<?php do_action('sport_wc_catalog_filter'); ?>

		<div class="product-grid grid">
			<?php if (wc_get_loop_prop('total')): ?>
				<?php while (have_posts()): the_post(); ?>

					<?php
						global $product;

						$product_url               = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);
						$product_image_url         = sport_wc_image_url_from_id($product->get_image_id());
						$product_name              = $product->get_name();
						$product_short_description = $product->get_short_description();
						$product_price             = $product->get_price_html();
						$product_add_to_cart_url   = do_shortcode('[add_to_cart_url id="' . $product->get_id() . '"]');
						$product_sellable          = true;

						$category_ids = $product->get_category_ids();
						foreach ($category_ids as $id) {
							$term = get_term($id, 'product_cat');
							if ($term->slug == 'import')
								$product_sellable = false;
						}
					?>
				
					<figure class="product-card grid-item">
						<a href="<?php echo $product_url ?>" class="product-image">
							<img src="<?php echo $product_image_url ?>" alt="<?php echo $product_name ?>">
						</a>
						<figcaption class="product-info">
							<h2 class="product-title"><a href="<?php echo $product_url ?>"><?php echo $product_name ?></a></h2>
							<div class="product-desc">
								<?php echo $product_short_description ?>
							</div>
							<span class="product-price"><?php echo $product_price ?></span>

							<div class="product-actions">
								<?php if ($product_sellable): ?>
									<a href="<?php echo $product_add_to_cart_url ?>" class="action-add-cart">Добавить в корзину</a>
								<?php endif; ?>

								<?php do_action('sport_wc_add_compare_link'); ?>
							</div>
						</figcaption>
					</figure>
				
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<?php do_action('sport_wc_catalog_filter'); ?>
    </article>

<?php get_footer(); ?>