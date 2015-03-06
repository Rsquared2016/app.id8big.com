<?php

if (elgg_in_context('members') == FALSE) {
	return FALSE;
}

$entity = elgg_extract('entity', $vars);

$menu = elgg_trigger_plugin_hook('register', "menu:user_hover", array('entity' => $entity), array());
$builder = new ElggMenuBuilder($menu);
$menu = $builder->getMenu();
$actions = elgg_extract('action', $menu, array());

$allowed_items = array(
	 'add_friend',
	 'remove_friend',
);


$profile_actions = '';
if (elgg_is_logged_in() && $actions) {
	foreach ($actions as $action) {
		$item_name = $action->getName();
		if (in_array($item_name, $allowed_items)) {
			$profile_actions .=  $action->getContent(array('class' => 'elgg-button list-members btn-mini'));
		}
	}
}

echo $profile_actions;