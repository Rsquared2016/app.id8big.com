<?php
/**
 * Projects plugin settings
 */

$hidden_projects = (PROJECTS_HIDDEN_GROUPS) ? 'yes' : 'no';
// set default value
if (!isset($vars['entity']->hidden_projects)) {
	$vars['entity']->hidden_projects = $hidden_projects;
}

// set default value
if (!isset($vars['entity']->limited_projects)) {
	$vars['entity']->limited_projects = 'no';
}

echo '<div>';
echo elgg_echo('projects:allowhiddenprojects');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[hidden_projects]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->hidden_projects,
));
echo '</div>';

echo '<div>';
echo elgg_echo('projects:whocancreate');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[limited_projects]',
	'options_values' => array(
		'no' => elgg_echo('LOGGED_IN'),
		'yes' => elgg_echo('admin')
	),
	'value' => $vars['entity']->limited_projects,
));
echo '</div>';
/*
echo '<div class="welcomeMessageWrapper">';
echo '<span class="label">';
echo elgg_echo('projects:welcome_message');
echo elgg_view('output/url', array(
	'text' => elgg_echo('projects:welcome_message:preview'),
	'href' => 'javascript:void(0)',
	'class' => 'preview-welcome-message',
));
echo '</span>';
echo ' ';
echo elgg_view('input/longtext', array(
	'name' => 'params[welcome_message]',
	'value' => $vars['entity']->welcome_message,
	'id' => 'welcome_message',
));
echo '<p class="note">' . elgg_echo('projects:welcome_message:note') . '</p>';
echo '</div>';
 */