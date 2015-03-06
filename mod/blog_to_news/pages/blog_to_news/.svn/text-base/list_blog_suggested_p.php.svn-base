<?php

/**
 * ktnews
 *
 * @author BOrtoli German and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
global $CONFIG;

$page_owner = elgg_get_page_owner_entity();
$object_subtype = 'blog';



$filter_context = 'blog_to_news_list';

elgg_pop_breadcrumb();

$title = elgg_echo("blog_to_news:title:blog:list");


if ($page_owner === false || is_null($page_owner)) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
}

elgg_push_breadcrumb(elgg_echo('blog'));

$offset = get_input('offset', 0);
$limit = get_input('limit', 10);

$options = array(
     'type' => 'object',
     'subtype' => $object_subtype,
	 'offset' => $offset,
	 'limit' => $limit,
     'annotation_name_value_pairs' => array(array(
                    'name' => 'suggested_to_news',
                    'value' => 'converted',
                    'operand' => '<>',
     )),
     'full_view' => false,
);

$entities_list = elgg_list_entities_from_annotations($options);

if ($entities_list == '') {
    $body = elgg_echo('blog_to_news:blog_suggest:empty');
} else {
    $body = $entities_list;
}



//Main Title section
/****** ADD SEARCH SUPPORT LINKS *****
$add_link = elgg_view('output/url', array('href' => $CONFIG->url . 'news/add/', 'text' => elgg_echo('news:listing:link:add')));
$search_link_text = elgg_echo('news:listing:link:search');
$search_support = NewsBaseMain::ktform_get_filter('news');
$body .= elgg_view('news/listing/main_title', array('title' => $title, 'add_link' => $add_link, 'search_link_text' => $search_link_text,'search_support' => $search_support));
 * 
 */

//$search_support = NewsBaseMain::ktform_get_filter('news');
//$sidebar = elgg_view('news/listing/sidebar_searchform', array('search_support' => $search_support));

//If no entities, do not show the listing titles.
if ($entities_list) {
//	$body .= elgg_view('news/listing/sortable_filter', array('object_subtype' => $object_subtype));
	//Titles section
//	$body .= elgg_view('news/listing/titles', array('object_subtype' => $object_subtype));
}
//Entities
//Remember always it is needed.

//$body .= elgg_view('news/listing/wrapper', array('entities' => $entities_list, 'entity_subtype' => $object_subtype));
elgg_set_context('blog');
$vars = array(
	 'filter_context' => $filter_context,
	 'content' => $body,
	 'title' => $title,
//	 'sidebar' => $sidebar,
);

// don't show filter if out of filter context
if ($page_owner instanceof ElggGroup) {
	$vars['filter'] = false;
}

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);