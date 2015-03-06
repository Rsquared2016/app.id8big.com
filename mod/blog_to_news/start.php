<?php
/**
* sparkfire
*
* @author Emanuel Kling
* @link http://community.elgg.org/pg/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

//require_once(dirname(__FILE__) . '/vendors/plugin/plugin.php');

function blog_to_news_init() {
	//Initializate the plugin
	//sparkfire_initializateplugin();
			
	//Page Handler
	//elgg_register_page_handler('sparkfire','sparkfire_page_handler');
	elgg_register_library('elgg:blog', elgg_get_plugins_path() . 'blog_to_news/lib/blog.php');
	
	/* CSS FILE INDEPENDENT - THIS SHOULD FIX SOME IE PROBLEMS IF THEM HAPPENS*/
	/*elgg_extend_view('css/custom_site/custom', 'css/theme_professionalelgg/setup', 400);
	elgg_register_simplecache_view('css/custom_site/custom');
	$theme_custom_css = elgg_get_simplecache_url('css', 'custom_site/custom');
	elgg_register_css('theme_custom', $theme_custom_css, 900);
	elgg_load_css('theme_custom');*/
    if (elgg_in_context('blog')) {
        elgg_extend_view('object/elements/full', 'blog_to_news/suggest_to_news');
    }
    
    /* CSS */
	elgg_extend_view('css/elgg', 'blog_to_news/css', 9999);
    
    //Actions
    $action_path = elgg_get_plugins_path() . 'blog_to_news/actions/blog_to_news';
    elgg_register_action('blog_to_news/suggest', "$action_path/suggest_a.php");
    elgg_register_action('blog_to_news/accept', "$action_path/accept_a.php");
    elgg_register_action('blog_to_news/deny', "$action_path/deny_a.php");
    
    elgg_register_plugin_hook_handler('register','menu:filter', 'blog_to_news_tabs_menu_filter');
    
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'blog_to_news_page_menu', 500);
	elgg_register_plugin_hook_handler('register', 'menu:project_profile_menu', 'blog_register_menu_project_profile_menu_hook');
    
    elgg_register_page_handler('blog_to_news', 'blog_to_news_page_handler');
	
}

function blog_to_news_page_handler($page) {
    global $CONFIG;
	
	switch ($page[0]) {
        case 'blog':
            set_input('entity_owner_filter', 'blog');
            !@include_once(dirname(__FILE__) . "/pages/blog_to_news/list_blog_suggested_p.php");
            return true;
			break;
        case 'news':
            set_input('entity_owner_filter', 'news');
            !@include_once(dirname(__FILE__) . "/pages/blog_to_news/list_news_from_blog_p.php");
            return true;
			break;
            
            
		

		default:
            set_input('entity_owner_filter', 'blog');
            !@include_once(dirname(__FILE__) . "/pages/blog_to_news/list_p.php");
            return true;
			break;
	}
}

function blog_to_news_setup() {
	
}

function blog_to_news_tabs_menu_filter($hook, $type, $returnvalue, $params) {
	$valid_hook = $hook == 'register';
	$valid_type = $type == 'menu:filter';
		
	
	if($valid_hook && $valid_type) {
        if (elgg_is_admin_logged_in()) {
            if (elgg_in_context('blog')) {
                $listing_item = new ElggMenuItem('blog_to_news_list', elgg_echo('blog_to_news:blog_suggest:list'), elgg_get_site_url().'blog_to_news/blog');
                $returnvalue[] = $listing_item;
            }
            if (elgg_in_context('news')) {
                $listing_item = new ElggMenuItem('blog_to_news_list', elgg_echo('blog_to_news:news_from_blog:list'), elgg_get_site_url().'blog_to_news/news');
                $returnvalue[] = $listing_item;
            }
        }
        
	}
	
	return $returnvalue;
	
}

function blog_to_news_page_menu($hook, $type, $return, $params) {

	$entity = elgg_extract('entity', $params);
	
	if (elgg_instanceof($entity, 'object', 'blog') && elgg_in_context('blog_to_news')) {
        $return = array();
        $options = array(
            'name' => 'blog_to_news',
            'text' => elgg_view('blog_to_news/listing_buttons', array('entity' => $entity)),
            'href' => false,
            'priority' => 1000,
        );
        $return[] = ElggMenuItem::factory($options);
		
	}
    
    return $return;
}

function blog_register_menu_project_profile_menu_hook($hook, $type, $return, $params) {
	
	$check_hook = ($hook == 'register');
	$check_type = ($type == 'menu:project_profile_menu');
	
	if ($check_hook && $check_type) {
		$page_owner = elgg_get_page_owner_entity();
		
		if (elgg_instanceof($page_owner, 'group', 'project')) {
			$project_gatekeeper = false;
			if (is_callable('project_gatekeeper')) {
				$project_gatekeeper = project_gatekeeper(false);
			}
			
			// Tab project discussion
			if ($page_owner->blog_enable == 'yes' && $project_gatekeeper) {
				$options = array(
					'name' => 'blog',
					'text' => elgg_echo('groups:tabs:blog'),
					'href' => "blog/group/" . $page_owner->guid . "/all",
					'priority' => 700,
					'selected' => elgg_in_context('blog'),
				);
				$return[] = ElggMenuItem::factory($options);
			}
		}
	}
	
	return $return;
	
}

elgg_register_event_handler('init','system','blog_to_news_init');
//elgg_register_event_handler('pagesetup','system','sparkfire_setup');