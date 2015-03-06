<?php

/**
 * Elgg blog: edit post action
 * 
 * @package ElggBlog
 */
// Make sure we're logged in (send us to the front page if not)
gatekeeper();

// Get input data
$guid = (int) get_input('guid');

$form = new KtJobForm;
if ($guid) {
    $form->setObject($guid);
}

//$tags = get_input('tags', array());
//$tags = string_to_tag_array($tags);
//$success = $form->save(TRUE, array('metadata' => array('tags' => $tags))); //Change how is saved a metadata.
//$success = $form->save(TRUE, array('guid' => $some_guid)); //Save with specific guid.
//$success = $form->save(TRUE, array('entity_options' => array('container_guid' => $container_guid))); //Change some entity options.
//$success = $form->save(TRUE, array('entity_options' => array('create_river' => FALSE))); //Do not create river.

$success = $form->save(TRUE);


if ($success) {
    $entity = get_entity($success);
    
    if (elgg_is_active_plugin('keetup_categories')) {
	$entity->job_category = 'yes';
    }

    if ($entity) {
        forward($entity->getUrl());
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