<?php

define('PROJECTS_HIDDEN_GROUPS', TRUE);
define('PROJECTS_DEFAULT_VISIBLE_ACCESS', ACCESS_LOGGED_IN);
define('PROJECTS_GRAPHICS', elgg_get_site_url() . 'mod/projects/graphics/');

/**
 * Elgg projects plugin
 *
 * @package ElggProjects
 */
elgg_register_event_handler('init', 'system', 'projects_init');

// Ensure this runs after other plugins
elgg_register_event_handler('init', 'system', 'projects_fields_setup', 10000);

/**
 * Initialize the projects plugin.
 */
function projects_init() {
	$user = elgg_get_logged_in_user_entity();
	
	elgg_register_library('elgg:projects', elgg_get_plugins_path() . 'projects/lib/projects.php');

	//Custom library to register functions related to projects
	elgg_register_library('elgg:projects_lib', elgg_get_plugins_path() . 'projects/lib/projects_lib.php');
	elgg_load_library('elgg:projects_lib');

	// register project entities for search
	elgg_register_entity_type('group', 'project');
	add_subtype('group', 'project', 'ProjectGroup');


	// Set up the menu
	if ($user) {
		$item = new ElggMenuItem('projects', elgg_echo('projects'), 'projects/all?filter=mine');
	} else {
		$item = new ElggMenuItem('projects', elgg_echo('projects'), 'projects/all');
	}
	
	elgg_register_menu_item('site', $item);

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('projects', 'projects_page_handler');

	// Register URL handlers for projects
	elgg_register_entity_url_handler('group', 'project', 'projects_url');
	elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'projects_icon_url_override', 800);
	
    //Rewrite the write permision into proyect.
    elgg_register_plugin_hook_handler('container_permissions_check', 'all', 'projects_can_write_to_container_hook', 510);
    elgg_register_plugin_hook_handler('permissions_check', 'all', 'projects_can_write_to_entity_hook', 600);
    elgg_register_plugin_hook_handler('permissions_check', 'object', 'projects_pages_write_permission_check', 600);
//	elgg_register_plugin_hook_handler('container_permissions_check', 'object', 'projects_pages_container_permission_check', 600);

	// Register an icon handler for projects
	elgg_register_page_handler('projecticon', 'projects_icon_handler');

	// Register some actions
	$action_base = elgg_get_plugins_path() . 'projects/actions/projects';
	elgg_register_action("projects/edit", "$action_base/edit.php");
	elgg_register_action("projects/delete", "$action_base/delete.php");
	elgg_register_action("projects/featured", "$action_base/featured.php", 'admin');
	elgg_register_action("thewire/add", elgg_get_plugins_path() . 'projects/actions/thewire/add.php');

	$action_base .= '/membership';
	elgg_register_action("projects/invite", "$action_base/invite.php");
	elgg_register_action("projects/join", "$action_base/join.php");
	elgg_register_action("projects/leave", "$action_base/leave.php");
	elgg_register_action("projects/remove", "$action_base/remove.php");
	elgg_register_action("projects/killrequest", "$action_base/delete_request.php");
	elgg_register_action("projects/killinvitation", "$action_base/delete_invite.php");
	elgg_register_action("projects/addtoproject", "$action_base/add.php");
	elgg_register_action("projects/change_relation", "$action_base/change_relation.php");

	// Add some widgets
	elgg_register_widget_type('a_users_projects', elgg_echo('projects:widget:membership'), elgg_echo('projects:widgets:description'));

	// add project project_activity tool option
	add_group_tool_option('project_activity', elgg_echo('projects:enableproject_activity'), true);
	elgg_extend_view('groups/tool_latest', 'projects/profile/project_activity_module');

	// add link to owner block
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'projects_project_activity_owner_block_menu');

	// project entity menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'projects_entity_menu_setup');
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'projects_thewire_entity_menu_setup');

	// project user hover menu	
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'projects_user_entity_menu_setup');

	// delete and edit annotations for topic replies
	elgg_register_plugin_hook_handler('register', 'menu:annotation', 'projects_annotation_menu_setup');

	//extend some views
	elgg_extend_view('css/elgg', 'projects/css');
	elgg_extend_view('js/elgg', 'projects/js');
	elgg_extend_view('css/admin', 'projects/css');
	
	elgg_register_js('elgg.userprojectpicker', 'mod/projects/js/ui.userprojectpicker.js');


	// Register profile menu hook
	elgg_register_plugin_hook_handler('profile_menu', 'profile', 'forum_profile_menu');
	elgg_register_plugin_hook_handler('profile_menu', 'profile', 'project_activity_projects_profile_menu');

	// allow ecml in project_discussion and profiles
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'projects_ecml_views_hook');
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'projectprofile_ecml_views_hook');

	elgg_register_event_handler('pagesetup', 'system', 'projects_setup_sidebar_menus');

	elgg_register_plugin_hook_handler('access:collections:add_user', 'collection', 'projects_access_collection_override');

	project_regsiter_hooks_and_events();
	
	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:profile_groups_tabs', 'project_register_menu_profile_groups_tabs_hook', 600);
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'project_register_menu_entity_hook', 600);
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'projects_register_menu_project_profile_menu_hook');
	elgg_register_plugin_hook_handler('view', 'forms/thewire/add', 'project_view_forms_thewire_add_hook');
	
	// Group Support
	add_group_tool_option('project_thewire', elgg_echo('projects:enableproject_thewire'), true);
	elgg_extend_view('groups/tool_latest', 'projects/profile/project_thewire_module');
	
//	elgg_register_event_handler('project:updated', 'group', 'project_update_entities_permissions');
	elgg_register_plugin_hook_handler('view', 'input/access', 'project_override_input_access_view');
	
//	elgg_register_plugin_hook_handler('view', 'navigation/breadcrumbs', 'projects_view_navigation_breadcrumbs_hook');
	elgg_register_plugin_hook_handler('view', 'page/layouts/content', 'projects_view_page_layouts_content_hook');
	elgg_register_plugin_hook_handler('view', 'page/layouts/content', 'projects_view_page_layouts_add_menu_hook');
	elgg_register_plugin_hook_handler('view', 'page/layouts/one_column', 'projects_view_page_layouts_add_menu_hook');
	elgg_register_plugin_hook_handler('projects:fields', 'profile', 'projects_projects_fields_profile_hook');
	elgg_register_plugin_hook_handler('view', 'groups_custom/navigation/menu/default', 'projects_view_groups_custom_navigation_menu_default_hook');
//	elgg_register_plugin_hook_handler('view', 'navigation/menu/default', 'projects_view_navigation_menu_default_hook');

//	elgg_register_event_handler('upgrade', 'system', 'projects_run_upgrades');
	
	// Welcome Message
//	elgg_register_event_handler('login', 'user', 'projects_login_user_event');
	elgg_extend_view('page/elements/foot', 'projects/welcome_message');
	elgg_load_css('lightbox');
	elgg_load_js('lightbox');
	
	elgg_register_plugin_hook_handler('route', 'thewire', 'projects_route_thewire_hook');
	elgg_register_plugin_hook_handler('route', 'pages', 'projects_route_pages_hook');
	
}

