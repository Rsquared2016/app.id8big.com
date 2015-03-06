<?php
/**
 * Edit / add a help_text
 *
 * @package Help texts
 */

// once elgg_view stops throwing all sorts of junk into $vars, we can use extract()
$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$section = elgg_extract('section', $vars, '');
$descriptive_icon = elgg_extract('descriptive_icon', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);
$shares = elgg_extract('shares', $vars, array());

?>
<div>
	<label><?php echo elgg_echo('title'); ?>*</label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>
<div>
	<label><?php echo elgg_echo('description'); ?>*</label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>
<div>
	<label><?php echo elgg_echo('help_texts:descriptive_icon'); ?>*</label><br />
	<?php echo elgg_view('input/icon_dropdown', array('name' => 'descriptive_icon', 'value' => $descriptive_icon)); ?>
</div>
<div>
	<label><?php echo elgg_echo('help_texts:section'); ?>*</label><br />
	<?php echo elgg_view('input/section_dropdown', array('name' => 'section', 'value' => $section)); ?>
</div>
<div>
	<label><?php echo elgg_echo('help_texts:mandatory'); ?></label><br />
</div>
<div class="elgg-foot">
<?php

echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
echo elgg_view('input/hidden', array('name' => 'access_id', 'value' => ACCESS_LOGGED_IN));

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

?>
</div>