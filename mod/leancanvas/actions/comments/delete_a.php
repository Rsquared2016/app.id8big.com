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
	
	$comment->delete();
	
	$entity = get_entity($entity_guid);
	
	$lean_canvas = new leanCanvas($entity);
	
	$section_id = $lean_canvas->isAnnotationNameOfCommentForSection($annotation_name);
	
	$output = array();
	
	$output['section_id'] = $section_id;
	$output['link_comment'] = $lean_canvas->renderLinkCommentForSection($section_id);
	
	echo json_encode($output);
	
	system_message(elgg_echo("generic_comment:deleted"));
} else {
	register_error(elgg_echo("generic_comment:notdeleted"));
}

forward(REFERER);