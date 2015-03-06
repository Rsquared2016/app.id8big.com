<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PollsBaseGroupSave
 *
 * @author Bortoli German <gbortoli@keetup.com>
 */
class PollsBaseGroupSave extends PollsBaseSave {

	protected $type = 'group'; //Force to be object 

	public function __construct($type, $subtype, $class = '') {
		parent::__construct($type, $subtype, $class);

		$this->type = $type;
		$this->subtype = $subtype;
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
		//KTODO: VER LA POSIBILIDAD DE PODER EDITAR LOS OWNERS GUIDS
		$default_entity_options = array(
			'owner_guid' => elgg_get_logged_in_user_guid(),
			'container_guid' => PollsBaseMain::ktform_get_container_guid(),
//			'access_id' => get_default_access(), //ACCESS_PUBLIC, //ACCESS_DEFAULT,
			'access_id' => ACCESS_PUBLIC, //ACCESS_PUBLIC, //ACCESS_DEFAULT,
		);

		if (empty($entity_options)) {
			$entity_options = array();
		}
		
		$static_entity_options = $entity_options;
		
		$entity_options = array_merge($default_entity_options, $entity_options);
		
		//Default data options.
		$default_data = array(
			'name' => '', //Entity title
			'description' => '', //Entity description
			'metadata' => array(), //Metadata values.
			'create_river' => TRUE, //Create a river element.
		);


		//data
		$data = array_merge($default_data, $data);
		if (array_key_exists('create_river', $entity_options) && is_bool($entity_options['create_river'])) {
			$data['create_river'] = $entity_options['create_river'];
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
		$error_object_key_name = 'kt_polls_ktform:save';

		//Validate data.
		if (empty($data['name']) && empty($data['description'])) {
			if ($new_entity) {
				throw New DataFormatException(sprintf(elgg_echo("$error_object_key_name:entity:name:and:description:empty"), $error_object_title));
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
			if (!$entity->subtype) {
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
		if ($data['name']) {
			if (defined('Polls_st_MAX_LENGHT_TEXT')) {
				$entity->name = elgg_get_excerpt($data['name'], Polls_st_MAX_LENGHT_TEXT);
			} else {
				$entity->name = $data['name'];
			}
		}

		if ($data['description']) {
			$entity->description = $data['description'];
		}


		$guid = $entity->save();

		if (empty($guid)) {
			throw New DataFormatException(sprintf(elgg_echo("$error_object_key_name:entity:notsaved"), $error_object_title));
		}



		//Saves some metadata.
		if ($data['metadata'] && is_array($data['metadata'])) {
			
		if (empty($data['metadata']['membership'])) {
			$data['metadata']['membership'] = ACCESS_PUBLIC;
		}			
			
			foreach ($data['metadata'] as $mkey => $mval) {
				if (!is_null($mval)) { //This comparison is correct ?
					$maccessid = $entity->access_id;
					$val = $mval;
					//$allow_multiple ?
					//If is an array. For setting special meta access id.
					if (is_array($mval)) {
						if (array_key_exists('access_id', $mval) && $mval['access_id'] != '') {
							$maccessid = $mval['access_id'];
						}

						if (array_key_exists('value', $mval) && $mval['value'] != '') {
							$val = $mval['value'];
						}
					}

					if (is_array($val)) {
						$allow_multiple = TRUE;
						remove_metadata($entity->getGUID(), $mkey);
						//Start to save
						foreach ($val as $metavalue) {
							create_metadata($entity->getGUID(), $mkey, $metavalue, '', $entity->getOwnerGUID(), $maccessid, $allow_multiple);
						}
					} else {
						//Now save the meta.
						create_metadata($entity->getGUID(), $mkey, $val, '', $entity->getOwnerGUID(), $maccessid);
					}
				}
			}
		}

		if ($new_entity) {
			if ($entity instanceof ElggGroup) {
				$entity->join($entity->getOwnerEntity());
			}
		}
		
		//Extra actions after save.
		//Update river.
		if ($data['create_river']) {
			$type = $this->getType();
			$subtype = $this->getSubtype();
			$river_action = 'create'; //The view and the action should be the same.
			if (!$new_entity) {
				$river_action = 'update';
			}

			// Add to the river
			add_to_river("river/$type/$subtype/$river_action", $river_action, $entity->getOwnerGUID(), $entity->getGUID());
		}

		return $guid;
	}

}
	
