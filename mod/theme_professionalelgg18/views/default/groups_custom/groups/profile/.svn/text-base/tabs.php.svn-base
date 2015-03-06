<?php

/**
 * Profile groups tabs
 */

$group = elgg_get_page_owner_entity();

if (!elgg_instanceof($group, 'group')) {
	return false;
}

// Get groups tool options
$group_tool_options = elgg_get_config('group_tool_options');

// Filter
$filter = get_input('filter', '');
if (empty($filter)) {
	if ($group->forum_enable == 'yes') {
		$filter = 'forum';
		set_input('filter', 'forum');
	}
	elseif ($group->activity_enable == 'yes') {
		$filter = 'activity';
		set_input('filter', 'activity');
	}
//	else {
//		if (!empty($group_tool_options) && is_array($group_tool_options)) {
//			foreach ($group_tool_options as $gto) {
//				$name = $gto->name;
//				$name_enable = $name . '_enable';
//				
//				if ($group->$name_enable == 'yes') {
//					$filter = $name;
//					set_input('filter', $name);
//					break;
//				}
//			}
//		}
//	}
}

// Get tabs
$tabs = array();
if (!empty($group_tool_options) && is_array($group_tool_options)) {
	$priority = 599;
	foreach ($group_tool_options as $gto) {
		$name = $gto->name;
		
		$name_enable = $name . '_enable';
		if ($group->$name_enable != 'yes') {
			continue;
		}
		
		switch ($name) {
			case 'activity':
				$priority = 500;
				break;
			case 'forum':
				$priority = 501;
				break;
			default:
				$priority++;
				if (empty($filter)) {
					$filter = $name;
					set_input('filter', $name);
				}
				break;
		}
		$tabs[$name] = array(
			'text' => elgg_echo('groups:tabs:'.$name),
			'href' => $group->getURL() . '?filter=' . $name,
			'selected' => ($filter == $name),
			'priority' => $priority,
		);
	}
}
foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	elgg_register_menu_item('profile_groups_tabs', $tab);
}
echo elgg_view_menu('profile_groups_tabs', array('sort_by' => 'priority', 'class' => 'elgg-menu-filter elgg-menu-hz'));

set_input('profile_groups_tabs', true);
//echo elgg_view("groups/tool_latest", $vars);
$views = elgg_get_config('views');
if ($views instanceof stdClass) {
	if (isset($views->extensions)) {
		$extensions = $views->extensions;
		if (array_key_exists('groups/tool_latest', $extensions)) {
			$groups_tool_latest = $extensions['groups/tool_latest'];
			if (is_array($groups_tool_latest)) {
				foreach($groups_tool_latest as $key => $value) {
					if ($value == 'groups/tool_latest') {
						unset($groups_tool_latest[$key]);
						break;
					}
				}
				$widget = '';
				foreach($groups_tool_latest as $gtl) {
					$a = explode('/', $gtl);
					if ($a[0] == $filter) {
						$widget = elgg_view($gtl, $vars);
						break;
					}
					elseif ($a[0] == 'groups' && $filter == 'activity') {
						$widget = elgg_view($gtl, $vars);
						break;
					}
					elseif ($a[0] == 'discussion' && $filter == 'forum') {
						$widget = elgg_view($gtl, $vars);
						break;
					}
				}
				if (!empty($widget)) {
					echo '<div class="elgg-widget-group-'.$filter.'">';
					echo $widget;
					echo '</div>';
				}
			}
		}
	}
}
set_input('profile_groups_tabs', false);