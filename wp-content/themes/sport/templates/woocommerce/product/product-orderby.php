<?php

if (!defined('ABSPATH'))
    exit;

?>

<form method="get" class="form-option option-orderby woocommerce-ordering">
	<label for="select-orderby">Сортировать по:</label>
	<select id="select-orderby" name="orderby" class="select-orderby orderby">
		<?php foreach ($args['catalog_orderby_options'] as $id => $name): ?>
			<option value="<?php echo $id; ?>" <?php selected($args['orderby'], $id); ?>><?php echo $name; ?></option>
		<?php endforeach; ?>
	</select>
	
	<?php
		if (strpos($args['orderby'], '-desc')) {
			$args['orderby'] = str_replace('-desc', '', $args['orderby']);
			// $content = '&#8595;';
			$content = '&#9660;';
			$message = 'Сортируется по убыванию. Установить по возрастанию';
		}
		else {
			$args['orderby'] .= '-desc';
			// $content = '&#8593;';
			$content = '&#9650;';
			$message = 'Сортируется по возрастанию. Установить по убыванию';
		}
	?>
	<a href="?orderby=<?php echo $args['orderby']; ?>" class="link-orderby" title="<?php echo $message; ?>"><?php echo $content; ?></a>

	<input type="hidden" name="paged" value="1">
	<?php wc_query_string_form_fields(null, [ 'orderby', 'submit', 'paged', 'product-page' ]); ?>
</form>