<?php
/**
* Elgg help_texts save action
*
* @package Help texts
*/

$title = htmlspecialchars(get_input('title', '', false), ENT_QUOTES, 'UTF-8');
$description = get_input('description');
//$target_url = get_input('target_url', FALSE);
$access_id = get_input('access_id');
$section = get_input('section');
$descriptive_icon = get_input('descriptive_icon');
//$tags = get_input('tags');
$guid = get_input('guid');
//$share = get_input('share');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());

elgg_make_sticky_form('help_texts');
// don't use elgg_normalize_url() because we don't want
// relative links resolved to this site.
if ($target_url && !preg_match("#^((ht|f)tps?:)?//#i", $target_url)) {
	$target_url = "http://$target_url";
}


if (!$title || !$description || !$section || !$descriptive_icon) {
	register_error(elgg_echo('help_texts:save:failed'));
	forward(REFERER);
}

if ($guid == 0) {
	$help_text = new ElggObject;
	$help_text->subtype = "help_texts";
	$help_text->container_guid = (int)get_input('container_guid', $_SESSION['user']->getGUID());
	$new = true;
} else {
	$help_text = get_entity($guid);
	if (!$help_text->canEdit()) {
        system_message(elgg_echo('help_texts:save:failed'));
		forward(REFERRER);
	}
}

$help_text->title = $title;
$help_text->description = $description;
$help_text->access_id = $access_id;

if ($help_text->save()) {
    $help_text->section = $section;
    $help_text->target_url = $target_url;
    $help_text->descriptive_icon = $descriptive_icon;
	elgg_clear_sticky_form('help_texts');

	// @todo
//	if (is_array($shares) && sizeof($shares) > 0) {
//		foreach($shares as $share) {
//			$share = (int) $share;
//			add_entity_relationship($help_text->getGUID(), 'share', $share);
//		}
//	}
	system_message(elgg_echo('help_texts:save:success'));

	//add to river only if new
	if ($new) {
//		add_to_river('river/object/help_texts/create','create', elgg_get_logged_in_user_guid(), $help_text->getGUID());
	}

	forward(elgg_get_site_entity().'help_texts/all');
} else {
	register_error(elgg_echo('help_texts:save:failed'));
	forward("help_texts");
}
