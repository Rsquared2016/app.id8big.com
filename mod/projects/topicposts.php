<?php
/**
 * Elgg Projects topic posts page
 * 
 * @package ElggProjects
 *
 * @deprecated 1.8
 */

// Load Elgg engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

elgg_load_library('elgg:project_discussion');

$guid = get_input('topic');

register_error(elgg_echo('changebookmark'));

forward("/project_discussion/view/$guid");
