<?php

/**
 * Add or remove owner block link
 */
function multigroup_activity_owner_block_menu($hook, $type, $return, $params) {

	$entity = elgg_extract('entity', $params);
	if (!($entity instanceof ElggGroup)) {
		return $return;
	}
	
	$handler = $entity->getSubtype();
	

	if (empty($return) || !is_array($return)) {
		return $return;
	}

	$unset_groups = array(
		'activity',
		'discussion',
	);

	$unset_projects = array(
		'project_activity',
		'project_discussion',
	);
	
	$rename_projects = array(
		'blog' => elgg_echo('blog:project'),
		'file' => elgg_echo('file:project'),
	);

	foreach ($return as $key => $item) {

		$item_name = $item->getName();

		switch ($handler) {
			case 'project':
				if (in_array($item_name, $unset_groups)) {
					unset($return[$key]);
				}
				
				if (array_key_exists($item_name, $rename_projects)) {
					$item->setText($rename_projects[$item_name]);
					$return[$key] = $item;
				}
				
				
				break;

			default:
				if (in_array($item_name, $unset_projects)) {
					unset($return[$key]);
				}
				break;
		}
	}

	return $return;
}