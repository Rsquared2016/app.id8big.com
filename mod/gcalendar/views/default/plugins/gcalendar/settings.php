<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ElggPlugin)) {
	return false;
}

?>
<div>
<?php
	echo elgg_echo('gcalendar:settings:client_id');
	echo elgg_view('input/text', array(
		'name' => 'params[client_id]',
		'value' => $entity->client_id,
	));
?>
</div>
<div>
<?php
	echo elgg_echo('gcalendar:settings:client_secret');
	echo elgg_view('input/text', array(
		'name' => 'params[client_secret]',
		'value' => $entity->client_secret,
	));
?>
</div>