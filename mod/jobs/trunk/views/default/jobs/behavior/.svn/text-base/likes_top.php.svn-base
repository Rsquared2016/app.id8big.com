<?php
/*
 * Handle it with a view html.
 *
 * @uses $vars['entity']
 * */
$entity = $vars['entity'];
if (!$entity) {
	return false;
}

$plugin_name = 'likes';
if (elgg_is_active_plugin($plugin_name) == FALSE) {
	return FALSE;
}

$num_likes = elgg_get_annotations($vars['entity']->getGUID(), "", "", 'like');
$action_name = elgg_get_context();

?>

<a href="#" class="aInteract aLikesListing ttip" title="<?php echo sprintf(elgg_echo('jobs_ktform:behavior:likes'), $num_likes) ?>">
	<span class="txtAI alikesTxt"><?php echo $num_likes ?></span>
</a>