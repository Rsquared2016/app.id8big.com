<?php 
/**
 * Group entity view
 * 
 * @package ElggGroups
 */

$group = $vars['entity'];

$icon = elgg_view_entity_icon($group, 'tiny');

$metadata = elgg_view_menu('entity', array(
	'entity' => $group,
	'handler' => 'groups',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	$metadata = '';
}


if ($vars['full_view']) {
	echo elgg_view('groups/profile/summary', $vars);
} else {
	// brief view
    $brief_description = $group->briefdescription;
    if (elgg_in_context('widgets')) {
        $brief_description = elgg_get_excerpt($group->briefdescription, 100);
    }
	$params = array(
		'entity' => $group,
		'metadata' => $metadata,
		'subtitle' => $brief_description,
	);
	$params = $params + $vars;
	$list_body = elgg_view('group/elements/summary', $params);

	echo elgg_view_image_block($icon, $list_body, $vars);
}
