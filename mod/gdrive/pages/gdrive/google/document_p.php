<?php

/**
 * GDrive Google Edit
 */

// Get google
//$google = get_input('google');

// Get entity
$guid = get_input('guid');
$gdrive = get_entity($guid);
if (!elgg_instanceof($gdrive, 'object', 'gdrive')) {
    forward();
}

// Get alternative link
$alternate_link = $gdrive->alternative_link;
//$alternate_link = urldecode(get_input('l'));
if (empty($alternate_link)) {
    forward();
}

// Get page_owner_guid
$page_owner = $gdrive->getContainerEntity();
if (!elgg_instanceof($page_owner, 'group', 'project')) {
    forward();
}
if (!$page_owner->isMember()) {
    forward();
}
elgg_set_page_owner_guid($page_owner->getGUID());

// Si no es el dueño del proyecto y tampoco tiene permisos, forward()
$user_logged_in_guid = elgg_get_logged_in_user_guid();
$opt = array(
    'guid' => $guid,
    'annotation_names' => GDRIVE_PERMISSION_ID,
    'annotation_owner_guids' => $user_logged_in_guid,
);
$annotations = elgg_get_annotations($opt);
if (empty($annotations) && $gdrive->getOwnerGUID() != $user_logged_in_guid) {
    forward($page_owner->getURL());
}

//$gdi = new GDriveIntegration();
//$document_types = $gdi->getDocumentTypesToCreate();
//if (!in_array($google, $document_types)) {
//    forward();
//}

// Title
//$title = elgg_echo('gdrive:menu:title:google:'.$google);
$title = $gdrive->title;

// Content
$content = elgg_view('gdrive/google/wrapper', array(
    'entity' => $gdrive,
));

$body = elgg_view_layout('google', array(
	 'content' => $content,
));

echo elgg_view_page($title, $body, 'google');