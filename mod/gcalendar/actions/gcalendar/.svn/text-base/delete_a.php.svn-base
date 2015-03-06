<?php

/**
 * GCalendar Delete
 */

$guid = get_input('guid');
$gcalendar = get_entity($guid);

if (elgg_instanceof($gcalendar, 'object', 'gcalendar') && $gcalendar->canEdit()) {
	if ($gcalendar->delete()) {
		system_message(elgg_echo('gcalendar:delete:success'));
		forward(REFERER);
	}
}

register_error(elgg_echo('gcalendar:delete:error'));

forward(REFERER);