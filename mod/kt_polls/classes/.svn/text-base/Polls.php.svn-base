<?php

/**
 * @ktodo: add another object types on skeleton
 */
class Polls extends ElggObject {

	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "kt_poll";
	}

	public function __construct($guid = null) {
		parent::__construct($guid);
	}

	/**
	 * Export the object values, so we can get those in the profile, etc
	 * 
	 * This method has to be implemented allways according to the model
	 *
	 * @param array $exclude
	 * @return array
	 */
	public function getObjectValues($exclude = array()) {

		$form = new PollsForm();
		return $form->getObjectValues($exclude, $this);
	}

	/**
	 * Imporatant this must be added into the class.
	 *
	 * @param string $section The section you want to get the actions: listing, profile.
	 *
	 * return array of actions links.
	 */
	public function getEntityLinkActions($section = 'listing') {
		global $CONFIG;

		//KTODO: Add extensible data, could be a trigger plugin hook or something like that.
		switch ($section) {
			case 'profile':
				$actions = ktform_get_entity_actions_link_default($this);
				break;

			case 'listing':
			default:
				$actions = ktform_get_entity_actions_link_default($this);
				break;
		}
		//KTODO: Check how to add the of the plugin to the actions.
		if($this->canEdit()) {
			$actions['edit'] = "<a href='{$CONFIG->url}kt_polls/edit/{$this->getGUID()}'>" . elgg_echo('edit') . '</a>';
		}

		
		/*if (!isadminloggedin()) {
			$guid_one = $this->getGUID();
			$guid_two = $this->getOwner();
			$relationship = KTPOLL_USER_PROFILE_SETTED;

			$from_profile_url = $CONFIG->url . 'action/kt_polls/profile/';

			if (check_entity_relationship($guid_one, $relationship, $guid_two)) {
				$remove_lnk = $from_profile_url . 'remove?guid=' . $guid_one;
				$actions['remove_to_profile'] = elgg_view('output/confirmlink', array('href' => $remove_lnk, 'text' => elgg_echo('kt_polls:poll:profile:action:remove')));
			} else {
				$add_lnk = $from_profile_url . 'add?guid=' . $guid_one;
				$actions['add_to_profile'] = elgg_view('output/confirmlink', array('href' => $add_lnk, 'text' => elgg_echo('kt_polls:poll:profile:action:add')));
			}
		}*/
		return $actions;
	}

	public function getListingLink() {
		global $CONFIG;
		return $CONFIG->url . 'kt_polls/';
	}

	/**
	 * Method to get the question type, if is a poll or a quiz
	 * @return type 
	 */
	public function getQuestionType() {
		return $this->question_type;
	}

	/**
	 * Generate the internalname of the poll
	 * 
	 * @return string | html
	 */
	public function getPollQuizInternalname() {
		$question_type = $this->getQuestionType();
		$guid = $this->getGUID();

		return "{$question_type}_{$guid}";
	}

	/**
	 * Retrieve the quiz values
	 */
	public function getQuizValues() {
		$questions_values = array();
		$question_options = $this->question_options;

		if (!empty($question_options)) {
			$questions_values = explode(PHP_EOL, $question_options);
		}

		foreach ($questions_values as $key => $value) {
			$questions_values[$key] = trim($value);
		}

		return $questions_values;
	}

	/**
	 * Function to retrieve the form elements for the poll
	 * 
	 * @return string | html 
	 */
	public function generatePollElements() {
		$internalname = $this->getPollQuizInternalname();

		$html = elgg_view('input/text', array('name' => $internalname, 'id' => $internalname));
		return '<li>'.$html.'</li>';
	}

	/**
	 * Function to retrieve the form elements for the quiz
	 * 
	 * @return string | html 
	 */
	public function generateQuizElements() {
		$internalname = $this->getPollQuizInternalname();
		$values = $this->getQuizValues();

		if (empty($values)) {
			return '';
		}

		return elgg_view('input/radio', array('name' => $internalname, 'id' => $internalname, 'options' => $values, 'is_item_li' => TRUE));
	}

	/**
	 * Function to generate the poll form or form element, depending of context
	 * 
	 * We need all the form content for the poll profile, but in tests we need only the form element
	 * 
	 * @param array $options  
	 * 
	 * 	poll_context => 'the_context'
	 */
	public function generatePollQuizView($options = array()) {

		$defaults = array(
			'poll_context' => get_context(),
			'entity' => $this,
			'user' => get_loggedin_userid(),
		);

		$options = array_merge($defaults, $options);

		$form_element = '';
		$question_type = $this->getQuestionType();

		switch ($question_type) {
			case 'poll':
				$form_element = $this->generatePollElements();
				break;

			case 'quiz':
				$form_element = $this->generateQuizElements();
				break;
		}

		$options['form_element'] = $form_element;

		$form_view = '';

		/**
		 * TODO: ADD WHEN THE TEST, THE VIEW
		 */
		switch ($options['poll_context']) {
			
			case 'test_profile':
					$form_view = elgg_view('kt_polls/test_profile', $options);
				break;

			case 'company':
				//KTODO:
				//Chequear si la empresa owner esta logeada.
				//Mostrar solo los resultados.
				if($options['entity']->canSubmitPollQuiz(elgg_get_logged_in_user_entity())) {
					$form_view = elgg_view('kt_polls/poll/vote', $options);
				} else {
					$form_view = elgg_view('kt_polls/poll/result', $options);
				}
				break;
			
			default:
				
				if ($options['entity']->canSubmitPollQuiz($options['user'])) {
					$form_view = elgg_view('kt_polls/poll_profile', $options);
				} else {
					$form_view = elgg_view('kt_polls/poll_profile_voted', $options);
				}
				
				break;
		}

		return $form_view;
	}

	/**
	 * Check if an user can submit a poll and quiz
	 * 
	 * @param int | ElggUser $user
	 * @return bool 
	 */
	public function canSubmitPollQuiz($user = 0) {
		$answer = $this->getUserAnswer($user);
		$is_owner = ($this->getOwner() == get_loggedin_userid());
		
		if ($answer || $is_owner) {
			return FALSE;
		} else {
            // Check for container group project
            $container = $this->getContainerEntity();
            if (elgg_instanceof($container, 'group', 'project')) {
                if ($container->isVisitor()) {
                    return FALSE;
                }
            }
            
			return TRUE;
		}
	}

	/**
	 * Get a specific user answer from the poll and quiz
	 * 
	 * @param int|ElggUser $user
	 * @return ElggAnnotation | bool 
	 */
	public function getUserAnswer($user = 0) {
		if (!defined('KT_POLLS_ANSWER_NAME')) {
			return FALSE;
		}

		if ($user === 0) {
			$user = get_loggedin_userid();
		}

		if (is_numeric($user)) {
			$user = get_entity($user);
		}

		if (!($user instanceof ElggUser)) {
			return FALSE;
		}

		$annotations = get_annotations($this->getGUID(), 'object', 'kt_poll', KT_POLLS_ANSWER_NAME, NULL, $user->getGUID(), 1);

		if ($annotations) {
			return current($annotations);
		} else {
			return FALSE;
		}
	}
	
	/**
	 * Method to submit a poll and quiz, this is useful for an action
	 * 
	 * @param array $options
	 * 
	 *	user => ID | ElggUser Object
	 * 
	 *	internalname => The field internalname to retrieve the value, this value is autogenerated with the guid and the quiz type
	 * 
	 *	value => The value of the answer, if null then it will get the input from the internalname, by def NULL
	 * 
	 *	access_id => Default annotation access id
	 * 
	 * @return ElggAnnotation
	 * 
	 * @throws Exception 
	 */

	public function submitPollQuiz($options = array()) {
		
		$defaults = array(
			'user' => get_loggedin_userid(),
			'internalname' => $this->getPollQuizInternalname(),
			'value' => NULL,
			'access_id' => ACCESS_LOGGED_IN,
			'poll_context' => get_input('poll_context', 'poll_profile'),
		);

		$options = array_merge($defaults, $options);


		if (is_numeric($options['user'])) {
			$options['user'] = get_entity($options['user']);
		}

		if (!($options['user'] instanceof ElggUser)) {
			throw new Exception(elgg_echo('kt_polls:errors:user:not_valid'));
		}

		if ($this->canSubmitPollQuiz($options['user']) == FALSE) {
			throw new Exception(elgg_echo('kt_polls:errors:user:can_submit'));
		}

		$value = get_input($options['internalname'], FALSE);
		if ($options['value'] !== NULL) {
			$value = $options['value'];
		}

		/**
		 * This validation should be skipped when the user is doing the test
		 */
		if (empty($value) && $options['poll_context'] != 'test_profile') {
			throw new Exception(elgg_echo('kt_polls:errors:annotation:empty_value'));
		}

		if (!defined('KT_POLLS_ANSWER_NAME')) {
			throw new Exception(elgg_echo('kt_polls:errors:annotation:not_defined'));
		}

		$annotation = $this->annotate(KT_POLLS_ANSWER_NAME, $value, $options['access_id'], $options['user']->getGUID());

		if ($annotation == FALSE) {
			throw new Exception(elgg_echo('kt_polls:errors:annotation:not_annotated'));
		}

		return $annotation;
	}
	
	public function retrievePollQuizAnswers() {
		if (!defined('KT_POLLS_ANSWER_NAME')) {
			return FALSE;
		}
		
		
		$annotations = $this->getAnnotations(KT_POLLS_ANSWER_NAME, 999999);
		
		if ($annotations == FALSE && !is_array($annotations)) {
			return FALSE;
		}
		
		$tmp_answers = array();
		foreach($annotations as $key => $answer) {
			$tmp_value = trim(strtolower($answer->value));
			
			if (empty($tmp_value)) { 
				$tmp_key = 'empty';
			} else {
				$tmp_key = $key;
			}
			$tmp_answers[$tmp_key] = $tmp_value;
		}
		
		$tmp_answers = array_count_values($tmp_answers);
		arsort($tmp_answers, SORT_NUMERIC);
		
		return $tmp_answers;
	}
	
	public function getQuestionRightAnswer() {
		$right_answer = $this->question_answer;
		
		if ($this->question_type == 'quiz') {
			$values = $this->getQuizValues();
			$right_answer = $this->question_right_answer;
			
			if (is_numeric($right_answer)) {
				$key = $right_answer - 1;
			} else {
				$key = 0;
			}
			
			if (isset($values[$key])) {
				$right_answer = $values[$key];
			}
		}
		
		return $right_answer;
	}
	
	public function validateAnswer($user = 0) {
		$answer_ob = $this->getUserAnswer($user);
		
		if ($answer_ob) {
			$answer = trim(strtolower($answer_ob->value));
		} else {
			$answer = '';
		}
		$correct_answer = trim(strtolower($this->getQuestionRightAnswer()));
		
		$debug = compact(array('answer_ob', 'answer', 'correct_answer'));
		
		
		$valid_answer = ($answer == $correct_answer);
		
		return $valid_answer;
	}
	
	
	public function addToUserProfile() {
			
			$relationship = KTPOLL_USER_PROFILE_SETTED;
			
			$this->clearPollUserProfile();
			
			$this->addRelationship($this->getOwner(), $relationship);
			
			
			add_to_river("river/object/kt_poll/create", 'create', $this->getOwner(), $this->getGUID(), ACCESS_LOGGED_IN, time());
			
			
	}
	
	public function clearPollUserProfile() {
		$dbprefix = get_config('dbprefix');
		
		$relationship = KTPOLL_USER_PROFILE_SETTED;
		$guid_two = $this->getOwner();
		
		delete_data("DELETE from {$dbprefix}entity_relationships where guid_two={$guid_two} and relationship='{$relationship}' ");
	}
	
	public function retrievePercentageResults($count_total_votes = FALSE) {
		
		$results = $this->retrievePollQuizAnswers();
		$questions = $this->getQuizValues();

		$num_answers = 0;
		
		if (!empty($results)) {
			$num_answers = (int) array_sum($results);
		}
		
		if ($count_total_votes) {
			return $num_answers;
		}

		$complete_results = array();

		foreach ($questions as $question) {
			$tmp_question = trim(strtolower($question));
			$percentage = 0;

			if (array_key_exists($tmp_question, $results)) {
				
				$total_votes = (int) $results[$tmp_question];
				
				if ($total_votes && $num_answers) {
					$percentage = round($total_votes * 100 / $num_answers, 2);
				}
				
			}

			$complete_results[] = array(
				 'label' => $question,
				 'percentage' => $percentage,
			);
		}

		return $complete_results;
	}
	
	public function getDescription() {
		$item_object = new stdClass();
		$item_object->object_guid = $this->getGUID();
		return elgg_view('kt_polls/poll/wrapper', array('item' => $item_object));
	}
	
	public function hideLinkOnListing() {
		return TRUE;
	}

}
