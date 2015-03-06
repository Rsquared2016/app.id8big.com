<?php

$owner = elgg_extract('owner', $vars);
$item = elgg_extract('item', $vars);

$river_class = '';
if ($item instanceof ElggRiverItem) {
//	$performed_by = get_entity($vars['item']->subject_guid);
	$poll = $item->getObjectEntity();
	$river_class = 'riverItemPoll';
	
} else {
	//Validate if is company.
	if(!($owner instanceof ElggUser)) {
		return false;
	}

	$options = array(
		'relationship' => KTPOLL_USER_PROFILE_SETTED,
		'relationship_guid' => $owner->getGUID(),
		'inverse_relationship' => TRUE,
		'limit' => 1,
	);

	//Get Company item.
	$poll = elgg_get_entities_from_relationship($options);
}

if($poll) {
	
	if (is_array($poll)) {
		$poll = current($poll);
	}
	
	if($poll instanceof Polls) {
		echo '<div class="pollWidgetWrapper '.$river_class.'">';
		echo '<div class="pollWidgetWrapperMsg">';
		echo '</div>';
		echo $poll->generatePollQuizView(array('poll_context' => 'company'));
		echo '</div>';
	}
} else {
	return;
}