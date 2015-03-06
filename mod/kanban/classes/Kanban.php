<?php

class Kanban {
	const COLUMN_ACTIVE = 'active';
	const COLUMN_IN_PROGRESS = 'in_progress';
	const COLUMN_TESTING = 'for_testing';
	const COLUMN_DONE = 'finished';
	const COLUMN_ON_HOLD = 'onhold';
	
    function __construct() {
        
    }
	
	function getGroupedTasks($options = array()) {
		$default = array(
			'limit' => 0,
			'container_guid' => '', //Group owner
		);
		
		$options = array_merge($default, $options);
		
		$gtask_handler = new GtaskHandler();
		$entities = $gtask_handler->get_filter_entities($options);		
		$grouped_tasks = array();
		if($entities) {
			foreach($entities as $entity) {
				$grouped_tasks[$entity->status][] = $entity;
			}
		}		
		
		return $grouped_tasks;
		
	}
	
	function getOptionsMaxTasks() {
		
		$options_max_tasks = array();
		for ($i = 1; $i < 21; $i++) {
			$options_max_tasks[$i] = $i;
		}

		return $options_max_tasks;
		
	}
	
	function saveMaxTasks($project_guid, $status, $max_tasks) {
		
		$max_tasks = (int)$max_tasks;
		
		// Get status
		$status_options = array();
		if (is_callable('gtask_get_status_options')) {
			$status_options = gtask_get_status_options();
		}
		
		// Get project
		$project = get_entity($project_guid);
		
		if ((
             ($project instanceof ProjectGroup && $project->canWriteToContainer()) ||
             ($project instanceof ElggUser && $project->canEdit()))
             && array_key_exists($status, $status_options)) {
			// Get annotation name
			$annotation_name = $status . '_max_tasks';
			
			$options = array(
				'guid' => $project_guid,
				'annotation_names' => $annotation_name,
				'offset' => 0,
				'limit' => 1,
			);
			$annotations = elgg_get_annotations($options);
			if ($annotations) {
				$annot = current($annotations);

				$success = update_annotation($annot->id, $annotation_name, $max_tasks, '', $project->owner_guid, ACCESS_LOGGED_IN);
			}
			else {
				$success = create_annotation($project_guid, $annotation_name, $max_tasks, '', $project->owner_guid, ACCESS_LOGGED_IN);
			}
			
			return $success;
		}
		
		return false;
		
	}
	
	public function getMaxTasks($page_owner_guid, $status) {
		
		$max_tasks = 5;
		
		// Get status
		$status_options = array();
		if (is_callable('gtask_get_status_options')) {
			$status_options = gtask_get_status_options();
		}
		
		// Get page owner
		$page_owner = get_entity($page_owner_guid);
		
		if (($page_owner instanceof ProjectGroup || $page_owner instanceof ElggUSer) && array_key_exists($status, $status_options)) {
			// Get annotation name
			$annotation_name = $status . '_max_tasks';
			
			$options = array(
				'guid' => $page_owner_guid,
				'annotation_names' => $annotation_name,
				'offset' => 0,
				'limit' => 1,
			);
			$annotations = elgg_get_annotations($options);
			if ($annotations) {
				$annot = current($annotations);
				
				$max_tasks = $annot->value;
			}
		}
		
		return $max_tasks;
		
	}
}
