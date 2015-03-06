<?php

/**
 * Elgg blog: edit post action
 * 
 * @package ElggBlog
 */
// Make sure we're logged in (send us to the front page if not)
//barchaeology_gatekeeper();
// Get input data
$guid = (int) get_input('guid');
$container_guid = PollsBaseMain::ktform_get_container_guid();

if ($container_guid == elgg_get_logged_in_user_guid()) {
	$container_guid = FALSE;
}

set_input('polls_quiz_action', TRUE);

$form = new PollsForm;
if ($guid) {
	$form->setObject($guid);
}

//$tags = get_input('tags', array());
//$tags = string_to_tag_array($tags);

//$success = $form->save(TRUE, array('metadata' => array('tags' => $tags)));

// Si se habilita current_profile poner create_river a FALSE
$override_data = array('entity_options' => array('create_river' => TRUE));
$poll_context = get_input('poll_context', 'poll_profile');


//if ($poll_context == 'test_profile') {
//	$override_data['entity_options']['create_river'] = FALSE;
//}

if ($poll_context == 'poll_profile') {
	$questions_values_str = get_input('question_options', '');

	if (!empty($questions_values_str)) {
		$questions_values = explode(PHP_EOL, $questions_values_str);
		if (count($questions_values) > KTPOLL_MAX_OPTIONS_FOR_POLL) {
			register_error(elgg_echo('kt_polls:error:max_options_for_poll'));
			forward(REFERER);
		}

	}
}

$success = $form->save(TRUE, $override_data );

//$success = $form->save(TRUE, array('guid' => $some_guid));

if ($success) {
	$entity = get_entity($success);

	if ($entity) {
		
		$add_to_profile = get_input('add_to_profile', FALSE);
		
		if (!empty($add_to_profile)) {
			$entity->addToUserProfile();
		} else {
			$entity->removeRelationship($entity->getOwner(), KTPOLL_USER_PROFILE_SETTED);
		}
		
		
		if ($container_guid) {
			$container_entity = get_entity($container_guid);
			
			if ($container_entity instanceof ElggGroup) {
				forward('kt_polls/group/'.$container_entity->getGUID().'/'.elgg_get_friendly_title($container_entity->name));
			}
			forward($container_entity->getURL());
		} else {
			forward(get_config('url').'pg/kt_polls/owner/'.$entity->getOwnerEntity()->username);
		}
		die;
	}
}

/**
 * 	$errors = $form->getErrors();

  foreach($errors as $error) {

  register_error($error);

  }
 */
forward(REFERER);