<?php

if (!defined('ABSPATH'))
    exit;

?>

<?php do_action('sport_page_before'); ?>

	<div class="content error-404">
		<center>
			<img src="<?php assets('resources/404-robot.jpg'); ?>" alt="">
	
			<h1>Oops! ... (I Did It Again)</h1>
			<p>
				<strong>Ошибка 404: страница не найдена.</strong>
				<br>Данная страница недоступна, возможно вы ошиблись при вводе URL.
				<br>Вы можете посетить нашу главную страницу.
			</p>
		</center>
	</div>

<?php do_action('sport_page_after'); ?>