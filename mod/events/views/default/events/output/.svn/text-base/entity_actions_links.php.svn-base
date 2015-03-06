<?php

$entity = $vars['entity'];
if(!$entity) {
	return false;
}

$css = $vars['css'];

//Try to call a default function and get those links.
$entity_actions = EventsBaseMain::ktform_get_entity_actions_link_default($entity);

if(is_array($entity_actions) && count($entity_actions)) {

	$entity_actions = implode('<span class="sep">·</span>', $entity_actions);
?>			
	<p class="pEditDelete <?php echo $css ?>">
	<?php
		echo $entity_actions;
	?>
	</p>
<?php
}
?>

