<?php
/**
 * Layout of fine_uploader panel loaded in lightbox
 */

$title =  elgg_view_title(elgg_echo('fine_uploader:media'));

$menu = elgg_view_menu('fine_uploader');

$selected = elgg_get_config('fine_uploader_tab');
$tab = elgg_view_form('file/upload', array(
	'class' => 'elgg-form-fine_uploader',
), array(
	'fine_uploader_form' => TRUE,
));

$tab .= elgg_view('graphics/ajax_loader', array(
	'class' => 'fine_uploader-throbber mtl',
));

$container_info = elgg_view('input/hidden', array(
	'name' => 'fine_uploader_container_guid',
	'value' => elgg_get_page_owner_guid(),
));

echo <<<HTML
<div class="fine_uploader-wrapper">
	$title
	$menu
	$tab
	$container_info
</div>
HTML;
