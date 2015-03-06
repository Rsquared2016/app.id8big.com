<?php

/**
 * Widget Groups
 */

$max_cols = 5;
$num = 10;
$item_size = 25;

echo elgg_view('theme_widgets/generic', array(
	'module' => 'groups',
	'type' => 'group',
	'picture' => 'object',
	'max_length' => 60,
	'view_type' => 'gallery',
	'item_size' => $item_size,
	'max_cols' => $max_cols,
	'num' => $num,
	'url_view_all' => $vars['url'] . 'groups/all/',
	)
);
