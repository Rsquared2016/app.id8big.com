<?php

/**
 * Add a bridge between custom groups and default group module
 * @package MultiGroup
 */
include_once(dirname(__FILE__) . '/functions/theme_projects_hooks.php');
include_once(dirname(__FILE__) . '/functions/group_hooks.php');

elgg_register_event_handler('init', 'system', 'multigroups_init');

function multigroups_init() {
	elgg_register_library('elgg:groups', elgg_get_plugins_path() . 'multigroups/functions/groups.php');

	//Give theme support with groups and projects
	MultiGroupsSupport::enableThemeSupport();
	
	//Unregister or register page owner menues
	MultiGroupsSupport::unregisterPageOwnerMenues();
    
    //override search hook of group
    elgg_register_plugin_hook_handler('search', 'group', 'multigroups_search_extend_hook');
	
}

function multigroups_page_setup() {

	$handler = get_input('handler');

	//Clean the group tools
	MultiGroupsSupport::cleanGroupsTools($handler);
	
	
	
}

function multigroups_search_extend_hook($hook, $type, $value, $params) {
	$db_prefix = elgg_get_config('dbprefix');

	$query = sanitise_string($params['query']);

	$join = "JOIN {$db_prefix}groups_entity ge ON e.guid = ge.guid";
	$params['joins'] = array($join);
	
	$fields = array('name', 'description');

	// force into boolean mode because we've having problems with the
	// "if > 50% match 0 sets are returns" problem.
	$where = search_get_where_sql('ge', $fields, $params, FALSE);

	$params['wheres'] = array($where);

	
	$params['count'] = TRUE;
    
	$count = elgg_get_entities($params);
	
	// no need to continue if nothing here.
	if (!$count) {
		return array('entities' => array(), 'count' => $count);
	}
	
	$params['count'] = FALSE;
	$entities = elgg_get_entities($params);

	// add the volatile data for why these entities have been returned.
	foreach ($entities as $entity) {
		$name = search_get_highlighted_relevant_substrings($entity->name, $query);
		$entity->setVolatileData('search_matched_title', $name);

		$description = search_get_highlighted_relevant_substrings($entity->description, $query);
		$entity->setVolatileData('search_matched_description', $description);
	}

	return array(
		'entities' => $entities,
		'count' => $count,
	);
}

elgg_register_event_handler('pagesetup', 'system', 'multigroups_page_setup');