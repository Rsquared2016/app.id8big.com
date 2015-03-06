<?php
/**
 * Elgg add comment action
 *
 * @package Elgg.Core
 * @subpackage Comments
 */
$is_xhr = elgg_is_xhr();

elgg_set_context('compass');

// Get inputs
$page_owner_guid = (int) get_input('page_owner');
$entity_guid = (int) get_input('entity_guid');
$comment = get_input('comment');
$comment_type = get_input('comment_type');

$entity = get_entity($entity_guid);
if(!$entity || !elgg_instanceof($entity, 'object', 'lean_objective')) {
	register_error(elgg_echo("generic_comment:blank"));
	forward(REFERER);
}
// Check comment
if (empty($comment)) {
	register_error(elgg_echo("generic_comment:blank"));
	forward(REFERER);
}

// Let's see if we can get an entity with the specified GUID
$page_owner = get_entity($page_owner_guid);
if (!($page_owner instanceof ProjectGroup)) {
	register_error(elgg_echo("generic_comment:notfound"));
	forward(REFERER);
}

if (!$page_owner->canWriteToContainer()) {
	register_error(elgg_echo("generic_comment:notfound"));
	forward(REFERER);
}

elgg_set_page_owner_guid($page_owner_guid);

// Get section
$valid = Compass::isValidCommentType($comment_type);
if (!$valid) {
	register_error(elgg_echo("generic_comment:notfound"));
	forward(REFERER);
}

// Get annotation name
$annotation_name = $comment_type;

$user_guid = elgg_get_logged_in_user_guid();

$annotation = create_annotation(
	$entity_guid,
	$annotation_name,
	$comment,
	"",
	$user_guid,
	$page_owner->access_id
);

// tell user annotation posted
if (!$annotation) {
	register_error(elgg_echo("generic_comment:failure"));
	forward(REFERER);
}


if ($is_xhr) {
	$output = array();
    
    $annotation = elgg_get_annotation_from_id($annotation);
    
	$count_comments = Compass::countComments($entity, $comment_type);
	if ($count_comments == 1) {
		$output['comment'] = Compass::viewComments($entity, $comment_type);
	}
	else {
		if ($annotation instanceof ElggAnnotation) {
			$html = '<li id="item-annotation-'.$annotation->id.'" class="elgg-item">';
			$html .= elgg_view_list_item($annotation);
			$html .= '</li>';
			$output['comment'] = $html;
		}
	}
	$output['link_comment'] = Compass::renderLinkComment($entity, $comment_type);
	$output['entity_guid'] = $entity_guid;
	$output['comment_type'] = $comment_type;
    $output['content_comment'] = elgg_view('compass/content_comment_item', array(
        'item' => $annotation,
    ));
	
	echo json_encode($output);
}

system_message(elgg_echo("compass:generic_comment:posted:{$comment_type}"));

// Forward to the page the action occurred on
forward(REFERER);