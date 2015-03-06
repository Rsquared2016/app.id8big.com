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

$new_entity = true;

$form = new GDriveForm;
if ($guid) {
	$new_entity = false;
	$form->setObject($guid);
}


//$tags = get_input('tags', array());
//$tags = string_to_tag_array($tags);
//$success = $form->save(TRUE, array('metadata' => array('tags' => $tags))); //Change how is saved a metadata.
//$success = $form->save(TRUE, array('guid' => $some_guid)); //Save with specific guid.
//$success = $form->save(TRUE, array('entity_options' => array('container_guid' => $container_guid))); //Change some entity options.
//$success = $form->save(TRUE, array('entity_options' => array('create_river' => FALSE))); //Do not create river.


if (elgg_get_plugin_setting('enable_rivers_items', 'gdrive') == 'yes') {
	$success = $form->save(TRUE);
}else {
	$success = $form->save(TRUE, array('entity_options' => array('create_river' => FALSE))); //Do not create river.
}


if ($success) {
	$entity = get_entity($success);
	
	if ($entity) {
		$subtype = $entity->getSubtype();
		
        // Indico con una anotacion que el archivo es subido por un usuario
        $options = array(
            'guid' => $entity->getGUID(),
            'annotation_names' => GDRIVE_UPLOADED_BY_USER,
        );
        $annotations = elgg_get_annotations($options);
        if (empty($annotations)) {
            create_annotation(
                $entity->getGUID(),
                GDRIVE_UPLOADED_BY_USER,
                'yes',
                '',
                $entity->getOwnerGUID(),
                ACCESS_LOGGED_IN);
        }
        
		/*if ($new_entity) {
			// Get container
			$container = $entity->getContainerEntity();
			if ($container instanceof ProjectGroup) {
				// Google Drive
				$gdi = new GDriveIntegration();
				$gdi->authenticate();
				
				// Insert file into Google Drive
				$file = $gdi->insertFile($entity, $_FILES['file']);

				if ($file instanceof Google_DriveFile) {
					// Set file's link
					$alternative_link = $file->getAlternateLink();
					$entity->alternative_link = $alternative_link;

					// Set file id
					$file_id = $file->getId();
					$entity->file_id = $file_id;

					// Set owner
//					$owner = $entity->getOwnerEntity();

					// Get collaborators
                    $entity->insertPermissionsCollaborators();
//					$options = array(
//						'type' => 'user',
//						'relationship' => 'collaborator',
//						'relationship_guid' => $container->getGUID(),
//						'inverse_relationship' => true,
//						'offset' => 0,
//						'limit' => null,
//					);
//					$collaborators = elgg_get_entities_from_relationship($options);
//					if ($collaborators) {
//						foreach ($collaborators as $col) {
//							$value = $col->email;
//							if (is_email_address($value) && $value != $owner->email) {
//								$permission = $gdi->insertPermission($file_id, $value, 'user', 'writer');
//
//								// Guardo en una anotacion el id del permiso para poder eliminarlo posteriormente si es necesario
//								if ($permission instanceof Google_Permission) {
//									$permission_id = $permission->getId();
//
//									create_annotation(
//										$entity->getGUID(),
//										GDRIVE_PERMISSION_ID,
//										$permission_id,
//										'',
//										$col->getGUID(),
//										ACCESS_LOGGED_IN);
//								}
//							}
//						}
//					}

					// Get visitors
                    $entity->insertPermissionsVisitors();
//					$options = array(
//						'type' => 'user',
//						'relationship' => 'visitor',
//						'relationship_guid' => $container->getGUID(),
//						'inverse_relationship' => true,
//						'offset' => 0,
//						'limit' => null,
//					);
//					$visitors = elgg_get_entities_from_relationship($options);
//					if ($visitors) {
//						foreach ($visitors as $vis) {
//							$value = $vis->email;
//							if (is_email_address($value) && $value != $owner->email) {
//								$permission = $gdi->insertPermission($file_id, $value, 'user', 'reader');
//
//								// Guardo en una anotacion el id del permiso para poder eliminarlo posteriormente si es necesario
//								if ($permission instanceof Google_Permission) {
//									$permission_id = $permission->getId();
//
//									create_annotation(
//										$entity->getGUID(),
//										GDRIVE_PERMISSION_ID,
//										$permission_id,
//										'',
//										$vis->getGUID(),
//										ACCESS_LOGGED_IN);
//								}
//							}
//						}
//					}
				}
			}
		}*/
		
		// Success message
		system_message(sprintf(elgg_echo("gdrive_ktform:save:entity:saved"), elgg_echo('item:object:'.$subtype)));
		
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