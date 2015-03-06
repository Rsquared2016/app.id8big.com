<?php

/**
 * GDrive import google
 */

// Get entity
$file_guid = get_input('file_guid');
$file_entity = get_entity($file_guid);
if (!elgg_instanceof($file_entity, 'object', 'gdrive')) {
    $data = array(
        'error' => 'yes',
    );
    echo json_encode($data);
    exit;
}

// Get file id
$file_id = get_input('file_id');
if (empty($file_id)) {
    $data = array(
        'error' => 'yes',
    );
    echo json_encode($data);
    exit;
}

$gdi = new GDriveIntegration();
$gdi->authenticate();

$file = $gdi->getFile($file_id);

if (!($file instanceof Google_DriveFile)) {
    $data = array(
        'error' => 'yes',
    );
    echo json_encode($data);
    exit;
}

$result = FALSE;
try {
    $title = $file->getTitle();
    
    $dbprefix = elgg_get_config('dbprefix');
    $query = "UPDATE `{$dbprefix}objects_entity`
    SET title = '{$title}'
    WHERE guid = {$file_entity->getGUID()}";

    $result = update_data($query);
}
catch (Exception $e) {

}

if ($result) {
    $data = array(
        'success' => 'yes',
        'title' => $file->getTitle(),
    );
    echo json_encode($data);
    exit;
}
else {
    $data = array(
        'error' => 'yes',
    );
    echo json_encode($data);
    exit;
}

exit;