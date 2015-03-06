<?php

/**
 * kt_polls
 *
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
define('KTPOLL_USER_PROFILE_SETTED', 'user_profile_setted');
define('KTPOLL_MAX_OPTIONS_FOR_POLL', 6);
define('KT_POLLS_ANSWER_NAME', 'kt_poll:answer');

define('Polls_ENABLE_DEMO', FALSE);

require_once(dirname(__FILE__) . '/ktform/start.php');
require_once(dirname(__FILE__) . '/lib/main.php');
require_once(dirname(__FILE__) . '/lib/kt_polls_lib.php');

elgg_register_event_handler('init', 'system', 'kt_polls_init');
elgg_register_event_handler('pagesetup','system','kt_polls_setup');

function kt_polls_init() {
	
	// Initializate the plugin
	//kt_polls_initializateplugin();
	
	// Page Handler
	elgg_register_page_handler('kt_polls', 'kt_polls_page_handler');
	elgg_register_entity_url_handler('object', 'kt_poll', 'kt_polls_url');

	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'kt_polls_page_menu');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'kt_polls_owner_block_menu');

	// JS
	elgg_register_js('form.placeholder.js', 'mod/kt_polls/vendors/placeholder/jquery.placeholder.min.js');
	
	// Menu
//	$listing_item = new ElggMenuItem('kt_polls', elgg_echo('kt_polls:plugin:menu:title'), 'kt_polls');
//	elgg_register_menu_item('site', $listing_item);
	
	// Widgets
	elgg_register_widget_type('kt_polls', elgg_echo('kt_polls'), elgg_echo('kt_polls:widget:description'));
	
	// Groups
	if (elgg_get_plugin_setting('group_support', 'kt_polls') != 'no') {
		add_group_tool_option('kt_polls', elgg_echo('kt_polls:enablekt_polls'), TRUE);
		elgg_extend_view('groups/tool_latest', 'kt_polls/group_module');
	}
	
	
	elgg_register_action('kt_polls/profile/add', dirname(__FILE__).'/actions/kt_polls/profile/add_a.php');
	elgg_register_action('kt_polls/profile/remove',dirname(__FILE__).'/actions/kt_polls/profile/remove_a.php');
	
	elgg_register_action('poll_quiz/vote', dirname(__FILE__).'/actions/kt_polls/vote_a.php');

	/**
	 * Profile hack
	 */
	register_plugin_hook('entity:profile:exclude:fields', 'object', 'kt_polls_exclude_profile_fields');
	
	/**
	 * We will use this to remove the description field, cuz is not necesarry where ktform sets
	 */
	register_plugin_hook('entity:profile:description:fields', 'object', 'kt_polls_include_description_fields');
	
	elgg_register_js('elgg.kt_polls', 'mod/kt_polls/js/elgg.kt_polls.js');
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'ktpolls_register_menu_profile_groups_tabs_hook');
	
	
}


/**
 * This plugin hook will remove the follow up item from the profile
 */

function kt_polls_exclude_profile_fields($hook, $entity_type, $returnvalue, $params) {
	$valid_hook = ($hook == 'entity:profile:exclude:fields');
	$valid_entity_type = ($entity_type == 'object');
	
	$entity = FALSE;
	if (array_key_exists('entity', $params) && ($params['entity'] instanceof Polls)) {
		$entity = $params['entity'];
	}
	
	
	if ($valid_hook && $valid_entity_type && $entity) {
		
			$returnvalue[] = 'question_answer';
			$returnvalue[] = 'question_type';
			$returnvalue[] = 'question_options';
			$returnvalue[] = 'question_right_answer';
			$returnvalue[] = 'poll_context';
			$returnvalue[] = 'container_guid';
		
	}
	
	return $returnvalue;
}

/**
 * This plugin hook will remove the follow up item from the profile
 */

function kt_polls_include_description_fields($hook, $entity_type, $returnvalue, $params) {
	$valid_hook = ($hook == 'entity:profile:description:fields');
	$valid_entity_type = ($entity_type == 'object');
	
	$entity = FALSE;
	if (array_key_exists('entity', $params) && ($params['entity'] instanceof Polls)) {
		$entity = $params['entity'];
	}
	
	
	if ($valid_hook && $valid_entity_type && $entity) {
		$search_key = array_search('description', $returnvalue);
		if ($search_key !== FALSE) {
			if (array_key_exists($search_key, $returnvalue)) {
				unset($returnvalue[$search_key]);
			}
		}
		
	}
	
	return $returnvalue;
}


function kt_polls_setup() {
	elgg_load_js('elgg.kt_polls');
}

/**
 * Populates the ->getUrl() method for blog objects
 *
 * @param ElggEntity $blogpost Polls post entity
 * @return string Polls post URL
 */
