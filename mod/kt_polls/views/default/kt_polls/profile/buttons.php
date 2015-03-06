<?php
/*This view should be extended to add buttons.*/
$entity = elgg_extract('entity', $vars);

//$context = elgg_get_context();
$context = PollsBaseMain::ktform_get_subtype($vars);

$rating_support = PollsBaseMain::ktform_get_entity_rating_support($context);

//If the rating is supported into the profile.
if($rating_support['enabled'] && $rating_support['profile']) {
	echo elgg_view('kt_polls/behavior/rating', $vars);
}

if (!($entity instanceof Polls)) {
	return FALSE;
}

echo $entity->generatePollQuizView(array('poll_context' => 'poll_profile'));