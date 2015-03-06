<?php

/**
 * leanCanvas handler class
 *
 * @author Bortoli German for keetup development <info@keetup.com>
 * 
 */
class leanCanvas {

	protected $sections = array();
	protected $project;
	protected $can_edit = false;

	const MAX_SECTIONS = 12;
	const DEFAULT_COLOR = 'yellow';

	/**
	 * Get max of sections of the leanboard
	 * 
	 * @return integer
	 */
	public function getMaxSectionsLimit() {
		return self::MAX_SECTIONS;
	}

	/**
	 * Construct the object, it is needed an projectgroup object otherwise will throw exception
	 * 
	 * @param ProjectGroup $project
	 * @throws Exception
	 * 
	 */
	public function __construct(ProjectGroup $project) {

		if ($project instanceof ProjectGroup) {
			$this->project = $project;
		} else {
			throw new Exception('There is no project to assign the leancanvas');
		}

		$sections = array();

		$max_sections = $this->getMaxSectionsLimit();

		for ($i = 1; $i <= $max_sections; $i++) {
			$sections[$i] = array(
				'title' => elgg_echo("leancanvas:section:title:{$i}"),
				'subtitle' => elgg_echo("leancanvas:section:subtitle:{$i}"),
				'help' => elgg_echo("leancanvas:section:help:{$i}"),
				'number' => elgg_echo("leancanvas:section:number:{$i}"),
			);
		}

		$this->sections = $sections;
		
		$this->can_edit = $project->canWriteToContainer();
		
	}

	/**
	 * Get a specific section from the list
	 * 
	 * @param integer $section
	 * @return array section => array('title', 'subtitle')
	 */
	public function getSection(int $section) {
		$section = (int) $section;
		$sections = $this->getSections();

		if (isset($sections[$section])) {
			$section = $sections[$section];
			return $section;
		}

		return FALSE;
	}

	/**
	 * Get all sections 
	 * 
	 * @return array array[section] => array('title', 'subtitle')
	 */	
	public function getSections() {
		return $this->sections;
	}

	/**
	 * Get the current project
	 * 
	 * @return ProjectGroup $project
	 */
	public function getProject() {
		return $this->project;
	}

	/**
	 * Render the objective form to add/edit some lean objective
	 * 
	 * @param integer $section
	 * @return string the form HTML output
	 */
	public function renderObjectiveForm($section = 1) {
		$vars = array(
			'page_owner' => $this->getProject(),
			'section' => $section,
			'lean_canvas' => $this,
		);
		
		$project = $this->getProject();
		if (!$project->canWriteToContainer()) {
			return;
		}

		return elgg_view_form('leancanvas/add_objective', array(), $vars);
	}
	
	/**
	 * Get objectives for section
	 */
	public function getObjectivesForSection(integer $section_id, $options = array()) {
		
		$section = $this->getSection($section_id);
		if (!$section) {
			return FALSE;
		}
		
		$defaults = array(
			'limit' => 0,
			'offset' => 0,
			'type' => 'object',
			'subtype' => 'lean_objective',
			'container_guid' => $this->getProject()->getGUID(),
			'reverse_order_by' => TRUE,
		);
		
		$options = array_merge($defaults, $options);
		
		$options['metadata_name_value_pairs'] = array();
		$options['metadata_name_value_pairs'][] = array('name' => 'section', 'value' => $section_id);
		
		$entities = elgg_get_entities_from_metadata($options);
		
		return $entities;
		
	}
	
	/**
	 * List leancanvas objects for a specific section
	 * 
	 * @param integer $section_id
	 * @param array $options => The listing options
	 * 
	 * @return string
	 * 
	 * @todo Add better rendering after integration
	 */
	
	public function renderObjectivesForSection(integer $section_id, $options = array()) {
		
		$entities = $this->getObjectivesForSection($section_id, $options);
		
		return elgg_view('lean_objective/listing', array('entities' => $entities, 'lean_canvas' => $this));
		
	}
	

	/**
	 * Get a static array of lean objective colors
	 * 
	 * @return array
	 */
	public static function getLeanCanvasColors() {
		$colors_options = array(
			'yellow' => 'Yellow',
			'skyblue' => 'Sky Blue',
			'orange' => "Orange",
		);
		
		return $colors_options;
	}
	
	
	/**
	 * Action to add/edit a lean canvas objective
	 * 
	 * @param array $lean_objective view defaults options
	 * @return boolean|integer
	 * 
	 * @throws Exception if error
	 */
	
