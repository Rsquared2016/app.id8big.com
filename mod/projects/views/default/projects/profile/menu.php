<?php

/*
 * Project profile menu
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ProjectGroup)) {
	return true;
}

// Get groups tool options
//$group_tool_options = elgg_get_config('group_tool_options');

// Tabs excludes
//$tabs_excludes = array(
//	'project_activity',
//);

// Filter
//$filter = get_input('filter', 'project_name');

// Get tabs
//$tabs = array();
// Add menu item 'project_name'
//$name = 'project_name';
//$tabs[$name] = array(
//	'text' => elgg_get_excerpt($entity->name, 20),
//	'href' => $entity->getURL() . '?filter=' . $name,
//	'selected' => ($filter == $name),
//	'priority' => 500,
//);

//if (!empty($group_tool_options) && is_array($group_tool_options) && project_gatekeeper(false)) {
//	$priority_count = 699;
//	foreach ($group_tool_options as $gto) {
//		$name = $gto->name;
//		
//		if (in_array($name, $tabs_excludes)) {
//			continue;
//		}
//		
//		$name_enable = $name . '_enable';
//		if ($entity->$name_enable != 'yes') {
//			continue;
//		}
//		
//		switch ($name) {
//			case 'forum':
//				$priority = 600;
//				break;
//			default:
//				$priority_count++;
//				$priority = $priority_count;
//				if (empty($filter)) {
//					$filter = $name;
//					set_input('filter', $name);
//				}
//				break;
//		}
//		$tabs[$name] = array(
//			'text' => elgg_echo('groups:tabs:'.$name),
//			'href' => elgg_get_site_url(). 'projects/profilelist/' . $entity->getGUID() . '?filter=' . $name,
//			'selected' => ($filter == $name),
//			'priority' => $priority,
//		);
//	}
//}
//
//foreach ($tabs as $name => $tab) {
//	$tab['name'] = $name;
//
//	elgg_register_menu_item('project_profile_menu', $tab);
//}

echo elgg_view_menu('project_profile_menu', array('sort_by' => 'priority', 'class' => 'elgg-menu-filter elgg-menu-hz'));