<?php

/**
 * NewsBaseSave
 *
 * This class add form save features to elgg
 * 
 * @author Diego Gallardo and German Bortoli
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

/**
 * This class try to save the information of the form.
 * 
 * @author Diego Gallardo and German Bortoli
 */
class NewsBaseSave {

	protected $type = 'object'; //Force to be object ?
	protected $subtype = '';
	protected $class = '';

	/**
	 * Constructor for NewsBaseForm Save
	 * 
	 * @param string $type the type of the object
	 * @param string $subtype the subtye of the object
	 * @param string $class the form class to handle the data model
	 */
	public function __construct($type, $subtype, $class = '') {
		$this->type = $type;
		$this->subtype = $subtype;
		$this->setClass($class);
	}

	/**
	 * Get the type of the object
	 * @return string 
	 */
	public function getType() {
		return $this->type;
		
	}
	
	/**
	 * Return the subtype or the type of the form save.
	 * @return string.
	 */
	public function getSubtype() {
		$subtype = $this->subtype;
		if(!$subtype) {
			$subtype = $this->type;
		}
		
		return $subtype;
		
	}
	
	/**
	 * Return the subtype or the type of the form save.
	 * @return string.
	 */
	public function setClass($class) {
//		$default = 'ElggObject';

		//If class not exists, set default elgg object class.
		if(class_exists($class)) {
			$this->class = $class;
		} else {
			$this->class = $default;
		}
	}

	/**
	 * Return the asociated class or the type of the form save.
	 * @return string.
	 */
	public function getClass() {
		return $this->class;
	}	
	