	public static function createObjective(array $lean_objective = array()) {
		
		$defaults = array(
			'guid' => ELGG_ENTITIES_ANY_VALUE,
			'title' => '',
			'color' => self::DEFAULT_COLOR,
			'section' => ELGG_ENTITIES_ANY_VALUE,
			'container_guid' => ELGG_ENTITIES_ANY_VALUE,
			'owner_guid' => ELGG_ENTITIES_ANY_VALUE,
		);
		
		if (empty($lean_objective) || !is_array($lean_objective)) {
			throw new Exception(elgg_echo('leancanvas:objective:empty:error'));
		}
		
		$lean_objective = array_merge($defaults, $lean_objective);
		
		if (empty($lean_objective['title'])) {
			throw new Exception(elgg_echo('leancanvas:objective:empty:title'));
		}
		
		$group = get_entity($lean_objective['container_guid']);
		if (!($group instanceof ElggGroup)) {
			throw new Exception(elgg_echo('leancanvas:objective:not:group'));
		}
		
		if (!$group->canWriteToContainer()) {
			throw new Exception(elgg_echo('leancanvas:objective:not:access'));
		}
		
		$lean_objective['access_id'] = $group->group_acl;
		$lean_objective['owner_guid'] = $group->getGUID();
		
		if ($lean_objective['guid']) {
			$objective_guid = (int) $lean_objective['guid'];
			$objective = get_entity($objective_guid);
		}
		
		if ($objective instanceof leanObjective) {
			if ($objective->canEdit() == FALSE) {
				throw new Exception(elgg_echo('leancanvas:objective:not:object:access'));
			}
		} else {
			$objective = new leanObjective();
		}
		
		
		foreach($lean_objective as $data_name => $data_value) {
			$objective->$data_name = $data_value;
		}
		
		return $objective->save();
	}
	
	/**
	 * Action to delete an objective task
	 * 
	 * @param integer $guid the objective guid
	 * @return boolean
	 * 
	 * @throws Exception
	 */
	public static function deleteObjective(integer $guid) {
		
		$guid = (int) $guid;
		$objective = get_entity($guid);
		
		if (!($objective instanceof leanObjective)) {
			throw new Exception(elgg_echo('leancanvas:objective:empty:error'));
		}
		
		if (!$objective->canEdit()) {
			throw new Exception(elgg_echo('leancanvas:objective:not:access'));
		}
		
		return $objective->delete();
	}
	
	/**
	 * Can edit
	 */
	public function canEdit() {
		
		return $this->can_edit;
		
	}
	
	/**
	 * Get annotation name of comment for section
	 */
	public function getAnnotationNameOfCommentForSection(integer $section_id) {
		
		$section = $this->getSection($section_id);
		if ($section) {
			return 'lean_comment_' . $section_id;
		}
		
		return false;
		
	}
	
	public function isAnnotationNameOfCommentForSection($annotation_name) {
		
		$is_valid = false;
		
		$sections = $this->getSections();
		if (is_array($sections)) {
			foreach($sections as $section_id => $section) {
				$annot = $this->getAnnotationNameOfCommentForSection($section_id);
				
				if ($annot == $annotation_name) {
					$is_valid = $section_id;
					break;
				}
			}
		}
		
		return $is_valid;
		
	}
	
	/**
	 * 
	 */
	public function getCommentsForSection(integer $section_id, $options = array()) {
		
		$comments = array();
		
		$annotation_name = $this->getAnnotationNameOfCommentForSection($section_id);
		
		if ($annotation_name) {
			$project = $this->getProject();
			
			$default = array(
				'guid' => $project->getGUID(),
				'annotation_names' => $annotation_name,
				'offset' => 0,
				'limit' => null,
				'section_id' => $section_id,
				'full_view' => TRUE,
			);
			if (!is_array($options)) {
				$options = array();
			}
			$options = array_merge($default, $options);
			
			$comments = elgg_get_annotations($options);
		}
		
		return $comments;
		
	}
	
	/**
	 * Render comments for section
	 */
	public function renderCommentsForSection(integer $section_id, $options = array()) {
		
		$list_comments = '';
		
		if (!is_array($options)) {
			$options = array();
		}
		
		$options['count'] = TRUE;
		$count_comments = $this->getCommentsForSection($section_id, $options);
		
		$options['count'] = FALSE;
		$comments = $this->getCommentsForSection($section_id, $options);
		
		$options['count'] = $count_comments;
		
		$list_comments = elgg_view_annotation_list($comments, $options);
		
		return $list_comments;
		
	}
	
	public function renderLinkCommentForSection(integer $section_id) {
		
		$link = '';
		
		$section = $this->getSection($section_id);
		if ($section) {
			$link = elgg_view('leancanvas/link_comment', array(
				'section_id' => $section_id,
				'lean_canvas' => $this,
			));
		}
		
		return $link;
		
	}

}