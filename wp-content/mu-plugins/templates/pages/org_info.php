<?php
    if ($_POST['org_info__name'])
        update_option('org_info__name', stripslashes($_POST['org_info__name']));

    if ($_POST['org_info__desc'])
        update_option('org_info__desc', stripslashes($_POST['org_info__desc']));

    if ($_POST['org_info__phone1'])
        update_option('org_info__phone1', stripslashes($_POST['org_info__phone1']));

    if ($_POST['org_info__phone2'])
        update_option('org_info__phone2', stripslashes($_POST['org_info__phone2']));

    if ($_POST['org_info__phone3'])
        update_option('org_info__phone3', stripslashes($_POST['org_info__phone3']));

    if ($_POST['org_info__address'])
        update_option('org_info__address', stripslashes($_POST['org_info__address']));

    if ($_POST['org_info__email'])
        update_option('org_info__email', stripslashes($_POST['org_info__email']));

    if ($_POST['org_info__skype'])
        update_option('org_info__skype', stripslashes($_POST['org_info__skype']));

    if ($_POST['org_info__forum'])
        update_option('org_info__forum', stripslashes($_POST['org_info__forum']));
?>

<div class="sport-plugin">

    <?php
        if ($_POST['message'] == 'true')
            require SPORT_PLUGIN_TEMPLATES_PARTS . '/message.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">Основная информация</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <form action="?page=<?php echo basename(__FILE__, '.php'); ?>" method="post" class="form-org">
                    <div class="container">
                        <div class="row">
                            <div class="col-3"><span class="row-title">Наименование организации:</span></div>
                            <div class="col-9">
                                <input type="text" name="org_info__name" value="<?php echo esc_html(get_option('org_info__name')); ?>" class="row-input row-input_text" placeholder="<?php bloginfo('name'); ?>">
                                <span class='description'>Ярлык: <strong>org_info__name</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3"><span class="row-title">Описание:</span></div>
                            <div class="col-9">
                                <textarea name="org_info__desc" rows="3" class="row-input row-textarea" placeholder="<?php bloginfo('description'); ?>"><?php echo esc_html(get_option('org_info__desc')); ?></textarea>
                                <span class='description'>Ярлык: <strong>org_info__desc</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3"><span class="row-title">Номера телефонов:</span></div>
                            <div class="col-3">
                                <input type="text" name="org_info__phone1" value="<?php echo esc_html(get_option('org_info__phone1')); ?>" class="row-input row-input_text" placeholder="+7 (800) 000-00-00">
                                <span class='description'>Ярлык: <strong>org_info__phone1</strong></span>
                            </div>
                            <div class="col-3">
                                <input type="text" name="org_info__phone2" value="<?php echo esc_html(get_option('org_info__phone2')); ?>" class="row-input row-input_text" placeholder="+7 (800) 000-00-00">
                                <span class='description'>Ярлык: <strong>org_info__phone2</strong></span>
                            </div>
                            <div class="col-3">
                                <input type="text" name="org_info__phone3" value="<?php echo esc_html(get_option('org_info__phone3')); ?>" class="row-input row-input_text" placeholder="+7 (800) 000-00-00">
                                <span class='description'>Ярлык: <strong>org_info__phone3</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3"><span class="row-title">Адрес:</span></div>
                            <div class="col-9">
                                <textarea name="org_info__address" rows="3" class="row-input row-textarea"><?php echo esc_html(get_option('org_info__address')); ?></textarea>
                                <span class='description'>Ярлык: <strong>org_info__address</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3"><span class="row-title">Электронная почта:</span></div>
                            <div class="col-9">
                                <input type="text" name="org_info__email" value="<?php echo esc_html(get_option('org_info__email')); ?>" class="row-input row-input_text">
                                <span class='description'>Ярлык: <strong>org_info__email</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3"><span class="row-title">Skype:</span></div>
                            <div class="col-9">
                                <input type="text" name="org_info__skype" value="<?php echo esc_html(get_option('org_info__skype')); ?>" class="row-input row-input_text">
                                <span class='description'>Ярлык: <strong>org_info__skype</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3"><span class="row-title">Ссылка на форум:</span></div>
                            <div class="col-9">
                                <input type="text" name="org_info__forum" value="<?php echo esc_html(get_option('org_info__forum')); ?>" class="row-input row-input_link">
                                <span class='description'>Ярлык: <strong>org_info__forum</strong></span>
                            </div>
                        </div>

                        <hr>
                        <input type="hidden" name="message" value="true">

                        <div class="row row-submit">
                            <div class="col-3 margin-left-auto">
                                <p class="submit">
                                    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>