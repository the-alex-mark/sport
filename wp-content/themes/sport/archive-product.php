<?php get_header(); ?>

<main class="container">
	<?php get_sidebar('shop'); ?>

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
</main>

<?php

// /**
//  * Hook: woocommerce_before_main_content.
//  *
//  * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
//  * @hooked woocommerce_breadcrumb - 20
//  * @hooked WC_Structured_Data::generate_website_data() - 30
//  */
// do_action( 'woocommerce_before_main_content' );

// if ( woocommerce_product_loop() ) {

// 	/**
// 	 * Hook: woocommerce_before_shop_loop.
// 	 *
// 	 * @hooked woocommerce_output_all_notices - 10
// 	 * @hooked woocommerce_result_count - 20
// 	 * @hooked woocommerce_catalog_ordering - 30
// 	 */
// 	do_action( 'woocommerce_before_shop_loop' );

// 	woocommerce_product_loop_start();

// 	if ( wc_get_loop_prop( 'total' ) ) {
// 		while ( have_posts() ) {
// 			the_post();

// 			/**
// 			 * Hook: woocommerce_shop_loop.
// 			 */
// 			do_action('woocommerce_shop_loop');

// 			wc_get_template_part('content', 'product');
// 		}
// 	}

// 	woocommerce_product_loop_end();

// 	/**
// 	 * Hook: woocommerce_after_shop_loop.
// 	 *
// 	 * @hooked woocommerce_pagination - 10
// 	 */
// 	do_action( 'woocommerce_after_shop_loop' );
// } else {
// 	/**
// 	 * Hook: woocommerce_no_products_found.
// 	 *
// 	 * @hooked wc_no_products_found - 10
// 	 */
// 	do_action( 'woocommerce_no_products_found' );
// }

// /**
//  * Hook: woocommerce_after_main_content.
//  *
//  * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
//  */
// do_action( 'woocommerce_after_main_content' );

// /**
//  * Hook: woocommerce_sidebar.
//  *
//  * @hooked woocommerce_get_sidebar - 10
//  */
// do_action( 'woocommerce_sidebar' );

get_footer('shop');