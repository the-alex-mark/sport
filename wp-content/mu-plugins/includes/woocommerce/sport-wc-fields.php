<?php

if (!defined('ABSPATH'))
    exit;

$box    = [
	'id'       => 'product_additionally',
	'title'    => 'Дополнительно',
	'screen'   => 'product',
	'context'  => 'advanced',
	'priority' => 'default'
];

$fields = [
	[
		'label'   => 'Видео о товаре',
		'desc'    => 'Каждая ссылка на видео должна быть на новой строке',
		'id'      => 'product_additionally__videos',
		'type'    => 'textarea'
	]
];

$nonce  = [
	'action' => 'product_additionally',
	'name'   => 'product_additionally'
];

sport_add_meta_boxes($box, $nonce, $fields);