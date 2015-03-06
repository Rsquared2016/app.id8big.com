<?php
/**
 * Project profile fields
 */

$project = $vars['entity'];

$profile_fields = elgg_get_config('project');

$params = array(
	'entity' => $project,
);
$profile_fields = elgg_trigger_plugin_hook('projects:fields', 'profile', $params, $profile_fields);

if (is_array($profile_fields) && count($profile_fields) > 0) {

	$even_odd = 'odd';
	foreach ($profile_fields as $key => $valtype) {
		// do not show the name
		if ($key == 'name') {
			continue;
		}

		$value = $project->$key;
		if (empty($value)) {
			continue;
		}

		$options = array('value' => $project->$key);
		if ($valtype == 'tags') {
			$options['tag_names'] = $key;
		}

		echo "<div class=\"{$even_odd}\">";
		echo "<b>";
		echo elgg_echo("projects:$key");
		echo ": </b>";
		echo elgg_view("output/$valtype", $options);
		echo "</div>";

		$even_odd = ($even_odd == 'even') ? 'odd' : 'even';
	}
}
