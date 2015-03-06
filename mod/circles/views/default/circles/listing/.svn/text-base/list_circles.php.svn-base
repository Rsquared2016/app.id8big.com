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

// Defines the number of circles per row
$circles_per_row = 3;

$user = elgg_get_logged_in_user_entity();

$circles = get_user_access_collections($user->getGUID());

if ($circles) {
	$break_max = 3;
	$break_count = 0;
	$break_class = '';
	for ($i = 0; $i < count($circles); $i++) {
		$break_count++;
		if ($break_count == $break_max) {
			$break_count = 0;
			$break_class = 'nmRig';
		} else {
			$break_class = '';
		}
		echo elgg_view('circles/listing/circle', array('circle' => $circles[$i], 'break_class' => $break_class));
	}
}
echo elgg_view('circles/listing/newcircle');