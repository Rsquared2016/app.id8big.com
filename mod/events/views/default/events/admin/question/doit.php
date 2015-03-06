<?php
/**
* events_ktform
*
* @author Bortoli German and German Bortoli
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_events_ktform;
run_function_once("events_ktform_qfp");
if ($ASKQUESTION_events_ktform) {
	echo elgg_view('events/admin/question/wrapper');
}