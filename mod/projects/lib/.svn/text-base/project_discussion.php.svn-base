<?php
/**
 * Project_discussion function library
 */

/**
 * List all project_discussion topics
 */
function project_discussion_handle_all_page() {

	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('project_discussion'));

	$content = elgg_list_entities(array(
		'type' => 'object',
		'subtype' => 'projectforumtopic',
		'order_by' => 'e.last_action desc',
		'limit' => 20,
		'full_view' => false,
	));

	$params = array(
		'content' => $content,
		'title' => elgg_echo('project_discussion:latest'),
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List project_discussion topics in a project
 *
 * @param int $guid Project entity GUID
 */
function project_discussion_handle_list_page($guid) {

	elgg_set_page_owner_guid($guid);

	$project = get_entity($guid);
	if (!$project) {
		register_error(elgg_echo('project:notfound'));
		forward();
	}
	elgg_push_breadcrumb($project->name);

	elgg_register_title_button();

	//@KEETUP_MOD: This was modified by keetup to not allow access to group 
	if ($project instanceof ProjectGroup) {
        $project_gatekeeper = project_gatekeeper(false);
//		if (FALSE == $project->canWriteToContainer()){
		if (!$project_gatekeeper){
			forward($project->getURL());
		} 
	}

	$title = elgg_echo('item:object:projectforumtopic');
	
	$options = array(
		'type' => 'object',
		'subtype' => 'projectforumtopic',
		'limit' => 20,
		'order_by' => 'e.last_action desc',
		'container_guid' => $guid,
		'full_view' => false,
	);
	$content = elgg_list_entities($options);
	if (!$content) {
		$content = '<p class="discussionsNone">' . elgg_echo('project_discussion:none') . '</p>';
	}


	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);

	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Edit or add a project_discussion topic
 *
 * @param string $type 'add' or 'edit'
 * @param int    $guid GUID of project or topic
 */
function project_discussion_handle_edit_page($type, $guid) {
	gatekeeper();

	if ($type == 'add') {
		$project = get_entity($guid);
		if (!$project) {
			register_error(elgg_echo('project:notfound'));
			forward();
		}

		// make sure user has permissions to add a topic to container
		if (!$project->canWriteToContainer(0, 'object', 'projectforumtopic')) {
			register_error(elgg_echo('projects:permissions:error'));
			forward($project->getURL());
		}

		$title = elgg_echo('projects:addtopic');

		elgg_push_breadcrumb($project->name, "project_discussion/owner/$project->guid");
		elgg_push_breadcrumb($title);

		$body_vars = project_discussion_prepare_form_vars();
		$content = elgg_view_form('project_discussion/save', array(), $body_vars);
	} else {
		$topic = get_entity($guid);
		if (!$topic || !$topic->canEdit()) {
			register_error(elgg_echo('project_discussion:topic:notfound'));
			forward();
		}
		$project = $topic->getContainerEntity();
		if (!$project) {
			register_error(elgg_echo('project:notfound'));
			forward();
		}

		$title = elgg_echo('projects:edittopic');

		elgg_push_breadcrumb($project->name, "project_discussion/owner/$project->guid");
		elgg_push_breadcrumb($topic->title, $topic->getURL());
		elgg_push_breadcrumb($title);

		$body_vars = project_discussion_prepare_form_vars($topic);
		$content = elgg_view_form('project_discussion/save', array(), $body_vars);
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * View a project_discussion topic
 *
 * @param int $guid GUID of topic
 */
function project_discussion_handle_view_page($guid) {
	// We now have RSS on topics
	global $autofeed;
	$autofeed = true;

	$topic = get_entity($guid);
	if (!$topic) {
		register_error(elgg_echo('noaccess'));
		$_SESSION['last_forward_from'] = current_page_url();
		forward('');
	}

	$project = $topic->getContainerEntity();
	if (!$project) {
		register_error(elgg_echo('project:notfound'));
		forward();
	}

	elgg_set_page_owner_guid($project->getGUID());

	//@KEETUP_MOD: This was modified by keetup to not allow access to group 
	$group = elgg_get_page_owner_entity();
	if ($group instanceof ProjectGroup) {
//		if (FALSE == $group->canWriteToContainer()){
        $project_gatekeeper = project_gatekeeper(false);
		if (!$project_gatekeeper){
			forward($group->getURL());
		} 
	}	

	elgg_push_breadcrumb($project->name, "project_discussion/owner/$project->guid");
	elgg_push_breadcrumb($topic->title);

	$content = elgg_view_entity($topic, array('full_view' => true));
	if ($topic->status == 'closed') {
		$content .= elgg_view('project_discussion/replies', array(
			'entity' => $topic,
			'show_add_form' => false,
		));
		$content .= elgg_view('project_discussion/closed');
	} elseif ($project->canWriteToContainer(0, 'object', 'projectforumtopic') || elgg_is_admin_logged_in()) {
		$content .= elgg_view('project_discussion/replies', array(
			'entity' => $topic,
			'show_add_form' => true,
		));
	} else {
		$content .= elgg_view('project_discussion/replies', array(
			'entity' => $topic,
			'show_add_form' => false,
		));
	}

	$params = array(
		'content' => $content,
		'title' => $topic->title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($topic->title, $body);
}

/**
 * Prepare project_discussion topic form variables
 *
 * @param ElggObject $topic Topic object if editing
 * @return array
 */
function project_discussion_prepare_form_vars($topic = NULL) {
	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'status' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $topic,
	);

	if ($topic) {
		foreach (array_keys($values) as $field) {
			if (isset($topic->$field)) {
				$values[$field] = $topic->$field;
			}
		}
	}

	if (elgg_is_sticky_form('topic')) {
		$sticky_values = elgg_get_sticky_values('topic');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('topic');

	return $values;
}
