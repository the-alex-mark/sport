<?php

if (!defined('ABSPATH'))
    exit;

?>
		
		<footer class="footer">
			<div class="container">
				<div class="footer-top">
					<span class="footer-text">Оставайся с нами на связи</span>

					<?php
						if (has_nav_menu('social')) {
							wp_nav_menu(
								array(
									'theme_location'  => 'social',
									'container_class' => 'footer-social social',
								)
							);
						}
					?>

				</div>
				<div class="footer-menu">
					<div class="footer-navigation"></div>
					<div class="footer-contacts"></div>
				</div>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>