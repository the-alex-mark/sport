<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php do_action('page_content__before'); ?>

	<div class="content">
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>

<?php do_action('page_content__after'); ?>