<?php
/**
 * Template Name: Ответы на вопросы
 * Template Post Type: faq
 */

if (!defined('ABSPATH'))
    exit;

?>

<?php get_header(); ?>

    <article class="content">
        <?php the_content(); ?>

        <?php
            $themes = get_terms([ 'taxonomy' => 'themes', ]);
            // print_o($themes);

            foreach ($themes as $_theme) {
                echo $_theme->name . '<br>';

                $faq = get_posts([
                    'post_type' => 'faq',
                    'tax_query' => [[
                        'taxonomy' => 'themes',
                        'field'    => 'slug',
                        'terms'    => $_theme->slug
                    ]]
                ]);

                foreach ($faq as $item) {
                    setup_postdata($item);

                    echo $item->post_title . '<br>';
                }

                echo '<br>';
            }
        ?>
    </article>

<?php get_footer(); ?>