function kt_polls_url($entity) {

	global $CONFIG;
	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	
	return $CONFIG->url . "kt_polls/view/" . $entity->getGUID() . "/" . $title;
	
}

/**
 *  All kt_polls:			kt_polls/all
 *  User's kt_polls:		kt_polls/owner/<username>
 *  Friends' kt_polls:		kt_polls/friends/<username>
 *  View kt_polls:			kt_polls/view/<guid>/<title>
 *  New kt_polls:			kt_polls/add/<guid> (container: user, group, parent)
 *  Edit kt_polls:			kt_polls/edit/<guid>
 *  Group kt_polls:			kt_polls/group/<guid>/owner
 */
function kt_polls_page_handler($page) {
	
	global $CONFIG;
	
	switch ($page[0]) {
		case 'add':
			if (isset($page[1]) && is_numeric($page[1])) {
				$container_entity = get_entity($page[1]);
				if (($container_entity instanceof ElggGroup) || ($container_entity instanceof ElggUser)) {
					set_input('container_guid', $page[1]);
				}
			}
			!@include_once(dirname(__FILE__) . "/pages/kt_polls/edit_p.php");
			return true;

			break;

		case 'edit':
			set_input('guid', $page[1]);
			
			!@include_once(dirname(__FILE__) . "/pages/kt_polls/edit_p.php");
			return true;

			break;

		case 'owner':
			set_input('username', $page[1]);
			set_input('entity_owner_filter', 'mine');

			!@include_once(dirname(__FILE__) . "/pages/kt_polls/list_p.php");
			return true;

			break;
		case 'friends':
			set_input('entity_owner_filter', 'friends');
			!@include_once(dirname(__FILE__) . "/pages/kt_polls/list_p.php");
			return true;

			break;

		case 'view':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/kt_polls/profile_p.php");
			return true;
			break;
		case 'group':
			set_input('guid', $page[1]);
			set_input('entity_owner_filter', 'mine');
			!@include_once(dirname(__FILE__) . "/pages/kt_polls/list_p.php");
			return true;
			break;

		default:
			if (is_numeric($page[1])) {
				set_input('guid', $page[1]);
				!@include_once(dirname(__FILE__) . "/pages/kt_polls/profile_p.php");
				return true;
			} else {
				set_input('entity_owner_filter', 'all');
				!@include_once(dirname(__FILE__) . "/pages/kt_polls/list_p.php");
				return true;
			}

			break;
	}
}

function kt_polls_page_menu($hook, $type, $return, $params) {
	
	$entity = elgg_extract('entity', $params);
	$view_type = elgg_extract('view_type', $params);

	if (elgg_instanceof($entity, 'object', 'kt_poll') && $view_type == 'listing') {
		
		$extra_fields = PollsBaseMain::ktform_get_extra_listing_fields('kt_poll');

		if ($extra_fields && is_array($extra_fields) && count($extra_fields)) {
			
			foreach ($extra_fields as $internalname => $options) {
				$output_view = $options['output_view'];
				$output_vars = array('value' => $entity->$internalname, 'entity' => $entity);
				if (array_key_exists('options', $options)) {
					$output_vars = array_merge($options['options'], $output_vars);
				}

				$value = elgg_view($output_view, $output_vars);
				if ($value) {
					$options = array(
						 'name' => "kt_poll:listing:title:{$internalname}",
						 'text' => "<span>$value</span>",
						 'href' => false,
						 'priority' => 2,
					);
						 
					$return[] = ElggMenuItem::factory($options);
				}
			}
			
			return $return;
		}
	}
	
}

/**
 * Add a menu item to the user ownerblock
 */
function kt_polls_owner_block_menu($hook, $type, $return, $params) {
	
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "kt_polls/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('pages', elgg_echo('kt_polls'), $url);
		$return[] = $item;
	}
	else {
		if (elgg_get_plugin_setting('group_support', 'kt_polls') == 'yes' && $params['entity']->kt_polls_enable != "no") {
			$url = "kt_polls/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('pages', elgg_echo('kt_polls:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
	
}


/**
 * Lean Canvas: Register Menu Profile Groups Tabs Hook
 */
function ktpolls_register_menu_profile_groups_tabs_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:project_profile_menu');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		
		if (elgg_instanceof($page_owner, 'group', 'project')) {
			$project_gatekeeper = false;
			if (is_callable('project_gatekeeper')) {
				$project_gatekeeper = project_gatekeeper(false);
			}
			
			// Tiene url github?
			if ($project_gatekeeper) {				
				$options = array(
					'name' => 'polls',
					'text' => elgg_echo('kt_polls'),
					'href' => 'kt_polls/group/'.$page_owner->getGUID().'/'.  elgg_get_friendly_title($page_owner->name),
					'priority' => 600,
					'selected' => elgg_in_context('polls'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}
	
	return $return;
	
}