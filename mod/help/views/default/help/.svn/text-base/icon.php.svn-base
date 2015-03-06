<?php

	/**
	 * Ktform icon
	 *
	 * @uses $vars['entity'] The entity.
	 * @uses $vars['size'] The size - small, medium or large. If none specified, medium is assumed.
	 */

	$entity = $vars['entity'];
	if (!($entity instanceof Help)) {
		return FALSE;
	}

	$entity_type = $entity->getType();
	$entity_subtype = $entity->getSubtype();



	$url = $entity->getURL();
	if (isset($vars['img_url'])) {
		$url = $vars['img_url'];
	}


	// Get size
	if (!in_array($vars['size'],array('small','medium','large','tiny','master','topbar')))
		$vars['size'] = "main";

	// Get any align and js
	if (!empty($vars['align'])) {
		$align = " align=\"{$vars['align']}\" ";
	} else {
		$align = "";
	}

	if ($icontime = $vars['entity']->icontime) {
		$icontime = "{$icontime}";
	} else {
		$icontime = "default";
	}

	$title = $entity->title;

?>

<div class="ktformicon <?php echo "{$entity_subtype}icon"; ?> <?php echo "{$entity_type}icon"; ?>">
<a href="<?php echo $url; ?>" class="icon" ><img src="<?php echo $vars['entity']->getIconURL($vars['size']); ?>" border="0" <?php echo $align; ?> title="<?php echo $title; ?>" <?php echo $vars['js']; ?> /></a>
</div>
