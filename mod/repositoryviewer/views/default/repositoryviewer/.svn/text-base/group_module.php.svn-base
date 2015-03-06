<?php

/*
 * Repository Viewer
 */

$project = elgg_extract('entity', $vars, false);
if (!elgg_instanceof($project, 'group', 'project')) {
	return false;
}

if (empty($project->source_url)) {
	return false;
}

echo elgg_view('output/repositoryviewer', array(
	'value' => $project->source_url,
));