<?php
/**
 * events plugin settings
 */
/**
 *	Este setting administra:
 *		- Permitir o no que el modulo tenga soporte de grupos.
 *		- Habilitar river items en modulo
 *		- Y que los labels aparezcan abajo o al lado del formulario. 
 */

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

echo '<div>';
echo elgg_echo('events:group_support');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[group_support]',
	'options_values' => array(
		'no' => elgg_echo('events:option:no'),
		'yes' => elgg_echo('events:option:yes')
	),
	'value' => $vars['entity']->group_support,
));
echo '</div>';

echo '<div>';
echo elgg_echo('events:enable_rivers_items');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[enable_rivers_items]',
	'options_values' => array(
		'no' => elgg_echo('events:option:no'),
		'yes' => elgg_echo('events:option:yes')
	),
	'value' => $vars['entity']->enable_rivers_items,
));
echo '</div>';

//echo '<div>';
//echo elgg_echo('events:profile_label_above');
//echo ' ';
//echo elgg_view('input/dropdown', array(
//	'name' => 'params[profile_label_above]',
//	'options_values' => array(
//		'no' => elgg_echo('events:option:no'),
//		'yes' => elgg_echo('events:option:yes')
//	),
//	'value' => $vars['entity']->profile_label_above,
//));
//echo '</div>';
$vars['entity']->profile_label_above = 'yes';
echo elgg_view('input/hidden', array(
	'name' => 'params[profile_label_above]',
//	'options_values' => array(
//		'no' => elgg_echo('events:option:no'),
//		'yes' => elgg_echo('events:option:yes')
//	),
	'value' => $vars['entity']->profile_label_above,
));

$site = $vars['entity'];
$timezone_value = $site->site_timezone;

if (empty($timezone_value)) {
	$timezone_value = '';
}


$input = elgg_view('input/dropdown', array('name' => 'params[site_timezone]', 'options_values' => elgg_timezone_get_timezones(TRUE), 'value' => $timezone_value));
?>
<div>
	<p><?php echo elgg_echo('events:admin:timezone:title'); ?></p>	
	<?php
	echo $input;
	?>
</div>

<div class="elgg-admin-notices">
	<p>
		<?php echo elgg_echo('events:admin:timezone:warning') ?>
	</p>
</div>
