<?php

/**
 * jobs
 *
 * @author BOrtoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
define('SUBMIT_JOB_SUBTYPE', 'job_submit');
define('SUBMIT_JOB_RELATIONSHIP', 'applied');
define('SUBMIT_JOB_ATTACH_RELATIONSHIP', 'attached');

require_once(dirname(__FILE__) . '/ktform/start.php');
require_once(dirname(__FILE__) . '/lib/jobs_lib.php');

function jobs_init() {
    $root = dirname(__FILE__);
    //Page Handler
    elgg_register_page_handler('jobs', 'jobs_page_handler');
    elgg_register_entity_url_handler('object', 'job', 'jobs_url');

    elgg_register_plugin_hook_handler('register', 'menu:entity', 'jobs_page_menu');

    elgg_register_js('form.placeholder.js', 'mod/jobs/vendors/placeholder/jquery.placeholder.min.js');

    $listing_item = new ElggMenuItem('jobs', elgg_echo('jobs:plugin:menu:title'), 'jobs/last');
    elgg_register_menu_item('site', $listing_item);

    //Register some actions
    $actions = "$root/actions/jobs/";

    elgg_register_action('jobs/submit', $actions . 'submit_job_a.php');

    //Register some actions settings
    elgg_register_action('jobs/settings/settings', $actions . 'settings/settings.php', 'admin');
    elgg_register_action('jobs/settings/categories', $actions . 'settings/categories.php', 'admin');
    elgg_register_action('jobs/settings/regions', $actions . 'settings/regions.php', 'admin');

    // menu
    elgg_register_admin_menu_item('configure', 'jobs', 'settings');
    
    elgg_register_plugin_hook_handler('keetup_categories:allow', 'context', 'jobs_keetup_categories_support');
}

/**
 * Populates the ->getUrl() method for blog objects
 *
 * @param ElggEntity $blogpost KtJob post entity
 * @return string KtJob post URL
 */
function jobs_url($entity) {

    global $CONFIG;
    $title = $entity->title;
    $title = elgg_get_friendly_title($title);
    return $CONFIG->url . "jobs/view/" . $entity->getGUID() . "/" . $title;
}

function jobs_keetup_categories_support($hook, $type, $return, $params) {
    $return[] = 'jobs';
    return $return;
}

/**
 *  All jobs:			jobs/all
 *  User's jobs:		jobs/owner/<username>
 *  Friends' jobs:		jobs/friends/<username>
 *  View jobs:			jobs/view/<guid>/<title>
 *  New jobs:			jobs/add/<guid> (container: user, group, parent)
 *  Edit jobs:			jobs/edit/<guid>
 *  Group jobs:			jobs/group/<guid>/owner
 */
function jobs_page_handler($page) {
    global $CONFIG;
    switch ($page[0]) {
	case 'add':
	    !@include_once(dirname(__FILE__) . "/pages/jobs/edit_p.php");
	    return true;

	    break;

	case 'edit':
	    set_input('guid', $page[1]);
	    !@include_once(dirname(__FILE__) . "/pages/jobs/edit_p.php");
	    return true;

	    break;

	case 'owner':
	    set_input('username', $page[1]);
	    set_input('entity_owner_filter', 'mine');

	    !@include_once(dirname(__FILE__) . "/pages/jobs/list_p.php");
	    return true;

	    break;
	case 'applies':
	    set_input('username', $page[1]);
	    set_input('entity_owner_filter', 'applies');

	    !@include_once(dirname(__FILE__) . "/pages/jobs/list_p.php");
	    return true;

	    break;
	case 'last':
	    set_input('entity_owner_filter', 'last');
	    !@include_once(dirname(__FILE__) . "/pages/jobs/list_p.php");
	    return true;

	    break;
	case 'friends':
	    set_input('entity_owner_filter', 'friends');
	    !@include_once(dirname(__FILE__) . "/pages/jobs/list_p.php");
	    return true;

	    break;

	case 'view':
	    set_input('guid', $page[1]);
	    !@include_once(dirname(__FILE__) . "/pages/jobs/profile_p.php");
	    return true;
	    break;
	case 'apply':
	    set_input('job_guid', $page[1]);
	    !@include_once(dirname(__FILE__) . "/pages/jobs/submit_job_p.php");
	    return true;
	    break;
	case 'submissions':
	    set_input('guid', $page[1]);
	    !@include_once(dirname(__FILE__) . "/pages/jobs/job_submissions_p.php");
	    return true;
	    break;

	default:
	    if (is_numeric($page[1])) {
		set_input('guid', $page[1]);
		!@include_once(dirname(__FILE__) . "/pages/jobs/profile_p.php");
		return true;
	    } else {
		set_input('entity_owner_filter', 'all');
		!@include_once(dirname(__FILE__) . "/pages/jobs/list_p.php");
		return true;
	    }

	    break;
    }
}

function jobs_page_menu($hook, $type, $return, $params) {
    $entity = elgg_extract('entity', $params);
    $view_type = elgg_extract('view_type', $params);

    if (elgg_instanceof($entity, 'object', 'job') && $view_type == 'listing') {
	$extra_fields = KtJobBaseMain::ktform_get_extra_listing_fields('job');

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
			'name' => "job:listing:title:{$internalname}",
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

elgg_register_event_handler('init', 'system', 'jobs_init');
