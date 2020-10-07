<?php

if (!defined('ABSPATH'))
    exit;

global $organization;

$org_phone_1 = $organization->get_phones()[0];
$org_phone_2 = $organization->get_phones()[1];
$org_phone_3 = $organization->get_phones()[3];
$org_email   = $organization->get_email();

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
            <?php if ($org_phone_1 || $org_email || has_nav_menu('social')): ?>
                <div class="header-wrapper contacts">
                    <div class="container">
                        <div class="header-contacts">

                            <?php if ($org_phone_1): ?>
                                <div class="header-phone icon-phone">
                                    <a href="tel:+<?php echo preg_replace('/[^0-9]/', '', $org_phone_1); ?>" class="header-link"><?php echo $org_phone_1; ?></a>

                                    <?php if ($org_phone_2): ?>
                                        <span class="header-comma">,</span>
                                        <a href="tel:+<?php echo preg_replace('/[^0-9]/', '', $org_phone_2); ?>" class="header-link"><?php echo $org_phone_2; ?></a>
                                    <?php endif; ?>

                                    <?php if ($org_phone_3): ?>
                                        <span class="header-comma">,</span>
                                        <a href="tel:+<?php echo preg_replace('/[^0-9]/', '', $org_phone_3); ?>" class="header-link"><?php echo $org_phone_3; ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($org_email): ?>
                                <div class="header-email icon-email">
                                    <a href="mailto:<?php echo $org_email; ?>" class="header-link"><?php echo $org_email; ?></a>
                                </div>
                            <?php endif; ?>

                            <?php
                                wp_nav_menu([
                                        'theme_location'  => 'social',
                                        'container'       => 'div',
                                        'container_class' => 'header-social',
                                        'walker'          => new sport_walker_social
                                    ]
                                );

                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="header-options">
                <a href="#" class="option-logo">
                    <img src="assets/resources/logo_mobile.png" alt="" class="logo">
                </a>

                <ul>
                    <li class="option-menu icon-menu"><a href="">Меню</a></li>
                    <li class="option-search icon-search"><a href="">Поиск</a></li>
                </ul>
            </div>

            <div class="header-wrapper navigation">
                <div class="container">
                    <div class="header-navigation">

                        <a href="<?php echo site_url(); ?>" class="header-logo">
                            <img src="<?php echo sport_get_logo_url(); ?>" alt="<?php bloginfo('name'); ?>" class="logo">
                        </a>

                        <?php
                            wp_nav_menu([
                                'theme_location'  => 'primary',
                                'container'       => 'nav',
                                'container_class' => 'header-menu',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                            ]);
                        ?>

                        <div class="header-menu ml-auto">
                            <ul>
                                <li class="forum"><a href="#">Форум</a></li>
                                <li class="search"><a href="#"></a></li>
                                <li class="cart">
                                    <a href="#">
                                        <span class="cart-title">Корзина</span>
                                        <span class="cart-count">3</span>
                                    </a
                                ></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-wrapper search">
                <div class="container">
                    <form action="" method="get" class="header-search">
                        <input type="text" name="query" class="header-search_text" placeholder="Введите запрос ...">
                        <button type="submit" class="header-search_button icon-search"></button>
                    </form>
                </div>
            </div>
        </header>

        <?php /* Хлебные крошки */ ?>

        <?php if (!is_front_page()): ?>

            <main class="main-wrapper">
                <div class="container">
                    <div class="main">

        <?php endif; ?>