<?php
    if ($_POST) {
        update_option('org_time', $_POST);
    }

    $time = get_option('org_time');
?>

<div class="sport-plugin">

    <?php
        if ($_POST && $_POST['message'] == 'true')
            require SPORT_PLUGIN_TEMPLATES_PARTS . '/message.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">Режим работы</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <form action="?page=<?php echo basename(__FILE__, '.php'); ?>" method="post" class="form-org">
                    <div class="container">

                        <h2 class="block-title">Будни</h2>
                        <div class="row">
                            <div class="col-1"><span class="row-title">С:</span></div>
                            <div class="col-5">
                                <div class="form-row">
                                    <div class="form-input ta-center">
                                        <input type="text" name="weekday[from][h]" value="<?php echo $time['weekday']['from']['h']; ?>" class="row-input row-input_text" placeholder="<?php echo '09'; ?>">
                                        <span class='description'><strong>org_time['weekday']['from']['h']</strong></span>
                                    </div>

                                    <span class="input-separator">:</span>

                                    <div class="form-input ta-center">
                                        <input type="text" name="weekday[from][m]" value="<?php echo esc_html($time['weekday']['from']['m']); ?>" class="row-input row-input_text" placeholder="<?php echo '00'; ?>">
                                        <span class='description'><strong>org_time['weekday']['from']['m']</strong></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1"><span class="row-title">До:</span></div>
                            <div class="col-5">
                                <div class="form-row">
                                    <div class="form-input ta-center">
                                        <input type="text" name="weekday[to][h]" value="<?php echo esc_html($time['weekday']['to']['h']); ?>" class="row-input row-input_text" placeholder="<?php echo '18'; ?>">
                                        <span class='description'><strong>org_time['weekday']['to']['h']</strong></span>
                                    </div>

                                    <span class="input-separator">:</span>

                                    <div class="form-input ta-center">
                                        <input type="text" name="weekday[to][m]" value="<?php echo esc_html($time['weekday']['to']['m']); ?>" class="row-input row-input_text" placeholder="<?php echo '00'; ?>">
                                        <span class='description'><strong>org_time['weekend']['to']['m']</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <h2 class="block-title">Выходные</h2>
                        <div class="row">
                            <div class="col-1"><span class="row-title">С:</span></div>
                            <div class="col-5">
                                <div class="form-row">
                                    <div class="form-input ta-center">
                                        <input type="text" name="weekend[from][h]" value="<?php echo esc_html($time['weekend']['from']['h']); ?>" class="row-input row-input_text" placeholder="<?php echo '09'; ?>">
                                        <span class='description'><strong>org_time['weekend']['from']['h']</strong></span>
                                    </div>

                                    <span class="input-separator">:</span>

                                    <div class="form-input ta-center">
                                        <input type="text" name="weekend[from][m]" value="<?php echo esc_html($time['weekend']['from']['m']); ?>" class="row-input row-input_text" placeholder="<?php echo '00'; ?>">
                                        <span class='description'><strong>org_time['weekend']['from']['m']</strong></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1"><span class="row-title">До:</span></div>
                            <div class="col-5">
                                <div class="form-row">
                                    <div class="form-input ta-center">
                                        <input type="text" name="weekend[to][h]" value="<?php echo esc_html($time['weekend']['to']['h']); ?>" class="row-input row-input_text" placeholder="<?php echo '17'; ?>">
                                        <span class='description'><strong>org_time['weekend']['to']['h']</strong></span>
                                    </div>

                                    <span class="input-separator">:</span>

                                    <div class="form-input ta-center">
                                        <input type="text" name="weekend[to][m]" value="<?php echo esc_html($time['weekend']['to']['m']); ?>" class="row-input row-input_text" placeholder="<?php echo '00'; ?>">
                                        <span class='description'><strong>org_time['weekend']['to']['m']</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2 class="block-title">Обед</h2>
                        <div class="row">
                            <div class="col-1"><span class="row-title">С:</span></div>
                            <div class="col-5">
                                <div class="form-row">
                                    <div class="form-input ta-center">
                                        <input type="text" name="dinner[from][h]" value="<?php echo esc_html($time['dinner']['from']['h']); ?>" class="row-input row-input_text" placeholder="<?php echo '13'; ?>">
                                        <span class='description'><strong>org_time['dinner']['from']['h']</strong></span>
                                    </div>

                                    <span class="input-separator">:</span>

                                    <div class="form-input ta-center">
                                        <input type="text" name="dinner[from][m]" value="<?php echo esc_html($time['dinner']['from']['m']); ?>" class="row-input row-input_text" placeholder="<?php echo '00'; ?>">
                                        <span class='description'><strong>org_time['dinner']['from']['m']</strong></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1"><span class="row-title">До:</span></div>
                            <div class="col-5">
                                <div class="form-row">
                                    <div class="form-input ta-center">
                                        <input type="text" name="dinner[to][h]" value="<?php echo esc_html($time['dinner']['to']['h']); ?>" class="row-input row-input_text" placeholder="<?php echo '14'; ?>">
                                        <span class='description'><strong>org_time['dinner']['to']['h']</strong></span>
                                    </div>

                                    <span class="input-separator">:</span>

                                    <div class="form-input ta-center">
                                        <input type="text" name="dinner[to][m]" value="<?php echo esc_html($time['dinner']['to']['m']); ?>" class="row-input row-input_text" placeholder="<?php echo '00'; ?>">
                                        <span class='description'><strong>org_time['dinner']['to']['m']</strong></span>
                                    </div>
                                </div>
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