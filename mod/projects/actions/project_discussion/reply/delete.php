<?php
/**
 * Delete project_discussion reply
 */

$id = (int) get_input('annotation_id');

$reply = elgg_get_annotation_from_id($id);
if (!$reply || $reply->name != 'project_topic_post') {
	register_error(elgg_echo('project_discussion:reply:error:notdeleted'));
	forward(REFERER);
}

if (!$reply->canEdit()) {
	register_error(elgg_echo('project_discussion:error:permissions'));
	forward(REFERER);
}

$result = $reply->delete();
if ($result) {
	system_message(elgg_echo('project_discussion:reply:deleted'));
} else {
	register_error(elgg_echo('project_discussion:reply:error:notdeleted'));
}

forward(REFERER);
