<?php

/**
 * GDrive import google
 */

$container_guid = get_input('container_guid');
$container = get_entity($container_guid);
if (!elgg_instanceof($container, 'group', 'project')) {
    register_error(elgg_echo('gdrive:import:document:error'));
    forward();
}
if (!$container->canWriteToContainer()) {
    register_error(elgg_echo('gdrive:import:document:error'));
    forward();
}

$file_id = get_input('file_id');

$gdi = new GDriveIntegration();

$gdi->authenticate();

$file = $gdi->getFile($file_id);

if (!($file instanceof Google_DriveFile)) {
    register_error(elgg_echo('gdrive:import:document:error'));
    forward();
}

// Create object elgg
$gdrive = $gdi->createEntity($file, array(
    'container_guid' => $container->getGUID(),
    'access_id' => $container->group_acl,
));

if (elgg_instanceof($gdrive, 'object', 'gdrive')) {
    system_message(elgg_echo('gdrive:import:document:success'));
    echo json_encode(array(
        'forward' => $gdrive->getURL(),
    ));
    forward();
}

register_error(elgg_echo('gdrive:import:document:error'));
forward();