<?php

if (!defined('ABSPATH'))
	exit;

?>

<div class="staff-grid grid">
    <?php $staff = get_posts([ 'post_type' => 'staff', 'order' => 'ASC' ]); ?>
    <?php foreach ($staff as $item): setup_postdata($item); ?>

        <div class="grid-item">
            <div class="staff-card">
                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($item->ID)); ?>" alt="" class="staff-image">
                <div class="staff-info">
                    <h3 class="staff-name"><?php echo $item->post_title; ?></h3>
                    <span class="staff-position"><?php echo get_the_terms($item->ID, 'position')[0]->name; ?></span>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>