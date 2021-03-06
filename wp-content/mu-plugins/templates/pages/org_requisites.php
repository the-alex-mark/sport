<?php
    if ($_POST) {
        update_option('org_requisites__inn',   stripslashes($_POST['org_requisites__inn']));
        update_option('org_requisites__okopf', stripslashes($_POST['org_requisites__okopf']));
        update_option('org_requisites__kpp',   stripslashes($_POST['org_requisites__kpp']));
        update_option('org_requisites__okfs',  stripslashes($_POST['org_requisites__okfs']));
        update_option('org_requisites__okpo',  stripslashes($_POST['org_requisites__okpo']));
        update_option('org_requisites__okdp',  stripslashes($_POST['org_requisites__okdp']));
        update_option('org_requisites__ogrn',  stripslashes($_POST['org_requisites__ogrn']));
        update_option('org_requisites__okato', stripslashes($_POST['org_requisites__okato']));
        update_option('org_requisites__okved', stripslashes($_POST['org_requisites__okved']));
        update_option('org_requisites__rs',    stripslashes($_POST['org_requisites__rs']));
        update_option('org_requisites__bank',  stripslashes($_POST['org_requisites__bank']));
    }
?>

<div class="sport-plugin">
    
    <?php
        if ($_POST && $_POST['message'] == 'true')
            require SPORT_PLUGIN_TEMPLATES_PARTS . '/message.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title"><?php _e('Реквизиты', 'sport'); ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <form action="?page=<?php echo basename(__FILE__, '.php'); ?>" method="post" class="form-org">
                    <div class="container">
                        <div class="row">
                            <div class="col-1"><span class="row-title"><?php _e('ИНН', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__inn" value="<?php echo esc_html(get_option('org_requisites__inn')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__inn</strong></span>
                            </div>

                            <div class="col-1"><span class="row-title"><?php _e('ОКОПФ', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__okopf" value="<?php echo esc_html(get_option('org_requisites__okopf')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__okopf</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1"><span class="row-title"><?php _e('КПП', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__kpp" value="<?php echo esc_html(get_option('org_requisites__kpp')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__kpp</strong></span>
                            </div>

                            <div class="col-1"><span class="row-title"><?php _e('ОКФС', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__okfs" value="<?php echo esc_html(get_option('org_requisites__okfs')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__okfs</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1"><span class="row-title"><?php _e('ОКПО', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__okpo" value="<?php echo esc_html(get_option('org_requisites__okpo')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__okpo</strong></span>
                            </div>

                            <div class="col-1"><span class="row-title"><?php _e('ОКДП', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__okdp" value="<?php echo esc_html(get_option('org_requisites__okdp')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__okdp</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1"><span class="row-title"><?php _e('ОГРН', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__ogrn" value="<?php echo esc_html(get_option('org_requisites__ogrn')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__ogrn</strong></span>
                            </div>

                            <div class="col-1"><span class="row-title"><?php _e('ОКАТО', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__okato" value="<?php echo esc_html(get_option('org_requisites__okato')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__okato</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1"><span class="row-title"><?php _e('ОКВЭД', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__okved" value="<?php echo esc_html(get_option('org_requisites__okved')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__okved</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1"><span class="row-title"><?php _e('Р/с', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__rs" value="<?php echo esc_html(get_option('org_requisites__rs')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__rs</strong></span>
                            </div>

                            <div class="col-1"><span class="row-title"><?php _e('Банк', 'sport'); ?>:</span></div>
                            <div class="col-5">
                                <input type="text" name="org_requisites__bank" value="<?php echo esc_html(get_option('org_requisites__bank')); ?>" class="row-input row-input_text">
                                <span class='description'><?php _e('Ярлык', 'sport'); ?>: <strong>org_requisites__bank</strong></span>
                            </div>
                        </div>

                        <hr>
                        <input type="hidden" name="message" value="true">
                        
                        <div class="row">
                            <div class="col-3 margin-left-auto">
                                <p class="submit">
                                    <input type="submit" class="button-primary" value="<?php _e('Сохранить изменения', 'sport'); ?>">
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>