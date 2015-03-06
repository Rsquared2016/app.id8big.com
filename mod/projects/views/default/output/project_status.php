<?php

/**
 * Elgg projects plugin
 *
 * @package ElggProjects
 * 
 * This view render the project status output
 * 
 * Project status options:
 *	Idea Phase
 *	Team Building
 *	Project Development
 *	Seeking Funding
 *	Suspended
 */


$value = elgg_extract('value', $vars);

$vars['value'] = projects_get_status_options(array('value' => $value));

echo elgg_view('output/text', $vars);