<?php

if (!defined('ABSPATH'))
    exit;

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo('name'); ?></title>

		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="robots" content="index, nofollow">
		<meta name="keywords" content="">
		<meta name="description" content="">

		<?php wp_head(); ?>
	</head>
	<body>

		<header class="header">
			<div class="header-contacts_wrapper">
				<div class="container">
					<div class="header-contacts">
						<div class="header-phone icon-phone">
							<a href="tel:+74852429095" class="header-link">+7 (4852) 42-90-95</a>
							<span class="header-comma">,</span>
							<a href="tel:+79301118238" class="header-link">+7 (930) 111-82-38</a>
						</div>

						<div class="header-mail icon-mail">
							<a href="mailto:robot@stack-sport.ru" class="header-link">robot@stack-sport.ru</a>
						</div>

						<?php
							if (has_nav_menu('social')) {
								wp_nav_menu(
									array(
										'theme_location'  => 'social',
										'container_class' => 'header-social social',
									)
								);
							}

							wp_reset_postdata();
						?>

					</div>
				</div>
			</div>

			<div class="header-menu_wrapper">
				<div class="container">
					<div class="header-menu no-select">
						<a href="<?php echo site_url(); ?>" class="header-logo">
							<img src="<?php echo sport_get_logo_url(); ?>" alt="<?php bloginfo('name'); ?>" class="header-logo">
						</a>
		
						<nav class="header-navigation primary-navigation">
							<ul id="menu-main" class="menu">
						
								<?php
									wp_nav_menu([
										'theme_location'  => 'primary',
										'container'       => '',
										'items_wrap'      => '%3$s'
									]);
								?>

								<?php $forum_link = esc_html(get_option('org_info__forum')); ?>
								<?php if ($forum_link): ?>
		
									<li class="margin-left-auto text-transform-uppercase font-weight-600 menu-item-forum icon-forum menu-item">
										<a href="<?php echo $forum_link; ?>" target="_blank">Форум</a>
									</li>

								<?php endif; ?>
		
								<li class="menu-item-search icon-search menu-item">
									<a href="#">&#160;</a>
								</li>
		
								<li class="menu-item-cart icon-cart menu-item">
									<a href="<?php echo sport_wc_cart_url(); ?>">&#160;
										<span class="cart-count"><?php echo sport_wc_cart_count(); ?></span>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>

			<form action="#" method="get" onsubmit="return validate_search()" class="header-search">
				<div class="search-row">
					<input id="input-search" type="search" name="query" maxlength="128" placeholder="Введите запрос ..." class="input-search">
					<button id="button-search" type="submit" title="Поиск" class="button-search">
						<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172" style=" fill:#000000;">
							<g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
								<path d="M0,172v-172h172v172z" fill="none"></path>
								<g fill="#9A9A9A">
									<path d="M95.04232,106.54818l17.77669,17.77669c-2.7155,5.17904 -2.99544,10.33008 -0.13998,13.18555l32.44597,32.44597c4.08724,4.08724 12.98958,1.84765 19.82031,-5.01107c6.85872,-6.85872 9.09831,-15.73307 5.01107,-19.82031l-32.41797,-32.44597c-2.88346,-2.85547 -8.0345,-2.57552 -13.21354,0.11198l-17.77669,-17.74869zM60.91667,0c-33.64974,0 -60.91667,27.26693 -60.91667,60.91667c0,33.64974 27.26693,60.91667 60.91667,60.91667c33.64974,0 60.91667,-27.26692 60.91667,-60.91667c0,-33.64974 -27.26692,-60.91667 -60.91667,-60.91667zM60.91667,107.5c-25.72722,0 -46.58333,-20.85612 -46.58333,-46.58333c0,-25.72722 20.85612,-46.58333 46.58333,-46.58333c25.72722,0 46.58333,20.85612 46.58333,46.58333c0,25.72722 -20.85612,46.58333 -46.58333,46.58333z"></path>
								</g>
							</g>
						</svg>
					</button>
				</div>
			</form>
		</header>

		<?php
			if (!is_page([ 'cart', 'checkout' ]) && !is_404())
				sport_wc_breadcrumb();
		?>