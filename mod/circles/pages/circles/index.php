<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

gatekeeper();

// Set page owner
elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

$title = elgg_echo("circles:title");

$content = elgg_view('circles/index');

$body = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'header_override' => '',
	'filter_override' => '',
	'class' => 'ktCirclesMainContainer',
));

echo elgg_view_page($title, $body);