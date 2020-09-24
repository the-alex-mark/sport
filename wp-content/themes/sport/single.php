<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php get_header(); ?>

	<main class="container">
		<div class="content">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</main>

<?php get_footer(); ?>