<?php

if (!defined('ABSPATH'))
    exit;

?>

<article class="sidebar">

    <span class="sidebar-title">Подобрать по:</span>

    <?php $categories = get_categories([ 'taxonomy' => 'product_cat' ]); ?>
    <?php if ($categories): ?>
        <div class="sidebar-categories">
            <div class="content-options">
                <span class="block-title">Категории</span>
            </div>

            <ul>
                <?php foreach ($categories as $item): ?>
                    <li><a href="<?php echo get_category_link($item->term_id); ?>"><?php echo $item->name; ?> <span class="count">(<?php echo $item->count; ?>)</span></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php $categories = get_categories([ 'taxonomy' => 'product_cat' ]); ?>
    <?php if ($categories): ?>
        <div class="sidebar-categories">
            <div class="content-options">
                <span class="block-title">Бренд</span>
            </div>

            <ul>
                <?php foreach ($categories as $item): ?>
                    <li><a href="<?php echo get_category_link($item->term_id); ?>"><?php echo $item->name; ?> <span class="count">(<?php echo $item->count; ?>)</span></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <a href="#" class="block-link">Сравнить тренажер с импортными аналогами</a>

</article>