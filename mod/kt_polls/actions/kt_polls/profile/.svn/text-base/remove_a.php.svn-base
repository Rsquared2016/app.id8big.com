<?php

$guid = get_input('guid');
$entity = get_entity($guid);

if (!($entity instanceof Polls)) {
	register_error(elgg_echo('kt_polls:poll:action:remove:error'));
	forward(REFERER);
}

$entity->clearPollUserProfile();

system_message(elgg_echo('kt_polls:poll:action:remove:success'));
forward(REFERER);