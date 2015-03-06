<?php

$performed_by = get_entity($vars['item']->subject_guid); // $statement->getSubject();
$object = get_entity($vars['item']->object_guid);

$contents = elgg_view('kt_polls/poll/wrapper', array('item' => $vars['item']));


echo elgg_view('river/elements/layout', array(
	 'item' => $vars['item'],
//	 'summary' => $string,
	'attachments' => $contents,
));