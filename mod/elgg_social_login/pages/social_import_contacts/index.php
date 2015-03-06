<?php

/**
 * Social Import Contacts
 */

$is_xhr = elgg_is_xhr();

$title = elgg_echo('social_import_contacts');

// Verifico si vienen los contactos para selecionar cuales importar
$social_import_contacts = array();
if (isset($_SESSION['social_import_contacts'])) {
	$social_import_contacts = $_SESSION['social_import_contacts'];
	if(!get_input('userimported', 0)) {
		unset($_SESSION['social_import_contacts']);
		$social_import_contacts = array();
	}
}

$show_form = TRUE;
$contacts = FALSE;
$provider = FALSE;

if (isset($social_import_contacts['error'])) {
	// Error
	register_error($social_import_contacts['error']);
}
elseif (isset($social_import_contacts['contacts'], $social_import_contacts['provider'])) {
	// Contacts
	$show_form = FALSE;
	$contacts = $social_import_contacts['contacts'];
	$provider = $social_import_contacts['provider'];
}

if ($show_form) {
	// Muestro el formulario para seleccionar desde que plataforma importar los contactos
	$params = array(
		'in_lightbox' => false,
	);
	if ($is_xhr) {
		$params['in_lightbox'] = true;
	}
	$content = elgg_view('social_import_contacts/wrapper', $params);
}
else {
	// Muestro el friends picker para seleccionar los contactos a importar.
    if (isset($social_import_contacts['project_guid'])) {
        $project_guid = $social_import_contacts['project_guid'];
        $body_vars = array('contacts' => $contacts, 'provider' => $provider, 'project_guid' => $project_guid);
        $title = elgg_echo('social_import_contacts:invite:to:project');
    } else {
        $body_vars = array('contacts' => $contacts, 'provider' => $provider);
    }
	$form_vars = array();
	$content = elgg_view_form('social_import_contacts/import', $form_vars, $body_vars);
}

if ($is_xhr) {
	echo $content;
	exit;
}

$body = elgg_view_layout('content', array(
	'filter_override' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);