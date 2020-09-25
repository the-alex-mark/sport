<?php do_action('page_content__before'); ?>

	<?php do_action('page_content__sidebar', 'shop'); ?>

	<div class="content">
		<h1 class="product-title"><?php woocommerce_page_title(); ?></h1>
		<div class="content-options">
			<div class="oprion-wrapper">
				<?php sport_catalog_ordering(); ?>
			</div>
		</div>

		<div class="product-list grid">
			<?php if (wc_get_loop_prop('total')): ?>
				<?php while (have_posts()): the_post(); global $product; ?>

					<figure class="product-card">
						<?php $product_url = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product); ?>
						<a href="<?php echo $product_url; ?>" class="product-image">

							<?php
								$image_url = wp_get_attachment_url($product->image_id);
								if (!$image_url)
									$image_url = woocommerce_placeholder_img_src();
							?>

							<img src="<?php echo $image_url; ?>" alt="">
						</a>
						<figcaption class="product-info">
							<h2 class="product-name"><a href="<?php echo $product_url; ?>"><?php echo $product->name; ?></a></h2>
							<span class="product-price"><?php echo round($product->price); ?> руб.</span>

							<div class="product-options">
								<button class="product-button order">Заказать</button>
								<button class="product-button topay">Оплатить</button>
							</div>

							<a href="#" class="product-compare">Добавить в сравнение</a>
						</figcaption>
					</figure>

				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<div class="content-options">
			<div class="oprion-wrapper">
				<?php sport_catalog_ordering(); ?>
			</div>
		</div>
	</div>

<?php do_action('page_content__after'); ?>