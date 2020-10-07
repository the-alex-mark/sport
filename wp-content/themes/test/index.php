<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php get_header(); ?>

    <article class="content">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </article>

<?php get_footer(); ?>