<?php
  /**
 * videos
 *
 * @author Administrator
 */

/*Class*/

//Load some external class
$kt_form_class_path = dirname(dirname(__FILE__));

//Get curl
//Because curl is taken from izap, validates to include it.
//May be, we should rename all the classes.
if(!elgg_is_active_plugin('izap_videos')) {
    require_once  $kt_form_class_path. '/classes/kt_form_video/HelpBaseCurl.php';
}

//Get Feed.
require_once  $kt_form_class_path. '/classes/kt_form_video/HelpBaseGetFeed.php';
require_once  $kt_form_class_path. '/classes/kt_form_video/HelpBaseUrlFeed.php';

function help_videos_init() {
	global $CONFIG;

	elgg_register_event_handler('create', 'object', 'help_videos_video_hander');
	elgg_register_event_handler('update', 'object', 'help_videos_video_hander');
	
	// Now override icons
	//elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'help_videos_icon_hook', 998);
	
	elgg_register_plugin_hook_handler('ktform:profile_full', 'object', 'help_videos_profile_full_hook');
}


function help_videos_video_hander($event, $object_type, $object) {
	if(($event == 'create' || $event == 'update') && $object_type == 'object') {

		//validate hidden video input, and get name of file.
		if(isset($_SESSION['videos']['input_video'])) {
			$input_video = $_SESSION['videos']['input_video'];
			$video_options = $_SESSION['videos']['video_options'];

			if(array_key_exists('generate_thumb', $video_options) === FALSE) {
				$video_options['generate_thumb'] = TRUE;
			}
			
			//Force to save the video to a certain object. This prevents to set videos to another object.
			//When the main object is created. 
			if(isset($video_options['subtype']) && $video_options['subtype'] != $object->getSubtype()) {
				//Breaks.
				return true;
			}
			
			$video_url = get_input($input_video);
			$urlFeed = new HelpBaseUrlFeed();
			$video_components = $urlFeed->setUrl($video_url);
			if(is_array($video_components) && isset($video_components['error'])) {
				register_error($error);
			} else {
				//Add video: id, thumb, type, src. 
				//Serialize this data ?
				$object->video_id = $video_components->videoId;
				$object->video_thumbnail = $video_components->videoThumbnail;
				$object->video_src = $video_components->videoSrc;
				$object->video_type = $video_components->videoType;
				//This is needed for the thumb.
				$object->image_suffix = 'videos';
				
				//Save some thumbs. Check if we want to save it.
				$files = array();
				$video_image = $video_components->fileContent;
				if($video_image && $video_options['generate_thumb']) {
					$owner_guid = $object->getOwnerGUID();
					$object_guid = $object->getGUID();

					//Call to images prefix.
					$prefix = help_images_get_prefix($object);

					$file = new ElggFile();
					$file->owner_guid = $owner_guid;
					$file->setFilename("{$prefix}/{$object_guid}.jpg");
					$file->open('write');
					$success = $file->write($video_image);
					$file->close();
					$files[] = $file;

					$icon_sizes = array(
						//'topbar' => array('w'=>16, 'h'=>16, 'square'=>TRUE, 'upscale'=>TRUE),
						//'tiny' => array('w'=>25, 'h'=>25, 'square'=>TRUE, 'upscale'=>TRUE),
						'small' => array('w'=>40, 'h'=>40, 'square'=>TRUE, 'upscale'=>TRUE), 
						'medium' => array('w'=>130, 'h'=>130, 'square'=>TRUE, 'upscale'=>TRUE),
						'large' => array('w'=>200, 'h'=>200, 'square'=>FALSE, 'upscale'=>FALSE),
						//'master' => array('w'=>600, 'h'=>600, 'square'=>FALSE, 'upscale'=>FALSE) //*
					);
					
					$icon_sizes = elgg_trigger_plugin_hook('help_videos:icon_sizes', 'object', array('entity' => $object), $icon_sizes);

					if (!is_array($icon_sizes)) {
						return TRUE;
					}

					// get the images and save their file handlers into an array
					// so we can do clean up if one fails.
					foreach ($icon_sizes as $name => $size_info) {
						//$resized = get_resized_image_from_existing_file($file->getFilenameOnFilestore(), $size_info['w'], $size_info['h'], $size_info['square'], $size_info['upscale']);
						$resized = kt_get_resized_image_from_existing_file($file->getFilenameOnFilestore(), $size_info['w'], $size_info['h'], $size_info['square'], 0, 0, 0, 0, $size_info['upscale']);

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
					
					if(count($files)) {
						$object->icontime = time();
					}
					
					unset($_SESSION['videos']);

					//Should return what triggers return ?
					trigger_elgg_event('objectvideoimageupdate', $object_type, $object);

				}
				
			}
		}
	}
}

/**
 * This hooks into the profile full, and will return the representation of a video.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 * @return unknown
 */

function help_videos_profile_full_hook($hook, $entity_type, $returnvalue, $params){
	global $CONFIG;

	if ($hook == 'ktform:profile_full'){
		$entity = $params['entity'];
		
		if($entity->video_type && $entity->video_thumbnail) {
			//Send all params to view.
			/*$params = array(
				'entity' => $entity,
				'width' => '',
				'heigth' => '',
			);*/
			
			return elgg_view('help/video', $params);
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

function help_videos_icon_hook($hook, $entity_type, $returnvalue, $params){
	global $CONFIG;

	if ((!$returnvalue) && ($hook == 'entity:icon:url')){
		$entity = $params['entity'];
		
		if($entity->video_type && $entity->video_thumbnail) {
			return $entity->video_thumbnail;
		}
	}
}
	
elgg_register_event_handler('init', 'system', 'help_videos_init');