function project_regsiter_hooks_and_events() {
	if (elgg_is_active_plugin('groups')) {
		return FALSE;
	}

	elgg_register_event_handler('leave', 'group', 'projects_user_leave_event_listener');
	elgg_register_event_handler('join', 'group', 'projects_user_join_event_listener');

	// Register a handler for delete projects
	elgg_register_event_handler('delete', 'group', 'projects_delete_event_listener');

	// Register a handler for create projects
	elgg_register_event_handler('create', 'group', 'projects_create_event_listener');

	// Access permissions
	elgg_register_plugin_hook_handler('access:collections:write', 'all', 'projects_write_acl_plugin_hook');
	//elgg_register_plugin_hook_handler('access:collections:read', 'all', 'projects_read_acl_plugin_hook');
}

/**
 * This function loads a set of default fields into the profile, then triggers
 * a hook letting other plugins to edit add and delete fields.
 *
 * Note: This is a system:init event triggered function and is run at a super
 * low priority to guarantee that it is called after all other plugins have
 * initialized.
 */
function projects_fields_setup() {

	$required_fields = array(
		'name',
		'description',
		'project_status',
		'project_type',
	);

	$required_fields = elgg_trigger_plugin_hook('profile:required:fields', 'project', NULL, $required_fields);

	elgg_set_config('project_required_fields', $required_fields);
	
	
	$access_fields = array(
		'keywords' => ACCESS_LOGGED_IN,
		'website' => ACCESS_LOGGED_IN,
		'source_url' => ACCESS_LOGGED_IN,
		'facebook_url' => ACCESS_LOGGED_IN,
		'twitter_url' => ACCESS_LOGGED_IN,
		'linkedin_url' => ACCESS_LOGGED_IN,
		'current_needs' => ACCESS_LOGGED_IN,
		'project_status' => ACCESS_LOGGED_IN,
		'project_type' => ACCESS_LOGGED_IN,
		'leancanvas' => ACCESS_LOGGED_IN,
	);

	$access_fields = elgg_trigger_plugin_hook('profile:access:fields', 'project', NULL, $access_fields);

	elgg_set_config('project_access_fields', $access_fields);


	$profile_defaults = array(
		'description' => 'longtext',
		'keywords' => 'tags',
		'website' => 'url',
		'source_url' => 'url', //GitHub Link
		
		//Social Links
		'facebook_url' => 'url',
		'twitter_url' => 'url',
		'linkedin_url' => 'url',
		//Project fields
		'current_needs' => 'longtext',
		'project_status' => 'project_status',
		'project_type' => 'project_type',
		'leancanvas' => 'project_leancanvas', //LeanCanvas Support
	);

	$profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'project', NULL, $profile_defaults);

	elgg_set_config('project', $profile_defaults);

	// register any tag metadata names
	foreach ($profile_defaults as $name => $type) {
		if ($type == 'tags') {
			elgg_register_tag_metadata_name($name);

			// only shows up in search but why not just set this in en.php as doing it here
			// means you cannot override it in a plugin
			add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("projects:$name")));
		}
	}
}

/**
 * Configure the projects sidebar menu. Triggered on page setup
 *
 */
function projects_setup_sidebar_menus() {

	// Get the page owner entity
	$page_owner = elgg_get_page_owner_entity();

	if (elgg_in_context('project_profile')) {
		if (elgg_is_logged_in() && $page_owner->canEdit() && !$page_owner->isPublicMembership()) {
			$url = elgg_get_site_url() . "projects/requests/{$page_owner->getGUID()}";
			
			$page_owner_guid = $page_owner->getGUID();
			
			$count = elgg_get_entities_from_relationship(array(
				'type' => 'user',
				'relationship' => 'membership_request',
				'relationship_guid' => $page_owner_guid,
				'inverse_relationship' => true,
				'count' => true,
					));

			if ($count) {
				$text = elgg_echo('projects:membershiprequests:pending', array($count));
			} else {
				$text = elgg_echo('projects:membershiprequests');
			}

			elgg_register_menu_item('title', array(
				'name' => 'membership_requests',
				'text' => $text,
				'href' => $url,
			));
		}
	}
	if (elgg_get_context() == 'projects' && !elgg_instanceof($page_owner, 'group', 'project', 'ProjectGroup')) {
//		elgg_register_menu_item('page', array(
//			'name' => 'projects:all',
//			'text' => elgg_echo('projects:all'),
//			'href' => 'projects/all',
//		));

		$user = elgg_get_logged_in_user_entity();
		if ($user) {
			$url = "projects/owner/$user->username";
			$item = new ElggMenuItem('projects:owned', elgg_echo('projects:owned'), $url);
			elgg_register_menu_item('page', $item);

//			$url = "projects/member/$user->username";
//			$item = new ElggMenuItem('projects:member', elgg_echo('projects:yours'), $url);
//			elgg_register_menu_item('page', $item);

			$url = "projects/invitations/$user->username";
			$invitations = projects_get_invited_projects($user->getGUID());
			if (is_array($invitations) && !empty($invitations)) {
				$invitation_count = count($invitations);
				$text = elgg_echo('projects:invitations:pending', array($invitation_count));
			} else {
				$text = elgg_echo('projects:invitations');
			}

			$item = new ElggMenuItem('projects:user:invites', $text, $url);
			elgg_register_menu_item('page', $item);
		}
	}
	
	if (elgg_get_context() == "settings" && elgg_get_logged_in_user_guid()) {

		$user = elgg_get_page_owner_entity();
		if (!$user) {
			$user = elgg_get_logged_in_user_entity();
		}

		$params = array(
			'name' => '2_a_user_notify',
			'text' => elgg_echo('notifications:subscriptions:changesettings'),
			'href' => "notifications/personal/{$user->username}",
		);
		elgg_register_menu_item('page', $params);
		
		$params = array(
			'name' => '2_group_notify',
			'text' => elgg_echo('notifications:subscriptions:changesettings:groups'),
			'href' => "notifications/group/{$user->username}",
		);
		elgg_register_menu_item('page', $params);
	}
}

/**
 * Projects page handler
 *
 * URLs take the form of
 *  All projects:           projects/all
 *  User's owned projects:  projects/owner/<username>
 *  User's member projects: projects/member/<username>
 *  Project profile:        projects/profile/<guid>/<title>
 *  New project:            projects/add/<guid>
 *  Edit project:           projects/edit/<guid>
 *  Project invitations:    projects/invitations/<username>
 *  Invite to project:      projects/invite/<guid>
 *  Membership requests:  projects/requests/<guid>
 *  Project project_activity:       projects/project_activity/<guid>
 *  Project members:        projects/members/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function projects_page_handler($page) {

	// forward old profile urls
	if (is_numeric($page[0])) {
		$project = get_entity($page[0]);
		if (elgg_instanceof($project, 'group', 'project', 'ProjectGroup')) {
			system_message(elgg_echo('changebookmark'));
			forward($project->getURL());
		}
	}

	elgg_load_library('elgg:projects');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	if (elgg_is_logged_in()) {
		elgg_push_breadcrumb(elgg_echo('projects'), "projects/all?filter=mine");
	} else {
		elgg_push_breadcrumb(elgg_echo('projects'), "projects/all");
	}

	switch ($page[0]) {
		case 'all':
			projects_handle_all_page();
			break;
		case 'search':
			projects_search_page();
			break;
		case 'owner':
			projects_handle_owned_page();
			break;
		case 'member':
			set_input('username', $page[1]);
			projects_handle_mine_page();
			break;
		case 'invitations':
			set_input('username', $page[1]);
			projects_handle_invitations_page();
			break;
		case 'add':
			projects_handle_edit_page('add');
			break;
		case 'edit':
			projects_handle_edit_page('edit', $page[1]);
			break;
		case 'profile':
			projects_handle_profile_page($page[1]);
			break;
		case 'project_activity':
			projects_handle_project_activity_page($page[1]);
			break;
		case 'members':
			projects_handle_members_page($page[1]);
			break;
		case 'collaborators':
            projects_handle_collaborators_page($page[1]);
			break;
		case 'invited_people':
			projects_handle_visitors_page($page[1]);
			break;
		case 'invite':
			projects_handle_invite_page($page[1]);
			break;
		case 'requests':
			projects_handle_requests_page($page[1]);
			break;
		
		case 'thewire':
			projects_handle_thewire_page($page[1]);
			break;
		
		case 'livesearch':
			projects_handle_livesearch_page($page);
			break;
		default:
			return false;
	}
	return true;
}

/**
 * Handle project icons.
 *
 * @param array $page
 * @return void
 */
