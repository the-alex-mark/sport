<?php
/**
 * Template Name: Элементы
 */

if (!defined('ABSPATH'))
    exit;

// Проверяет страницу на защищённость паролем
if (post_password_required()) {
	echo get_the_password_form();
	return;
}

?>

<?php get_header(); ?>

    <article class="content">
    
        <!-- Заголовки -->
        <h1>Заголовок первого уровня</h1>
        <h2>Заголовок второго уровня</h2>
        <h3>Заголовок третьего уровня</h3>
        <h4>Заголовок четвёртого уровня</h4>

        <!-- Параграф -->
        <p class="indent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus natus magnam illo quo modi similique illum, saepe, molestias ipsum impedit reprehenderit odio enim necessitatibus, debitis alias nesciunt ducimus. Ratione maxime dicta veniam quod a amet ea, nostrum quam maiores consequuntur libero dolore repellendus? Illo, corrupti fugiat. Impedit nulla nihil aspernatur quae eveniet repellendus et quo sapiente aperiam molestiae, odit quidem ratione officia, totam quaerat, quas officiis architecto maxime deleniti nesciunt cum repudiandae a nostrum? Assumenda, voluptatibus ex? Quidem sed, saepe ut libero eum commodi dolorem quis, iure neque placeat distinctio eius nobis id quam temporibus ullam maxime, ab beatae! Quis.</p>
        <p class="indent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ratione, blanditiis voluptatum optio autem inventore corporis dolorem reprehenderit a! Explicabo possimus quos laborum iure veniam sit dolores, culpa ducimus qui optio, consequatur temporibus magni, expedita minima nesciunt in doloremque sunt beatae ipsa? Blanditiis nesciunt alias maxime culpa odit. Maxime, rem.</p>

    </article>

<?php get_footer(); ?>