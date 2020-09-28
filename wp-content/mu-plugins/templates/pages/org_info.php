<?php
    if ($_POST['org_info__name'])
        update_option('org_info__name', stripslashes($_POST['org_info__name']));

    if ($_POST['org_info__desc'])
        update_option('org_info__desc', stripslashes($_POST['org_info__desc']));
?>

<div class="sport-plugin">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">Информация об организации</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <form action="?page=<?php echo basename(__FILE__, '.php'); ?>" method="post" class="form-org">
                    <div class="container">
                        <div class="row">
                            <div class="col-3"><span class="row-title">Название организации:</span></div>
                            <div class="col-9">
                                <input type="text" name="org_info__name" value="<?php echo esc_html(get_option('org_info__name')); ?>" class="row-input row-input_text">
                                <span class='description'>Ярлык: <strong>org_info__name</strong></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3"><span class="row-title">Описание:</span></div>
                            <div class="col-9">
                                <textarea name="org_info__desc" rows="4" class="row-input row-textarea"><?php echo esc_html(get_option('org_info__desc')); ?></textarea>
                                <span class='description'>Ярлык: <strong>org_info__desc</strong></span>
                            </div>
                        </div>

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