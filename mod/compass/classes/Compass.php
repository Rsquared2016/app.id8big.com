<?php

class Compass {
	const DEFAULT_STATUS = 'active';
	const COLUMN_ACTIVE = 'active';
	const COLUMN_IN_PROGRESS = 'in_progress';
	const COLUMN_DONE_VALIDATED = 'validated';
	const COLUMN_DONE_UNVALIDATED = 'unvalidated';
	const COLUMN_DONE_UNKNOWN = 'unknown';
	const NOTES_NAME = 'note';
	const EXPERIMENT_NAME = 'experiment';
	const RISKIEST_ASSUMPTION_NAME = 'riskiest_assumption'; // Riskiest Assumption
	const EXPECTED_OUTCOME_NAME = 'expected_outcome'; // Expected Outcome
	const KEY_METRICS_MEASURED_NAME = 'key_metrics_measured'; // Key Metrics Measured
    const TASK_NAME = 'task'; // Task
    const RESULT_NAME = 'result'; // Results
    const WHATS_THE_NEXT_STEP = 'whats_the_next_step'; // Results
	
    function __construct() {
        
    }
	
	static function getStatusOptions() {
		$status = array(
			'active' => elgg_echo('compass:group_board:active'),
			'in_progress' => elgg_echo('compass:group_board:in_progress'),
			'validated' => elgg_echo('compass:group_board:validated'),
			'unvalidated' => elgg_echo('compass:group_board:unvalidated'),
			'unknown' => elgg_echo('compass:group_board:unknown'),
		);

		return $status;
	}
	
	static function getCommentTypes() {
		$types = array(
            Compass::NOTES_NAME,
            Compass::EXPERIMENT_NAME,
            Compass::RISKIEST_ASSUMPTION_NAME,
            Compass::EXPECTED_OUTCOME_NAME,
            Compass::KEY_METRICS_MEASURED_NAME,
            Compass::TASK_NAME,
            Compass::RESULT_NAME,
            Compass::WHATS_THE_NEXT_STEP,
        );
		return $types;
	}
	
	static function isValidCommentType($comment_type) {
		if(!$comment_type) {
			return false;
		}
		
		$types = Compass::getCommentTypes();
		
		return in_array($comment_type, $types);
	}
	
	function getGroupedTasks($options = array()) {
		$default = array(
			'type' => 'object',
			'subtype' => 'lean_objective',
			'limit' => 0,
			'container_guid' => '', //Group owner
		);
		
		$options = array_merge($default, $options);
		
		//Security check
		if(!$options['container_guid']) {
			return array();
		}
		
		$entities = elgg_get_entities($options);
		$grouped_tasks = array();
		if($entities) {
			foreach($entities as $entity) {
				$status = $entity->compass_status;
				if(!$status) {
					$status = Compass::DEFAULT_STATUS;
				}
				
				$grouped_tasks[$status][] = $entity;
			}
		}		
		
		return $grouped_tasks;
		
	}
	
	static function countComments($entity, $comment_type, $options = array()) {
		if (!is_array($options)) {
			$options = array();
		}
		
		$options['count'] = TRUE;
		
		$count = self::getComments($entity, $comment_type, $options);
		if(empty($count)) {
			$count = 0;
		}
		
		return $count;
	}

	static function getComments($entity, $comment_type, $options = array()) {
		$comments = array();

		if (!is_array($options)) {
			$options = array();
		}
		
		$valid = Compass::isValidCommentType($comment_type);
		if(!$valid) {
			return $comments;
		}

		$annotation_name = $comment_type;
		if ($annotation_name) {
			$entity_guid = $entity->getGUID();

			$default = array(
				'guid' => $entity_guid,
				'annotation_names' => $annotation_name,
				'offset' => 0,
				'limit' => null,
				//'full_view' => TRUE,
			);
			if (!is_array($options)) {
				$options = array();
			}
			
			$options = array_merge($default, $options);

			$comments = elgg_get_annotations($options);
		}

		return $comments;
	}

	static function viewComments($entity, $comment_type, $options = array()) {
		$list_comments = '';

		if (!is_array($options)) {
			$options = array();
		}

		$comments = self::getComments($entity, $comment_type, $options);
		$count_comments = self::countComments($entity, $comment_type, $options);
		
		$options['count'] = $count_comments;
		$options['full_view'] = TRUE;
 
		$list_comments = elgg_view_annotation_list($comments, $options);

		return $list_comments;
	}	
	
	public static function renderLinkComment($entity, $comment_type) {
		
		$link = elgg_view('compass/link_comment', array(
			'entity' => $entity,
			'comment_type' => $comment_type,
		));
		
		return $link;
		
	}
    
    public static function renderContentComment($entity, $comment_type) {
        
        $content = elgg_view('compass/content_comment', array(
            'entity' => $entity,
            'comment_type' => $comment_type,
        ));
        
        return $content;
        
    }
	
	public static function getSectionsOptions(ProjectGroup $project) {
        
        $options = array();
        
        if (class_exists('leanCanvas')) {
            $leancanvas = new leanCanvas($project);
            
            $sections = $leancanvas->getSections();
            
            if (!empty($sections) && is_array($sections)) {
                $options[0] = elgg_echo('compass:sections:options:all');
                $options_aux = array();
                foreach($sections as $section_id => $section_data) {
                    $options_aux[$section_id] = $section_data['title'];
                }
                asort($options_aux);
                $options = $options + $options_aux;
            }
        }
        
        return $options;
        
    }
}
