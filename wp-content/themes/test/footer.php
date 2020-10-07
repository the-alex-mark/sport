<?php

if (!defined('ABSPATH'))
    exit;

global $organization;

$org_phones            = $organization->get_phones();
$org_address           = $organization->get_address();
$org_email             = $organization->get_email();
$org_forum             = $organization->get_forum();

$wc_privacy_policy_url = sport_wc_page_url('privacy_policy');

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

                        <?php if ($wc_privacy_policy_url): ?>
                            <div class="footer-add-menu">
                                <ul id="menu-main" class="menu">
                                    <li><a href="<?php echo $wc_privacy_policy_url; ?>" target="_blank">Пользовательское соглашение</a></li>
                                <ul>
                            </div>
                        <?php endif; ?>

                        <?php if ($org_phones || $org_email || $org_address): ?>
                            <div class="footer-contacts">
                                <?php if ($org_address): ?>
                                    <div class="header-address icon-location">
                                        <span class="header-link"><?php echo $org_address; ?></span>
                                    </div>
                                <?php endif; ?>

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
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
	</body>
</html>