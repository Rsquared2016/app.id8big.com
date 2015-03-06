<?php
  /**
 * images
 *
 * @author Administrator
 */

function gdrive_images_init() {
	global $CONFIG;

	elgg_extend_view('css/elgg','images/css');

	elgg_register_page_handler('gdrive_icon','gdrive_images_page_handler');
	
	elgg_register_event_handler('create', 'object', 'gdrive_images_image_hander');
	elgg_register_event_handler('update', 'object', 'gdrive_images_image_hander');
	
//	elgg_register_event_handler('create', 'group', 'gdrive_images_image_hander');
//	elgg_register_event_handler('update', 'group', 'gdrive_images_image_hander');
	
	
	// Now override icons
	elgg_register_plugin_hook_handler('entity:icon:url', 'all', 'gdrive_images_icon_hook', 999);
}


function gdrive_images_page_handler($page) {
	global $CONFIG;

	//images/$prefix/$entity_guid/$size/$icontime.jpg";
	if($page[0]) {
		set_input('image_prefix', $page[0]);
	}
	if($page[1]) {
		set_input('guid', $page[1]);
	}
	if($page[2]) {
		set_input('size', $page[2]);
	}
	if($page[3]) {
		set_input('icontime', $page[3]);
	}
	
	include $CONFIG->pluginspath . 'gdrive/ktform/pages/images/thumb.php';

	return TRUE;
}

function gdrive_images_image_hander($event, $object_type, $object) {
		$check_event = ($event == 'create' || $event == 'update');
		$valid_objects = array(
//			'group',
			'object',
		);
		
		$check_objects = in_array($object_type, $valid_objects);
	
	if($check_event && $check_objects && $object->getType() == 'object' && $object->getSubType() == 'gdrive') {
		//validate hidden image input, and get name of file.

		if(isset($_SESSION['images']['input_image'])) {
			$input_image = $_SESSION['images']['input_image'];
			$image_options = $_SESSION['images']['image_options'];

			//Force to save the image to a certain object. This prevents to set images to another object.
			//When the main object is created. 
			if(isset($image_options['subtype']) && $image_options['subtype'] != $object->getSubtype()) {
				//Breaks.
				return true;
			}			
			//KTODO: Validate image type ?
			// we have a file photo, so process it
			if (isset($_FILES[$input_image]) && $_FILES[$input_image]['error'] == 0) {
				$files = array();
				$owner_guid = $object->getOwnerGUID();
				$object_guid = $object->getGUID();

				$prefix = gdrive_images_get_prefix($object);

				$file = new ElggFile();
				$file->owner_guid = $owner_guid;
				$file->setFilename("{$prefix}/{$object_guid}.jpg");
				$file->open('write');
                if (isset($image_options['access_id'])) {
                    $file->access_id = $image_options['access_id'];
                }            
				$file->write(get_uploaded_file($input_image));
				
				$file->close();
				$files[] = $file;
				

				if(isset($image_options['resize']) && $image_options['resize']) {
					
					//@todo make this configurable?
					$icon_sizes = array(
						//'topbar' => array('w'=>16, 'h'=>16, 'square'=>TRUE, 'upscale'=>TRUE),
						'tiny' => array('w'=>25, 'h'=>25, 'square'=>TRUE, 'upscale'=>TRUE), //*
						'small' => array('w'=>40, 'h'=>40, 'square'=>TRUE, 'upscale'=>TRUE), 
						'medium' => array('w'=>130, 'h'=>130, 'square'=>TRUE, 'upscale'=>TRUE),
						'large' => array('w'=>200, 'h'=>200, 'square'=>FALSE, 'upscale'=>FALSE),
						'master' => array('w'=>600, 'h'=>600, 'square'=>FALSE, 'upscale'=>FALSE) //*
					);
					
					$icon_sizes = elgg_trigger_plugin_hook('gdrive_images:icon_sizes', 'object', array('entity' => $object), $icon_sizes);

					if (!is_array($icon_sizes)) {
						return TRUE;
					}

					// get the images and save their file handlers into an array
					// so we can do clean up if one fails.
					foreach ($icon_sizes as $name => $size_info) {
						//$resized = get_resized_image_from_uploaded_file($input_image, $size_info['w'], $size_info['h'], $size_info['square'], $size_info['upscale']);
						$resized = gdrive_images_get_resized_image_from_existing_file($_FILES[$input_image]['tmp_name'], $size_info['w'], $size_info['h'], $size_info['square'], 0, 0, 0, 0, $size_info['upscale']);

						if ($resized) {
							//@todo Make these actual entities.  See exts #348.
							$file = new ElggFile();
							$file->owner_guid = $owner_guid;
							$file->setFilename("{$prefix}/{$object_guid}{$name}.jpg");
							$file->open('write');
							$file->write($resized);
							$file->close();
							$files[] = $file;
						} else {
							// cleanup on fail
							foreach ($files as $file) {
								$file->delete();
							}
							$files = array();

							system_message(elgg_echo('image:icon:notfound'));
						}
					}
				}
				
				if(count($files)) {
					$object->icontime = time();
				}

				unset($_SESSION['images']);
				
				//Should return what triggers return ?
				trigger_elgg_event('objectimageupdate', $object_type, $object);
			}
		}
	}
}

