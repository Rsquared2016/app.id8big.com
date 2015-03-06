<?php

/**
 * This library pretend to save files to one object handled with gtask_ktform input file
 */
//Constant that defines the file name, that will handle the session and the filefactory
define('Gtask_st_FILE_NAME', 'kt_file');

function gtask_file_init() {
	/**
	 * Register the events
	 */
//	elgg_register_event_handler('create', 'user', 'gtask_file_hander', 999);
	elgg_register_event_handler('profileupdate', 'user', 'gtask_file_hander', 999);
	
	elgg_register_event_handler('create', 'object', 'gtask_file_hander', 999);
	elgg_register_event_handler('update', 'object', 'gtask_file_hander', 999);
	
	elgg_register_event_handler('update', 'group', 'gtask_file_hander', 999);
	elgg_register_event_handler('update', 'group', 'gtask_file_hander', 999);

	elgg_register_page_handler('kt_file', 'gtask_files_handler');

	elgg_register_action('gtask/download/file', dirname(dirname(__FILE__)) . '/actions/kt_file/download_a.php', TRUE);
}

function gtask_files_handler($page) {
	switch ($page[0]) {
		default:
			if (isset($page[0])) {
				set_input('guid', $page[0]);
			}

			if (isset($page[1])) {
				set_input('name', $page[1]);
			}
			//Our controller is the same as the action to download the file, so we dont need to create a page :D
			!@include_once dirname(dirname(__FILE__)) . '/actions/kt_file/download_a.php';
			return true;
			
			
			break;
	}
}

function gtask_file_hander($event, $object_type, $object) {
	$valid_events = array('create', 'update', 'profileupdate');
	$check_event = (in_array($event, $valid_events));

	$valid_objects = array('user', 'object', 'group');
	$check_object = (in_array($object_type, $valid_objects));

	$object_subtype = '';
	if ($object instanceof ElggEntity) {

		$tmp_subtype = $object->getSubtype();
		if (!empty($tmp_subtype)) {
			$object_subtype = $tmp_subtype;
		}
		else {
			if ($object instanceof ElggUser) {
				$object_subtype = 'normal';
			}
		}
	}

	//Validate the event
	if ($check_event && $check_object) {

		//Validate if file session key exists
		if(!array_key_exists(Gtask_st_FILE_NAME, $_SESSION)) {
			return TRUE;
		}
		
		/**
		 * Start to get all the input files that are stored in the session associated to that object
		 * and object subtype
		 */
		$KT_FILE = $_SESSION[Gtask_st_FILE_NAME];
		if (!is_array($KT_FILE)) {
			return TRUE;
		}

		$file_inputs = array();
		if (empty($object_subtype)) {
			if (array_key_exists($object_type, $KT_FILE)) {
				$file_inputs = $KT_FILE[$object_type];
			}
		} else {
			if (array_key_exists($object_type, $KT_FILE)) {
				if (array_key_exists($object_subtype, $KT_FILE[$object_type])) {
					$file_inputs = $KT_FILE[$object_type][$object_subtype];
				}
			}
		}

		//we break if none is setted as subtype or type of object
		if (empty($file_inputs)) {
			return TRUE;
		}

		//We clean the session so we can clean the bugs too
		unset($_SESSION[Gtask_st_FILE_NAME]);

		$owner_guid = $object->getOwnerGUID();
		$object_guid = $object->getGUID();

		$prefix = gtask_file_get_prefix($object);

		foreach ($file_inputs as $internalname => $input) {
			if (isset($_FILES[$internalname]['name']) && !empty($_FILES[$internalname]['name'])) {
				/**
				 * Start to store the inputs
				 */
				$up_file = $_FILES[$internalname]['name'];
				$extension = pathinfo($up_file, PATHINFO_EXTENSION);

				if ($extension) {
					$extension = '.' . $extension;
				}
				//This is a killer feature :D
				$filestorename = elgg_strtolower($object_guid . $internalname . $extension);
				
				//Remove extension.
				$up_file_name = str_replace($extension, '', $up_file);
				$downloadname = friendly_title($up_file_name) . $extension;

				//check if we have already a file, if exists must to be deleted
				$existent_filename = gtask_get_filestore_data($object, $internalname, 'filename');
				if (!empty($existent_filename) && is_string($existent_filename)) {
					$tmp_file = new ElggFile();
					$tmp_file->setFilename($prefix . DIRECTORY_SEPARATOR . $existent_filename);
					$tmp_filename = $tmp_file->getFilenameOnFilestore();

					if (file_exists($tmp_filename)) {
						unlink($tmp_filename);
					}
				}

				$file = new ElggFile();
				$file->owner_guid = $owner_guid;
				$file->setFilename($prefix . DIRECTORY_SEPARATOR . $filestorename);
				$file->setMimeType($_FILES[$internalname]['type']);
				// Open the file to guarantee the directory exists
				$file->open("write");
				$file->close();
				// move using built in function to allow large files to be uploaded
				$success = move_uploaded_file($_FILES[$internalname]['tmp_name'], $file->getFilenameOnFilestore());

				$filestore_internalname = $internalname . '_filestore';

				$filestore_save_data = array(
					'filename' => $filestorename,
					'downloadname' => $downloadname,
					'mimetype' => $file->getMimeType(),
					'simpletype' => gtask_get_general_file_type($_FILES[$internalname]['type']),
					'size' => $file->size(),
				);

				$filestore_save_data = serialize($filestore_save_data);
				
				$access_id = get_input('access_id', FALSE);
				if ($access_id === FALSE) {
					$accesslevel = get_input('accesslevel');
					if (is_array($accesslevel) && array_key_exists($internalname, $accesslevel)) {
						$access_id = $accesslevel[$internalname];
					}
				}
				if ($access_id === FALSE) {
					$access_id = ACCESS_DEFAULT;
				}
				$success_metadata = create_metadata($object_guid, $filestore_internalname, $filestore_save_data, '', $owner_guid, $access_id);

				if ($success_metadata == FALSE) {
					$error_msg = sprintf(elgg_echo('kt_file:error:creating_metadata'), $internalname);
					trigger_error($error_msg);
				}
			}
			else {
				// Update accesslevel for profile user only
				$filestore_internalname = $internalname . '_filestore';
				
				$access_id = FALSE;
				$accesslevel = get_input('accesslevel');
				if (is_array($accesslevel) && array_key_exists($internalname, $accesslevel)) {
					$access_id = $accesslevel[$internalname];
				}
				
				if ($access_id !== FALSE) {
					// Update access
					$meta = get_metadata_byname($object_guid, $filestore_internalname);
					update_metadata(
						$meta->id,
						$meta->name,
						$meta->value,
						$meta->type,
						$meta->owner_guid,
						$access_id);
				}
			}
		}
	} //End of event validation
}

