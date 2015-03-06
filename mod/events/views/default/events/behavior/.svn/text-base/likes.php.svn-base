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

/**
 * 	<div class="photoActions">
		<div class="flLef">
			<?php
			
				//Add like button.
				//TODOk: Add some js when you change the image change the compliment code and the compliment count.
				echo elgg_view('likes/item_action/element', array('action_name' => 'like', 'action_update' => 'complimentWrapper|photoActions', 'entity' => $vars['entity']));
			
			?>
		</div>
		<div class="complimentWrapper flRig">
			<?php 
			$ammount = elgg_get_annotations($vars['entity']->getGUID(), "", "", 'like');
			echo $ammount;
			?>
		</div>
		<div class="cThis">&nbsp;</div>
	</div>

<div class="cThis">&nbsp;</div>
 */
?>

			
<a href="#" class="aInteract aLikesListing ttip" title="<?php echo sprintf(elgg_echo('events_ktform:behavior:likes'), $num_likes) ?>"></a>