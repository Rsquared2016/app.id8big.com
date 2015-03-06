<?php

/**
 * news
 *
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

define('News_ENABLE_DEMO', FALSE);

require_once(dirname(__FILE__) . '/ktform/start.php');
require_once(dirname(__FILE__) . '/lib/news_lib.php');

function news_init() {
	
	// Initializate the plugin
	//news_initializateplugin();
	
	// Page Handler
	elgg_register_page_handler('news', 'news_page_handler');
	elgg_register_entity_url_handler('object', 'new', 'news_url');

	// Hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'news_page_menu');
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'news_owner_block_menu');

	// JS
	elgg_register_js('form.placeholder.js', 'mod/news/vendors/placeholder/jquery.placeholder.min.js');
	
	// Menu
    $listing_item = new ElggMenuItem('news', elgg_echo('news:plugin:menu:title'), 'news');
    elgg_register_menu_item('site', $listing_item);
    
    
	
	// Widgets
	elgg_register_widget_type('news', elgg_echo('news'), elgg_echo('news:widget:description'));
	
	// Groups
	if (elgg_get_plugin_setting('group_support', 'news') == 'yes') {
		add_group_tool_option('news', elgg_echo('news:enablenews'), TRUE);
		elgg_extend_view('groups/tool_latest', 'news/group_module');
	}
    
    elgg_register_plugin_hook_handler('register','menu:filter', 'news_tabs_menu_filter');
	
}

/**
 * Populates the ->getUrl() method for blog objects
 *
 * @param ElggEntity $blogpost News post entity
 * @return string News post URL
 */
function news_url($entity) {

	global $CONFIG;
	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	
	return $CONFIG->url . "news/view/" . $entity->getGUID() . "/" . $title;
	
}

/**
 *  All news:			news/all
 *  User's news:		news/owner/<username>
 *  Friends' news:		news/friends/<username>
 *  View news:			news/view/<guid>/<title>
 *  New news:			news/add/<guid> (container: user, group, parent)
 *  Edit news:			news/edit/<guid>
 *  Group news:			news/group/<guid>/owner
 */
function news_page_handler($page) {
	
	global $CONFIG;
	
	switch ($page[0]) {
		case 'add':
			!@include_once(dirname(__FILE__) . "/pages/news/edit_p.php");
			return true;

			break;

		case 'edit':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/news/edit_p.php");
			return true;

			break;

		case 'owner':
			set_input('username', $page[1]);
			set_input('entity_owner_filter', 'mine');

			!@include_once(dirname(__FILE__) . "/pages/news/list_p.php");
			return true;

			break;
		case 'friends':
			set_input('entity_owner_filter', 'friends');
			!@include_once(dirname(__FILE__) . "/pages/news/list_p.php");
			return true;

			break;

		case 'view':
			set_input('guid', $page[1]);
			!@include_once(dirname(__FILE__) . "/pages/news/profile_p.php");
			return true;
			break;
		case 'group':
			set_input('guid', $page[1]);
			set_input('entity_owner_filter', 'mine');
			!@include_once(dirname(__FILE__) . "/pages/news/list_p.php");
			return true;
			break;

		default:
			if (is_numeric($page[1])) {
				set_input('guid', $page[1]);
				!@include_once(dirname(__FILE__) . "/pages/news/profile_p.php");
				return true;
			} else {
				set_input('entity_owner_filter', 'all');
				!@include_once(dirname(__FILE__) . "/pages/news/list_p.php");
				return true;
			}

			break;
	}
}

function news_page_menu($hook, $type, $return, $params) {
	
	$entity = elgg_extract('entity', $params);
	$view_type = elgg_extract('view_type', $params);

	if (elgg_instanceof($entity, 'object', 'new') && $view_type == 'listing') {
		
		$extra_fields = NewsBaseMain::ktform_get_extra_listing_fields('new');

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
						 'name' => "new:listing:title:{$internalname}",
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
function news_owner_block_menu($hook, $type, $return, $params) {
	
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "news/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('pages', elgg_echo('news'), $url);
		$return[] = $item;
	}
	else {
		if (elgg_get_plugin_setting('group_support', 'news') == 'yes' && $params['entity']->news_enable != "no") {
			$url = "news/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('pages', elgg_echo('news:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
	
}

function news_tabs_menu_filter($hook, $type, $returnvalue, $params) {
	$valid_hook = $hook == 'register';
	$valid_type = $type == 'menu:filter';
		
	
	if($valid_hook && $valid_type) {
		if(elgg_in_context('news')) {
            if (!elgg_is_admin_logged_in()) {
                unset($returnvalue[1]);
            }
            unset($returnvalue[2]);
		}
	}
	
	return $returnvalue;
	
}

elgg_register_event_handler('init', 'system', 'news_init');