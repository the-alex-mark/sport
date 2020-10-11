<?php

if (!defined('ABSPATH'))
    exit;

global $product;

$product_reviews_count     = $product->get_review_count();

?>

<div class="tab-control">
		<ul class="tab-list">
			<li class="tab-item open">
				<a href="#" class="tab-button"><?php _e('Описание', 'sport'); ?></a>
				<div class="tab-content">
					<?php the_content(); ?>
				</div>
			</li>

			<li class="tab-item">
				<a href="#" class="tab-button"><?php _e('Характеристики', 'sport'); ?></a>
				<div class="tab-content">
					<?php $product->list_attributes(); ?>
				</div>
			</li>

			<li class="tab-item">
				<a href="#" class="tab-button"><?php _e('Видео', 'sport'); ?></a>
				<div class="tab-content">
					
					<div class="product-videos">
						<?php $videos = explode(chr(10), get_post_meta($product->get_id(), 'product_additionally__videos', true)); ?>
						<?php foreach ($videos as $src): ?>

							<div class="product-video">
								<iframe src="<?php echo $src; ?>" width="364" height="205" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
							</div>

						<?php endforeach; ?>
					</div>

				</div>
			</li>

			<li class="tab-item">
				<a href="#" class="tab-button"><?php _e('Документация', 'sport'); ?></a>
				<div class="tab-content">
					
				</div>
			</li>

			<?php if (comments_open()): ?>
				<li class="tab-item">
					<a href="#" class="tab-button"><?php echo sprintf(__('Отзывы (%d)', 'sport'), $product_reviews_count); ?></a>
					<div class="tab-content">
						<?php
							call_user_func('comments_template', 'reviews', [
                                'title'    => sprintf(__('Reviews (%d)', 'woocommerce'), $product_reviews_count),
                                'priority' => 30,
                                'callback' => 'comments_template',
                            ]);
						?>
					</div>
				</li>
			<?php endif; ?>

			<li class="tab-item">
				<a href="#" class="tab-button"><?php _e('Cопутствующие товары', 'sport'); ?></a>
				<div class="tab-content">
					
				</div>
			</li>
		</ul>
	</div>