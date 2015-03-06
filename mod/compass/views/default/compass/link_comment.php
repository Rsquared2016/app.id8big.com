<?php

/*
 * Link Comment
 */

$entity = elgg_extract('entity', $vars, false);
$comment_type = elgg_extract('comment_type', $vars, false);

if(!$entity || !elgg_instanceof($entity, 'object', 'lean_objective')) {
	return false;
}

$entity_guid = $entity->guid;
$container_guid = $entity->container_guid;

$count = Compass::countComments($entity, $comment_type);
$site_url = elgg_get_site_url();
$link = $site_url . "compass/{$comment_type}/$container_guid/$entity_guid";


$extra_class = $comment_type;
$compass_comment_id = "compass_comments_{$comment_type}_{$entity_guid}";
?>
<div id="<?php echo $compass_comment_id; ?>" class="badge comments <?php echo $extra_class; ?>">
	<?php 
	$comment_img = "<div class='commnetImg'><span></span>{$count}</div>";
	echo elgg_view('output/url', array('href' => $link, 'text' => $comment_img, 'class' => 'compass_comments'));
	?>
</div>
