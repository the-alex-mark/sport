<?php

if (!defined('ABSPATH'))
    exit;

?>

<form action="#" method="get" class="form-orderby">
	<label for="select-orderby">Сортировать по:</label>
	<select id="select-orderby" name="orderby" class="select-orderby">
		<?php foreach ($catalog_orderby_options as $id => $name): ?>
			<option value="<?php echo $id; ?>" <?php selected($orderby, $id); ?>><?php echo $name; ?></option>
		<?php endforeach; ?>
	</select>

	<!-- <a href="#" class="sort-by-switcher sort-by-switcher--asc">Сортируется по возрастанию. Установить по убыванию</a> -->

	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields(null, [ 'orderby', 'submit', 'paged', 'product-page' ]); ?>
</form>