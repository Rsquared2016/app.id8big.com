<?php
/**
 * Project members sidebar
 *
 * @package ElggProjects
 *
 * @uses $vars['entity'] Project entity
 * @uses $vars['limit']  The number of members to display
 */

$limit = elgg_extract('limit', $vars, 14);

$all_link = elgg_view('output/url', array(
	'href' => 'projects/collaborators/' . $vars['entity']->guid,
	'text' => elgg_echo('projects:collaborators:more'),
	'is_trusted' => true,
));

$body = elgg_list_entities_from_relationship(array(
	'relationship' => 'collaborator',
	'relationship_guid' => $vars['entity']->guid,
	'inverse_relationship' => true,
	'types' => 'user',
	'limit' => $limit,
	'list_type' => 'gallery',
	'gallery_class' => 'elgg-gallery-users',
	'pagination' => false
));

//$body .= "<div class='center mts'>$all_link</div>";

?>
<div class="projects-profile-collaborators projects-profile-box">
	<h3><?php echo elgg_echo('projects:profile:team:members'); ?></h3>
<?php
//	echo elgg_view_module('aside', elgg_echo('projects:collaborators'), $body);
	echo elgg_view('groups/profile/module', array(
//		'title' => elgg_echo('projects:profile:activity'),
		'content' => $body,
		'all_link' => $all_link,
	));
?>
</div>