function projects_icon_handler($page) {

	// The username should be the file we're getting
	if (isset($page[0])) {
		set_input('project_guid', $page[0]);
	}
	if (isset($page[1])) {
		set_input('size', $page[1]);
	}
	// Include the standard profile index
	$plugin_dir = elgg_get_plugins_path();
	include("$plugin_dir/projects/icon.php");
	return true;
}

/**
 * Populates the ->getUrl() method for project objects
 *
 * @param ElggEntity $entity File entity
 * @return string File URL
 */
function projects_url($entity) {
	$title = elgg_get_friendly_title($entity->name);

	return "projects/profile/{$entity->guid}/$title";
}

/**
 * Override the default entity icon for projects
 *
 * @return string Relative URL
 */
function projects_icon_url_override($hook, $type, $returnvalue, $params) {
	/* @var ProjectGroup $project */
	$project = $params['entity'];
	$size = $params['size'];

	if ($project instanceof ProjectGroup) {

		$icontime = $project->icontime;
		// handle missing metadata (pre 1.7 installations)
		if (null === $icontime) {
			$file = new ElggFile();
			$file->owner_guid = $project->owner_guid;
			$file->setFilename("projects/" . $project->guid . "large.jpg");
			$icontime = $file->exists() ? time() : 0;
			create_metadata($project->guid, 'icontime', $icontime, 'integer', $project->owner_guid, ACCESS_PUBLIC);
		}
		if ($icontime) {
			// return thumbnail
			return "projecticon/$project->guid/$size/$icontime.jpg";
		}

		return "mod/projects/graphics/default{$size}.gif";
	}
}


/**
 * Override the default write permission of content
 *
 * @return string Relative URL
 */
function projects_can_write_to_container_hook($hook, $type, $returnvalue, $params) {
	/* @var ProjectGroup $project */
	$project = elgg_extract('container', $params);
	$user = elgg_extract('user', $params);
	
    if (($project instanceof ProjectGroup) && ($user instanceof ElggUser)) {
		
        $is_member = $project->isMember($user);
		
        if ($is_member) {
			
            $member_type = $project->getMemberType($user->getGUID());
			
			switch($member_type) {
				case ProjectSettings::REL_VISITOR:
					return FALSE;
				break;
			}
            
        }
		
	}
    
    return $returnvalue;
}


function projects_can_write_to_entity_hook($hook, $type, $returnvalue, $params) {
	$entity = elgg_extract('entity', $params);
	$user = elgg_extract('user', $params);
	
	if ($entity instanceof ElggGroup) {
		return $returnvalue;
	}
	
	
	if (($entity instanceof ElggEntity) && ($user instanceof ElggUser)) { 
		$container_entity = $entity->getContainerEntity();
		
		$old_access = elgg_set_ignore_access(TRUE);
		$invisible_project = $entity->getContainerEntity();
		elgg_set_ignore_access($old_access);
		
		if (($invisible_project instanceof ProjectGroup) && $container_entity == FALSE) {
			return FALSE;
		}
		
		if ( ($invisible_project instanceof ProjectGroup) && ($invisible_project->isMember($user) == FALSE && !elgg_is_admin_logged_in()) ) {
			return FALSE;
		}
		
	}
	
	return $returnvalue;
}


/**
 * Add owner block link
 */
