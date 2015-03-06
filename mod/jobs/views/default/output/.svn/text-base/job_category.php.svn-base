<?php

if (elgg_is_active_plugin('keetup_categories')) {
    echo elgg_view('output/keetup_categories', $vars);
    return;
}

$entity = elgg_extract('entity', $vars);
$values = elgg_extract('value', $vars);
$view_type = elgg_extract('view_type', $vars);

if(!$values && $entity) {
	$values = $entity->job_category;
}

if($values) {

	if (!is_array($values)) {
		$values = array($values);
	}

	$output = array();
	foreach($values as $key => $val) {
		$params = array();
		$params['href'] = elgg_http_add_url_query_elements('jobs/all?searching_jobs=true', array('job_category' => $val));
		$params['text'] = JobsSettings::getCategories(array('value' => $val));

		$output[$key] = '';

		if($view_type == 'listing' && $key == 0) {

			$output[$key] .= '<p class="elgg-output-categories">';
			$output[$key] .= elgg_echo('jobs:output:jobs_category') . ': ';
		}
		
		$output[$key] .= elgg_view('output/url', $params);
		
		if($view_type == 'listing' && $val == end($values)) {
			$output[$key] .= '</p>';
		}
	}

	echo implode('<span class="jobCategoryStepBreak">&middot;</span>', $output);
}

