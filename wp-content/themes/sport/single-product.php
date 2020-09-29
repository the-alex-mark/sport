<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php do_action('sport_page_before'); ?>

	<div class="content">
		<?php while (have_posts()): the_post(); ?>
			<?php get_template_part(SPORT_TEMPLATES_PARTS . '/product', 'content'); ?>
		<?php endwhile; ?>
	</div>

<?php do_action('sport_page_after'); ?>