function projects_project_activity_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'group', 'project', 'ProjectGroup')) {
		if ($params['entity']->project_activity_enable != "no") {
			$url = "projects/project_activity/{$params['entity']->guid}";
			$item = new ElggMenuItem('project_activity', elgg_echo('projects:project_activity'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add links/info to entity menu particular to project entities
 */
function projects_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'projects') {
		return $return;
	}

	foreach ($return as $index => $item) {
		if (in_array($item->getName(), array('access', 'likes', 'edit', 'delete'))) {
			unset($return[$index]);
		}
	}

	// membership type
	$membership = $entity->membership;
	if ($membership == ACCESS_PUBLIC) {
		$mem = elgg_echo("projects:open");
	} else {
		$mem = elgg_echo("projects:closed");
	}
	$options = array(
		'name' => 'membership',
		'text' => $mem,
		'href' => false,
		'priority' => 100,
	);
	$return[] = ElggMenuItem::factory($options);

	// number of members
	$num_members = get_group_members($entity->guid, 10, 0, 0, true);
	$members_string = elgg_echo('projects:member');
	$options = array(
		'name' => 'members',
		'text' => $num_members . ' ' . $members_string,
		'href' => false,
		'priority' => 200,
	);
	$return[] = ElggMenuItem::factory($options);

	// feature link
	if (elgg_is_admin_logged_in()) {
		if ($entity->featured_project == "yes") {
			$url = "action/projects/featured?project_guid={$entity->guid}&action_type=unfeature";
			$wording = elgg_echo("projects:makeunfeatured");
		} else {
			$url = "action/projects/featured?project_guid={$entity->guid}&action_type=feature";
			$wording = elgg_echo("projects:makefeatured");
		}
		$options = array(
			'name' => 'feature',
			'text' => $wording,
			'href' => $url,
			'priority' => 300,
			'is_action' => true
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}

/**
 * Add a remove user link to user hover menu when the page owner is a project
 */
function projects_user_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		$project = elgg_get_page_owner_entity();

		// Check for valid project
		if (!($project instanceof ProjectGroup)) {
			return $return;
		}

		$entity = $params['entity'];

		// Make sure we have a user and that user is a member of the project
		if (!elgg_instanceof($entity, 'user') || !$project->isMember($entity)) {
			return $return;
		}
		
		$member_type = $project->getMemberType($entity->getGUID());

		
		$can_remove = ($project->canEdit() && $project->getOwnerGUID() != $entity->guid);
		$can_collaborator_remove = (($project->getMemberType(elgg_get_logged_in_user_guid()) == ProjectSettings::REL_COLLABORATOR) && $member_type == ProjectSettings::REL_VISITOR);
		
		if ($can_remove == FALSE && $can_collaborator_remove == TRUE) {
			$can_remove = TRUE;
		}
		
		// Add remove link if we can edit the project, and if we're not trying to remove the project owner
		if ($can_remove) {
			$href = "action/projects/remove?user_guid={$entity->guid}&project_guid={$project->guid}";
			$href = elgg_add_action_tokens_to_url($href);

			$options = array(
				'name' => 'removeuser',
				'text' => elgg_echo('projects:removeuser'),
				'href' => $href,
				'priority' => 999,
				'link_class' => 'gdrive-auth',
				'confirm' => elgg_echo('projects:removeconfirm'),
			);
			$return[] = ElggMenuItem::factory($options);
		}
        
        if ($project->canEdit() && $entity->guid != elgg_get_logged_in_user_guid()) {
            if ($member_type == ProjectSettings::REL_VISITOR || $member_type == ProjectSettings::REL_COLLABORATOR) {
                $href = "action/projects/change_relation?user_guid={$entity->guid}&project_guid={$project->guid}&relationship={$member_type}";
                $href = elgg_add_action_tokens_to_url($href);

                $options = array(
                    'name' => 'change_relation',
                    'text' => elgg_echo("projects:change:from:$member_type"),
                    'href' => $href,
                    'priority' => 999,
                    'link_class' => 'gdrive-auth',
                    'confirm' => elgg_echo("projects:change:from:$member_type:confirm"),
                );
                $return[] = ElggMenuItem::factory($options);
            } 
        }
	
	}
	
	return $return;
}

/**
 * Add edit and delete links for forum replies
 */
function projects_annotation_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$annotation = $params['annotation'];

	if ($annotation->name != 'project_topic_post') {
		return $return;
	}

	if ($annotation->canEdit()) {
		$url = elgg_http_add_url_query_elements('action/project_discussion/reply/delete', array(
			'annotation_id' => $annotation->id,
				));

		$options = array(
			'name' => 'delete',
			'href' => $url,
			'text' => "<span class=\"elgg-icon elgg-icon-delete\"></span>",
			'confirm' => elgg_echo('deleteconfirm'),
			'encode_text' => false
		);
		$return[] = ElggMenuItem::factory($options);

		$url = elgg_http_add_url_query_elements('project_discussion', array(
			'annotation_id' => $annotation->id,
				));

		$options = array(
			'name' => 'edit',
			'href' => "#edit-annotation-$annotation->id",
			'text' => elgg_echo('edit'),
			'encode_text' => false,
			'rel' => 'toggle',
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}

/**
 * Projects created so create an access list for it
 */
function projects_create_event_listener($event, $object_type, $object) {
	$ac_name = elgg_echo('projects:project') . ": " . $object->name;
	$project_id = create_access_collection($ac_name, $object->guid);
	if ($project_id) {
		$object->group_acl = $project_id;
	} else {
		// delete project if access creation fails
		return false;
	}

	return true;
}

/**
 * Hook to listen to read access control requests and return all the projects you are a member of.
 */
function projects_read_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	//error_log("READ: " . var_export($returnvalue));
	$user = elgg_get_logged_in_user_entity();
	if ($user) {
		// Not using this because of recursion.
		// Joining a project automatically add user to ACL,
		// So just see if they're a member of the ACL.
		//$membership = get_users_membership($user->guid);

		$members = get_members_of_access_collection($project->group_acl);
		print_r($members);
		exit;

		if ($membership) {
			foreach ($membership as $project)
				$returnvalue[$user->guid][$project->group_acl] = elgg_echo('projects:project') . ": " . $project->name;
			return $returnvalue;
		}
	}
}

/**
 * Return the write access for the current project if the user has write access to it.
 */
function projects_write_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	$page_owner = elgg_get_page_owner_entity();
	$user_guid = $params['user_id'];
	$user = get_entity($user_guid);
	if (!$user) {
		return $returnvalue;
	}

	// only insert project access for current project
	if ($page_owner instanceof ProjectGroup) {
		if ($page_owner->canWriteToContainer($user_guid)) {
			$returnvalue[$page_owner->group_acl] = elgg_echo('projects:project') . ': ' . $page_owner->name;

			unset($returnvalue[ACCESS_FRIENDS]);
		}
	} else {
		// if the user owns the project, remove all access collections manually
		// this won't be a problem once the project itself owns the acl.
		$projects = elgg_get_entities_from_relationship(array(
			'relationship' => 'member',
			'relationship_guid' => $user_guid,
			'inverse_relationship' => FALSE,
			'limit' => 999
				));

		if ($projects) {
			foreach ($projects as $project) {
				unset($returnvalue[$project->group_acl]);
			}
		}
	}

	return $returnvalue;
}

/**
 * Projects deleted, so remove access lists.
 */
function projects_delete_event_listener($event, $object_type, $object) {
	delete_access_collection($object->group_acl);

	return true;
}

/**
 * Listens to a project join event and adds a user to the project's access control
 *
 */
function projects_user_join_event_listener($event, $object_type, $object) {

	$project = $object['group'];
	$user = $object['user'];
	$acl = $project->group_acl;

	add_user_to_access_collection($user->guid, $acl);

	return true;
}

/**
 * Make sure users are added to the access collection
 */
function projects_access_collection_override($hook, $entity_type, $returnvalue, $params) {
	if (isset($params['collection'])) {
		if (elgg_instanceof(get_entity($params['collection']->owner_guid), 'group', 'project', 'ProjectGroup')) {
			return true;
		}
	}
}

/**
 * Listens to a project leave event and removes a user from the project's access control
 *
 */
function projects_user_leave_event_listener($event, $object_type, $object) {

	$project = $object['group'];
	$user = $object['user'];
	$acl = $project->group_acl;

	remove_user_from_access_collection($user->guid, $acl);

	return true;
}

/**
 * Grabs projects by invitations
 * Have to override all access until there's a way override access to getter functions.
 *
 * @param int  $user_guid    The user's guid
 * @param bool $return_guids Return guids rather than ProjectGroup objects
 *
 * @return array ElggProjects or guids depending on $return_guids
 */
function projects_get_invited_projects($user_guid, $return_guids = FALSE) {
	$ia = elgg_set_ignore_access(TRUE);
	$projects = elgg_get_entities_from_relationship(array(
		'relationship' => 'invited',
		'type' => 'group',
		'subtype' => 'project',
		'relationship_guid' => $user_guid,
		'inverse_relationship' => TRUE,
		'limit' => 0,
			));
	elgg_set_ignore_access($ia);

	if ($return_guids) {
		$guids = array();
		foreach ($projects as $project) {
			$guids[] = $project->getGUID();
		}

		return $guids;
	}

	return $projects;
}

/**
 * Join a user to a project, add river event, clean-up invitations
 *
 * @param ProjectGroup $project
 * @param ElggUser  $user
 * @return bool
 */
function projects_join_project($project, $user) {

	// access ignore so user can be added to access collection of invisible project
	$ia = elgg_set_ignore_access(TRUE);
	$result = $project->join($user);
	elgg_set_ignore_access($ia);

	if ($result) {
		// flush user's access info so the collection is added
		get_access_list($user->guid, 0, true);

		// Remove any invite or join request flags
		remove_entity_relationship($project->guid, 'invited', $user->guid);
		remove_entity_relationship($user->guid, 'membership_request', $project->guid);
		
		$invitation_type = $project->getInvitedType();
		if ($invitation_type) {
			remove_entity_relationship($user->guid, $invitation_type, $project->guid);
		}

		add_to_river('river/relationship/member/create', 'join', $user->guid, $project->guid);

		return true;
	}

	return false;
}

/**
 * Function to use on projects for access. It will house private, loggedin, public,
 * and the project itself. This is when you don't want other projects or access lists
 * in the access options available.
 *
 * @return array
 */
function project_access_options($project) {
	$access_array = array(
		ACCESS_PRIVATE => 'private',
		ACCESS_LOGGED_IN => 'logged in users',
		ACCESS_PUBLIC => 'public',
		$project->group_acl => elgg_echo('projects:acl', array($project->name)),
	);
	return $access_array;
}

function project_activity_projects_profile_menu($hook, $entity_type, $return_value, $params) {

	if ($params['owner'] instanceof ProjectGroup) {
		$return_value[] = array(
			'text' => elgg_echo('Project_activity'),
			'href' => "projects/project_activity/{$params['owner']->getGUID()}"
		);
	}
	return $return_value;
}

/**
 * Parse ECML on project project_discussion views
 */
function projects_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['forum/viewposts'] = elgg_echo('projects:ecml:project_discussion');

	return $return_value;
}

