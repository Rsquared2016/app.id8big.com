<?php
/**
 * gdrive plugin settings
 */
/**
 *	Este setting administra:
 *		- Permitir o no que el modulo tenga soporte de grupos.
 *		- Habilitar river items en modulo
 *		- Y que los labels aparezcan abajo o al lado del formulario. 
 */

$entity = elgg_extract('entity', $vars, false);
if (!($entity instanceof ElggPlugin)) {
	return false;
}

// set default value
if (!isset($vars['entity']->group_support)) {
	$vars['entity']->group_support = 'yes';
}
if (!isset($vars['entity']->enable_rivers_items)) {
	$vars['entity']->enable_rivers_items = 'yes';
}
if (!isset($vars['entity']->profile_label_above)) {
	$vars['entity']->profile_label_above = 'yes';
}
?>
<?php /*
<div>
<?php
	echo elgg_echo('gdrive:settings:server_key');
	echo elgg_view('input/text', array(
		'name' => 'params[server_key]',
		'value' => $entity->server_key,
	));
?>
</div>
<div>
<?php
	echo elgg_echo('gdrive:settings:browser_key');
	echo elgg_view('input/text', array(
		'name' => 'params[browser_key]',
		'value' => $entity->browser_key,
	));
?>
</div>
 */ ?>
<div>
<?php
	echo elgg_echo('gdrive:settings:client_id');
	echo elgg_view('input/text', array(
		'name' => 'params[client_id]',
		'value' => $entity->client_id,
	));
?>
</div>
<div>
<?php
	echo elgg_echo('gdrive:settings:client_secret');
	echo elgg_view('input/text', array(
		'name' => 'params[client_secret]',
		'value' => $entity->client_secret,
	));
?>
</div>
<?php
echo '<div>';
echo elgg_echo('gdrive:group_support');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[group_support]',
	'options_values' => array(
		'no' => elgg_echo('gdrive:option:no'),
		'yes' => elgg_echo('gdrive:option:yes')
	),
	'value' => $vars['entity']->group_support,
));
echo '</div>';

echo '<div>';
echo elgg_echo('gdrive:enable_rivers_items');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[enable_rivers_items]',
	'options_values' => array(
		'no' => elgg_echo('gdrive:option:no'),
		'yes' => elgg_echo('gdrive:option:yes')
	),
	'value' => $vars['entity']->enable_rivers_items,
));
echo '</div>';

echo '<div>';
echo elgg_echo('gdrive:profile_label_above');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[profile_label_above]',
	'options_values' => array(
		'no' => elgg_echo('gdrive:option:no'),
		'yes' => elgg_echo('gdrive:option:yes')
	),
	'value' => $vars['entity']->profile_label_above,
));
echo '</div>';
