<?php

if (!defined('ABSPATH'))
    exit;

?>

<span class="option-result-count">
	<?php
		if ($total <= $per_page || -1 === $per_page) {
			echo sprintf('%d шт.', $total);
		}
		else {
			$first = ($per_page * $current) - $per_page + 1;
			$last  = min($total, $per_page * $current);
			echo sprintf('%1$d&ndash;%2$d из %3$d', $first, $last, $total);
		}
	?>
</span>