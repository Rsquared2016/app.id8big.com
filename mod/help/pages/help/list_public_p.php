<?php

/**
 * ktform
 *
 * @author Diego Gallardo and German Bortoli
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

$page_owner = elgg_get_page_owner_entity();
if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}

$object_subtype = 'help';

if(elgg_is_admin_logged_in()) {
	elgg_register_title_button();
}

$filter_context = get_input('entity_owner_filter', 'all');

elgg_pop_breadcrumb();

$title = elgg_echo("help:plugin:page_owner:list");

if ($filter_context == 'all') {
	elgg_push_breadcrumb(elgg_echo('help'));
}

$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$help_handler = new HelpHandler();

$options = array(
	 'offset' => 0,
	 'limit' => 0,
);



$display_admin_msg = FALSE; 
//If no admin logged in. Filter content by user type
//If no user logged in ?
if(isadminloggedin()) {
	$display_admin_msg = TRUE;
} else {
	$options['filter_by_user_type'] = TRUE;
}

$entities = $help_handler->get_filter_entities($options);

$body = '';

//Get some content.
$guid = get_input('guid');

if($guid) {
	$entity = get_entity($guid);

	if(!$entity || !($entity instanceof Help)) {
		register_error(elgg_echo('help:invalid:guid'));
		forward(REFERER);
	}
} else {
	//Try to get a random entry.
	if($entities) {
		$key = array_rand($entities);
		$entity = $entities[$key];
	}
}

//Entities
//Remember always it is needed.
//Remember always it is needed.
if($entity) {
	$title = $entity->getTitle();
	$body .= elgg_view('help/help_content', array('entity' => $entity));	
} else {
	$body .= elgg_view('help/listing/wrapper', array('entities' => $entities, 'entity_subtype' => $object_subtype));
}

//Left sidebar.
$sidebar = elgg_view('help/menu', array('entities' => $entities, 'force_instance_of' => Help));

$vars = array(
	 'filter_context' => $filter_context,
	 'filter_override' => false,
	 'content' => $body,
	 'title' => $title,
	 'sidebar' => $sidebar,
);

// don't show filter if out of filter context
if ($page_owner instanceof ElggGroup) {
	$vars['filter'] = false;
}

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);