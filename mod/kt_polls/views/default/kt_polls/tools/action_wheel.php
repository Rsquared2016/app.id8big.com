<?php

/*
 * @ueses $vars['entity']
 * 
 */

$entity = $vars['entity'];
if(!$entity) {
	return false;
}

/*
 * Entity actions section.
 * */
//Tip: If the extra fields are more than 2, we cant display the action section.
if($entity instanceof Polls) {
//if(count($extra_fields) <= 2) {
	
	$entity_actions = array();

	//KTODO: Make configurable the action wheel. By default always be enabled.

	//Try to get from class.
	if(is_callable(array($entity, 'getEntityLinkActions'))) {
		$entity_actions = $entity->getEntityLinkActions();
	} else {
		//Try to call a default function and get those links.
		$entity_actions = PollsBaseMain::ktform_get_entity_actions_link_default($entity);
	}
	
	if (is_array($entity_actions) && count($entity_actions)) {
?>
<div>
	<div class="itemListingToolsWrapper">
		<ul class="itemListingTools">
		<?php
			$max_entity_actions = count($entity_actions);
			$mea_counter = 1;
			foreach($entity_actions as $key => $action_link) {
		?>
			<li <?php if($max_entity_actions == $mea_counter) { echo 'class="lastItemListingTools"'; } else { $mea_counter++; } ?>><?php echo $action_link; ?></li>
		<?php
			}
		?>
		</ul>
	</div>
</div>
<?php
	}
}
?>