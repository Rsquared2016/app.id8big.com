<?php

$guid = get_input('guid');
$entity = get_entity($guid);

if (!($entity instanceof Polls)) {
	register_error(elgg_echo('kt_polls:poll:action:add:error'));
	forward(REFERER);
}

$entity->addToUserProfile();

system_message(elgg_echo('kt_polls:poll:action:add:success'));
forward(REFERER);