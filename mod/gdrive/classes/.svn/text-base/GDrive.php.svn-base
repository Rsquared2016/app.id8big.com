<?php

/*
 * GDrive
 */

class GDrive extends ElggObject {
	
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "gdrive";
	}

	public function __construct($guid = null) {
		parent::__construct($guid);
	}

	/**
	 * Export the object values, so we can get those in the profile, etc
	 * 
	 * This method has to be implemented allways according to the model
	 *
	 * @param array $exclude
	 * @return array
	 */
	public function getObjectValues($exclude = array()) {

		$form = new GDriveForm();
		return $form->getObjectValues($exclude, $this);
	}

	/**
	 * Imporatant this must be added into the class.
	 *
	 * @param string $section The section you want to get the actions: listing, profile.
	 *
	 * return array of actions links.
	 */
	public function getEntityLinkActions($section = 'listing') {
		global $CONFIG;

		switch ($section) {
			case 'profile':
				$actions = GDriveBaseMain::ktform_get_entity_actions_link_default($this);
				break;

			case 'listing':
			default:
				$actions = GDriveBaseMain::ktform_get_entity_actions_link_default($this);
				break;
		}
		//Can edit.
		if ($this->canEdit()) {
			$actions['edit'] = "<a href='{$CONFIG->url}gdrive/edit/{$this->getGUID()}'>" . elgg_echo('edit') . '</a>';
		}


		return $actions;
	}

	public function getListingLink() {
		global $CONFIG;
		return $CONFIG->url . 'gdrive/';
	}

	public function getTagsOnListing() {
		$tags = $this->getTags();
		
		if (!empty($tags)) {
			$tags = elgg_view('gdrive/output/tags', array('value' => $tags));
			return $tags;
		}
		
		
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Overrides the listing subtitle section
	 */
//Uncomment this line to override the "By Administrator time ago"	
//	public function getSubtitleOnListing() {
//		
//	}
    
    public function insertPermissionsCollaborators(GDriveIntegration $gdi) {
        
        // Google Drive
        if (!($gdi instanceof GDriveIntegration)) {
            return FALSE;
        }
        
        $owner = $this->getOwnerEntity();
        $container = $this->getContainerEntity();
        if (!elgg_instanceof($owner, 'user') || !elgg_instanceof($container, 'group', 'project')) {
            return FALSE;
        }
        $file_id = $this->file_id;
        if (empty($file_id)) {
            return FALSE;
        }
        
        // Get collaborators
        $options = array(
            'type' => 'user',
            'relationship' => 'collaborator',
            'relationship_guid' => $container->getGUID(),
            'inverse_relationship' => true,
            'offset' => 0,
            'limit' => null,
        );
        $collaborators = elgg_get_entities_from_relationship($options);
        if ($collaborators) {
            foreach ($collaborators as $col) {
                $value = $col->email;
                if (is_email_address($value) && $value != $owner->email) {
                    $permission = $gdi->insertPermission($file_id, $value, 'user', 'writer');

                    // Guardo en una anotacion el id del permiso para poder eliminarlo posteriormente si es necesario
                    if ($permission instanceof Google_Permission) {
                        $permission_id = $permission->getId();

                        create_annotation(
                            $this->getGUID(),
                            GDRIVE_PERMISSION_ID,
                            $permission_id,
                            '',
                            $col->getGUID(),
                            ACCESS_LOGGED_IN);
                    }
                }
            }
        }
        
        return TRUE;
        
    }
    
    public function insertPermissionsVisitors(GDriveIntegration $gdi) {
        
        // Google Drive
        if (!($gdi instanceof GDriveIntegration)) {
            return FALSE;
        }
        
        $owner = $this->getOwnerEntity();
        $container = $this->getContainerEntity();
        if (!elgg_instanceof($owner, 'user') || !elgg_instanceof($container, 'group', 'project')) {
            return FALSE;
        }
        $file_id = $this->file_id;
        if (empty($file_id)) {
            return FALSE;
        }
        
        // Get visitors
        $options = array(
            'type' => 'user',
            'relationship' => 'visitor',
            'relationship_guid' => $container->getGUID(),
            'inverse_relationship' => true,
            'offset' => 0,
            'limit' => null,
        );
        $visitors = elgg_get_entities_from_relationship($options);
        if ($visitors) {
            foreach ($visitors as $vis) {
                $value = $vis->email;
                if (is_email_address($value) && $value != $owner->email) {
                    $permission = $gdi->insertPermission($file_id, $value, 'user', 'reader');

                    // Guardo en una anotacion el id del permiso para poder eliminarlo posteriormente si es necesario
                    if ($permission instanceof Google_Permission) {
                        $permission_id = $permission->getId();

                        create_annotation(
                            $this->getGUID(),
                            GDRIVE_PERMISSION_ID,
                            $permission_id,
                            '',
                            $vis->getGUID(),
                            ACCESS_LOGGED_IN);
                    }
                }
            }
        }
        
        return TRUE;
    }

}
