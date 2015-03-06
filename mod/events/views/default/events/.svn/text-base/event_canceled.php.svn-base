<?php

/*
 * 
 */

$entity = elgg_extract('entity', $vars, false);
if (!elgg_instanceof($entity, 'object', 'event')) {
	return true;
}

if (!$entity->isCanceled()) {
	return true;
}

$lang = get_current_language();
?>
<div class="eventState eventStateClosed <?php echo $lang; ?>"></div>