/**
 * Parse ECML on project profiles
 */
function projectprofile_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['projects/projectprofile'] = elgg_echo('projects:ecml:projectprofile');

	return $return_value;
}

/**
 * Project_discussion
 *
 */
elgg_register_event_handler('init', 'system', 'project_discussion_init');

/**
 * Initialize the project_discussion component
 */
function project_discussion_init() {

	elgg_register_library('elgg:project_discussion', elgg_get_plugins_path() . 'projects/lib/project_discussion.php');

	elgg_register_page_handler('project_discussion', 'project_discussion_page_handler');
	elgg_register_page_handler('forum', 'project_discussion_forum_page_handler');

	elgg_register_entity_url_handler('object', 'projectforumtopic', 'project_discussion_override_topic_url');

	// commenting not allowed on project_discussion topics (use a different annotation)
	elgg_register_plugin_hook_handler('permissions_check:comment', 'object', 'project_discussion_comment_override');

	$action_base = elgg_get_plugins_path() . 'projects/actions/project_discussion';
	elgg_register_action('project_discussion/save', "$action_base/save.php");
	elgg_register_action('project_discussion/delete', "$action_base/delete.php");
	elgg_register_action('project_discussion/reply/save', "$action_base/reply/save.php");
	elgg_register_action('project_discussion/reply/delete', "$action_base/reply/delete.php");

	// add link to owner block
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'project_discussion_owner_block_menu');

	// Register for search.
	elgg_register_entity_type('object', 'projectforumtopic');

	// because replies are not comments, need of our menu item
	elgg_register_plugin_hook_handler('register', 'menu:river', 'project_discussion_add_to_river_menu');

	add_group_tool_option('forum', elgg_echo('projects:enableforum'), TRUE);
	elgg_extend_view('groups/tool_latest', 'project_discussion/project_module');

	// notifications
	register_notification_object('object', 'projectforumtopic', elgg_echo('project_discussion:notification:topic:subject'));
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'projectforumtopic_notify_message');
	elgg_register_event_handler('create', 'annotation', 'project_discussion_reply_notifications');
	elgg_register_plugin_hook_handler('notify:annotation:message', 'project_topic_post', 'project_discussion_create_reply_notification');
}

/**
 * Exists for backwards compatibility for Elgg 1.7
 */
function project_discussion_forum_page_handler($page) {
	switch ($page[0]) {
		case 'topic':
			header('Status: 301 Moved Permanently');
			forward("/project_discussion/view/{$page[1]}/{$page[2]}");
			break;
		default:
			return false;
	}
}

/**
 * Project_discussion page handler
 *
 * URLs take the form of
 *  All topics in site:    project_discussion/all
 *  List topics in forum:  project_discussion/owner/<guid>
 *  View project_discussion topic: project_discussion/view/<guid>
 *  Add project_discussion topic:  project_discussion/add/<guid>
 *  Edit project_discussion topic: project_discussion/edit/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function project_discussion_page_handler($page) {

	elgg_load_library('elgg:project_discussion');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	if (elgg_is_logged_in()) {
		elgg_push_breadcrumb(elgg_echo('project_discussion'), 'project_discussion/all?filter=all');
	} else {
		elgg_push_breadcrumb(elgg_echo('project_discussion'), 'project_discussion/all');
	}

	switch ($page[0]) {
		case 'all':
			project_discussion_handle_all_page();
			break;
		case 'owner':
			project_discussion_handle_list_page($page[1]);
			break;
		case 'add':
			project_discussion_handle_edit_page('add', $page[1]);
			break;
		case 'edit':
			project_discussion_handle_edit_page('edit', $page[1]);
			break;
		case 'view':
			project_discussion_handle_view_page($page[1]);
			break;
		default:
			return false;
	}
	return true;
}

/**
 * Function to change the permissions to river items, annotations and object of the group while changing of permissions to invisible
 * 
 * @param string $event
 * @param string $type
 * @param ProjectGroup $object
 */
function project_update_entities_permissions($event, $type, $object) {
	$check_event = ($event == 'project:updated');
	$check_type = ($type == 'group');
	$check_object = ($object instanceof ProjectGroup);
	$change_permissions = get_input('project_change_permissions', FALSE);

	if ($check_event && $check_type && $check_object && $change_permissions) {
		$object->updateEntitiesPermissions();
	}
}

function project_override_input_access_view($hook, $type, $return, $params) {
	$view = elgg_extract('view', $params);
	$vars = elgg_extract('vars', $params);
	$viewtype = elgg_extract('viewtype', $params);
	
	$handler = get_input('handler');
	
	if ($view == 'input/access' && $viewtype == 'default' && $handler != 'projects') {
		$container_entity = elgg_get_page_owner_entity();
		if ($container_entity instanceof ProjectGroup) {
			$vars['entity'] = $container_entity;
			return elgg_view('input/project_container_access', $vars);
		}
	}
	
	return $return;
	
}

/**
 * Override the project_discussion topic url
 *
 * @param ElggObject $entity Project_discussion topic
 * @return string
 */
function project_discussion_override_topic_url($entity) {
	return 'project_discussion/view/' . $entity->guid . '/' . elgg_get_friendly_title($entity->title);
}

/**
 * We don't want people commenting on topics in the river
 */
function project_discussion_comment_override($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'object', 'projectforumtopic')) {
		return false;
	}
}

/**
 * Add owner block link
 */
