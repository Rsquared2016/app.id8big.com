<?php

/*
 * Repository Viewer: repositoryviewer/view
 */

// Get url
$url = get_input('repositoryviewer', 'http://github.com/Elgg/Elgg');

// Get form
$body_form = '';
$body_form .= elgg_view('input/repositoryviewer', array(
	'name' => 'repositoryviewer',
	'value' => $url,
));
$body_form .= elgg_view('input/submit', array(
	'name' => 'view',
	'value' => elgg_echo('repositoryviewer:form:view:label'),
));
$form = elgg_view('input/form', array(
	'method' => 'GET',
	'action' => $vars['url'] . 'repositoryviewer/',
	'body' => $body_form,
));

// Get repositoryviewer
$repositoryviewer = elgg_view('output/repositoryviewer', array(
	'name' => 'repositoryviewer',
	'value' => $url,
));

?>
<div class="repositoryviewer-wrapper">
	<div class="repositoryviewer-form"><?php echo $form; ?></div>
	<div class="repositoryviewer-view"><?php echo $repositoryviewer; ?></div>
</div>