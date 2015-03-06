<?php
/**
 * Anypage
 *
 * @todo Expose for Walled Garden sites
 */

elgg_register_event_handler('init', 'system', 'anypage_init');
elgg_register_event_handler('pagesetup', 'system', 'anypage_pagesetup');

/**
 * Anypage init
 */
function anypage_init() {
	elgg_register_admin_menu_item('configure', 'anypage', 'appearance');
	// fix for selecting the right section in admin area
	elgg_register_plugin_hook_handler('prepare', 'menu:page', 'anypage_init_fix_admin_menu');

	$actions = dirname(__FILE__) . '/actions/anypage';

	elgg_register_action('anypage/save', "$actions/save.php", 'admin');
	elgg_register_action('anypage/delete', "$actions/delete.php", 'admin');

	elgg_extend_view('js/elgg', 'anypage/js');

//	elgg_register_plugin_hook_handler('route', 'all', 'anypage_router');
	elgg_register_plugin_hook_handler('forward', '404', 'anypage_router', -1);
}

function anypage_pagesetup() {
	//Get last 10 pages.
	$pages = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'anypage',
		'limit' => 10,
	));
	
	if($pages) {
		foreach($pages as $page) {
			//Set menues
			$text = $page->title;
			$name = elgg_get_friendly_title($text);
			$href = $page->getPagePath();
			$item = new ElggMenuItem($name, $text, $href);
			elgg_register_menu_item('site', $item);
		}
	}
	

}

function anypage_init_fix_admin_menu($hook, $type, $value, $params) {
	if (!(elgg_in_context('admin') && elgg_in_context('anypage'))) {
		return null;
	}

	if (isset($value['configure'])) {
		foreach ($value['configure'] as $item) {
			if ($item->getName() == 'appearance') {
				foreach($item->getChildren() as $child) {
					if ($child->getName() == 'appearance:anypage') {
						$item->setSelected();
						$child->setSelected();
						break;
					}
				}
				break;
			}
//			var_dump($item->getID());
//			$t = new ElggMenuItem();
		}
	}
}

/**
 * Route to the correct page if defined. Allows a fallthrough to the 404 error page otherwise.
 *
 * @param $hook
 * @param $type
 * @param $value
 * @param $params
 */
function anypage_router($hook, $type, $value, $params) {
	$url = elgg_extract('current_url', $params);
	
	//Remove query string
	$url_array = parse_url($url);
	unset($url_array['query']);
	$url = elgg_http_build_url($url_array);
	
	$path = AnyPage::normalizePath(str_replace(elgg_get_site_url(), '', $url));

//	$handler = elgg_extract('handler', $value);
//	$pages = elgg_extract('segments', $value, array());
//	array_unshift($pages, $handler);
//	$page = implode('/', $pages);

	$page = AnyPage::getAnyPageEntityFromPath($path);

	if (!$page) {
		return;
	}

	if ($page->usesView()) {
		// route to view
		$content = elgg_view($page->getView());
		$layout = $page->getPageLayout();
		if (!$layout) {
			$layout = 'one_column';
		}
		$body = elgg_view_layout($layout, array('content' => $content));
		echo elgg_view_page($page->title, $body);
		exit;
	} else {
		// display entity
		$content = elgg_view_entity($page);
		$layout = $page->getPageLayout();
		if (!$layout) {
			$layout = 'one_column';
		}
		$body = elgg_view_layout($layout, array('content' => $content));
		echo elgg_view_page($page->title, $body);
		exit;
	}
}

/**
 * Prepare form variables for page edit form.
 *
 * @param mixed $page
 * @return array
 */
function anypage_prepare_form_vars($page = null) {
	$values = array(
		'entity' => $page,
		'title' => '',
		'page_path' => '',
		'page_layout' => '',
		'layout' => '',
		'description' => '',
		'use_view' => false,
		'custom_view' => '',
		'guid' => null,
	);
	
	if ($page) {
		foreach (array_keys($values) as $field) {
			if (isset($page->$field)) {
				$values[$field] = $page->$field;
			}
		}
	}

	if (elgg_is_sticky_form('anypage')) {
		$sticky_values = elgg_get_sticky_values('anypage');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('anypage');

	return $values;
}