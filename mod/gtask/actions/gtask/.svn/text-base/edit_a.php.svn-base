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

$form = new GtaskForm;
if ($guid) {
	$form->setObject($guid);
}

//$tags = get_input('tags', array());
//$tags = string_to_tag_array($tags);
//$success = $form->save(TRUE, array('metadata' => array('tags' => $tags))); //Change how is saved a metadata.
//$success = $form->save(TRUE, array('guid' => $some_guid)); //Save with specific guid.
//$success = $form->save(TRUE, array('entity_options' => array('container_guid' => $container_guid))); //Change some entity options.
//$success = $form->save(TRUE, array('entity_options' => array('create_river' => FALSE))); //Do not create river.


if (elgg_get_plugin_setting('enable_rivers_items', 'gtask') == 'yes') {
	$success = $form->save(TRUE);
}else {
	$success = $form->save(TRUE, array('entity_options' => array('create_river' => FALSE))); //Do not create river.
}


if ($success) {
	$entity = get_entity($success);
	
	if ($entity) {
		$subtype = $entity->getSubtype();
		
		// Success message
		system_message(sprintf(elgg_echo("gtask_ktform:save:entity:saved"), elgg_echo('item:object:'.$subtype)));
		
		$forward = $entity->getUrl();
		
		if (!$guid) {
			$container = $entity->getContainerEntity();
			if ($container instanceof ProjectGroup || $container instanceof ElggUser) {
				$forward = 'kanban/view/'.$container->getGUID();
			}
		}
		
		forward($forward);
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