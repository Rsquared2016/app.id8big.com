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

$is_xhr = elgg_is_xhr();
if (!$is_xhr) {
	forward();
}

if (!elgg_is_logged_in()) {
	echo '';
	return;
}

$from = get_input('from', 'circles');

echo elgg_view('forms/circles/edit', array('from' => $from));

return;