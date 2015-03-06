<?php

/**
* kt_polls
*
* This action will submit the vote...
* 
* @author Bortoli German
* @link http://community.elgg.org/pg/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

$entity_guid = get_input('guid', FALSE);
$entity = get_entity($entity_guid);

if (!($entity instanceof Polls)) {
	register_error(elgg_echo('kt_polls:errors:entity'));
	forward(REFERER);
}

$success = FALSE;

try {
	$success = $entity->submitPollQuiz();
} catch (Exception $exc) {
	register_error($exc->getMessage());
}

if ($success) {
	system_message(elgg_echo('kt_polls:success:annotation'));
}

forward(REFERER);

