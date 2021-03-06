<?php
/**
 * Edit / add a page
 */

extract($vars);
$desc_class = $use_view ? 'class="hidden"' : '';
$view_info_class = $use_view ? '' : 'class="hidden"';
$use_view_checked = $use_view ? 'checked="checked"' : '';

?>
<div>
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'title',
		'value' => $title
	));
	?>
</div>

<div>
	<label><?php echo elgg_echo('anypage:path'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'page_path',
		'value' => $page_path,
		'id' => 'anypage-path'
	));
	// add notice if there is an unsupported character
	if ($entity && $entity->hasUnsupportedPageHandlerCharacter($entity->getPagePath())) {
		$module_title = elgg_echo('anypage:warning');
		$msg = elgg_echo('anypage:unsupported_page_handler_character');
		echo elgg_view_module('info', $module_title, $msg, array('class' => 'pvm elgg-message elgg-state-error'));
	}
	echo elgg_echo('anypage:path_full_link') . ': ';
	echo elgg_view('output/url', array(
		'href' => $entity ? $entity->getPagePath() : '',
		'text' => elgg_normalize_url($entity ? $entity->getPagePath() : ''),
		'class' => 'anypage-updates-on-path-change'
	));
	?>
</div>

<div>
	<label>
	<?php
	echo elgg_echo('anypage:use_view');
	?>
	<input type="checkbox" id="anypage-use-view" name="use_view" value="1" <?php echo $use_view_checked; ?> />
	</label>
</div>

<div id="anypage-view-info" <?php echo $view_info_class;?>>
	<p>
	<?php
	echo '<p>' . elgg_echo('anypage:view_info');
	echo " anypage<span class=\"anypage-updates-on-path-change\">$page_path</span>";
	echo '</p>';
	?>
	</p>
	<label>
	<?php
	echo elgg_echo('anypage:custom_view:use_view');
	?><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'custom_view',
		'value' => $custom_view,
		'id' => 'anypage-custom-view'
	)); 
	?>
	</label>
	
</div>

<div>
	<label><?php echo elgg_echo('anypage:layout'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'page_layout',
		'value' => $layout,
		'id' => 'anypage-layout'
	));
	?>
</div>

<div id="anypage-description" <?php echo $desc_class;?>>
	<label><?php echo elgg_echo('anypage:body'); ?></label>
	<?php
	echo elgg_view('input/longtext', array(
		'name' => 'description',
		'value' => $description
	));
	?>
</div>
<div class="elgg-foot">
<?php

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
	echo elgg_view('output/confirmlink', array(
		'class' => 'float-alt elgg-button elgg-button-action',
		'text' => elgg_echo('delete'),
		'href' => 'action/anypage/delete?guid=' . $guid
	));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

?>
</div>