<?php
$container_guid = elgg_get_page_owner_guid();
if (empty($container_guid)) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$context = elgg_get_context();

$add_url = elgg_view('output/url', array('href' => elgg_normalize_url("{$context}/add/{$container_guid}"), 'text' => elgg_echo('projects:create:one')));
$filter = elgg_extract('filter', $vars, 'all');


$search_url = elgg_view('output/url', array(
    'href' => elgg_normalize_url('search'),
    'text' => elgg_echo('projects:advanced_search'),
    'class' => 'js_projects_search',
));
$intro_text = elgg_echo("empty_section:{$context}:{$filter}:intro", array($add_url, $search_url));
?>
<div class="emptySection context-projects filter-all">
	<div class="introText">
		<h2><?php echo $intro_text; ?></h2>
	</div>
	<div class="helpEmptySection no">
		<h4>Help about this</h4>
	</div>
</div>
