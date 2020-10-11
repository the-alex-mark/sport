<?php

if (!defined('ABSPATH'))
	exit;

?>

<form method="get" class="form-filter filter-orderby woocommerce-ordering">
	<label for="select-orderby" class="filter-label">Сортировать по:</label>
	<select id="select-orderby" name="orderby" class="filter-select select-orderby orderby">
		<?php foreach ($catalog_orderby_options as $id => $name): ?>
			<option value="<?php echo $id; ?>" <?php selected($orderby, $id); ?>><?php echo $name; ?></option>
		<?php endforeach; ?>
	</select>
	
	<?php
		if (strpos($orderby, '-desc')) {
			$orderby = str_replace('-desc', '', $orderby);
			$content = '&#9660;';
			$message = 'Сортируется по убыванию. Установить по возрастанию';
		}
		else {
			$orderby .= '-desc';
			$content = '&#9650;';
			$message = 'Сортируется по возрастанию. Установить по убыванию';
		}
	?>
	<a href="?orderby=<?php echo $orderby; ?>" class="filter-link link-orderby" title="<?php echo $message; ?>"><?php echo $content; ?></a>

	<input type="hidden" name="paged" value="1">
	<?php wc_query_string_form_fields(null, [ 'orderby', 'submit', 'paged', 'product-page' ]); ?>
</form>