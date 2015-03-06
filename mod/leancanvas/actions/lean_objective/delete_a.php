<?php

$guid = get_input('guid');

try {
	$success = leanCanvas::deleteObjective($guid);
} catch (Exception $exc) {
	register_error($exc->getMessage());
	forward(REFERER);
	die;
}

if ($success) {
	system_message(elgg_echo('leancanvas:objective:deleted:success'));
} else {
	register_error(elgg_echo('leancanvas:objective:deleted:error'));
}

forward(REFERER);