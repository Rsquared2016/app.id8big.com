<?php

/**
 * GDrive Google Edit
 *
 * @package GDrive
 */

// Get google
$google = get_input('google');
$create = get_input('c', 'no');

$page_owner = elgg_get_page_owner_entity();
if (!elgg_instanceof($page_owner, 'group', 'project')) {
    forward(REFERER);
}
if (!$page_owner->canWriteToContainer()) {
    register_error(elgg_echo('gdrive:google:error'));
    forward($page_owner->getURL());
}

$gdi = new GDriveIntegration();
$document_types = $gdi->getDocumentTypesToCreate();

if (!in_array($google, $document_types)) {
    forward();
}

if ($create == 'yes' && elgg_is_xhr()) {
    $gdi->authenticate();

    // Insert file into Google Drive
    $file = $gdi->insertFileSpecial($google);

    if ($file instanceof Google_DriveFile) {
        // Create object elgg
        $gdrive = $gdi->createEntity($file, array(
            'container_guid' => $page_owner->getGUID(),
            'access_id' => $page_owner->group_acl,
        ));
        
        if (elgg_instanceof($gdrive, 'object', 'gdrive')) {
//            $forward = elgg_get_site_url().'gdrive/edit/'.$gdrive_guid.'/'.$google;
            $forward = $gdrive->getURL();
            system_message(elgg_echo('gdrive:google:success'));
            $data = array(
                'forward' => $forward,
            );
            echo json_encode($data);
            forward($forward);
        }
        else {
            register_error(elgg_echo('gdrive:google:error'));
            forward(REFERER);
        }
    }
    else {
        register_error(elgg_echo('gdrive:google:error'));
        forward(REFERER);
    }
}

// Title
$title = elgg_echo('gdrive:menu:title:google:'.$google);

// Content
$content = elgg_view('gdrive/google/wrapper', array(
    'create' => 'yes',
));

$body = elgg_view_layout('google', array(
	 'content' => $content,
));

echo elgg_view_page($title, $body, 'google');