function project_discussion_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'group', 'project', 'ProjectGroup')) {
		if ($params['entity']->forum_enable != "no") {
			$url = "project_discussion/owner/{$params['entity']->guid}";
			$item = new ElggMenuItem('project_discussion', elgg_echo('project_discussion:project'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add the reply button for the river
 */
function project_discussion_add_to_river_menu($hook, $type, $return, $params) {
	if (elgg_is_logged_in() && !elgg_in_context('widgets')) {
		$item = $params['item'];
		$object = $item->getObjectEntity();
		if (elgg_instanceof($object, 'object', 'projectforumtopic')) {
			if ($item->annotation_id == 0) {
				$project = $object->getContainerEntity();
				if ($project && ($project->canWriteToContainer() || elgg_is_admin_logged_in())) {
					$options = array(
						'name' => 'reply',
						'href' => "#projects-reply-$object->guid",
						'text' => elgg_view_icon('speech-bubble'),
						'title' => elgg_echo('reply:this'),
						'rel' => 'toggle',
						'priority' => 50,
					);
					$return[] = ElggMenuItem::factory($options);
				}
			}
		}
	}

	return $return;
}

/**
 * Create project_discussion notification body
 *
 * @todo namespace method with 'project_discussion'
 *
 * @param string $hook
 * @param string $type
 * @param string $message
 * @param array  $params
 */
function projectforumtopic_notify_message($hook, $type, $message, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];

	if (($entity instanceof ElggEntity) && ($entity->getSubtype() == 'projectforumtopic')) {
		$descr = $entity->description;
		$title = $entity->title;
		$url = $entity->getURL();
		$owner = $entity->getOwnerEntity();
		$project = $entity->getContainerEntity();

		return elgg_echo('projects:notification', array(
					$owner->name,
					$project->name,
					$entity->title,
					$entity->description,
					$entity->getURL()
				));
	}

	return null;
}

/**
 * Create project_discussion reply notification body
 *
 * @param string $hook
 * @param string $type
 * @param string $message
 * @param array  $params
 */
function project_discussion_create_reply_notification($hook, $type, $message, $params) {
	$reply = $params['annotation'];
	$method = $params['method'];
	$topic = $reply->getEntity();
	$poster = $reply->getOwnerEntity();
	$project = $topic->getContainerEntity();

	return elgg_echo('project_discussion:notification:reply:body', array(
				$poster->name,
				$topic->title,
				$project->name,
				$reply->value,
				$topic->getURL(),
			));
}

/**
 * Catch reply to project_discussion topic and generate notifications
 *
 * @todo this will be replaced in Elgg 1.9 and is a clone of object_notifications()
 *
 * @param string         $event
 * @param string         $type
 * @param ElggAnnotation $annotation
 * @return void
 */
function project_discussion_reply_notifications($event, $type, $annotation) {
	global $CONFIG, $NOTIFICATION_HANDLERS;

	if ($annotation->name !== 'project_topic_post') {
		return;
	}

	// Have we registered notifications for this type of entity?
	$object_type = 'object';
	$object_subtype = 'projectforumtopic';

	$topic = $annotation->getEntity();
	if (!$topic) {
		return;
	}

	$poster = $annotation->getOwnerEntity();
	if (!$poster) {
		return;
	}

	if (isset($CONFIG->register_objects[$object_type][$object_subtype])) {
		$subject = $CONFIG->register_objects[$object_type][$object_subtype];
		$string = $subject . ": " . $topic->getURL();

		// Get users interested in content from this person and notify them
		// (Person defined by container_guid so we can also subscribe to projects if we want)
		foreach ($NOTIFICATION_HANDLERS as $method => $foo) {
			$interested_users = elgg_get_entities_from_relationship(array(
				'relationship' => 'notify' . $method,
				'relationship_guid' => $topic->getContainerGUID(),
				'inverse_relationship' => true,
				'types' => 'user',
				'limit' => 0,
					));

			if ($interested_users && is_array($interested_users)) {
				foreach ($interested_users as $user) {
					if ($user instanceof ElggUser && !$user->isBanned()) {
						if (($user->guid != $poster->guid) && has_access_to_entity($topic, $user) && $topic->access_id != ACCESS_PRIVATE) {
							$body = elgg_trigger_plugin_hook('notify:annotation:message', $annotation->getSubtype(), array(
								'annotation' => $annotation,
								'to_entity' => $user,
								'method' => $method), $string);
							if (empty($body) && $body !== false) {
								$body = $string;
							}
							if ($body !== false) {
								notify_user($user->guid, $topic->getContainerGUID(), $subject, $body, null, array($method));
							}
						}
					}
				}
			}
		}
	}
}

/**
 * A simple function to see who can edit a project project_discussion post
 * @param the comment $entity
 * @param user who owns the project $project_owner
 * @return boolean
 */
function projects_can_edit_project_discussion($entity, $project_owner) {

	//logged in user
	$user = elgg_get_logged_in_user_guid();

	if (($entity->owner_guid == $user) || $project_owner == $user || elgg_is_admin_logged_in()) {
		return true;
	} else {
		return false;
	}
}

/**
 * Process upgrades for the projects plugin
 */
function projects_run_upgrades() {
	$path = elgg_get_plugins_path() . 'projects/upgrades/';
	$files = elgg_get_upgrade_files($path);
	foreach ($files as $file) {
		include "$path{$file}";
	}
}

function project_register_menu_profile_groups_tabs_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:profile_groups_tabs');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		
		if (elgg_instanceof($page_owner, 'group', 'project')) {
			foreach($return as $key => $menu_item) {
				$name = $menu_item->getName();
				if ($name == 'project_activity') {
					$menu_item->setPriority(500);
				}
				elseif ($name == 'project_thewire') {
					$menu_item->setPriority(500);
				}
			}
//			$name = 'thewire';
//			$text = elgg_echo('project:tabs:thewire');
//			$href = $page_owner->getURL() . '?filter=thewire';
//			$menu_item = new ElggMenuItem($name, $text, $href);
//			$menu_item->setPriority(500);
//			$return[] = $menu_item;
		}
	}
	
	return $return;
	
}

function project_register_menu_entity_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:entity');
	
	if ($check_hook && $check_type) {
//		$handler = elgg_extract('handler', $params, false);
//		if ($handler != 'thewire') {
//			return $return;
//		}
		
		$entity = $params['entity'];
		
		$in_context = elgg_in_context('thewire_widgets');
		$delete_items = array(
			'likes',
			'delete',
			'reply',
			'previous',
		);
		foreach ($return as $index => $item) {
			$name = $item->getName();
			if (in_array($name, $delete_items) && $in_context) {
				unset($return[$index]);
			}
			if ($name == 'reply' && $entity instanceof ElggWire) {
				$container = $entity->getContainerEntity();
				if (elgg_instanceof($container, 'group', 'project')) {
					if (!$container->isMember()) {
						unset($return[$index]);
					}
				}
			}
			if ($name == 'access') {
				$container = $entity->getContainerEntity();
				if ($container instanceof ProjectGroup) {
					$text = elgg_echo('project:menu:entity:access', array($container->name));
					$item->setText($text);
				}
			}
		}
	}
	
	return $return;
	
}

function project_view_forms_thewire_add_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'forms/thewire/add');
	
	if ($check_hook && $check_type) {
		if (isset($params['vars'])) {
			$vars = $params['vars'];
			$page_owner = elgg_get_page_owner_entity();
			
			if (elgg_instanceof($page_owner, 'group', 'project')) {
				$return .= elgg_view('input/hidden', array(
					'name' => 'container_guid',
					'value' => $page_owner->getGUID(),
				));
				
			}
		}
	}
	
	return $return;
	
}

