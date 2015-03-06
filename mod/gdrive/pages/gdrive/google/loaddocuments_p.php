<?php

/**
 * Load documents
 */

if (!elgg_is_xhr()) {
    forward();
}

$guid = get_input('guid');
$page_owner = get_entity($guid);
if (!elgg_instanceof($page_owner, 'group', 'project')) {
    register_error(elgg_echo('gdrive:load:documents:error'));
    forward();
}
if (!$page_owner->canWriteToContainer()) {
    register_error(elgg_echo('gdrive:load:documents:error'));
    forward();
}

$gdi = new GDriveIntegration();

$gdi->authenticate();

$files = $gdi->listFiles();

if ($files instanceof Google_FileList) {
    $items = $files->getItems();
    
    if (is_array($items)) {
        $body = elgg_view('gdrive/import/list_documents', array(
            'items' => $items,
        ));
        echo json_encode(array(
            'output' => $body,
            'system_messages' => array(
                'error' => array(
                    
                ),
                'success' => array(
                    
                ),
            ),
        ));
//        forward();
        exit;
    }
}

register_error(elgg_echo('gdrive:load:documents:error'));
forward();