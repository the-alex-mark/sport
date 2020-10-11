<?php

if (!defined('ABSPATH'))
    exit;

?>

<span class="filter-text">
	<?php

		// Если только одна страница
		if ($total <= $per_page || -1 === $per_page) {
			echo sprintf('%d шт.', $total);
		}

		// Если страниц больше одной
		else {
			$first = ($per_page * $current) - $per_page + 1;
			$last  = min($total, $per_page * $current);
			echo sprintf(__('%1$d–%2$d из %3$d', 'sport'), $first, $last, $total);
		}
	?>
</span>