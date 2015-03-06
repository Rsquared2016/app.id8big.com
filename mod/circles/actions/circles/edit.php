<?php

/**
 * circles
 *
 * Action edit circle
 * 
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

$namecircle = get_input('namecircle', '');
$from = get_input('from', 'circles');

$members = array();

if (!$namecircle) {
	register_error(elgg_echo('circles:error:noname'));
	forward('circles/');
}

$id = create_access_collection($namecircle);

if ($id) {
	$result = update_access_collection($id, $members);
	
	if ($result) {
		system_message(elgg_echo('circles:success:circlesadd'));
		forward(REFERER);
	}
	else {
		register_error(elgg_echo('circles:error:noname'));
		forward('circles/');
	}
}
else {
	register_error(elgg_echo('circles:error:noname'));
	forward('circles/');
}