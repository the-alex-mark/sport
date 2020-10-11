<?php

function sport_add_meta_boxes($box, $nonce, $fields) {

    add_action('add_meta_boxes', function () {
        global $box, $nonce, $fields;

        add_meta_box(
            $box['id'],
            $box['title'],
            'callback',
            $box['screen'],
            $box['context'],
            $box['priority'],
            null
        );
    });

    function callback($post, $meta) {
        global $nonce, $fields;

        wp_nonce_field($nonce['action'], $nonce['name']);
        
        echo '<style>';
        echo '.meta_box-row:not(:last-child) { margin-bottom: 15px; }';
        echo '.meta_box-row label { display: inline-block; margin-bottom: 3px; font-weight: 600; }';
        echo '.meta_box-row input[type="text"] { margin: 0; }';
        echo '.meta_box-row textarea { display: block; padding: 4px 8px; min-height: 30px; }';
        echo '.meta_box-row .description { display: inline-block; margin: 0 10px; }';
        echo '</style>';

        foreach ($fields as $field) {
            $value = get_post_meta($post->ID, $field['id'], true);

            echo '<div class="meta_box-row">';
            switch ($field['type']) {
                
                case 'text':
                    echo '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
                    echo '<input id="' . $field['id'] . '" type="text" name="' . $field['id'] . '" value="' . $value . '" style="width: 100%;">';
                break;
                
                case 'textarea':
                    echo '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
                    echo '<textarea id="' . $field['id'] . '" name="' . $field['id'] . '" rows="3" style="width: 100%;">' . $value . '</textarea>';
                break;
                
                case 'checkbox':
                    echo '<label style="font-weight: normal;">';
                    echo '<input type="checkbox" id="' . $field['id']  . '" name="' . $field['id'].'" ' . ($value ? ' checked="checked"' : '') . '>';
                    echo $field['label'];
                    echo '<label>';
                break;
                
                case 'select':
                    echo '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
                    echo '<select id="' . $field['id'] . '" name="' . $field['id'] . '" style="width: 100%;">';

                    foreach ($field['options'] as $option_key => $option_value) {
                        echo '<option value="' . $option_key . '" ' . (($value == $option_key) ? ' selected="selected"' : '') . '>' . $option_value . '</option>';
                    }

                    echo '</select>';
                    break;
            }

            if ($field['desc'])
                echo '<span class="description">' . $field['desc'] . '</span>';

            echo '</div>';
        }
    }

    add_action('save_post', function ($post_id) {
        global $box, $nonce, $fields;

        if (!wp_verify_nonce($_POST[$nonce['action']], $nonce['name']))
            return $post_id;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;

        if ($box['screen'] == $_POST['post_type'])
            if (!current_user_can('edit_page', $post_id))
                return $post_id;

        elseif (!current_user_can('edit_post', $post_id))
                return $post_id;

        foreach ($fields as $field) {

            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];

            if ($new && $new != $old)
                update_post_meta($post_id, $field['id'], $new);

            elseif ($old && $new == '')
                delete_post_meta($post_id, $field['id'], $old);
        }
    });
}