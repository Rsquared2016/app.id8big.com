<?php

/*
 * Ajaxify
 * 
 * - Se agrego la settings 'show_content_comment_activity' para definir si mostrar
 *   el contenido del comentario en el river item del comentario
 * - Se piso la vista 'river/elements/responses' por 'theme/river/elements/responses'
 */

elgg_register_event_handler('init', 'system', 'theme_ajaxify_init');

/**
 * Theme Ajaxify: Init
 */
function theme_ajaxify_init() {
	
	// Page handler
	elgg_register_page_handler('theme_ajaxify', 'theme_ajaxify_page_handler');
	
	// Events
	elgg_register_event_handler('create', 'annotation', 'theme_ajaxify_create_delete_annotation_event');
	elgg_register_event_handler('delete', 'annotations', 'theme_ajaxify_create_delete_annotation_event');
	
	// Hooks
	elgg_register_plugin_hook_handler('forward', 'all', 'theme_ajaxify_forward_all_hook', 400);
	elgg_register_plugin_hook_handler('view', 'river/elements/layout', 'theme_view_river_elements_layout_hook');
	elgg_register_plugin_hook_handler('view', 'river/elements/responses', 'theme_view_river_elements_responses_hook');
	elgg_register_plugin_hook_handler('action', 'comments/delete', 'theme_action_comments_delete_hook');
	
	// JS
	elgg_register_js('ajaxify.js', 'mod/theme_professionalelgg18/vendors/theme_professionalelgg/ajaxify.js');							// Site JS
	elgg_load_js('ajaxify.js');
	
}

/**
 * Theme Ajaxify: Page Handler
 */
function theme_ajaxify_page_handler($page) {
	
	// Base path
	$base = elgg_get_plugins_path() . 'theme_professionalelgg18/pages/theme_ajaxify';
	
	switch ($page[0]) {
		// Get all comments
		case 'get_all_comments':
		default:
			set_input('entity_guid', $page[1]);
			require_once "$base/index.php";
			break;
	}
	
	return true;
	
}

/**
 * Theme Ajaxify: Create Delete Annotation Event
 */
function theme_ajaxify_create_delete_annotation_event($event, $type, $annotation) {
	
	$check_event = ($event == 'create' || $event == 'delete');
	$check_type = ($type == 'annotation' || $type == 'annotations');
	$check_annotation = ($annotation instanceof ElggAnnotation);
	$is_xhr = (elgg_is_xhr());
	
	if ($check_event && $check_type && $check_annotation && $is_xhr) {
		$annotation_id = $annotation->id;
		$annotation_name = $annotation->name;
		$entity_guid = $annotation->entity_guid;
		
		if ($annotation_name == 'likes' || $annotation_name == 'generic_comment') {
			// Get entity
			set_input('theme_ajaxify_annotation_id', $annotation_id);
			set_input('theme_ajaxify_annotation_name', $annotation_name);
			set_input('theme_ajaxify_entity_guid', $entity_guid);
		}
	}
	
}

function theme_ajaxify_forward_all_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'forward');
	$is_xhr = (elgg_is_xhr());
	
	if ($check_hook && $is_xhr) {
		// Get annotation name and entity guid
		$annotation_id = Get_input('theme_ajaxify_annotation_id', false);
		$annotation_name = get_input('theme_ajaxify_annotation_name', false);
		$entity_guid = get_input('theme_ajaxify_entity_guid', false);
		
		if ($annotation_id && $annotation_name && $entity_guid) {
			// Get entity
			$entity = get_entity($entity_guid);
			
			if ($entity instanceof ElggEntity) {
				if ($annotation_name == 'likes') {
					// Get button
					$button = elgg_view('likes/button', array(
						'entity' => $entity,
					));

					// Get count
					$count = elgg_view('likes/count', array(
						'entity' => $entity,
					));

					$data = array(
						'annotation_id' => $annotation_id,
						'entity_guid' => $entity_guid,
						'button' => $button,
						'count' => $count,
					);
					echo json_encode($data);
				}
				elseif ($annotation_name == 'generic_comment') {
					// Set context activity
					elgg_set_context('activity');
					// Get comment
					$annotation = elgg_get_annotation_from_id($annotation_id);
					$comment = elgg_view('annotation/generic_comment', array(
						'annotation' => $annotation,
					));
					// Get river_id
					$river_id = get_input('theme_ajaxify_river_id', '');
					
					$data = array(
						'annotation_id' => $annotation_id,
						'entity_guid' => $entity_guid,
						'comment' => $comment,
						'river_id' => $river_id,
					);
					echo json_encode($data);
				}
			}
		}
	}
	
	return $return;
	
}

/**
 * Theme Ajaxify: River Elements Layout Hook
 */
function theme_view_river_elements_layout_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'river/elements/layout');
	
	if ($check_hook && $check_type) {
		$show_content_comment_activity = theme_get_show_content_comment_activity();
		
		if (!$show_content_comment_activity) {
			if (isset($params['vars'])) {
				$vars = $params['vars'];
				
				$item = $vars['item'];
				$vars['message'] = '';
				$return = elgg_view('page/components/image_block', array(
					'image' => elgg_view('river/elements/image', $vars),
					'body' => elgg_view('river/elements/body', $vars),
					'class' => 'elgg-river-item',
				));
			}
		}
	}
	
	return $return;
	
}

/**
 * Theme Ajaxify: River Elements Responses Hook
 */
function theme_view_river_elements_responses_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'river/elements/responses');
	
	if ($check_hook && $check_type) {
		if (isset($params['vars'])) {
			$vars = $params['vars'];
			
			$return = elgg_view('theme/river/elements/responses', $vars);
		}
	}
	
	return $return;
	
}

function theme_action_comments_delete_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'action');
	$check_type = ($type == 'comments/delete');
	$is_xhr = (elgg_is_xhr());
	
	if ($check_hook && $check_type && $is_xhr) {
		$annotation_id = get_input('annotation_id', false);
		
		$river_id = false;
		$options = array(
			'annotation_ids' => $annotation_id,
		);
		$rivers = elgg_get_river($options);
		if (!empty($rivers) && is_array($rivers) && count($rivers) > 0) {
			$river = current($rivers);
			$river_id = $river->id;
			set_input('theme_ajaxify_river_id', $river_id);
		}
	}
	
	return $return;
	
}