<?php
	if (isset($vars['entity'])) {
		$entity = $vars['entity'];
	}
	if (!($entity instanceof ElggEntity)) {
		return FALSE;
	}
?>

<div class="KtProfileIconEdit">
	<div class="imgTxt">
		<img src="<?php echo $entity->getIcon() ?>" alt="<?php echo $entity->nombre ?>" class="flLef" />
		<div class="txt">Archivo JPG, GIF o PNG (tamaño máx. 4 MB)</div>
		<div class="cThis">&nbsp;</div>
	</div>
	<?php echo elgg_view('input/file', array('name' => 'profileicon')) ?>
</div>
