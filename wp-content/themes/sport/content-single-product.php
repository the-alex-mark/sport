<?php

if (!defined('ABSPATH'))
    exit;

global $product;

?>

		<div class="content">
			<div class="row">
				<div class="col product-photo">
					<div class="large-photo">
						<img src="" alt="" class="large-photo">
					</div>
					<!-- <ul>

					</ul> -->

					<?php
						// echo $product->get_name();
						// echo $product->get_image();
						// dd($product->get_gallery_image_ids());

						$attachment_ids = $product->get_gallery_image_ids();
						foreach( $attachment_ids as $attachment_id ) 
						{
							// Display the image URL
							// echo $Original_image_url = wp_get_attachment_url( $attachment_id );

							// Display Image instead of URL
							// echo wp_get_attachment_image($attachment_id, 'full');
						}
					?>
				</div>

				<div class="col product-description">

				</div>

				<div class="col product-purchase">

				</div>
			</div>

			<!-- <div class="your-class">
				<div>your content</div>
				<div>your content</div>
				<div>your content</div>
			</div> -->

			<!-- http://sport/wp-content/uploads/2020/09/aga_8824.jpg
			http://sport/wp-content/uploads/2020/09/aga_8775-1.jpg -->

			<div class="slider slider-for"> 
				<div><img src="http://sport/wp-content/uploads/2020/09/aga_8824.jpg" alt=""></div>
				<div><img src="http://sport/wp-content/uploads/2020/09/aga_8775-1.jpg" alt=""></div>
			</div>
			<div class="slider slider-nav">
				<div class="item"><img src="http://sport/wp-content/uploads/2020/09/aga_8824.jpg" alt=""></div>
				<div class="item"><img src="http://sport/wp-content/uploads/2020/09/aga_8775-1.jpg" alt=""></div>
			</div>
		</div>

<!-- <main class="content">
	
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

	<?php /* dd($product);  */?>
</main> -->

<?php

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>