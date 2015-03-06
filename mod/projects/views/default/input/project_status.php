<?php

/**
 * Elgg projects plugin
 *
 * @package ElggProjects
 * 
 * This view render the project status options as a pulldown
 * 
 * Project status options:
 *	Idea Phase
 *	Team Building
 *	Project Development
 *	Seeking Funding
 *	Suspended
 */

$vars['options_values'] = projects_get_status_options(array('selectable' => TRUE));
echo elgg_view('input/dropdown', $vars);