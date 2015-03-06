<?php
/**
 * Elgg delete comment action
 *
 * @package Elgg
 */

// Ensure we're logged in
if (!elgg_is_logged_in()) {
	forward();
}

// Make sure we can get the comment in question
$annotation_id = (int) get_input('annotation_id');
$comment = elgg_get_annotation_from_id($annotation_id);
if ($comment && $comment->canEdit()) {
	$annotation_name = $comment->name;
	$entity_guid = $comment->entity_guid;
	
	$success = $comment->delete();
	if($success) {
		if(elgg_is_xhr()) {
			$output = array();

			$entity = get_entity($entity_guid);
			$output['entity_guid'] = $entity_guid;
			$output['link_comment'] = Compass::renderLinkComment($entity, $annotation_name);
			$output['comment_type'] = $annotation_name;
            $output['annotation_id'] = $annotation_id;
			
			echo json_encode($output);
		}
	} else {
		register_error(elgg_echo("generic_comment:notdeleted"));
	}
	
	system_message(elgg_echo("compass:generic_comment:deleted:{$annotation_name}"));
} else {
	register_error(elgg_echo("compass:generic_comment:notdeleted:{$annotation_name}"));
}

forward(REFERER);