function project_thewire_save_post($text, $userid, $container_id, $access_id, $parent_guid = 0, $method = "site") {
	$post = new ElggObject();

	$post->subtype = "thewire";
	$post->owner_guid = $userid;
	$post->access_id = $access_id;
	$post->container_guid = $container_id;

	// only 200 characters allowed
	$text = elgg_substr($text, 0, 200);

	// no html tags allowed so we escape
	$post->description = htmlspecialchars($text, ENT_NOQUOTES, 'UTF-8');

	$post->method = $method; //method: site, email, api, ...

	$tags = thewire_get_hashtags($text);
	if ($tags) {
		$post->tags = $tags;
	}

	// must do this before saving so notifications pick up that this is a reply
	if ($parent_guid) {
		$post->reply = true;
	}

	$guid = $post->save();

	// set thread guid
	if ($parent_guid) {
		$post->addRelationship($parent_guid, 'parent');
		
		// name conversation threads by guid of first post (works even if first post deleted)
		$parent_post = get_entity($parent_guid);
		$post->wire_thread = $parent_post->wire_thread;
	} else {
		// first post in this thread
		$post->wire_thread = $guid;
	}

	if ($guid) {
		add_to_river('river/object/thewire/create', 'create', $post->owner_guid, $post->guid);

		// let other plugins know we are setting a user status
		$params = array(
			'entity' => $post,
			'user' => $post->getOwnerEntity(),
			'message' => $post->description,
			'url' => $post->getURL(),
			'origin' => 'thewire',
		);
		elgg_trigger_plugin_hook('status', 'user', $params);
	}
	
	return $guid;
}

function projects_view_navigation_breadcrumbs_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'navigation/breadcrumbs');
//	$check_context = (elgg_in_context('projects'));
	
	if ($check_hook && $check_type) {// && $check_context) {
		$page_owner = elgg_get_page_owner_entity();
		
		if ($page_owner instanceof ProjectGroup) {
			$return = elgg_view('projects/profile/menu', array(
				'entity' => $page_owner,
			));
		}
	}
	
	return $return;
	
}

function projects_view_page_layouts_content_hook($hook, $type, $return, $params) {
	
	// Contextos en los cuales se reemplaza el layouts
	$allow_context = array(
		'project_discussion',
		'project_thewire',
		'project_profile',
		'project_activity',
		'project_collaborators',
		'project_visitors',
		'project_invite',
		'project_requests',
		'project_edit',
		'gtask',
        'friends',
	);
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'page/layouts/content');
	
	$context = elgg_get_context();
	$check_context = (in_array($context, $allow_context));
	
    $page_owner = elgg_get_page_owner_entity();
    
	if ($check_hook && $check_type && $page_owner instanceof ProjectGroup) {
		if ($check_context) {
			$vars = $params['vars'];
			
			$header = elgg_view('page/layouts/content/header', $vars);
			$vars['content'] = $header . $vars['content'];
			unset($vars['title']);
			
            $vars['add_menu'] = FALSE;
			$return = elgg_view('page/layouts/one_column', $vars);
//			$return = elgg_view('projects/profile/menu', array(
//				'entity' => $page_owner,
//			));
		}
	}
	
	return $return;
	
}

function projects_view_page_layouts_add_menu_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'page/layouts/one_column' || $type == 'page/layouts/content');
	
    $page_owner = elgg_get_page_owner_entity();
    
	if ($check_hook && $check_type && $page_owner instanceof ProjectGroup) {
        $vars = elgg_extract('vars', $params, array());
        
        $add_menu = elgg_extract('add_menu', $vars, TRUE);
        if ($add_menu) {
            $menu = elgg_view('projects/profile/menu', array(
                'entity' => $page_owner,
            ));

            $return = $menu . $return;
        }
	}
	
	return $return;
	
}

function projects_projects_fields_profile_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'projects:fields');
	$check_type = ($type == 'profile');
	
	if ($check_hook && $check_type) {
		$entity = $params['entity'];
		
		if ($entity instanceof ProjectGroup && is_array($return)) {
			$exclude_fields = array(
				'project_status',
				'source_url',
				'facebook_url',
				'twitter_url',
				'linkedin_url',
				'leancanvas',
			);
			
			foreach($return as $shortname => $type) {
				if (in_array($shortname, $exclude_fields)) {
					unset($return[$shortname]);
				}
			}
			
			// Order
			$order_fields = array(
				'description',
				'current_needs',
				'website',
				'keywords',
				'project_type',
			);
			$return_aux = array();
			foreach($order_fields as $shortname) {
				if (array_key_exists($shortname, $return)) {
					$return_aux[$shortname] = $return[$shortname];
					unset($return[$shortname]);
				}
			}
			$return = $return_aux + $return;
		}
	}
	
	return $return;
	
}

function projects_login_user_event($event, $type, $object) {
	
	$check_event = ($event == 'login');
	$check_type = ($type == 'user');
	$check_object = (elgg_instanceof($object, 'user'));
	
	if ($check_event && $check_type && $check_object) {
		// Verifico si es miembro de algun proyecto
		$options = array(
			'type' => 'group',
			'subtype' => 'project',
			'relationship' => 'collaborator',
			'relationship_guid' => $object->getGUID(),
			'inverse_relationship' => false,
			'count' => true,
		);
		$projects = elgg_get_entities_from_relationship($options);
		
		if (!$projects) {
			$_SESSION['projects_show_welcome_message'] = TRUE;
		}
	}
	
}

/**
 * Hook para modificar la visualizacion de menu title en el perfil de grupos
 * Las opciones se muestran en un dropdown, si se tienen mas de dos
 */
function projects_view_navigation_menu_default_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'view');
	$check_type = ($type == 'navigation/menu/default');

	if ($check_hook && $check_type) {
		$group = elgg_get_page_owner_entity();

		// Get page
		$handler = get_input('handler');
		$page = get_input('page');
		
		$page_array = explode('/', $page);
		$is_profile = FALSE;
		if (is_array($page_array) && isset($page_array[0]) && $page_array[0] == 'profile' && $handler == 'groups') {
			$is_profile = TRUE;
		}

		$is_title = false;
		if (isset($params['vars']) && isset($params['vars']['name']) && $params['vars']['name'] == 'title') {
			$is_title = true;
		}

		if (elgg_instanceof($group, 'group') && $is_profile && $is_title) {
			$params['vars'] = array_merge($params['vars'], array('entity' => $group));
			$return = elgg_view('groups_custom/navigation/menu/default', $params['vars']);
		}
	}

	return $return;

}

