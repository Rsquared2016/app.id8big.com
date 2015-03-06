<?php
/**
 * Elgg add comment action
 *
 * @package Elgg.Core
 * @subpackage Comments
 */

$is_xhr = elgg_is_xhr();

elgg_set_context('leancanvas');

// Get inputs
$page_owner_guid = (int) get_input('page_owner');
$comment = get_input('comment');
$section_id = get_input('section_id');

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

// Lean canvas
$lean_canvas = new leanCanvas($page_owner);

// Get section
$section = $lean_canvas->getSection($section_id);
if (empty($section)) {
	register_error(elgg_echo("generic_comment:notfound"));
	forward(REFERER);
}

// Get annotation name
$annotation_name = $lean_canvas->getAnnotationNameOfCommentForSection($section_id);
if (!$annotation_name) {
	register_error(elgg_echo("generic_comment:notfound"));
	forward(REFERER);
}

$user_guid = elgg_get_logged_in_user_guid();

$annotation = create_annotation(
	$page_owner_guid,
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

$output = array();

if ($is_xhr) {
	$count_comments = $lean_canvas->getCommentsForSection($section_id, array('count' => TRUE));
	if ($count_comments == 1) {
		$output['comment'] = $lean_canvas->renderCommentsForSection($section_id);
	}
	else {
		$annotation = elgg_get_annotation_from_id($annotation);
		if ($annotation instanceof ElggAnnotation) {
			$html = '<li id="item-annotation-'.$annotation->id.'" class="elgg-item">';
			$html .= elgg_view_list_item($annotation);
			$html .= '</li>';
			$output['comment'] = $html;
		}
	}
	$output['link_comment'] = $lean_canvas->renderLinkCommentForSection($section_id);
}

echo json_encode($output);

system_message(elgg_echo("generic_comment:posted"));

// Forward to the page the action occurred on
forward(REFERER);