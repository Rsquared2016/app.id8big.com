<?php
/**
 * Elgg custom index page
 * 
 */
elgg_push_context('front');

//elgg_push_context('widgets');
/**
 *Retrieves the widgets entities 
 */
//elgg_pop_context();

// lay out the content
//$params = array(
//	'blogs' => $blogs,
//	'bookmarks' => $bookmarks,
//	'files' => $files,
//	'groups' => $groups,
//	'login' => $login,
//	'members' => $newest_members,
//);
//$body = elgg_view_layout('custom_index', $params);
$params = array(
	 'home_site' => TRUE,
);
$body = elgg_view_layout('home_site_index', $params);

// no RSS feed with a "widget" front page
global $autofeed;
$autofeed = FALSE;

echo elgg_view_page('', $body);
