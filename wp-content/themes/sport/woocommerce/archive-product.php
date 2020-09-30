<?php do_action('sport_page_before'); ?>

	<?php do_action('sport_content_sidebar', 'shop'); ?>

	<div class="content">
		<h1 class="product-title"><?php woocommerce_page_title(); ?></h1>



		<div class="product-options">
			<?php sport_wc_ordering(); ?>

			<hr class="option-separator">

			<?php
				remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
				do_action('woocommerce_before_shop_loop',);
			?>

			<?php sport_wc_pagination(); ?>
		</div>

		<div class="product-list grid">
			<!-- <?php woocommerce_product_loop_start(); ?> -->
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
			<!-- <?php woocommerce_product_loop_end(); ?> -->
		</div>

		<div class="product-options">
			<?php sport_wc_ordering(); ?>

			<hr class="option-separator">

			<?php
				remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
				do_action('woocommerce_before_shop_loop',);
			?>

			<?php sport_wc_pagination(); ?>
		</div>
	</div>


<?php
// if ( woocommerce_product_loop() ) {

// 	/**
// 	 * Hook: woocommerce_before_shop_loop.
// 	 *
// 	 * @hooked woocommerce_output_all_notices - 10
// 	 * @hooked woocommerce_result_count - 20
// 	 * @hooked woocommerce_catalog_ordering - 30
// 	 */
// 	do_action( 'woocommerce_before_shop_loop' );

// 	/**
// 	 * Hook: woocommerce_after_shop_loop.
// 	 *
// 	 * @hooked woocommerce_pagination - 10
// 	 */
// 	do_action( 'woocommerce_after_shop_loop' );
// }
?>

<?php do_action('sport_page_after'); ?>