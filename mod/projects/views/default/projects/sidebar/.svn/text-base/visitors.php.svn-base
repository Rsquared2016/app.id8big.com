<?php
/**
 * Project members sidebar
 *
 * @package ElggProjects
 *
 * @uses $vars['entity'] Project entity
 * @uses $vars['limit']  The number of members to display
 */

$entity = elgg_extract('entity', $vars);

if (!($entity instanceof ProjectGroup)) {
	return FALSE;
}

$limit = elgg_extract('limit', $vars, 14);

$all_link = elgg_view('output/url', array(
	'href' => 'projects/invited_people/' . $entity->guid,
	'text' => elgg_echo('projects:visitors:more'),
	'is_trusted' => true,
));

$body = elgg_list_entities_from_relationship(array(
	'relationship' => 'visitor',
	'relationship_guid' => $entity->guid,
	'inverse_relationship' => true,
	'types' => 'user',
	'limit' => $limit,
	'list_type' => 'gallery',
	'gallery_class' => 'elgg-gallery-users',
	'pagination' => false
));

if (empty($body)) {
	$empty_txt = "<p>".elgg_echo('projects:widget:empty:visitors')."</p>";
	if ($entity->canEdit()) {
		$invite_url = elgg_view('output/url', array('href' => "projects/invite/{$entity->getGUID()}", 'text' => elgg_echo('projects:invite:visitors')));
		$empty_txt .= "<p>{$invite_url}</p>";
	}
	$body = "<div class='center mts emptyItems'>{$empty_txt}</div>";
	$all_link = '';
} else {
//	$body .= "<div class='center mts'>$all_link</div>";
}

?>
<div class="projects-profile-visitors projects-profile-box">
	<h3><?php echo elgg_echo('projects:profile:project:guest'); ?></h3>
<?php
//	echo elgg_view_module('aside', elgg_echo('projects:visitors'), $body);
	echo elgg_view('groups/profile/module', array(
//		'title' => elgg_echo('projects:profile:activity'),
		'content' => $body,
		'all_link' => $all_link,
	));
?>
</div>