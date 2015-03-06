<?php
$entity = elgg_extract('entity', $vars);

$name = elgg_extract('name', $vars, 'write_access_id');

if (!($entity instanceof ElggGroup)) {
    return;
}

if (!($entity instanceof ProjectGroup)) {
	return;
}

//$access_id = $entity->access_id;
$group_access_id = $entity->group_acl;

$group_name = $entity->name;

//if ($group_access_id == $access_id) {
    $access_id = $group_access_id;
	$text = elgg_echo('group:write:access:container:group_entity', array($group_name));
//} else {
//	$access_id = PROJECTS_DEFAULT_VISIBLE_ACCESS;
//	$text = elgg_echo('project:access:container:logged_in');
//}


?>

<div class="projectAccessInputAndOutput">
	<?php
		echo elgg_view('output/text', array('value' => $text));
		echo elgg_view('input/hidden', array('name' => $name, 'value' => $access_id));
	?>
</div>