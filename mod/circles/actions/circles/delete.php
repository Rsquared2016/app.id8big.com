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

$circle_id = get_input('circle_id', '');

if (!can_edit_access_collection($circle_id)) {
	register_error(elgg_echo('circles:error:delete'));
	forward(REFERER);
}

// delete circles
$success = delete_access_collection($circle_id);

if ($success) {
	system_message(elgg_echo('circles:success:delete'));
}
else {
	register_error(elgg_echo('circles:error:delete'));
}

forward(REFERER);