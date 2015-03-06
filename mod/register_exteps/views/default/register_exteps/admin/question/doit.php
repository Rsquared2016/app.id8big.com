<?php
/**
* register_exteps
*
* @author Bortoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

global $ASKQUESTION_register_exteps;
run_function_once("register_exteps_qfp");
if ($ASKQUESTION_register_exteps) {
	echo elgg_view('register_exteps/admin/question/wrapper');
}