<?php

if (!defined('ABSPATH'))
    exit;

global $product;

if (!comments_open())
	return;

?>

<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<?php if (have_comments()): ?>
			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
				<nav class="woocommerce-pagination">
					<?php paginate_comments_links(apply_filters('woocommerce_comment_pagination_args', [ 'prev_text' => '&larr;', 'next_text' => '&rarr;', 'type' => 'list', ])); ?>
				</nav>
			<?php endif; ?>

		<?php else: ?>
			<p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'woocommerce'); ?></p>
		<?php endif; ?>
	</div>

	<style>
		/* Комментации */
		ol.commentlist {
			list-style: none;
			padding: 0;
		}
		li.review {
			margin-bottom: 26px;
		}
		.comment-author {
			display: inline-block;
			margin-bottom: 6px;
		}
		.comment-rating {
			display: flex;
			align-items: center;
			margin-bottom: 10px;
		}
		.comment-label {
			font-size: 12px;
			line-height: 1;
			text-transform: uppercase;
		}
		.comment-rating .star-rating {
			display: flex;
			margin-left: 10px;
			margin-top: -2px;
		}
		.comment-rating .star-rating .star {
			font-size: 16px;
			/* line-height: inherit; */
		}
		.comment-desc p {
			/* display: flex; */
			display: inline;
		}
		.comment-time {
			display: inline;
		}

		.comment-reply-title {
			margin-bottom: 30px;
			font-size: 26px;
			font-weight: 500;
			text-align: center;
			text-transform: uppercase;
			color: var(--color-h1);
		}

		.comment-form {
			
		}
		.comment-form .required {
			color: #F44336;
		}
		.comment-form label {
			display: inline-block;
			width: 100%;
		}
		.comment-form input[type='text'],
		.comment-form input[type='email'] {
			display: block;
			width: 100%;
		}
	</style>

	<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())): ?>
		<div id="review_form_wrapper">
			<div id="review_form">

				<?php
					$commenter    = wp_get_current_commenter();
					$comment_form = array(
						'title_reply'         => esc_html__('Оставьте ваш отзыв', 'sport'), // get_the_title()
						'title_reply_to'      => '',
						'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title">',
						'title_reply_after'   => '</h3>',
						'comment_notes_after' => '',
						'label_submit'        => esc_html__( 'Submit', 'woocommerce' ),
						'logged_in_as'        => '',
						'comment_field'       => '',
					);

					$comment_form['fields'] = [];
					$fields = [
						'author' => [
							'label'    => __('Name', 'woocommerce'),
							'type'     => 'text',
							'value'    => $commenter['comment_author'],
							'required' => true,
						],

						'email'  => [
							'label'    => __('Электронная почта', 'sport'),
							'type'     => 'email',
							'value'    => $commenter['comment_author_email'],
							'required' => (bool)get_option('require_name_email', true),
						]
					];
					
					foreach ($fields as $key => $field) {
						$field_html  = '<p class="comment-form-' . esc_attr($key) . '">';
						$field_html .= '<label for="' . esc_attr($key) . '">' . esc_html($field['label']);

						if ($field['required'])
							$field_html .= '&nbsp;<span class="required">*</span>';

						$field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' /></p>';

						$comment_form['fields'][$key] = $field_html;
					}

					if (wc_review_ratings_enabled()) {
						$comment_form['fields']['rating'] = '<p class="comment-form-rating">
							<label for="rating">' . esc_html__('Your rating', 'woocommerce') . (wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '') . '</label>
							<select name="rating" id="rating" required>
								<option value="">'  . esc_html__('Rate&hellip;', 'woocommerce') . '</option>
								<option value="5">' . esc_html__('Perfect', 'woocommerce')      . '</option>
								<option value="4">' . esc_html__('Good', 'woocommerce')         . '</option>
								<option value="3">' . esc_html__('Average', 'woocommerce')      . '</option>
								<option value="2">' . esc_html__('Not that bad', 'woocommerce') . '</option>
								<option value="1">' . esc_html__('Very poor', 'woocommerce')    . '</option>
							</select>
						</p>';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment">
						<label for="comment">' . esc_html__('Отзыв', 'sport') . '&nbsp;<span class="required">*</span></label>
						<textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
					</p>';

					comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
				?>

				<style>
					.table-star {

					}
					.table-star .star-rating .star {
						font-size: 14px;
					}
					.table-star thead th,
					.table-star thead td {
						background-color: transparent;
						border: none;
					}
					.table-star tbody td {
						padding: 0;
					}
					.raling-label {
						display: flex;
						justify-content: center;
						align-items: center;
						margin: 0;
						padding: 10px;
						width: 100%;
						height: 100%;
					}

					.form-submit #submit {
						display: block;
						padding: 6px 16px;
						font-weight: normal;
						text-decoration: none;
						text-align: center;
						color: #FFFFFF;
						background-color: #F44336;
						border: none;
						border-radius: 4px;
					}
					.form-submit #submit:hover {
						background-color: #D93C37;
    					text-decoration: none;
					}
				</style>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>
