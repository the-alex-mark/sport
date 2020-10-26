<?php

if (!defined('ABSPATH'))
    exit;

global $comment;

$rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
$verified = wc_review_is_from_verified_owner($comment->comment_ID);

?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">
		<div class="comment-text">
			<div class="comment-row comment-meta">
				<?php if ($comment->comment_approved === '0'): ?>
					<em class="woocommerce-review__awaiting-approval">
						<?php esc_html_e( 'Your review is awaiting approval', 'woocommerce' ); ?>
					</em>
				<?php else: ?>
					<span class="comment-author">Отзыв пользователя <strong><?php comment_author(); ?></strong></span>
					<?php
						if (get_option('woocommerce_review_rating_verification_label') && $verified === 'yes')
							echo '<em class="woocommerce-review__verified verified">(' . esc_attr__('verified owner', 'woocommerce') . ')</em> ';
					?>
				<?php endif; ?>
			</div>

			<div class="comment-row comment-rating">
				<span class="comment-label">Качество</span>
				<?php
					if ($rating > 0)
						sport_wc_star_rating([ 'rating' => $rating ]);
				?>
			</div>

			<div class="comment-row comment-desc">
				<?php comment_text(); ?>

				<span class="comment-time">
					(Отзыв написан
					<time class="woocommerce-review__published-date" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></time>)
				</span>
			</div>
		</div>
	</div>
</li>