//end of handler function

function gtask_file_get_prefix($object) {

	//$prefix = 'images';
	$prefix = $object->getSubtype();
	if (!$prefix) {
		$prefix = $object->type;
	}

	$prefix = $prefix . DIRECTORY_SEPARATOR . Gtask_st_FILE_NAME;

	return $prefix;
}

function gtask_get_filestore_data($object, $internalname, $return_key = FALSE) {
	if (is_numeric($object)) {
		$object = get_entity($object);
	}

	if (!($object instanceof ElggEntity)) {
		return FALSE;
	}

	$filestore_internalname = $internalname . '_filestore';
	$filestore_data = unserialize($object->$filestore_internalname);

	if (empty($filestore_data) || empty($filestore_data['filename'])) {
		return FALSE;
	}

	if ($return_key) {
		if (array_key_exists($return_key, $filestore_data)) {
			return $filestore_data[$return_key];
		}
	}

	return $filestore_data;
}

/**
 * Returns an overall file type from the mimetype
 *
 * @param string $mimetype The MIME type
 * @return string The overall type
 */
function gtask_get_general_file_type($mimetype) {

	switch($mimetype) {
		case "application/msword":
			return "document";
			break;
		case "application/pdf":
			return "document";
			break;
	}

	if (substr_count($mimetype,'text/'))
		return "document";

	if (substr_count($mimetype,'audio/'))
		return "audio";

	if (substr_count($mimetype,'image/'))
		return "image";

	if (substr_count($mimetype,'video/'))
		return "video";

	if (substr_count($mimetype,'opendocument'))
		return "document";	

	return "general";	
}

elgg_register_event_handler('init', 'system', 'gtask_file_init');