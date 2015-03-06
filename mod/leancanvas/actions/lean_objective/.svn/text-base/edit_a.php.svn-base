<?php

/**
 * Edit objective
 */

$is_xhr = elgg_is_xhr();

$lean_objective = get_input('lean_objective', array());

try {
	$success = leanCanvas::createObjective($lean_objective);
} catch (Exception $exc) {
	register_error($exc->getMessage());
	forward(REFERER);
	die;
}

if ($success) {
	if ($is_xhr) {
		$entity = get_entity($success);
		if ($entity instanceof leanObjective) {
			echo elgg_view('lean_objective/list_item', array('entity' => $entity));
		}
	}
	
	system_message(elgg_echo('leancanvas:objective:created:success'));
} else {
	register_error(elgg_echo('leancanvas:objective:created:error'));
}

forward(REFERER);