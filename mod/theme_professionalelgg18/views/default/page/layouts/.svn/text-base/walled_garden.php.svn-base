<?php
/**
 * Walled Garden layout
 *
 * @uses $vars['content'] Main content
 * @uses $vars['class']   CSS classes
 * @uses $vars['id']      CSS id
 */

/*$class = elgg_extract('class', $vars, 'elgg-walledgarden-single');
echo elgg_view_module('walledgarden', '', $vars['content'], array(
	'class' => $class,
	'id' => elgg_extract('id', $vars, ''),
	'header' => ' ',
	'footer' => ' ',
));*/

//Remove custom walledgarden class and id
unset($vars['class']);
unset($vars['id']);


$site = elgg_get_site_entity();

$handler = get_input('handler');

if (!$site->isPublicPage() || empty($handler)) {
	unset($vars['content']);
}
 
echo elgg_view_layout('home_site_index', $vars);