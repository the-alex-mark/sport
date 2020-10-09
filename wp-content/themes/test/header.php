<?php

if (!defined('ABSPATH'))
    exit;

global $organization;

$org_phones            = $organization->get_phones();
$org_email             = $organization->get_email();
$org_forum             = $organization->get_forum();

$wc_cart_url           = sport_wc_page_url('cart');

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

                            <?php if ($org_phones): ?>
                                <div class="header-phone icon-phone">
                                    <?php foreach ($org_phones as $i => $phone_formated): ?>
                                        
                                        <?php if ($i > 0): ?>
                                            <span class="header-comma">,</span>
                                        <?php endif; ?>
                                            
                                        <?php $phone = preg_replace('/[^0-9]/', '', $phone_formated); ?>
                                        <a href="tel:+<?php echo preg_replace('/[^0-9]/', '', $phone); ?>" class="header-link"><?php echo $phone_formated; ?></a>

                                    <?php endforeach; ?>
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
                                <?php if ($org_forum): ?>
                                    <li class="forum"><a href="<?php echo $org_forum; ?>" target="_blank">Форум</a></li>
                                <?php endif; ?>

                                <li class="search"><a href="#"></a></li>

                                <?php if ($wc_cart_url): ?>
                                    <li class="cart">
                                        <a href="<?php echo $wc_cart_url; ?>">
                                            <span class="cart-title">Корзина</span>
                                            <span class="cart-count">0</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
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
        
        <?php if (!is_front_page()): ?>
            <?php woocommerce_breadcrumb(); ?>

            <main class="main-wrapper">
                <div class="container">
                    <div class="main">

        <?php endif; ?>