<?php

/**
 * Project profile list
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ProjectGroup)) {
	return true;
}

$filter = elgg_extract('filter', $vars, false);

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
					elseif ($a[0] == 'project_discussion' && $filter == 'forum') {
						$widget = elgg_view($gtl, $vars);
						break;
					}
					elseif ($a[0] == 'projects' && $a[2] == 'project_activity_module' && $filter == 'project_activity') {
						$widget = elgg_view($gtl, $vars);
						break;
					}
					elseif ($a[0] == 'projects' && $a[2] == 'project_thewire_module' && ($filter == 'thewire' || $filter == 'project_thewire')) {
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