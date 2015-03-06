<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$is_xhr = elgg_is_xhr();
if (!$is_xhr) {
	forward();
}

$guid = get_input('guid');
$entity = get_entity($guid);

if (!($entity instanceof ProjectGroup)) {
	register_error(elgg_echo('gdrive:sync:error'));
	forward();
}
if (!$entity->canWriteToContainer()) {
	forward();
}

// Google Drive
$gdi = new GDriveIntegration();
$gdi->authenticate();

// Sync permissions
$options = array(
	'type'=> 'object',
	'subtype' => 'gdrive',
    'owner_guid' => elgg_get_logged_in_user_guid(),
	'container_guid' => $entity->getGUID(),
	'annotation_names' => GDRIVE_SYNC_PERMISSION,
	'offset' => 0,
	'limit' => null,
);
$files = elgg_get_entities_from_annotations($options);

if ($files) {	
	foreach ($files as $f) {
		$file_id = $f->file_id;
		if (empty($file_id)) {
            continue;
        }
        
		// Get users to sync
		$annotations = $f->getAnnotations(GDRIVE_SYNC_PERMISSION, null);
		if ($annotations) {
			foreach ($annotations as $an) {
				$user = get_entity($an->owner_guid);
				
				$is_collaborator = false;
				$is_visitor = false;
				$permission = false;
				
				if ($user instanceof ElggUser) {
                    // Elimino el permiso
                    $permission_id = '';
                    $op_del = array(
                        'guid' => $f->getGUID(),
                        'annotation_names' => GDRIVE_PERMISSION_ID,
                        'annotation_owner_guids' => $user->getGUID(),
                        'offset' => 0,
                        'limit' => 1,
                    );
                    $annotations_del = elgg_get_annotations($op_del);
                    if ($annotations_del) {
                        $annot_del = current($annotations_del);
                        $permission_id = $annot_del->value;
                    }

                    if ($file_id && $permission_id) {
                        $gdi->deletePermission($file_id, $permission_id);
                        
                        elgg_delete_annotation_by_id($annot_del->id);
                    }
                    
                    // Chequeo si es colaborador o visitante y le doy el permiso correspondiente
                    $permission = FALSE;
					$is_collaborator = check_entity_relationship($user->getGUID(), 'collaborator', $entity->getGUID());
					if ($is_collaborator) {
						$permission = $gdi->insertPermission($file_id, $user->email, 'user', 'writer');
					}
					else {
						$is_visitor = check_entity_relationship($user->getGUID(), 'visitor', $entity->getGUID());
						
						if ($is_visitor) {
							$permission = $gdi->insertPermission($file_id, $user->email, 'user', 'reader');
						}
					}

					if ($is_collaborator || $is_visitor) {
						// Guardo en una anotacion el id del permiso para poder eliminarlo posteriormente si es necesario
						if ($permission instanceof Google_Permission) {
							$permission_id = $permission->getId();

							// Create annotation permission
                            $opt_annot = array(
                                'guid' => $f->getGUID(),
                                'annotation_names' => GDRIVE_PERMISSION_ID,
                                'annotation_owner_guids' => $user->getGUID(),
                            );
                            $annot_user = elgg_get_annotations($opt_annot);
                            if ($annot_user) {
                                $au = current($annot_user);
                                update_annotation(
                                    $au->id,
                                    GDRIVE_PERMISSION_ID,
                                    $permission_id,
                                    '',
                                    $user->getGUID(),
                                    ACCESS_LOGGED_IN);
                            }
                            else {
                                create_annotation(
                                    $f->getGUID(),
                                    GDRIVE_PERMISSION_ID,
                                    $permission_id,
                                    '',
                                    $user->getGUID(),
                                    ACCESS_LOGGED_IN);
                            }
						}
					}
//					else {
						// No es colaborador ni visitante, elimino el permiso
//						$permission_id = '';
//						
//						$op = array(
//							'guid' => $f->getGUID(),
//							'annotation_names' => GDRIVE_PERMISSION_ID,
//							'annotation_owner_guids' => $user->getGUID(),
//							'offset' => 0,
//							'limit' => 1,
//						);
//						$annotations = elgg_get_annotations($op);
//						if ($annotations) {
//							$annot = current($annotations);
//							$permission_id = $annot->value;
//						}
//						
//						if ($file_id && $permission_id) {
//							$gdi->deletePermission($file_id, $permission_id);
//
//							elgg_delete_annotation_by_id($annot->id);
//						}
//					}
					
					// Delete annotation sync
					elgg_delete_annotations(array(
						'guid' => $f->getGUID(),
						'annotation_names' => GDRIVE_SYNC_PERMISSION,
						'annotation_owner_guids' => $user->getGUID(),
					));
				}
			}
		}
	}
}

system_message(elgg_echo('gdrive:sync:success'));

forward();