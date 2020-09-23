<?php

add_shortcode('helloworld', function ($attrs) {
    $params = shortcode_atts([
        'color' => 'red',
        'left'  => '0'
    ],
    $attrs);

    return "<p style='color:{$params['color']};padding-left:{$params['left']}'>Hello, World!!!</p>";
});