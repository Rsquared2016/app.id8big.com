<?php
/**
 * Elgg Help texts plugin
 *
 * @package ElggHelp texts
 */

elgg_register_event_handler('init', 'system', 'help_texts_init');
define('HELP_TEXT_GRAPHICS', elgg_get_site_url() . "mod/help_texts/graphics/");
define('HELP_TEXTS_VENDORS', elgg_get_site_url() . "mod/help_texts/vendors/");

/**
 * Help text init
 */
function help_texts_init() {

	$root = dirname(__FILE__);
	elgg_register_library('elgg:help_texts', "$root/lib/help_texts.php");

	// actions
	$action_path = "$root/actions/help_texts";
	elgg_register_action('help_texts/save', "$action_path/save.php");
	elgg_register_action('help_texts/delete', "$action_path/delete.php");
//	elgg_register_action('help_texts/share', "$action_path/share.php");

	// menus
	elgg_register_menu_item('user_top_menu', array(
		'name' => 'help_texts',
		'text' => elgg_echo('help_texts'),
		'href' => 'help_texts/all'
	));

//	elgg_register_plugin_hook_handler('register', 'menu:filter', 'help_texts_filter_menu');
//	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'help_texts_owner_block_menu');

	elgg_register_page_handler('help_texts', 'help_texts_page_handler');

	elgg_extend_view('css/elgg', 'help_texts/css');
	elgg_extend_view('js/elgg', 'help_texts/js');

	elgg_register_widget_type('help_texts', elgg_echo('help_texts'), elgg_echo('help_texts:widget:description'));

	if (elgg_is_logged_in()) {
		$user_guid = elgg_get_logged_in_user_guid();
		$address = urlencode(current_page_url());

		elgg_register_menu_item('extras', array(
			'name' => 'help_text',
			'text' => elgg_view_icon('push-pin-alt'),
			'href' => "help_texts/add/$user_guid?address=$address",
			'title' => elgg_echo('help_texts:this'),
			'rel' => 'nofollow',
		));
	}
	// Register granular notification for this type
	register_notification_object('object', 'help_texts', elgg_echo('help_texts:new'));

	// Listen to notification events and supply a more useful message
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'help_texts_notify_message');

	// Register help_texts view for ecml parsing
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'help_texts_ecml_views_hook');

	// Register a URL handler for help_texts
	elgg_register_entity_url_handler('object', 'help_texts', 'help_text_url');

	// Register entity type for search
	elgg_register_entity_type('object', 'help_texts');

	// Groups
	add_group_tool_option('help_texts', elgg_echo('help_texts:enablehelp_texts'), true);
	elgg_extend_view('groups/tool_latest', 'help_texts/group_module');
    elgg_extend_view('theme_elements/sidebar_extras', 'help_texts/widget');
    
    // ICOMOON    
    elgg_register_css('elgg.icomoon.css', HELP_TEXTS_VENDORS. 'icomoon/premium/style.css');
	elgg_load_css('elgg.icomoon.css');
    
    // SELECT 2
	elgg_register_js('select2', HELP_TEXTS_VENDORS . 'select2/select2.js', 'footer');
	elgg_register_css('select2', HELP_TEXTS_VENDORS . 'select2/select2.css', 1000);

}

/**
 * Dispatcher for help_texts.
 *
 * URLs take the form of
 *  All help_texts:        help_texts/all
 *  User's help_texts:     help_texts/owner/<username>
 *  Friends' help_texts:   help_texts/friends/<username>
 *  View help_text:        help_texts/view/<guid>/<title>
 *  New help_text:         help_texts/add/<guid> (container: user, group, parent)
 *  Edit help_text:        help_texts/edit/<guid>
 *  Group help_texts:      help_texts/group/<guid>/all
 *  Bookmarklet:          help_texts/bookmarklet/<guid> (user)
 *
 * Title is ignored
 *
 * @param array $page
 * @return bool
 */
function help_texts_page_handler($page) {

	elgg_load_library('elgg:help_texts');

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	elgg_push_breadcrumb(elgg_echo('help_texts'), 'help_texts/all');

	// old group usernames
	if (substr_count($page[0], 'group:')) {
		preg_match('/group\:([0-9]+)/i', $page[0], $matches);
		$guid = $matches[1];
		if ($entity = get_entity($guid)) {
			help_texts_url_forwarder($page);
		}
	}

	// user usernames
	$user = get_user_by_username($page[0]);
	if ($user) {
		help_texts_url_forwarder($page);
	}

	$pages = dirname(__FILE__) . '/pages/help_texts';


	switch ($page[0]) {
		case "all":
            admin_gatekeeper();
			include "$pages/all.php";
			break;
		case "add":
			admin_gatekeeper();
			elgg_extend_view('input/longtext', 'tinymce/init');
			include "$pages/add.php";
			break;
        case "view":
			elgg_extend_view('input/longtext', 'tinymce/init');
			set_input('guid', $page[1]);
			include "$pages/view.php";
			break;
		case "edit":
			admin_gatekeeper();
			elgg_extend_view('input/longtext', 'tinymce/init');
			set_input('guid', $page[1]);
			include "$pages/edit.php";
			break;
		default:
			return false;
	}

	elgg_pop_context();
	return true;
}

/**
 * Forward to the new style of URLs
 *
 * @param string $page
 */
function help_texts_url_forwarder($page) {
	global $CONFIG;

	if (!isset($page[1])) {
		$page[1] = 'items';
	}

	switch ($page[1]) {
		case "read":
			$url = "{$CONFIG->wwwroot}help_texts/view/{$page[2]}/{$page[3]}";
			break;
		case "inbox":
			$url = "{$CONFIG->wwwroot}help_texts/inbox/{$page[0]}";
			break;
		case "friends":
			$url = "{$CONFIG->wwwroot}help_texts/friends/{$page[0]}";
			break;
		case "add":
			$url = "{$CONFIG->wwwroot}help_texts/add/{$page[0]}";
			break;
		case "items":
			$url = "{$CONFIG->wwwroot}help_texts/owner/{$page[0]}";
			break;
		case "bookmarklet":
			$url = "{$CONFIG->wwwroot}help_texts/bookmarklet/{$page[0]}";
			break;
	}

	register_error(elgg_echo("changehelp_text"));
	forward($url);
}

/**
 * Populates the ->getUrl() method for help_texted objects
 *
 * @param ElggEntity $entity The help_texted object
 * @return string bookmarked item URL
 */
function help_text_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "help_texts/view/" . $entity->getGUID() . "/" . $title;
}

/**
 * Add a menu item to an ownerblock
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function help_texts_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "help_texts/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('help_texts', elgg_echo('help_texts'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->help_texts_enable != 'no') {
			$url = "help_texts/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('help_texts', elgg_echo('help_texts:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Returns the body of a notification message
 *
 * @param string $hook
 * @param string $entity_type
 * @param string $returnvalue
 * @param array  $params
 */
function help_texts_notify_message($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];
	if (($entity instanceof ElggEntity) && ($entity->getSubtype() == 'help_texts')) {
		$descr = $entity->description;
		$title = $entity->title;
		$owner = $entity->getOwnerEntity();

		return elgg_echo('help_texts:notification', array(
			$owner->name,
			$title,
			$entity->address,
			$descr,
			$entity->getURL()
		));
	}
	return null;
}

/**
 * Return help_texts views to parse for ecml
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function help_texts_ecml_views_hook($hook, $type, $return, $params) {
	$return['object/help_texts'] = elgg_echo('item:object:help_texts');
	return $return;
}