function projects_register_menu_project_profile_menu_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:project_profile_menu');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		
		if (elgg_instanceof($page_owner, 'group', 'project') ) {
			$project_gatekeeper = false;
			if (is_callable('project_gatekeeper')) {
				$project_gatekeeper = project_gatekeeper(false);
			}
			
			$array_context = array(
				'project_profile',
				'project_activity',
				'project_collaborators',
				'project_visitors',
				'project_invite',
				'project_requests',
				'project_edit',
			);
			$in_context = false;
			$context = elgg_get_context();
			
			if (in_array($context, $array_context)) {
				$in_context =  true;
			}
			
			// Tab project name
			$options = array(
				'name' => 'project_name',
				'text' => elgg_get_excerpt($page_owner->name, 20),
				'href' => $page_owner->getURL(),
				'priority' => 500,
				'selected' => $in_context,
			);
			$return[] = ElggMenuItem::factory($options);
			// Tab project discussion
			if ($page_owner->forum_enable == 'yes' && $project_gatekeeper) {
				$options = array(
					'name' => 'forum',
					'text' => elgg_echo('groups:tabs:forum'),
					'href' => "project_discussion/owner/" . $page_owner->guid,
					'priority' => 550,
					'selected' => elgg_in_context('project_discussion'),
				);
				$return[] = ElggMenuItem::factory($options);
			}

			// Tab project thewire
			if ($page_owner->project_thewire_enable == 'yes' && $project_gatekeeper) {
				$options = array(
					'name' => 'project_thewire',
					'text' => elgg_echo('groups:tabs:project_thewire'),
					'href' => "projects/thewire/" . $page_owner->guid,
					'priority' => 575,
					'selected' => elgg_in_context('project_thewire'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
            
            // Tab pages
            if ($page_owner->pages_enable == 'yes' && $project_gatekeeper) {
				$options = array(
					'name' => 'pages',
					'text' => elgg_echo('groups:tabs:pages'),
					'href' => "pages/group/" . $page_owner->guid,
					'priority' => 725,
					'selected' => elgg_in_context('pages'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}
	
	return $return;
	
}

function projects_view_groups_custom_navigation_menu_default_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'groups_custom/navigation/menu/default');

	if ($check_hook && $check_type) {
		$group = elgg_get_page_owner_entity();

		// Get page
		$handler = get_input('handler');
		$page = get_input('page');
		$page_array = explode('/', $page);
		$is_profile = FALSE;
		if (is_array($page_array) && isset($page_array[0]) && $page_array[0] == 'profile' && $handler == 'projects') {
			$is_profile = TRUE;
		}

		$is_title = false;
		if (isset($params['vars']) && isset($params['vars']['name']) && $params['vars']['name'] == 'title') {
			$is_title = true;
		}

		if (elgg_instanceof($group, 'group', 'project') && $is_profile && $is_title) {
			$params['vars'] = array_merge($params['vars'], array('entity' => $group));
			$return = elgg_view('projects/groups_custom/navigation/menu/default', $params['vars']);
		}
	}
	
	return $return;
	
}

function projects_route_thewire_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'route');
	$check_type = ($type == 'thewire');
	
	if ($check_hook && $check_type) {
		$segments = $return['segments'];
		
		if (is_array($segments) && count($segments) == 2) {
			$fs = $segments[0];
			$ss = $segments[1];
			
			if ($fs == 'thread' || $fs == 'reply') {
				$thread = get_entity($ss);
				
				if (elgg_instanceof($thread, 'object', 'thewire')) {
					$container = $thread->getContainerEntity();
					
					if ($container instanceof ProjectGroup) {
						elgg_set_page_owner_guid($container->getGUID());
					}
				}
			}
		}
	}
	
	return $return;
	
}

function projects_thewire_entity_menu_setup($hook, $type, $return, $params) {

    $check_hook = ($hook == 'register');
    $check_type = ($type == 'menu:entity');

    if ($check_hook && $check_type) {
        $entity = elgg_extract('entity', $params, FALSE);
        if (elgg_instanceof($entity, 'object', 'thewire')) {
            $container = $entity->getContainerEntity();
            if (elgg_instanceof($container, 'group', 'project')) {
                if (!$container->canWriteToContainer()) {
                    foreach($return as $key => $menu_item) {
                        $name = $menu_item->getName();
                        switch($name) {
                            case 'reply':
                                unset($return[$key]);
                                break;
                        }
                    }
                }
            }
        }
    }

    return $return;

}

function projects_route_pages_hook($hook, $type, $return, $params) {

    $check_hook = ($hook == 'route');
    $check_type = ($type == 'pages');

    if ($check_hook && $check_type) {
        $page_owner = elgg_get_page_owner_entity();
        
        if (elgg_instanceof($page_owner, 'group', 'project')) {
            $segments = elgg_extract('segments', $return, array());
            
            if (!empty($segments) && is_array($segments)) {
                $segment_0 = elgg_extract(0, $segments, '');
                $segment_1 = elgg_extract(1, $segments, '');
                
                $base_dir = elgg_get_plugins_path() . 'projects/pages/projects/pages';
                elgg_load_library('elgg:pages');
                switch ($segment_0) {
                    case 'group':
                        include "$base_dir/owner.php";
                        exit;
                        break;
                    case 'add':
                        gatekeeper();
                        if (FALSE == $page_owner->canWriteToContainer()){
                            forward($page_owner->getURL());
                        }
                        break;
                    case 'view':
                        if (is_callable('project_gatekeeper')) {
            //				if (FALSE == $owner->canWriteToContainer()){
                            $project_gatekeeper = project_gatekeeper(false);
                            if (!$project_gatekeeper){
                                forward($page_owner->getURL());
                            } 
                        }
                        set_input('guid', $segment_1);
                        include "$base_dir/view.php";
                        exit;
                        break;
                }
            }
        }
        elseif (elgg_instanceof($page_owner, 'object', 'page_top')) {
            $container = $page_owner->getContainerEntity();
            if (elgg_instanceof($container, 'group', 'project')) {
                $segments = elgg_extract('segments', $return, array());
                
                if (!empty($segments) && is_array($segments)) {
                    $segment_0 = elgg_extract(0, $segments, '');
                    $segment_1 = elgg_extract(1, $segments, '');
                }
                
                switch ($segment_0) {
                    case 'add':
                        gatekeeper();
                        if (FALSE == $container->canWriteToContainer()){
                            forward($container->getURL());
                        }
                        break;
                }
            }
        }
    }

    return $return;

}

function projects_pages_write_permission_check($hook, $entity_type, $returnvalue, $params)
{
	if ($params['entity']->getSubtype() == 'page'
		|| $params['entity']->getSubtype() == 'page_top') {
        
        $container = $params['entity']->getContainerEntity();
        if ($container instanceof ProjectGroup) {
            if ($container->isVisitor($params['user'])) {
                return FALSE;
            }
//            $write_permission = $params['entity']->write_access_id;
//            $user = $params['user'];
//
//            if (($write_permission) && ($user)) {
//                // $list = get_write_access_array($user->guid);
//                $list = get_access_array($user->guid); // get_access_list($user->guid);
//
//                if (($write_permission!=0) && (in_array($write_permission,$list))) {
//
//                    return true;
//                }
//            }
        }
	}
}

//function projects_pages_container_permission_check($hook, $entity_type, $returnvalue, $params) {

//	if (elgg_get_context() == "pages") {
//		if (elgg_get_page_owner_guid()) {
//			if (can_write_to_container(elgg_get_logged_in_user_guid(), elgg_get_page_owner_guid())) return true;
//		}
//		if ($page_guid = get_input('page_guid',0)) {
//			$entity = get_entity($page_guid);
//		} else if ($parent_guid = get_input('parent_guid',0)) {
//			$entity = get_entity($parent_guid);
//		}
//		if ($entity instanceof ElggObject) {
//			if (
//					can_write_to_container(elgg_get_logged_in_user_guid(), $entity->container_guid)
//					|| in_array($entity->write_access_id,get_access_list())
//				) {
//					return true;
//			}
//		}
//	}

//}