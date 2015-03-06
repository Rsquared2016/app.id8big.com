<?php

/**
 * Extended class to add more project supports
 *
 * @author Bortoli German
 */
class ProjectGroup extends ElggGroup {

	/**
	 * Set subtype to project.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "project";
	}

	/**
	 * Returns whether the current group is public membership or not.
	 * overrides the default one to add our logic
	 *
	 * @return bool
	 */
	public function isPublicMembership() {
//		if ($this->membership == ACCESS_PUBLIC) {
//			return true;
//		}

		$handler = get_input('handler');

		if ($handler) {
			if ($handler != 'projects') {
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * Check if the project is avaible to open invitations requests.
	 * 
	 * @return boolean
	 */
	public function isOpenProject() {
		if ($this->membership == ACCESS_PUBLIC) {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Get the invitation type of an user, for example, an user can be invited as contributor or visitor
	 * 
	 * @param integer $user_guid
	 * @return string or boolean if none present
	 */
	public function getInvitedType($user_guid = 0) {

		if (empty($user_guid)) {
			$user_guid = elgg_get_logged_in_user_guid();
		}

		$user = get_user($user_guid);
		if (empty($user)) {
			return FALSE;
		}

		$invite_types = project_get_invite_type_options(array('with_options_values' => FALSE));

		if (is_array($invite_types)) {
			foreach ($invite_types as $type) {
				$result = check_entity_relationship($this->guid, $type, $user->guid);

				if ($result) {
					return $type;
				}
			}
		}

		return FALSE;
	}

	/**
	 * Get the member type of the user if visitor or contributor.
	 * 
	 * @param integer $user_guid
	 * @return string if member type is present otherwise will return false
	 */
	public function getMemberType($user_guid = 0) {

		if (empty($user_guid)) {
			$user_guid = elgg_get_logged_in_user_guid();
		}

		$user = get_user($user_guid);
		if (empty($user)) {
			return FALSE;
		}

		$member_types = array(
			ProjectSettings::REL_COLLABORATOR,
			ProjectSettings::REL_VISITOR,
		);

		if (is_array($member_types)) {
			foreach ($member_types as $type) {
				$result = check_entity_relationship($user->guid, $type, $this->guid);

				if ($result) {
					return $type;
				}
			}
		}

		return FALSE;
	}

	/**
	 * Clear the annotations of invitations for one specific group and user
	 * 
	 * @param integer $user_guid
	 * @return boolean
	 */
	public function clearInvitation($user_guid = 0) {
		if (empty($user_guid)) {
			$user_guid = elgg_get_logged_in_user_guid();
		}

		$user = get_user($user_guid);
		if (empty($user)) {
			return FALSE;
		}

		remove_entity_relationship($this->guid, 'invited', $user_guid);

		$invitation_type = $this->getInvitedType();
		if ($invitation_type) {
			remove_entity_relationship($this->guid, $invitation_type, $user_guid);
		}
	}

	/**
	 * Overrides the custom join function, to add type of members.
	 * 
	 * @param ElggUser $user
	 * @return type
	 */
	public function join(ElggUser $user) {
		$user_guid = $user->getGUID();
		$group_guid = $this->getGUID();

		$success = parent::join($user);
		if ($success) {

			$invitation_type = $this->getInvitedType();
			
			switch ($invitation_type) {
				case ProjectSettings::REL_INVITED_VISITOR:

					$add_membership_type = ProjectSettings::REL_VISITOR;
					break;
				default:
					$add_membership_type = ProjectSettings::REL_COLLABORATOR;
					break;
			}
			
			$this->clearInvitation();

			add_entity_relationship($user_guid, $add_membership_type, $group_guid);
		}

		return $success;
	}

	
	/**
	 * Overrides the leave method to remove the member type of invitations
	 * 
	 * @param ElggUser $user
	 * @return type
	 */
	public function leave(ElggUser $user) {
		$user_guid = $user->getGUID();
		$group_guid = $this->getGUID();

		//To avoid errors we make in this way
		remove_entity_relationship($user_guid, ProjectSettings::REL_COLLABORATOR, $group_guid);
		remove_entity_relationship($user_guid, ProjectSettings::REL_VISITOR, $group_guid);
		
		$this->clearInvitation();
		
		$success = parent::leave($user);

		return $success;
	}
	
	
	/**
	 * Get an associative array with annotation name id and the string name, of valid annotations that must change of permissions.
	 * 
	 * @return array
	 */
	public function getWhiteListAnnotationsNames() {
		
		$annotations = array();
		
		$annotations_names = array(
			'likes',
			'reply',
			'generic_comment',
			'wire_thread',
			'project_topic_post',
		);
		
		foreach($annotations_names as $string) {
			
			$annotation_id = get_metastring_id($string, FALSE);
			if ($annotation_id) {
				$annotations[$annotation_id] = $string;
			}
		}
		
		return elgg_trigger_plugin_hook('annotation:whitelist', 'project', NULL, $annotations);
	}
	
	/**
	 * Updates the annotations, river items, and entities from the group while changing of permission if visible or invisible
	 * if visible all entities will pass to public, otherwise to group acl.
	 */
	public function updateEntitiesPermissions() {
		
		$access_id = $this->access_id;
		$group_acl = $this->group_acl;
		$dbprefix = elgg_get_config('dbprefix');
		
		if (($access_id != PROJECTS_DEFAULT_VISIBLE_ACCESS) && ($access_id != $group_acl)) {
			return FALSE;
		}
		
		//Retrieves all entities no matter type and subtype
		$options = array(
			'container_guid' => $this->getGUID(),
			'limit' => 0,
		);
		
		$entities = elgg_get_entities($options);
		$entities_guids = array();
		
		//Retrieves all the entities associated to the group and we change the permissions here.
		if (is_array($entities) && count($entities) > 0) {
			foreach($entities as $entity) {
				if ($entity instanceof ElggEntity) {
					$entities_guids[$entity->getGUID()] = $entity->getGUID();
				}
			}
			
			$e_guids_string = join(',', $entities_guids);
			$e_sql = "UPDATE {$dbprefix}entities SET access_id = '{$access_id}' WHERE {$dbprefix}entities.guid IN ({$e_guids_string})";
			execute_delayed_write_query($e_sql);
		}
		
		//Add to the entities list the self group is useful to retrieve the annotations and river items from the project.
		$entities_guids[$this->getGUID()] = $this->getGUID();
		
		//Get all the river items from the group and the related entities and we change the permissions
		$r_guids_string = join(',', $entities_guids);
		
		$r_sql = "UPDATE {$dbprefix}river SET access_id = '{$access_id}' WHERE {$dbprefix}river.object_guid IN ({$r_guids_string})";
		execute_delayed_write_query($r_sql);
		
		//Get all the valid annotations ( comments, likes, etc ) related to the associated entities and the self project then we change permissions
		$valid_annotations = $this->getWhiteListAnnotationsNames();
		if (empty($valid_annotations) && !is_array($valid_annotations)) {
			return TRUE;
		}
		
		$a_name_ids_string = join(',', array_keys($valid_annotations));
		
		$a_sql = "UPDATE {$dbprefix}annotations SET access_id = '{$access_id}' 
			WHERE ( {$dbprefix}annotations.name_id IN ($a_name_ids_string) ) AND ( {$dbprefix}annotations.entity_guid IN ({$r_guids_string}) )";
		
		execute_delayed_write_query($a_sql);
		
		return TRUE;
		
	}
	
	public function countMembers() {
		return (int) $this->getMembers(0, 0, TRUE);
	}
	
	public function getMembers($limit = 10, $offset = 0, $count = false) {
		$members = elgg_get_entities_from_relationship(array(
				'relationship' => 'collaborator',
				'relationship_guid' => $this->guid,
				'inverse_relationship' => true,
				'types' => 'user',
				'limit' => $limit,
				'limit' => $offset,
				'count' => $count,
			));
		return $members;
	}
	
	public function countDiscussions() {
		$options = array(
			'type' => 'object',
			'subtype' => 'projectforumtopic',
			'count' => TRUE,
			'container_guid' => $this->getGUID(),
		);
		return elgg_get_entities($options);
	}
	
	public function countFavorites() {
		return rand(1, 79);
	}
	
	public function isFavorite() {
		return rand(0, 1);
	}
	
	public function hasLeanCanvas() {
		$leancanvas_support = $this->leancanvas;
		if (!elgg_is_active_plugin('leancanvas')) {
			return FALSE;
		}
		
		return ($leancanvas_support == 'yes') ? TRUE : FALSE;
	}

	public function hasKanban() {
		$kanban_support = $this->gtask_enable;
		if (!elgg_is_active_plugin('kanban') || !elgg_is_active_plugin('gtask')) {
			return FALSE;
		}
		
		return ($kanban_support == 'yes') ? TRUE : FALSE;
	}

	public function hasCompass() {
		$compass_support = $this->leancanvas;
		if (!elgg_is_active_plugin('compass') || !elgg_is_active_plugin('leancanvas')) {
			return FALSE;
		}
		
		return ($compass_support == 'yes') ? TRUE : FALSE;
	}
	
	public function isCollaborator(ElggUser $user) {
		
		if (!elgg_instanceof($user, 'user')) {
			$user = elgg_get_logged_in_user_entity();
		}
		
		$check_rel = check_entity_relationship($user->guid, ProjectSettings::REL_COLLABORATOR, $this->guid);
		
		if ($check_rel) {
			return true;
		}
		
		return false;
		
	}
	
	public function isVisitor(ElggUser $user) {
		
		if (!elgg_instanceof($user, 'user')) {
			$user = elgg_get_logged_in_user_entity();
		}
		
		$check_rel = check_entity_relationship($user->guid, ProjectSettings::REL_VISITOR, $this->guid);
		
		if ($check_rel) {
			return true;
		}
		
		return false;
		
	}

}
