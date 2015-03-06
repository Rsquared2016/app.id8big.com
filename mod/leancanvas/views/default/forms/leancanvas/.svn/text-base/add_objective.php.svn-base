<?php

$lean_canvas = elgg_extract('lean_canvas', $vars);

if (!($lean_canvas instanceof leanCanvas)) {
	return;
}

$page_owner = $lean_canvas->getProject();

$page_owner_guid = $page_owner->getGUID();

$section = elgg_extract('section', $vars);
$color = elgg_extract('color', 'yellow');

$description = elgg_extract('title', $vars, '');

$colors_options = leanCanvas::getLeanCanvasColors();

//$lean_objectives = $lean_canvas->renderObjectivesForSection($section);
//
//echo $lean_objectives;

?>
<div class="enterText">
	<?php echo elgg_view('input/plaintext', array('name' => 'lean_objective[title]', 'value' => $description, 'autocomplete' => 'off', 'class' => 'lean_objetive_text', 'id' => 'lean_objetive_text')); ?>
</div>
<div class="selectColor">
	<div class="flRig">
		<?php echo elgg_view("input/dropdown", array('id' => 'lean_objective_color', 'class' => 'no', 'name' => 'lean_objective[color]', 'value' => $color, 'options_values' => $colors_options)); ?>
		<div class="colorSq colorSqYellow flLef on"><div class="colorSqInner"></div></div>
		<div class="colorSq colorSqOrange flLef"><div class="colorSqInner"></div></div>
		<div class="colorSq colorSqBlue flLef nmRig"><div class="colorSqInner"></div></div>
		<div class="clearfloat"></div>
	</div>
	<div class="clearfloat"></div>
</div>
<div class="buttons">
	<?php
		echo elgg_view('input/hidden', array('id' => 'lean_objective_guid', 'name' => 'lean_objective[guid]', 'value' => ''));
		echo elgg_view('input/hidden', array('id' => 'lean_objective_section', 'name' => 'lean_objective[section]', 'value' => $section));
		echo elgg_view('input/hidden', array('id' => 'lean_objective_container_guid', 'name' => 'lean_objective[container_guid]', 'value' => $page_owner_guid));
		echo elgg_view('input/submit', array('id' => 'lean_objective_save', 'name' => 'add', 'value' => elgg_echo('leancanvas:add'), 'data-edit' => elgg_echo('leancanvas:edit'), 'data-add' => elgg_echo('leancanvas:add'), 'class' => 'elgg-button elgg-button-submit'));
		echo elgg_view('output/url', array('text' => elgg_echo('leancanvas:cancel'), 'href' => 'javascript:void(0);', 'class' => 'elgg-button cancel_objective'));
	?>
</div>