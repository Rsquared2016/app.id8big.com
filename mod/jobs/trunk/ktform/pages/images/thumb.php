<?php

/**
 * Elgg file thumbnail
 *
 * @package ElggFile
 */
// Get file GUID
$guid = (int) get_input('guid', 0);

// Get file thumbnail size
$size = get_input('size', 'small');
$load_image = get_input('load_image');

if ($load_image) {
	elgg_set_ignore_access(true);
}
// Get file entity
if ($entity = get_entity($guid)) {

	$photo_owner = $entity->getOwnerGUID();
	if ($entity->photo_owner) {
		$photo_owner = $entity->photo_owner;
	}

	$prefix = jobs_images_get_prefix($entity);

	// Get thumbnail
	$thumbfile = "{$prefix}/{$guid}{$size}.jpg";
	//Main file name
	$mainfile = "{$prefix}/{$guid}.jpg";

	if ($size == 'main') {
		$thumbfile = $mainfile;
	}


	// Grab the file
	if ($thumbfile && !empty($thumbfile)) {
		$readfile = new ElggFile();
		$readfile->owner_guid = $photo_owner;
		$readfile->setFilename($thumbfile);

		//Obtenemos el archivo directamente, ya que previamente se valida si existe.
		$contents = $readfile->grabFile();
		
		/*
		 * Estas lineas hacen un doble chequeo si existe el archivo, ya que se realiza el el icon hook,
		 * y aca.
		 * Esto conlleva a que demore mas en retornar la imagen.
		 * Se cree que no afectaria, pero falta testeo.
		 */

		/*
		if ($readfile->exists()) {
			$contents = $readfile->grabFile();
		} else {
			//Get main file.
			$readfile->setFilename($mainfile);
			if ($readfile->exists()) {
				$contents = $readfile->grabFile();
			} else {
				return FALSE;
			}
		}
		 */
		//We get the mimetype of the thumb image, if is a png then we set the header
		$mime_type = 'image/jpeg';
		if ($contents) {
			$img_info = getimagesize($readfile->getFilenameOnFilestore());
			if (array_key_exists('mime', $img_info)) {
				switch ($img_info['mime']) {
					case 'image/png':
					case 'image/x-png':
						$mime_type = $img_info['mime'];
						break;
				}
			}
		}

		elgg_set_ignore_access(false);

		// caching images for 10 days
		header("Content-type: {$mime_type}");
		header('Expires: ' . date('r', time() + 864000));
		header("Pragma: public", true);
		header("Cache-Control: public", true);
		header("Content-Length: " . strlen($contents));

		echo $contents;
		exit;
	}
}
