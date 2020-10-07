<?php

if (!defined('ABSPATH'))
    exit;

global $organization;

$org_phone_1 = $organization->get_phones()[0];
$org_phone_2 = $organization->get_phones()[1];
$org_phone_3 = $organization->get_phones()[3];
$org_address = $organization->get_address();
$org_email   = $organization->get_email();

?>

        <?php if (!is_front_page()): ?>

                    </div>
                </div>
            </main>

        <?php endif; ?>

        <footer class="footer">
            <?php if (has_nav_menu('social')): ?>
                <div class="footer-wrapper top">
                    <div class="container">
                        <div class="footer-top">
                            <span class="social-title">Оставайся с нами на связи</span>
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

            <div class="footer-wrapper bottom">
                <div class="container">
                    <div class="footer-bottom">
                        <?php
                            wp_nav_menu([
                                'theme_location'  => 'primary',
                                'container'       => 'nav',
                                'container_class' => 'footer-menu',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 1
                            ]);

                            wp_reset_postdata();
                        ?>

                        <div class="footer-add-menu">
                            <ul id="menu-main" class="menu">
                                <li id="menu-item-38" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-38"><a href="http://sport/about">Пользовательское соглашение</a></li>
                            <ul>
                        </div>

                        <?php if ($org_phone_1 || $org_email || $org_address): ?>
                            <div class="footer-contacts">
                                <?php if ($org_address): ?>
                                    <div class="header-address icon-location">
                                        <span class="header-link"><?php echo $org_address; ?></span>
                                    </div>
                                <?php endif; ?>

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
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
	</body>
</html>