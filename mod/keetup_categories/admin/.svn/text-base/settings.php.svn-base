<?php 
	$plugin = find_plugin_settings('keetup_categories');
	$form_body = elgg_view('settings/keetup_categories/edit', array('entity' => $plugin));
	//$submit_button = elgg_view('input/submit', array('value' => elgg_echo('save')));
	$form_body .= "<p>" . elgg_view('input/hidden', array('name' => 'plugin', 'value' => 'keetup_categories')) . $submit_button . "</p>";
	
	$content = elgg_view('input/form', array('action' => "{$CONFIG->url}action/plugins/settings/save", 'body' => $form_body));
	$content = "<div class='contentWrapper'>$content</div>";
	echo $content;
?>