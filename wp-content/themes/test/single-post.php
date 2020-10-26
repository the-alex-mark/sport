<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php get_header(); ?>

    <article class="content content-article">
        <h1 align="center"><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </article>

<?php get_footer(); ?>