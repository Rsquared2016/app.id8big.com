<?php

/**
 * Comments
 */

$is_xhr = elgg_is_xhr();

if (!$is_xhr) {
//	forward(REFERER);
}

$entity_guid = get_input('entity_guid');

$entity = get_entity($entity_guid);
if(!$entity || !elgg_instanceof($entity, 'object', 'lean_objective')) {
	//return false;
	forward(REFERER);
}


elgg_set_context('compas');

$group = elgg_get_page_owner_entity();
if (!($group instanceof ProjectGroup)) {
	echo '';
	exit;
}

// Gatekeeper
$project_gatekeeper = project_gatekeeper(false);
if (!$project_gatekeeper) {
	echo '';
	exit;
}

// Get comments type.
$comments_type = get_input('comments_type');
switch($comments_type) {
	case 'experiment':
		// Get comments
		$comment_type = Compass::EXPERIMENT_NAME;
		$comments = Compass::viewComments($entity, $comment_type);
		
		break;
	case 'note':
		$comment_type = Compass::NOTES_NAME;
		$comments = Compass::viewComments($entity, $comment_type);
		break;
    
    case 'riskiest_assumption':
		$comment_type = Compass::RISKIEST_ASSUMPTION_NAME;
		$comments = Compass::viewComments($entity, $comment_type);
		break;
    
    case 'expected_outcome':
		$comment_type = Compass::EXPECTED_OUTCOME_NAME;
		$comments = Compass::viewComments($entity, $comment_type);
		break;
    
    case 'key_metrics_measured':
		$comment_type = Compass::KEY_METRICS_MEASURED_NAME;
		$comments = Compass::viewComments($entity, $comment_type);
		break;
    
    case 'task':
		$comment_type = Compass::TASK_NAME;
		$comments = Compass::viewComments($entity, $comment_type);
		break;
    
    case 'result':
		$comment_type = Compass::RESULT_NAME;
		$comments = Compass::viewComments($entity, $comment_type);
		break;
    case 'whats_the_next_step':
		$comment_type = Compass::WHATS_THE_NEXT_STEP;
		$comments = Compass::viewComments($entity, $comment_type);
		break;
}

// Get content
$vars = array(
	'page_owner' => $group,
	'entity_guid' => $entity_guid,
	'comments' => $comments,
	'comment_type' => $comment_type
);
$content = elgg_view('compass/comments', $vars);

echo $content;

exit;