<?php
/**
 * Template Name: Список статьей
 */

if (!defined('ABSPATH'))
    exit;

?>


<?php get_header(); ?>

	<main class="container">
		<div class="content">
            <?php the_content(); ?>
            
            <ul>
                <?php $articles = get_posts([ 'category' => 'articles' ]); ?>
                <?php foreach($articles as $item): setup_postdata($item); ?>
                    
                <?php /* dd($item); */ ?>
                    <li><a href="<?php echo get_permalink($item->ID); ?>"><?php echo $item->post_title; ?></a></li>

                <?php endforeach; wp_reset_postdata(); ?>
            </ul>
		</div>
	</main>

<?php get_footer(); ?>