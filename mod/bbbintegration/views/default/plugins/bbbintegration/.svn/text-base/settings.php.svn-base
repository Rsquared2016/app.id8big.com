<?php
/**
 * meeting plugin settings
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
if (!isset($vars['entity']->site_timezone)) {
	$vars['entity']->site_timezone = '';
}
if (!isset($vars['entity']->server_url)) {
	$vars['entity']->server_url = '';
}
if (!isset($vars['entity']->security_salt)) {
	$vars['entity']->security_salt = '';
}

// Server url
echo '<div>';
echo elgg_echo('meeting:settings:server_url');
echo ' ';
echo elgg_view('input/text', array(
	'name' => 'params[server_url]',
	'value' => $vars['entity']->server_url,
));
echo '</div>';

// Security salt
echo '<div>';
echo elgg_echo('meeting:settings:security_salt');
echo ' ';
echo elgg_view('input/text', array(
	'name' => 'params[security_salt]',
	'value' => $vars['entity']->security_salt,
));
echo '</div>';
echo '<hr>';

// Timezone
if (!elgg_is_active_plugin('events')) {
    echo '<div>';
    echo elgg_echo('meeting:settings:timezone');
    echo ' ';
    echo elgg_view('meeting/input/timezone', array(
    	'name' => 'params[site_timezone]',
    	'is_pulldown' => TRUE,
    	'value' => $vars['entity']->site_timezone,
    ));
    echo '</div>';
    echo '<div class="elgg-admin-notices" style="padding-bottom: 0;">';
    echo '<p>' . elgg_echo('meeting:admin:timezone:warning') . '</p>';
    echo '</div>';
    echo '<hr>';
}

// Group Support
echo '<div>';
echo elgg_echo('meeting:group_support');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[group_support]',
	'options_values' => array(
		'no' => elgg_echo('meeting:option:no'),
		'yes' => elgg_echo('meeting:option:yes')
	),
	'value' => $vars['entity']->group_support,
));
echo '</div>';

// Enable Rivers Items
echo '<div>';
echo elgg_echo('meeting:enable_rivers_items');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[enable_rivers_items]',
	'options_values' => array(
		'no' => elgg_echo('meeting:option:no'),
		'yes' => elgg_echo('meeting:option:yes')
	),
	'value' => $vars['entity']->enable_rivers_items,
));
echo '</div>';

// Profile Label Above
echo '<div>';
echo elgg_echo('meeting:profile_label_above');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[profile_label_above]',
	'options_values' => array(
		'no' => elgg_echo('meeting:option:no'),
		'yes' => elgg_echo('meeting:option:yes')
	),
	'value' => $vars['entity']->profile_label_above,
));
echo '</div>';
