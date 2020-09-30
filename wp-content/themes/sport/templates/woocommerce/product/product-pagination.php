<?php

if (!defined('ABSPATH'))
    exit;

$total   = isset($args['total'])   ? $args['total']   : wc_get_loop_prop('total_pages');
$current = isset($args['current']) ? $args['current'] : wc_get_loop_prop('current_page');
$base    = isset($args['base'])    ? $args['base']    : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
$format  = isset($args['format'])  ? $args['format']  : '';

if ($total <= 1)
	return;

?>

<form method="get" class="form-option option-pagination">
	<?php
		echo paginate_links(
			apply_filters(
				'woocommerce_pagination_args',
				[
					'base'      => $base,
					'format'    => $format,
					'add_args'  => false,
					'current'   => max(1, $current),
					'total'     => $total,
					'prev_text' => '&#9668;',
					'next_text' => '&#9658;',
					'type'      => 'list',
					'end_size'  => 3,
					'mid_size'  => 3,
				]
			)
		);
	?>
</form>