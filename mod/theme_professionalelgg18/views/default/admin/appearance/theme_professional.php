<?php
/**
 * Home Site
 */
//elgg_push_context('theme_professionalelgg18');
$tab = get_input('tab', ThemeSettings::getDefaultSelectedTab());

//Validate page.
if(!ThemeSettings::settingsPageExists($tab)) {
	register_error('Invalid Page');
	forward(ThemeSettings::getDefaultSettingsPage(TRUE));
	exit;
}

//Edit some entity.
/*$guid = get_input('guid'); //Edit, view
$entity = NULL;
if($guid) {
	$entity = get_entity($guid);
}*/

//Nav menu
echo elgg_view('admin/theme_professionalelgg18/tabs', array('tab' => $tab));

//Form
$body_vars = array();
$form_vars = array('class' => "elgg-form-$tab");
switch($tab) {
	case 'home':
		break;
	case 'settings':
		break;
	case 'style':
		//Load libs.
		elgg_load_css('colorpicker');
		elgg_load_js('colorpicker');
		elgg_load_js('colorpicker_eye');
		break;
}

elgg_push_context("theme_settings_$tab");
//Print form.
echo elgg_view_form("theme_professionalelgg18/$tab", $form_vars, $body_vars);

elgg_pop_context();