	/**
	 * This function save a object.
	 * 
	 * @param int $guid
	 * @param array $data array('title' => 'Some Title', 'description' => 'Some description', 'metadata' => array('key' => 'value') || 'metadata' => array('key' => array('value' => '', 'access_id' => ''))
	 * @param array $entity_options array('owner_guid' => '', 'container_guid' => '', 'access_id' => '')
	 */
	public function save($guid = 0, $data = array(), $entity_options = array()) {
	//Entity default options.
		$default_entity_options = array(
			'owner_guid' => elgg_get_logged_in_user_guid(),
			'container_guid' => NewsBaseMain::ktform_get_container_guid(),
			'access_id' => get_default_access(), //ACCESS_PUBLIC, //ACCESS_DEFAULT,
		);
		
		if (empty($entity_options)) {
			$entity_options = array();
		}
		 
		$static_entity_options = $entity_options;
		$entity_options = array_merge($default_entity_options, $entity_options);

	//Default data options.
		$default_data = array(
			'title' => '', //Entity title
			'description' => '', //Entity description
			'metadata' => array(), //Metadata values.
			'create_river' => TRUE, //Create a river element.
		);
	
		
	//data
		$data = array_merge($default_data, $data);
		if (is_bool($entity_options['create_river']) && $entity_options['create_river'] == FALSE) {
			$data['create_river'] = FALSE;
		}
		
	//Lets begin.
		//Class
		$object_class = $this->getClass();
		$new_entity = false;
		if ($guid == 0) {
			$new_entity = true;
		}
	
		//Error language options.
		$error_object_title = ucfirst($this->getSubtype()); //Dinamic object error name.
		$error_object_key_name = 'news_ktform:save';
		
		//Validate data.
		if (empty($data['title']) && empty($data['description'])) {
			if($new_entity) {
				throw New DataFormatException(sprintf(elgg_echo("$error_object_key_name:entity:title:and:description:empty"), $error_object_title));
			}
		}
		
		//Puede escribir en el container.
		$container = get_entity($entity_options['container_guid']);
		if($container instanceof ElggGroup) {
			if(!$container->canWriteToContainer()) {
				throw New DataFormatException(elgg_echo("$error_object_key_name:entity:can_write_to_container"));
			}
		}
		
		if ($new_entity) {
			$entity = new $object_class();
			
			//If no subtype, we must set the subtype.
			if(!$entity->subtype) {
				$subtype = $this->getSubtype();
				$entity->subtype = $subtype;
			}
			$entity->owner_guid = $entity_options['owner_guid'];
			$entity->container_guid = $entity_options['container_guid'];
		} else {
			// load original object
			$entity = get_entity($guid);
			if (!$entity || !($entity instanceof $object_class)) {
				throw New DataFormatException(sprintf(elgg_echo("$error_object_key_name:entity:cannotload"), $error_object_title));
			}
	
			// user must be able to edit
			if (!$entity->canEdit()) {
				throw New DataFormatException(sprintf(elgg_echo("$error_object_key_name:entity:noaccess"), $error_object_title));
			}
			
			//Force to override the owner and containers
			if (!empty($static_entity_options['owner_guid'])) {
				if ($entity->owner_guid != $static_entity_options['owner_guid']) {
					$entity->owner_guid = $static_entity_options['owner_guid'];
				}
			}
			
			if (!empty($static_entity_options['container_guid'])) {
				if ($entity->container_guid != $static_entity_options['container_guid']) {
					$entity->container_guid = $static_entity_options['container_guid'];
				}
			}
			
			 
			
		}
	
		
		//$entity_options['access_id']
		if (array_key_exists('access_id', $entity_options)) {
			$access_id = $entity_options['access_id'];
		}
		
		
		
		$entity->access_id = $access_id;
		if($data['title']) {
			if (defined('News_st_MAX_LENGHT_TEXT')) {
				$entity->title = elgg_get_excerpt($data['title'], News_st_MAX_LENGHT_TEXT);
			}else{
			$entity->title = $data['title'];
		}
		}
		
		if($data['description']) {
			$entity->description = $data['description'];
		}
	

		$guid = $entity->save();		

		if (empty($guid)) {
			throw New DataFormatException(sprintf(elgg_echo("$error_object_key_name:entity:notsaved"), $error_object_title));
		}
		

		
		//Saves some metadata.
		if($data['metadata'] && is_array($data['metadata'])) {
			foreach($data['metadata'] as $mkey => $mval) {
				if(!is_null($mval)) { //This comparison is correct ?
					$maccessid = $entity->access_id;
					$val = $mval;
					//$allow_multiple ?

					//If is an array. For setting special meta access id.
					if(is_array($mval)) {
						if(array_key_exists('access_id', $mval) && $mval['access_id'] != '') {
							$maccessid = $mval['access_id'];
						}
						
						if(array_key_exists('value', $mval) && $mval['value'] != '') {
							$val = $mval['value'];
						}
						
						
					}
					
					if (is_array($val)) {
						$allow_multiple = TRUE;
						remove_metadata($entity->getGUID(), $mkey);						
						//Start to save
						foreach($val as $metavalue) {
							create_metadata($entity->getGUID(), $mkey, $metavalue, '', $entity->getOwnerGUID(), $maccessid, $allow_multiple);
						}
					} else {
					//Now save the meta.
						create_metadata($entity->getGUID(), $mkey, $val, '', $entity->getOwnerGUID(), $maccessid);
					}
					
					
				}
			}
		}
		
		//Extra actions after save.
		
		//Update river.
		if($data['create_river']) {
			$type = $this->getType();
			$subtype = $this->getSubtype();
			$river_action = 'create'; //The view and the action should be the same.
			if(!$new_entity) {
				$river_action = 'update';
				
				// Remove river items of the day, so that only the left one day
				$posted_time_lower = get_day_start(date('d'), date('m'), date('Y'));
				$posted_time_upper = get_day_end(date('d'), date('m'), date('Y'));
				$options_river = array(
					'types' => $entity->getType(),
					'subtypes' => $entity->getSubtype(),
					'action_types' => $river_action,
					'object_guids' => $entity->getGUID(),
					'posted_time_lower' => $posted_time_lower,
					'posted_time_upper' => $posted_time_upper,
				);
				$delete_river = elgg_delete_river($options_river);
			}

			// Add to the river
	        add_to_river("river/$type/$subtype/$river_action", $river_action, $entity->getOwnerGUID(), $entity->getGUID());
		}
		
		$hook_params = array(
			 'data' => $data,
			 'entity' => $entity,
			 'entity_options' => $entity_options,
			 'guid' => $guid,
		);
		
		elgg_trigger_plugin_hook('ktform:after_save', $type, $hook_params);
			
		return $guid;
		
		
	}
	

}