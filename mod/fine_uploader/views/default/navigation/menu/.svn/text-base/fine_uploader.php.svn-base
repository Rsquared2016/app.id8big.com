<?php
/**
 * Fine_uploader tabs
 *
 * @uses $vars['menu']['default']
 */

$tabs = array();
foreach ($vars['menu']['default'] as $menu_item) {
	$tabs[] = array(
		'title' => $menu_item->getText(),
		'url' => 'fine_uploader/tab/' . $menu_item->getName(),
		'link_class' => 'fine_uploader-section',
		'selected' => $menu_item->getSelected(),
	);
}

echo elgg_view('navigation/tabs', array('tabs' => $tabs));
