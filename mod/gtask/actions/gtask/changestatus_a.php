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
if (!($entity instanceof Gtask)) {
	register_error(elgg_echo('gtask:changestatus:error'));
	forward(REFERER);
}

$container = $entity->getContainerEntity();
if (!$container->canWriteToContainer()) {
	register_error(elgg_echo('gtask:changestatus:error'));
	forward(REFERER);
}

//if ($entity->status != $origen) {
//	register_error(elgg_echo('gtask:changestatus:error'));
//	forward(REFERER);
//}

// Validate status
$status_options = gtask_get_status_options();
if (!array_key_exists($received, $status_options)) {
	register_error(elgg_echo('gtask:changestatus:error'));
	forward(REFERER);
}

// Change status
$entity->status = $received;

//system_message(elgg_echo('gtask:changestatus:success'));
forward(REFERER);