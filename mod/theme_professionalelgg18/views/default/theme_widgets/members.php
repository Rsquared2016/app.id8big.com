<?php

/**
 * Widget Members
 */

$max_cols = 5;
$num = 10;
$item_size = 25;

echo elgg_view('theme_widgets/generic', array(
	'title' => $title,
	'module' => 'profile',
	'type' => 'user',
	//'subtype' => NULL,
	'view_type' => 'gallery',
	'item_size' => $item_size,
	'max_cols' => $max_cols,
	'num' => $num,
	'url_view_all' => $vars['url'] . 'members/',
	)
);

?>