/**
 * This hooks into the getIconURL API and provides nice user icons for users where possible.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 * @return unknown
 */

function gdrive_images_icon_hook($hook, $entity_type, $returnvalue, $params){
	global $CONFIG;

	if ((!$returnvalue) && ($hook == 'entity:icon:url') && ($params['entity'] instanceof GDrive)) {
		$entity = $params['entity'];
		$entity_guid = $entity->getGUID();
		
		$photo_owner = $entity->getOwnerGUID();

		$type = $entity->type;
		$subtype = $entity->getSubtype();

		$viewtype = $params['viewtype'];
		$size = $params['size'];
		if(!$size) {
			//If no params should set main ?
			$size = 'small';
		}

		if ($icontime = $entity->icontime) {
			$icontime = "{$icontime}";
		} else {
			$icontime = "default";
		}

		$prefix = gdrive_images_get_prefix($entity);

		//Thumbnail file name
		$thumbfile = "{$prefix}/{$entity_guid}{$size}.jpg";

		//Main file name
		$mainfile = "{$prefix}/{$entity_guid}.jpg";

		$filehandler = new ElggFile();
		$filehandler->owner_guid = $photo_owner;
		$filehandler->setFilename($thumbfile);

		$file_exists = FALSE;
		if ($filehandler->exists()) {
			$file_exists = TRUE;
		} else {
			//Try to get main file.
			$filehandler->setFilename($mainfile);
			if ($filehandler->exists()) {
				$file_exists = TRUE;
				$size = 'main';
			}
		}

		if($file_exists) {
			$url = $CONFIG->url . "gdrive_icon/$prefix/$entity_guid/$size/$icontime.jpg";
			return $url;
		}
	}
}

function gdrive_images_get_entity_icon_url($entity, $size, $viewtype = '') {
	
	$hook = 'entity:icon:url';
	if(!$viewtype) {
		$viewtype = elgg_get_viewtype();
	}
	
	$params = array(
		'viewtype' => $viewtype,
		'entity' => $entity,
		'size' => $size,
	);
	
	return gdrive_images_icon_hook($hook, $entity->getType(), '', $params);
}


function gdrive_images_get_prefix($object) {
	$otype = $object->type;

	switch ($otype) {
		//$prefix = 'images';

		case 'group':
			$prefix = 'groups';
			break;

		default:
			$prefix = $object->getSubtype();
			if (!$prefix) {

				$prefix = $otype;
			}
			break;
	}


	return $prefix;
}

