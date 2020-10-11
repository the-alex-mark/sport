<?php

if (!defined('ABSPATH'))
    exit;

?>

<div class="content-filter">
    <?php

        // Порядок отображения
        woocommerce_catalog_ordering();
    ?>

    <hr class="filter-separator option-separator">

    <?php

        // Общее количество и количество на странице
        woocommerce_result_count();

        // Выбор количества отображения на одной странице
        woocommerce_per_page();

        // Пагинация
        woocommerce_pagination();
    ?>
</div>