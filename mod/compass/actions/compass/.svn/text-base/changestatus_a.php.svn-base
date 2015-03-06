<?php

/**
 * Change Status
 */

// Make sure we're logged in (send us to the front page if not)
gatekeeper();

// Get input data
$guid = (int) get_input('guid');
$origen = get_input('origen');
$received = get_input('received');

$entity = get_entity($guid);
if(!$entity || !elgg_instanceof($entity, 'object', 'lean_objective')) {
	register_error(elgg_echo('compass:changestatus:error'));
	forward(REFERER);
}

$container = $entity->getContainerEntity();
if (!$container->canWriteToContainer()) {
	register_error(elgg_echo('compass:changestatus:error'));
	forward(REFERER);
}

//if ($entity->status != $origen) {
//	register_error(elgg_echo('compass:changestatus:error'));
//	forward(REFERER);
//}

// Validate status
$status_options = Compass::getStatusOptions();
if (!array_key_exists($received, $status_options)) {
	register_error(elgg_echo('compass:changestatus:error'));
	forward(REFERER);
}

// Change status
$entity->compass_status = $received;

//system_message(elgg_echo('compass:changestatus:success'));
forward(REFERER);