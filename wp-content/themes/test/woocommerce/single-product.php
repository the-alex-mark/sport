<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php get_header(); ?>

    <article class="content">
		
		<?php while (have_posts()): the_post(); ?>
			<?php wc_get_template_part('content', 'single-product'); ?>
		<?php endwhile; ?>

    </article>

<?php get_footer(); ?>