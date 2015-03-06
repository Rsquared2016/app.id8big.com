<?php

/**
 * All projects listing page navigation
 *
 * @uses $vars['selected'] Name of the tab that has been selected
 */
$tabs = array(
	'newest' => array(
		'text' => elgg_echo('projects:all'),
		'href' => 'projects/all',
		'priority' => 500,
	),
	'popular' => array(
		'text' => elgg_echo('projects:popular'),
		'href' => 'projects/all?filter=popular',
		'priority' => 600,
	),
);

if (elgg_is_logged_in()) {
	$tabs['mine'] = array(
		'text' => elgg_echo('projects:mine'),
		'href' => 'projects/all?filter=mine',
		'priority' => 100,
	);
}

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	if ($vars['selected'] == $name) {
		$tab['selected'] = true;
	}

	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
