<?php

/*
 * This view should be extended to add buttons.
 */

// Get entity
$entity = elgg_extract('entity', $vars, null);
if (!elgg_instanceof($entity, '', '', 'Events')) {
	return false;
}

// Get logged in user
$user_logged_in = elgg_get_logged_in_user_guid();

$context = EventsBaseMain::ktform_get_subtype($vars);

$rating_support = EventsBaseMain::ktform_get_entity_rating_support($context);

// If the rating is supported into the profile.
if($rating_support['enabled'] && $rating_support['profile']) {
	echo elgg_view('events/behavior/rating', $vars);
}

if (!$entity->isCanceled()) {
	// Button Invite Event
	if ($entity->canEdit()) {
		$url_invite = $vars['url'] . 'events/invite/' . $entity->getGUID();
?>
		<a class="elgg-button elgg-button-action elgg-button-special elgg-button-assist" href="<?php echo $url_invite; ?>"><?php echo elgg_echo('events:button:invite'); ?></a>
<?php
	}
	
	// Button Assist, Maybe, No assit
	$url_assist = $vars['url'] . 'action/events/event/attend?entity_guid=' . $entity->getGUID() . '&attend=' . EVENTS_ATTEND_YES;
	$url_assist = elgg_add_action_tokens_to_url($url_assist);
	
	$url_maybe = $vars['url'] . 'action/events/event/attend?entity_guid=' . $entity->getGUID() . '&attend=' . EVENTS_ATTEND_MAYBE;
	$url_maybe = elgg_add_action_tokens_to_url($url_maybe);
	
	$url_no_assist = $vars['url'] . 'action/events/event/attend?entity_guid=' . $entity->getGUID() . '&attend=' . EVENTS_ATTEND_NO;
	$url_no_assist = elgg_add_action_tokens_to_url($url_no_assist);
	
	// Get user attend
	$user_attend = $entity->getUserAttend();
?>
	<a class="elgg-button elgg-button-submit <?php echo ($user_attend == EVENTS_ATTEND_YES) ? 'elgg-state-disabled' : ''; ?>" href="<?php echo ($user_attend == EVENTS_ATTEND_YES) ? 'javascript:return false;' : $url_assist; ?>"><?php echo elgg_echo('events:button:attend:' . EVENTS_ATTEND_YES); ?></a>
	<a class="elgg-button elgg-button-submit <?php echo ($user_attend == EVENTS_ATTEND_MAYBE) ? 'elgg-state-disabled' : ''; ?>" href="<?php echo ($user_attend == EVENTS_ATTEND_MAYBE) ? 'javascript:return false;' : $url_maybe; ?>"><?php echo elgg_echo('events:button:attend:' . EVENTS_ATTEND_MAYBE); ?></a>
	<a class="elgg-button elgg-button-submit <?php echo ($user_attend == EVENTS_ATTEND_NO) ? 'elgg-state-disabled' : ''; ?>" href="<?php echo ($user_attend == EVENTS_ATTEND_NO) ? 'javascript:return false;' : $url_no_assist; ?>"><?php echo elgg_echo('events:button:attend:' . EVENTS_ATTEND_NO); ?></a>
<?php
}