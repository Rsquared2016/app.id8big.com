<?php

$filestore_internalname = get_input('name');
$guid = get_input('guid');

$download_file = get_input('dfile', FALSE);

if ($download_file) {
	elgg_set_ignore_access(true);
}

$entity = get_entity($guid);
if (!($entity instanceof Help)) {
	register_error(elgg_echo('kt_file:error:not_entity'));
	forward(REFERER);
}

if (empty($filestore_internalname)) {
	register_error(elgg_echo('kt_file:error:empty_filename'));
	forward(REFERER);
}

$filestore_data = help_get_filestore_data($entity, $filestore_internalname);

if (empty($filestore_data)) {
	register_error(elgg_echo('kt_file:error:empty_filestore'));
	forward(REFERER);
}

$file = new ElggFile();
$file->owner_guid = $entity->getOwnerGUID();
$prefix = help_file_get_prefix($entity);
$file->setFilename($prefix . DIRECTORY_SEPARATOR . $filestore_data['filename']);

$full_path = $file->getFilenameOnFilestore();
$file_exists = file_exists($full_path);

if ($file_exists == FALSE) {
	register_error(elgg_echo('kt_file:error:empty_filestore'));
	forward(REFERER);
}

$mimetype = "application/octet-stream";
if (isset($filestore_data['mimetype']) && !empty($filestore_data['mimetype'])) {
	$mimetype = $filestore_data['mimetype'];
}

// fix for IE https issue 
header("Pragma: public");
header("Content-type: $mimetype");
if (strpos($mimetype, "image/") !== false) {
	header("Content-Disposition: inline; filename=\"{$filestore_data['downloadname']}\"");
} else {
	header("Content-Disposition: attachment; filename=\"{$filestore_data['downloadname']}\"");
}

// allow downloads of large files.
// see http://trac.elgg.org/ticket/1932
ob_clean();
flush();
readfile($full_path);
exit;