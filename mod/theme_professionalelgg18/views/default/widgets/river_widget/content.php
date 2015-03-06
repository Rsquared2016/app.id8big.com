<?php

/**
 * Activity widget content view
 */
$num = (int) $vars['entity']->num_display;

$options = array(
	'limit' => $num,
	'pagination' => false,
);

if (elgg_in_context('dashboard')) {
	if ($vars['entity']->content_type == 'friends') {
		$options['relationship_guid'] = elgg_get_page_owner_guid();
		$options['relationship'] = 'friend';
	}
} else {
	$options['subject_guid'] = elgg_get_page_owner_guid();
}

$content = elgg_list_river($options);

if ($content) {
	echo $content;

//	$more_activities_url = "activity/owner/" . elgg_get_page_owner_entity()->username;
//	$more_link = elgg_view('output/url', array(
//		'href' => $more_activities_url,
//		'text' => elgg_echo('activity:moreactivities'),
//		'is_trusted' => true,
//			));
//	echo "<span class=\"elgg-widget-more\">$more_link</span>";
	
} else {
	echo elgg_echo('river:none');
	
}
