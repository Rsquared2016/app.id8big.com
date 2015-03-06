<?php
	$entity = $vars['entity'];
	
	$date_format = elgg_echo('help_ktform:output:format:date');
	
	$calendar_start = strftime($date_format, $entity->calendar_start);
	
	$calendar_end = '';
	if ($entity->calendar_end) {
		$calendar_end = strftime($date_format, $entity->calendar_end);
	}
	
	echo sprintf(elgg_echo('help_ktform:output:date_range'), $calendar_start, $calendar_end);