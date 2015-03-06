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

$vars['options_values'] = project_get_types_options(array('selectable' => TRUE));
echo elgg_view('input/dropdown', $vars);