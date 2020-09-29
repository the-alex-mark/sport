<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php do_action('sport_page_before'); ?>

	<div class="content">
		<?php the_content(); ?>
	</div>

<?php do_action('sport_page_after'); ?>