/**
 * Duplicated function on the filestore engine, to add png alpha background support.
 * 
 * Gets the jpeg contents of the resized version of an already uploaded image
 * (Returns false if the file was not an image)
 *
 * @param string $input_name The name of the file on the disk
 * @param int $maxwidth The desired width of the resized image
 * @param int $maxheight The desired height of the resized image
 * @param true|false $square If set to true, takes the smallest of maxwidth and
 * 			maxheight and use it to set the dimensions on the new image. If no
 * 			crop parameters are set, the largest square that fits in the image
 * 			centered will be used for the resize. If square, the crop must be a
 * 			square region.
 * @param int $x1 x coordinate for top, left corner
 * @param int $y1 y coordinate for top, left corner
 * @param int $x2 x coordinate for bottom, right corner
 * @param int $y2 y coordinate for bottom, right corner
 * @param bool $upscale Resize images smaller than $maxwidth x $maxheight?
 * @return false|mixed The contents of the resized image, or false on failure
 */
function gdrive_images_get_resized_image_from_existing_file($input_name, $maxwidth, $maxheight, $square = FALSE, $x1 = 0, $y1 = 0, $x2 = 0, $y2 = 0, $upscale = FALSE) {
		// Get the size information from the image
	$imgsizearray = getimagesize($input_name);
	if ($imgsizearray == FALSE) {
		return FALSE;
	}

	$width = $imgsizearray[0];
	$height = $imgsizearray[1];

	$accepted_formats = array(
		'image/jpeg' => 'jpeg',
		'image/pjpeg' => 'jpeg',
		'image/png' => 'png',
		'image/x-png' => 'png',
		'image/gif' => 'gif'
	);
	
	$allow_transparency_on = array(
		'image/png',
		'image/x-png',
	);

	// make sure the function is available
	$load_function = "imagecreatefrom" . $accepted_formats[$imgsizearray['mime']];
	if (!is_callable($load_function)) {
		return FALSE;
	}

	// get the parameters for resizing the image
	$options = array(
		'maxwidth' => $maxwidth,
		'maxheight' => $maxheight,
		'square' => $square,
		'upscale' => $upscale,
		'x1' => $x1,
		'y1' => $y1,
		'x2' => $x2,
		'y2' => $y2,
	);
	$params = get_image_resize_parameters($width, $height, $options);
	if ($params == FALSE) {
		return FALSE;
	}

	// load original image
	$original_image = $load_function($input_name);
	if (!$original_image) {
		return FALSE;
	}

	$new_image = imagecreatetruecolor($params['newwidth'], $params['newheight']);
	
	$output_img_function = 'imagejpeg';
	$custom_img_quality = 90;
	
	switch($imgsizearray['mime']) {
		case (in_array($imgsizearray['mime'], $allow_transparency_on)):
      
			imagealphablending($new_image, false);
			imagesavealpha($new_image, true);
			
			$transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
			
			imagefilledrectangle($new_image, $params['xoffset'], $params['yoffset'], $params['newwidth'], $params['newheight'], $transparent);
			$output_img_function = 'imagepng';
			$custom_img_quality = NULL;
			
		break;	
	}
	// allocate the new image
	if (!$new_image) {
		return FALSE;
	}

	$rtn_code = imagecopyresampled(	$new_image,
									$original_image,
									0,
									0,
									$params['xoffset'],
									$params['yoffset'],
									$params['newwidth'],
									$params['newheight'],
									$params['selectionwidth'],
									$params['selectionheight']);
	if (!$rtn_code) {
		return FALSE;
	}

	// grab a compressed jpeg version of the image
	ob_start();
	
	if (is_callable($output_img_function)) {
		$output_img_function($new_image, NULL, $custom_img_quality);
	}
	
	$gen_img = ob_get_clean();

	imagedestroy($new_image);
	imagedestroy($original_image);

	return $gen_img;
}
	
elgg_register_event_handler('init', 'system', 'gdrive_images_init');