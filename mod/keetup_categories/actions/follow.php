<?php
/*
 * Bulk action follow a category or subcategory.
 * 
 */
// Make sure we're logged in (send us to the front page if not)
gatekeeper();

// Get input data
$guids = get_input('guids');
$follow_rel = get_input('follow_rel', ''); //Default relationship
$follow_type = get_input('follow_type', 'kt_category');//Could be: kt_category | kt_subcategory
$type_text = get_input('type_text', '');//Could be: Category | Subcategory
$follow_stream_cat = get_input('follow_stream_cat', ''); // Category of opportunity

$instance = FALSE;
switch($follow_type) {
	case 'kt_category':
		$instance = KtCategory;
		if(!$follow_rel) {
			$follow_rel = KT_CATEGORIES_FOLLOW_CATEGORY;
		}
		if(!$guids) {
			$guids = get_input('category_id');
		}
		if(!$type_text) {
			$type_text = elgg_echo('keetup_categories:follow:type:category');
		}
		break;
	
	case 'kt_subcategory':
		$instance = KtSubCategory;
		if(!$follow_rel) {
			$follow_rel = KT_CATEGORIES_FOLLOW_SUBCATEGORY;
		}
		if(!$guids) {		
			$guids = get_input('subcategory_id');
		}
		if(!$type_text) {
			$type_text = elgg_echo('keetup_categories:follow:type:subcategory');
		}
		if (!$follow_stream_cat) {
			$follow_stream_cat = 'all';
		}

		break;
}

$fw = get_input('fw', 'fw_ref'); //If we add the string 'fw_ref' => Redirecciona al referer.

$user_guid = elgg_get_logged_in_user_guid();
$success = TRUE;
try {
	if(!$guids) {
		throw new Exception(sprintf(elgg_echo('keetup_categories:follow:error:select'), $type_text));
	}

	if(!is_array($guids)) {
		$guids = array($guids);
	}	
	
	foreach ($guids as $guid) {
		$entity = get_entity($guid);
		$entity_title = $entity->title;
		if($entity instanceof $instance) {
			//Follow the entity.
			if (check_entity_relationship($user_guid, $follow_rel, $guid)) {
				throw new Exception(sprintf(elgg_echo('keetup_categories:follow:error:already:following'), $entity_title));
			} else {
				$success = add_entity_relationship($user_guid, $follow_rel, $guid);
				
				// Add annotation of category followed
				if ($follow_stream_cat) {
					$options = array(
						'guid' => $entity->getGUID(),
						'annotation_name' => OPPORTUNITIES_FOLLOW_STREAM_CATEGORY,
						'annotation_owner_guid' => $user_guid,
					);
					$annotations = elgg_get_annotations($options);
					if ($annotations) {
						// Update annotation
						$annotation = current($annotations);
						$annotation_id = $annotation->id;
						update_annotation($annotation_id, OPPORTUNITIES_FOLLOW_STREAM_CATEGORY, $follow_stream_cat, '', $user_guid, ACCESS_LOGGED_IN);
					}
					else {
						// Insert annotation
						create_annotation($entity->getGUID(), OPPORTUNITIES_FOLLOW_STREAM_CATEGORY, $follow_stream_cat, '', $user_guid, ACCESS_LOGGED_IN);
					}
				}
			}

			if(!$success) {
				throw new Exception(sprintf(elgg_echo('keetup_categories:follow:error:adding:rel'), $entity_title));
			}
		} else {
			throw new Exception(sprintf(elgg_echo('keetup_categories:follow:error:invalid'), $type_text));
		}
	}
} catch(Exception $e) {
	register_error($e->getMessage());
	$sucess = FALSE;
}

if($success) {
	// Success message
	if($entity_title && count($guids) == 1) {
		$type_text = $type_text . " '{$entity_title}'";
	}
	system_message(sprintf(elgg_echo("keetup_categories:follow:success"), $type_text));
}


if($fw == 'fw_ref') {
	$fw = REFERER;
}
// Forward
forward($fw);