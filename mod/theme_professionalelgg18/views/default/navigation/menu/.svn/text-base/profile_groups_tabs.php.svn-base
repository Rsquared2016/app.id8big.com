<?php

/*
 * Navigation menu profile groups tabs
 * 
 * @uses $vars['name']                 Name of the menu
 * @uses $vars['menu']                 Array of menu items
 * @uses $vars['class']                Additional CSS class for the menu
 * @uses $vars['item_class']           Additional CSS class for each menu item
 * @uses $vars['show_section_headers'] Do we show headers for each section?
 */

// we want css classes to use dashes
$vars['name'] = preg_replace('/[^a-z0-9\-]/i', '-', $vars['name']);
$headers = elgg_extract('show_section_headers', $vars, false);
$item_class = elgg_extract('item_class', $vars, '');

$class = "elgg-menu elgg-menu-{$vars['name']}";
if (isset($vars['class'])) {
	$class .= " {$vars['class']}";
}

// Menu
$tab_more = theme_get_profile_groups_show_more_tab();
$menu_items = $vars['menu']['default'];

$menu_tabs = array();
$menu_dropdown = array();

if (count($menu_items) <= $tab_more || empty($tab_more)) {
	$menu_tabs = $menu_items;
}
else {
	$count = 0;
	foreach($menu_items as $item) {
		if ($count < $tab_more) {
			$menu_tabs[] = $item;
		}
		else {
			$menu_dropdown[] = $item;
		}
		$count++;
	}
}

// Tab More
if (!empty($menu_dropdown)) {
	$menu_item_tab_more = '<div class="btn-group flRig btnTopCtrl">';
	$menu_item_tab_more .= '<button data-toggle="dropdown" class="btn dropdown-toggle">'.elgg_echo('theme:groups:tabs:button:more').'<span class="caret"></span></button>';
	$menu_item_tab_more .=	elgg_view('navigation/menu/elements/section', array(
		'items' => $menu_dropdown,
		'class' => "dropdown-menu",
	));
	$menu_item_tab_more .= '</div>';
	
	$item_more = new ElggMenuItem('more', $menu_item_tab_more, false);
	$item_more->setPriority(1000);
	$menu_tabs[] = $item_more;
}

echo elgg_view('navigation/menu/elements/section', array(
	'items' => $menu_tabs,
	'class' => "$class elgg-menu-{$vars['name']}-$section",
	'section' => $section,
	'name' => $vars['name'],
	'show_section_headers' => $headers,
	'item_class' => $item_class,
));