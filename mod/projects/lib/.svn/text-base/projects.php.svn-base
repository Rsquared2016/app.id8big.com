<?php

/**
 * Projects function library
 */

/**
 * List all projects
 */
function projects_handle_all_page() {
	$owner_guid = elgg_get_logged_in_user_guid();
	// all projects doesn't get link to self
	elgg_pop_breadcrumb();

	$breadcrumb_url = '';
	if ($owner_guid) {
		$breadcrumb_url = elgg_normalize_url('projects/all?filter=mine');
	}
	elgg_push_breadcrumb(elgg_echo('projects'));

	$selected_tab = get_input('filter', 'all');

	switch ($selected_tab) {
		case 'popular':
			$content = elgg_list_entities_from_relationship_count(array(
				'type' => 'group',
				'subtype' => 'project',
				'relationship' => 'member',
				'inverse_relationship' => false,
				'full_view' => false,
				'list_type' => 'gallery'
			));

//			if (!$content) {
//				$content = elgg_echo('projects:none');
//			}
			break;
		case 'project_discussion':		
			$content = elgg_list_entities(array(
				'type' => 'object',
				'subtype' => 'projectforumtopic',
				'order_by' => 'e.last_action desc',
				'limit' => 40,
				'full_view' => false,
				'list_type' => 'gallery'
			));
			if (!$content) {
				$content = elgg_echo('project_discussion:none');
			}
			break;
		case 'mine':

			if ($owner_guid) {
				$content = elgg_list_entities_from_relationship(array(
					'relationship' => 'member',
					'relationship_guid' => $owner_guid,
					'inverse_relationship' => FALSE,
					'types' => 'group',
					'subtype' => 'project',
					'full_view' => FALSE,
					'list_type' => 'gallery'					
				));
			}
			break;
		case 'newest':
		default:
			$selected_tab = 'all';
			$content = elgg_list_entities(array(
				'type' => 'group',
				'subtype' => 'project',
				'full_view' => false,
				'list_type' => 'gallery'
			));
//			if (!$content) {
//				$content = elgg_echo('projects:none');
//			}
			break;
	}

	if (get_input('dbg_p')) {
		$content = '';
	}

	if ($content) {
		if (elgg_get_plugin_setting('limited_projects', 'projects') != 'yes' || elgg_is_admin_logged_in()) {
			elgg_register_title_button();
		}
	} else {
		$content = elgg_view('page/elements/empty_section', array('filter' => $selected_tab));
	}

	$filter = elgg_view('projects/project_sort_menu', array('selected' => $selected_tab));

	$sidebar = elgg_view('projects/sidebar/find');
	$sidebar .= elgg_view('projects/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => $filter,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page(elgg_echo('projects:all'), $body);
}

function projects_search_page() {
	elgg_push_breadcrumb(elgg_echo('search'));

	$tag = get_input("tag");
	$title = elgg_echo('projects:search:title', array($tag));

	$db_prefix = elgg_get_config('dbprefix');

	// projects plugin saves tags as "interests" - see projects_fields_setup() in start.php
	$params = array(
		'metadata_name' => 'keywords',
		'metadata_value' => $tag,
		'types' => 'group',
		'subtypes' => 'project',
		'full_view' => FALSE,
	);

	$params['joins'] = array();
	$params['wheres'] = array();

	$params['joins'][] = "JOIN {$db_prefix}groups_entity oe on oe.guid = e.guid";
	$params['wheres'][] = "( oe.name LIKE '%{$tag}%' OR oe.description LIKE '%{$tag}%' )";

//	$content = elgg_list_entities_from_metadata($params);
	$content = elgg_list_entities($params);

	if (!$content) {
		$content = elgg_echo('projects:search:none');
	}

	$sidebar = elgg_view('projects/sidebar/find');
	$sidebar .= elgg_view('projects/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => false,
		'title' => $title,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List owned projects
 */
function projects_handle_owned_page() {

	$page_owner = elgg_get_page_owner_entity();

	if ($page_owner->guid == elgg_get_logged_in_user_guid()) {
		$title = elgg_echo('projects:owned');
	} else {
		$title = elgg_echo('projects:owned:user', array($page_owner->name));
	}
	elgg_push_breadcrumb($title);

	elgg_register_title_button();

	$content = elgg_list_entities(array(
		'type' => 'group',
		'subtype' => 'project',
		'owner_guid' => elgg_get_page_owner_guid(),
		'full_view' => false,
	));
	if (!$content) {
		$content = elgg_echo('projects:none');
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
 * List projects the user is memober of
 */
function projects_handle_mine_page() {

	$page_owner = elgg_get_page_owner_entity();

	if ($page_owner->guid == elgg_get_logged_in_user_guid()) {
		$title = elgg_echo('projects:yours');
	} else {
		$title = elgg_echo('projects:user', array($page_owner->name));
	}
	elgg_push_breadcrumb($title);

	elgg_register_title_button();

	$content = elgg_list_entities_from_relationship(array(
		'type' => 'group',
		'subtype' => 'project',
		'relationship' => 'member',
		'relationship_guid' => elgg_get_page_owner_guid(),
		'inverse_relationship' => false,
		'full_view' => false,
	));
	if (!$content) {
		$content = elgg_echo('projects:none');
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
 * Create or edit a project
 *
 * @param string $page
 * @param int $guid
 */
function projects_handle_edit_page($page, $guid = 0) {
	gatekeeper();
	
	if ($page == 'add') {
		elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
		$title = elgg_echo('projects:add');
		elgg_push_breadcrumb($title);
		if (elgg_get_plugin_setting('limited_projects', 'projects') != 'yes' || elgg_is_admin_logged_in()) {
			$content = elgg_view('projects/edit');
		} else {
			$content = elgg_echo('projects:cantcreate');
		}
	} else {
		$title = elgg_echo("projects:edit");
		$project = get_entity($guid);
		elgg_push_context('project_edit');

		if ($project && $project->canEdit()) {
			elgg_set_page_owner_guid($project->getGUID());
			elgg_push_breadcrumb($project->name, $project->getURL());
			elgg_push_breadcrumb($title);
			$content = elgg_view("projects/edit", array('entity' => $project));
		} else {
			$content = elgg_echo('projects:noaccess');
		}
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
 * Project invitations for a user
 */
function projects_handle_invitations_page() {
	gatekeeper();

	$user = elgg_get_page_owner_entity();

	$title = elgg_echo('projects:invitations');
	elgg_push_breadcrumb($title);

	// @todo temporary workaround for exts #287.
	$invitations = projects_get_invited_projects(elgg_get_logged_in_user_guid());
	$content = elgg_view('projects/invitationrequests', array('invitations' => $invitations));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Project profile page
 *
 * @param int $guid Project entity GUID
 */
function projects_handle_profile_page($guid) {
	elgg_set_page_owner_guid($guid);

	// turn this into a core function
	global $autofeed;
	$autofeed = true;

	elgg_push_context('project_profile');

	$project = get_entity($guid);
	if (!$project) {
		forward('projects/all');
	}

	elgg_pop_breadcrumb();
//	elgg_push_breadcrumb($project->name);

	projects_register_profile_buttons($project);

	$content = elgg_view('projects/profile/layout', array('entity' => $project));
	$sidebar = '';

	if (project_gatekeeper(false)) {
		if (elgg_is_active_plugin('search')) {
			$sidebar .= elgg_view('projects/sidebar/search', array('entity' => $project));
		}
//		$sidebar .= elgg_view('projects/sidebar/members', array('entity' => $project));
//		$sidebar .= elgg_view('projects/sidebar/collaborators', array('entity' => $project));
//		$sidebar .= elgg_view('projects/sidebar/visitors', array('entity' => $project));

		$subscribed = false;
		if (elgg_is_active_plugin('notifications')) {
			global $NOTIFICATION_HANDLERS;

			foreach ($NOTIFICATION_HANDLERS as $method => $foo) {
				$relationship = check_entity_relationship(elgg_get_logged_in_user_guid(), 'notify' . $method, $guid);

				if ($relationship) {
					$subscribed = true;
					break;
				}
			}
		}

		$sidebar .= elgg_view('projects/sidebar/my_status', array(
			'entity' => $project,
			'subscribed' => $subscribed
		));
	}

	$header = elgg_view('projects/profile/header', array(
		'entity' => $project
	));

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'title' => $project->name,
		'filter' => '',
		'header' => $header,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($project->name, $body);
}

/**
 * Project project_activity page
 *
 * @param int $guid Project entity GUID
 */
function projects_handle_project_activity_page($guid) {

	elgg_set_page_owner_guid($guid);

	$project = get_entity($guid);
	if (!$project || !elgg_instanceof($project, 'group', 'project', 'ProjectGroup')) {
		forward();
	}
	
	elgg_push_context('project_activity');
	
	project_gatekeeper();

	$title = elgg_echo('projects:project_activity');

	elgg_push_breadcrumb($project->name, $project->getURL());
	elgg_push_breadcrumb($title);

	$db_prefix = elgg_get_config('dbprefix');

	$content = elgg_list_river(array(
		'joins' => array("JOIN {$db_prefix}entities e ON e.guid = rv.object_guid"),
		'wheres' => array("e.container_guid = $guid")
	));
	if (!$content) {
		$content = '<p>' . elgg_echo('projects:project_activity:none') . '</p>';
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
 * Project members page
 *
 * @param int $guid Project entity GUID
 */
function projects_handle_members_page($guid) {

	elgg_set_page_owner_guid($guid);

	$project = get_entity($guid);
	if (!$project || !elgg_instanceof($project, 'group', 'project', 'ProjectGroup')) {
		forward();
	}

	project_gatekeeper();

	$title = elgg_echo('projects:members:title', array($project->name));

	elgg_push_breadcrumb($project->name, $project->getURL());
	elgg_push_breadcrumb(elgg_echo('projects:members'));

	$content = elgg_list_entities_from_relationship(array(
		'relationship' => 'member',
		'relationship_guid' => $project->guid,
		'inverse_relationship' => true,
		'types' => 'user',
		'limit' => 20,
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Project Collaborators page
 *
 * @param int $guid Project entity GUID
 */
function projects_handle_collaborators_page($guid) {

	elgg_set_page_owner_guid($guid);

	$project = get_entity($guid);
	if (!$project || !elgg_instanceof($project, 'group', 'project', 'ProjectGroup')) {
		forward();
	}

	project_gatekeeper();

	elgg_push_context('project_collaborators');
	
	$title = elgg_echo('projects:collaborators:title', array($project->name));

	elgg_push_breadcrumb($project->name, $project->getURL());
	elgg_push_breadcrumb(elgg_echo('projects:collaborators'));

	$content = elgg_list_entities_from_relationship(array(
		'relationship' => 'collaborator',
		'relationship_guid' => $project->guid,
		'inverse_relationship' => true,
		'types' => 'user',
		'limit' => 20,
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Project Collaborators page
 *
 * @param int $guid Project entity GUID
 */
function projects_handle_visitors_page($guid) {

	elgg_set_page_owner_guid($guid);

	$project = get_entity($guid);
	if (!$project || !elgg_instanceof($project, 'group', 'project', 'ProjectGroup')) {
		forward();
	}

	project_gatekeeper();
	
	elgg_push_context('project_visitors');
	
	$title = elgg_echo('projects:invitors:title', array($project->name));

	elgg_push_breadcrumb($project->name, $project->getURL());
	elgg_push_breadcrumb(elgg_echo('projects:visitors'));

	$content = elgg_list_entities_from_relationship(array(
		'relationship' => 'visitor',
		'relationship_guid' => $project->guid,
		'inverse_relationship' => true,
		'types' => 'user',
		'limit' => 20,
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Invite users to a project
 *
 * @param int $guid Project entity GUID
 */
function projects_handle_invite_page($guid) {
	gatekeeper();

	elgg_set_page_owner_guid($guid);

	$project = get_entity($guid);

	$title = elgg_echo('projects:invite:title');

	elgg_push_context('project_invite');
	
	elgg_push_breadcrumb($project->name, $project->getURL());
	elgg_push_breadcrumb(elgg_echo('projects:invite'));

	if ($project && $project->canEdit()) {
		$content = elgg_view_form('projects/invite', array(
			'id' => 'invite_to_project',
			'class' => 'elgg-form-alt mtm',
				), array(
			'entity' => $project,
		));
	} else {
		$content .= elgg_echo('projects:noaccess');
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
 * Manage requests to join a project
 * 
 * @param int $guid Project entity GUID
 */
function projects_handle_requests_page($guid) {

	gatekeeper();

	elgg_set_page_owner_guid($guid);

	$project = get_entity($guid);

	$title = elgg_echo('projects:membershiprequests');

	elgg_push_context('project_requests');
	
	if ($project && $project->canEdit()) {
		elgg_push_breadcrumb($project->name, $project->getURL());
		elgg_push_breadcrumb($title);

		$requests = elgg_get_entities_from_relationship(array(
			'type' => 'user',
			'relationship' => 'membership_request',
			'relationship_guid' => $guid,
			'inverse_relationship' => true,
			'limit' => 0,
		));
		$content = elgg_view('projects/membershiprequests', array(
			'requests' => $requests,
			'entity' => $project,
		));
	} else {
		$content = elgg_echo("projects:noaccess");
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
 * Registers the buttons for title area of the project profile page
 *
 * @param ProjectGroup $project
 */
function projects_register_profile_buttons($project) {

	$actions = array();

	// project owners
	if ($project->canEdit()) {
		// edit and invite
		$url = elgg_get_site_url() . "projects/edit/{$project->getGUID()}";
		$actions[$url] = 'projects:edit';
		$url = elgg_get_site_url() . "projects/invite/{$project->getGUID()}";
		$actions[$url] = 'projects:invite';
		$url = elgg_get_site_url() . "social_import_contacts?project_guid={$project->getGUID()}&provider=Facebook";
		$actions[$url] = 'projects:external_invite';
	}

	// project members
	if ($project->isMember(elgg_get_logged_in_user_entity())) {
		if ($project->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
			// leave
			$url = elgg_get_site_url() . "action/projects/leave?project_guid={$project->getGUID()}";
			$url = elgg_add_action_tokens_to_url($url);
			$actions[$url] = 'projects:leave';
		}
	} elseif (elgg_is_logged_in() && $project->isOpenProject()) {
		// join - admins can always join.
		$url = elgg_get_site_url() . "action/projects/join?project_guid={$project->getGUID()}";
		$url = elgg_add_action_tokens_to_url($url);
		if ($project->isPublicMembership() || $project->canEdit()) {
			$actions[$url] = 'projects:join';
		} else {
			// request membership
			$actions[$url] = 'projects:joinrequest';
		}
	}

	if ($actions) {
		foreach ($actions as $url => $text) {
            $opt = array(
                'name' => $text,
				'href' => $url,
				'text' => elgg_echo($text),
				'link_class' => 'elgg-button elgg-button-action',
            );
            if ($text == 'projects:leave') {
                $opt['confirm'] = elgg_echo('projects:question:areyousure');
            }
			elgg_register_menu_item('title', $opt);
		}
	}
}

/**
 * Prepares variables for the project edit form view.
 *
 * @param mixed $project ProjectGroup or null. If a project, uses values from the project.
 * @return array
 */
function projects_prepare_form_vars($project = null) {
	$values = array(
		'name' => '',
		'membership' => ACCESS_PUBLIC,
		'vis' => ACCESS_PUBLIC,
		'guid' => null,
		'entity' => null
	);

	// handle customizable profile fields
	$fields = elgg_get_config('project');

	if ($fields) {
		foreach ($fields as $name => $type) {
			$values[$name] = '';
		}
	}

	// handle tool options
	$tools = elgg_get_config('group_tool_options');
	if ($tools) {
		foreach ($tools as $project_option) {
			$option_name = $project_option->name . "_enable";
			$values[$option_name] = $project_option->default_on ? 'yes' : 'no';
		}
	}

	// get current project settings
	if ($project) {
		foreach (array_keys($values) as $field) {
			if (isset($project->$field)) {
				$values[$field] = $project->$field;
			}
		}

		if ($project->access_id != ACCESS_PUBLIC && $project->access_id != ACCESS_LOGGED_IN) {
			// project only access - this is done to handle access not created when project is created
			$values['vis'] = ACCESS_PRIVATE;
		}

		$values['entity'] = $project;
	}

	// get any sticky form settings
	if (elgg_is_sticky_form('projects')) {
		$sticky_values = elgg_get_sticky_values('projects');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('projects');

	return $values;
}

function projects_handle_thewire_page($guid) {

	elgg_set_page_owner_guid($guid);

	$project = get_entity($guid);
	if (!$project || !elgg_instanceof($project, 'group', 'project', 'ProjectGroup')) {
		forward();
	}
	if ($project->project_thewire_enable == 'no') {
		forward();
	}
	
	project_gatekeeper();

	elgg_push_context('project_thewire');
	
	$title = elgg_echo('projects:thewire:title');

	elgg_push_breadcrumb($project->name, $project->getURL());
	elgg_push_breadcrumb(elgg_echo('projects:thewire'));

	$content = '';
	
	// Add form thewire
	if ($project->project_thewire_enable == 'yes' && $project->canWriteToContainer()) {
		$form_vars = array('class' => 'thewire-form');
		$thewire_form = elgg_view_form('thewire/add', $form_vars);

		$content .= $thewire_form;
	}
	
	$options = array(
		'type' => 'object',
		'subtype' => 'thewire',
		'container_guid' => $project->getGUID(),
		'limit' => 15,
	);
	$content .= elgg_list_entities($options);

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Page handler for autocomplete endpoint.
 *
 * /livesearch?q=<query>
 *
 * Other options include:
 *     match_on	   string all or array(groups|users|friends)
 *     match_owner int    0/1
 *     limit       int    default is 10
 *
 * @return string JSON string is returned and then exit
 * @access private
 */
function projects_handle_livesearch_page($page) {
	global $CONFIG;

	// only return results to logged in users.
	if (!$user = elgg_get_logged_in_user_entity()) {
		exit;
	}

	if (!$q = get_input('term', get_input('q'))) {
		exit;
	}

	$q = sanitise_string($q);

	// replace mysql vars with escaped strings
	$q = str_replace(array('_', '%'), array('\_', '\%'), $q);

	$match_on = get_input('match_on', 'all');

	if (!is_array($match_on)) {
		$match_on = array($match_on);
	}

	// all = users and groups
	if (in_array('all', $match_on)) {
		$match_on = array('users', 'groups');
	}

	if (get_input('match_owner', false)) {
		$owner_guid = $user->getGUID();
		$owner_where = 'AND e.owner_guid = ' . $user->getGUID();
	} else {
		$owner_guid = null;
		$owner_where = '';
	}

	$limit = sanitise_int(get_input('limit', 10));
	$entity_guid = sanitise_int(get_input('entity_guid', 0));

	$project_group = get_entity($entity_guid);

	if (!($project_group instanceof ProjectGroup)) {
		return NULL;
	}

	$members_users = $project_group->getMembers(FALSE);
	$members_guids = array();

	if ($members_users && is_array($members_users)) {
		foreach ($members_users as $user_item) {
			$user_item_guid = $user_item->getGUID();
			$members_guids[$user_item_guid] = $user_item_guid;
		}
	}

	$not_in_members = implode(',', $members_guids);

	// grab a list of entities and send them in json.
	$results = array();
	foreach ($match_on as $match_type) {
		switch ($match_type) {
			default:
				$query = "SELECT * FROM {$CONFIG->dbprefix}users_entity as ue, {$CONFIG->dbprefix}entities as e
					WHERE (
							e.guid = ue.guid
							AND e.enabled = 'yes'
							AND ue.banned = 'no'
							AND (ue.name LIKE '$q%' OR ue.name LIKE '% $q%' OR ue.username LIKE '$q%')
						) 
						AND e.guid NOT IN ($not_in_members)
					LIMIT $limit
				";

				$entities = get_data($query);

				if ($entities) {
					foreach ($entities as $entity) {
						$entity = get_entity($entity->guid);
						if (!$entity) {
							continue;
						}

						if (in_array('groups', $match_on)) {
							$value = $entity->guid;
						} else {
							$value = $entity->username;
						}

						$output = elgg_view_list_item($entity, array(
							'use_hover' => false,
							'class' => 'elgg-autocomplete-item',
						));

						$icon = elgg_view_entity_icon($entity, 'tiny', array(
							'use_hover' => false,
						));

						$result = array(
							'type' => 'user',
							'name' => $entity->name,
							'desc' => $entity->username,
							'guid' => $entity->guid,
							'label' => $output,
							'value' => $value,
							'icon' => $icon,
							'url' => $entity->getURL(),
						);
						$results[$entity->name . rand(1, 100)] = $result;
					}
				}
				break;
		}

		ksort($results);
		header("Content-Type: application/json");
		echo json_encode(array_values($results));
		exit;
	}
}
