<?php
/**
* top_notifications
*
* @author German Scarel
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_top_notifications;
run_function_once("top_notifications_qfp");
if ($ASKQUESTION_top_notifications) {
	echo elgg_view('top_notifications/admin/question/wrapper');
}