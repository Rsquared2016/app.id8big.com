<?php

/**
 * Elgg projects plugin
 *
 * @package ElggProjects
 * 
 * This view render the project types output
 * 
 * Project types options:
 *  commercial
 *  nonprofit
 *  hybrid
 *  Undecided

 */


$value = elgg_extract('value', $vars);

$vars['value'] = project_get_types_options(array('value' => $value));

echo elgg_view('output/text', $vars);