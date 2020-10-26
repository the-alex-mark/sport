<?php
/**
 * YITH Woocommerce Compare widget template
 *
 * @author YITH
 * @package YITH Woocommerce Compare
 * @version 2.5.0
 */

if( ! defined( 'YITH_WOOCOMPARE' ) ) {
	exit;
}

global $yith_woocompare;

?>

<div class="yith-woocomerce-widget-content" data-lang="<?php echo esc_attr( $lang ); ?>" <?php echo ! empty( $hide_empty ) ? 'data-hide="1"' : ''; ?>>

	<?php if ( ! empty( $products_list ) ) : ?>

		<ul class="products-list">

			<?php foreach ( $products_list as $product_id ) :
				/**
				 * @type object $product /WC_Product
				 */
				$product = wc_get_product( $product_id );
				if ( ! $product ) {
					continue;
				}

				wc_get_template( 'yith-compare-widget-item.php', array(
					'product' => $product,
					'product_id' => $product_id
				), '', YITH_WOOCOMPARE_TEMPLATE_PATH . '/' );

			endforeach; ?>
		</ul>

		<a href="<?php echo esc_url( $remove_url ); ?>" data-product_id="all" class="clear-all" rel="nofollow"><?php _e( 'Clear all', 'yith-woocommerce-compare' ) ?></a>
		<a href="<?php echo esc_url( $view_url ); ?>" class="compare-widget button" rel="nofollow"><?php echo apply_filters( 'yith_woocompare_widget_view_table_button',__( 'Compare', 'yith-woocommerce-compare' )) ?></a>

	<?php else : ?>

	<span class="list_empty"><?php echo esc_html__( 'No products to compare', 'yith-woocommerce-compare' ); ?></span>

	<?php endif; ?>
</div>
