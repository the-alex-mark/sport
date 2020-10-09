<?php

if (!defined('ABSPATH'))
    exit;

// Добавление поля для пользовательского кода CSS
add_action('admin_menu', 'custom_css_hooks');
function custom_css_hooks() {
    add_meta_box('custom_css', __('Пользовательский CSS', 'sport'), 'custom_css_input', 'post', 'normal', 'high');
    add_meta_box('custom_css', __('Пользовательский CSS', 'sport'), 'custom_css_input', 'page', 'normal', 'high');
}

function custom_css_input() {
    global $post;
    echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="' . wp_create_nonce('custom-css') . '" />';
    echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">' . get_post_meta($post->ID,'_custom_css', true) . '</textarea>';
}

// Сохранение полей
add_action('save_post', 'save_custom_css');
function save_custom_css($post_id) {
    if (!wp_verify_nonce($_POST['custom_css_noncename'], 'custom-css'))
        return $post_id;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    $custom_css = $_POST['custom_css'];
    update_post_meta($post_id, '_custom_css', $custom_css);
}

// Вставка поля
add_action('wp_head', 'insert_custom_css');
function insert_custom_css() {
    if (is_page() || is_single()) {

        if (have_posts()) {
            while (have_posts()) {
                the_post();
                echo '<style type="text/css">' . get_post_meta(get_the_ID(), '_custom_css', true) . '</style>';
            }
        }

        rewind_posts();
    }
}

// Замена элемента "textarea" на текстовый редактор "CodeMirror"
add_action('admin_enqueue_scripts', function() {
    $settings = wp_enqueue_code_editor([ 'type' => 'text/css' ]);

	if ($settings === false)
		return;

	wp_add_inline_script( 
		'code-editor',
		sprintf('jQuery( function() { wp.codeEditor.initialize("custom_css", %s); } );', wp_json_encode($settings))
	);
});