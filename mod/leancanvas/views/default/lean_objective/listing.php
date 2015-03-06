<?php
//$lean_canvas = elgg_extract('lean_canvas', $vars);
$entities = elgg_extract('entities', $vars);

$objectives_count = 0;
if (is_array($entities)) {
	$objectives_count = count($entities);
}

if ($objectives_count == 0) {
	return;
}
?>
<?php /*<div class="canvasContentItems">*/ ?>
	<?php
		foreach ($entities as $entity) {
			echo elgg_view('lean_objective/list_item', array('entity' => $entity));
		}
	?>
<?php /*</div> */ ?>