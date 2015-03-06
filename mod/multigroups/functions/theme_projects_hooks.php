<?php

/**
 * Hook para reemplazar los widgets del perfil de grupos como tabs
 */
function mg_theme_projects_view_groups_profile_widgets_hook($hook, $view_type, $return, $params) {

	$check_hook = ($hook == 'view');

	$allowed_views = array(
		'projects/profile/widgets',
	);

	$check_view_type = in_array($view_type, $allowed_views);

	if ($check_hook && $check_view_type) {

		$vars = $params['vars'];

		$vars = array_merge($vars, array('profile_content' => $return));

		$content = elgg_view('groups_custom/groups/profile/tabs', $vars);

		return $content;
	}
}

/**
 * Hook para reemplazar el modo en que se visaulizan los widget del perfil de grupos
 */
function mg_theme_projects_view_page_components_module_hook($hook, $view_type, $return, $params) {

	$check_hook = ($hook == 'view');

	$allowed_views = array(
		'page/components/module',
	);

	$check_view_type = in_array($view_type, $allowed_views);

	if ($check_hook && $check_view_type) {
		$profile_groups_tabs = get_input('profile_projects_tabs', false);
		if ($profile_groups_tabs) {
			$return = elgg_view('groups_custom/page/components/module', $params['vars']);
		}
	}

	return $return;
}

/**
 * Hook para reemplazar el modo en que se visaulizan los widget del perfil de grupos
 */
function mg_theme_projects_view_groups_profile_module_hook($hook, $view_type, $return, $params) {

	$check_hook = ($hook == 'view');

	$allowed_views = array(
		'groups/profile/module',
	);

	$check_view_type = in_array($view_type, $allowed_views);


	if ($check_hook && $check_view_type) {
		$profile_groups_tabs = get_input('profile_projects_tabs', false);
		if ($profile_groups_tabs) {
			$return = elgg_view('groups_custom/groups/profile/module', $params['vars']);
		}
	}

	return $return;
}

function mg_theme_projects_view_discussion_group_module_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'view');


	$allowed_views = array(
		'project_discussion/project_module',
	);

	$check_view_type = in_array($type, $allowed_views);

	if ($check_hook && $check_view_type) {
		$group = elgg_get_page_owner_entity();

		// Get page
		$handler = get_input('handler');
		$page = get_input('page');
		$page_array = explode('/', $page);
		$is_profile = FALSE;
		if (is_array($page_array) && isset($page_array[0]) && $page_array[0] == 'profile' && $handler == 'projects') {
			$is_profile = TRUE;
		}

		if (elgg_instanceof($group, 'group') && $is_profile) {
			if ($group->canWriteToContainer() && $group->forum_enable == 'yes') {
				$form = elgg_view('groups_custom/forms/discussion', $params['vars']);
				$return = $form . $return;
			}
		}
	}

	return $return;
}

function mg_theme_projects_forward_system_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'forward');
	$check_type = ($type == 'system');

	if ($check_hook && $check_type) {
		$action = get_input('action');
		$profile_group = get_input('project_group', 0);
		if ($action == 'project_discussion/save' && $profile_group) {
			$container_guid = get_input('container_guid');
			$group = get_entity($container_guid);
			if (elgg_instanceof($group, 'group')) {
				$return = $group->getURL() . '?filter=forum';
			}
		}
	}

	return $return;
}

function mg_theme_projects_action_discussion_save_hook($hook, $type, $return, $params) {

	$check_hook = ($hook == 'action');
	$check_type = ($type == 'project_discussion/save');

	if ($check_hook && $check_type) {
		$profile_group = get_input("profile_project");
		$desc = get_input("description");

		if ($profile_group) {
			if (!$desc) {
				elgg_make_sticky_form('topic');

				register_error(elgg_echo('theme:groups:discussion:error'));
				$return = false;
			} else {
				$title = substr($desc, 0, 50);
				$title = strip_tags($title);
				set_input('title', $title);
			}
		}
	}

	return $return;
}

function mg_theme_projects_view_navigation_menu_default_hook($hook, $type, $return, $params) {
	$check_hook = ($hook == 'view');
	$check_type = ($type == 'navigation/menu/default');

	if ($check_hook && $check_type) {
		$group = elgg_get_page_owner_entity();

		// Get page
		$handler = get_input('handler');
		$page = get_input('page');
		$page_array = explode('/', $page);
		$is_profile = FALSE;
		if (is_array($page_array) && isset($page_array[0]) && in_array($page_array[0], array('profile', 'profilelist')) && $handler == 'projects') {
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