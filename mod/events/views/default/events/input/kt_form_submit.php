<?php
	$has_required_fields = $vars['has_required_fields'];
	$form_vars = $vars['form_vars'];
	
	
	$container_classname = 'ktForm';
	if (array_key_exists('submit_classname', $form_vars)) {
		if (!empty($form_vars['submit_classname'])) {
			$container_classname = $form_vars['submit_classname'];
		}
	}
	
	$editing_entity = elgg_extract('editing_entity', $vars, FALSE);
	$entity = elgg_extract('entity', $vars);
	
	$delete_link = '';
	
	$context = elgg_get_context();
	
	
	if ($editing_entity && $entity) {
	
		$delete_url = "action/{$context}/delete?guid={$entity->getGUID()}";
		$delete_link = elgg_view('output/confirmlink', array(
			 'href' => $delete_url,
			 'text' => elgg_echo('delete'),
			 'class' => 'elgg-button elgg-button-delete float-alt elgg-requires-confirmation'
				  ));
	}
?>
<div class="elgg-foot">
	<?php if ($has_required_fields) { ?>
		<div class="elgg-subtext mbm">
			<span><?php echo elgg_echo('events:form:footer:has_required_fields'); ?></span>
		</div>
	<?php } ?>
	<?php echo elgg_view('input/submit', array('value' => $vars['value'], 'class' => 'elgg-button elgg-button-submit', 'name' => $vars['name'], 'rel' => $vars['rel'])); ?>
	<?php echo $delete_link ?>
	<div class="clearfloat">&nbsp;</div>
</div>