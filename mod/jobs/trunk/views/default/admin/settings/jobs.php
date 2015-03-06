<?php
/**
 * Home Site
 */
//elgg_push_context('homesite');
$tab = get_input('tab', 'settings');

$guid = get_input('guid'); //Edit, view
$entity = NULL;
if($guid) {
	$entity = get_entity($guid);
}

//Nav menu
echo elgg_view('jobs/admin/tabs', array('tab' => $tab));

//Form
switch($tab) {
	case 'settings':
	default:
		$body_vars = array();
		echo elgg_view_form("jobs/settings/$tab", array('class' => "elgg-form-$tab"), $body_vars);
		break;
}
