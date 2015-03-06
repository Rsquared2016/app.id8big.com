<?php

/*
 * GDriveIntegration
 * 
 * API Console https://code.google.com/apis/console/
 * API https://developers.google.com/drive/v2/reference
 * 
 * Mime Types https://developers.google.com/drive/mime-types
 * 
 * Create Client ID
 * 
 * Application Type: Web Application
 * 
 */

// Require
//$vendors = elgg_get_plugins_path() . 'gdrive/vendors/';
//require_once($vendors . 'google/Google_Client.php');
//require_once($vendors . 'google/contrib/Google_Oauth2Service.php');
//require_once($vendors . 'google/contrib/Google_DriveService.php');

class GDriveIntegration {

	/**
	 * Attributtes
	 */
	private $client,
			$drive,
			$calendar;
	
	/**
	 * Construct
	 */
	public function __construct() {
		
		// Get site
		$site = elgg_get_site_entity();
		
		// Create Google Client
		$this->client = new Google_Client();
		
		// Set config
		$this->client->setUseObjects(true);
		$this->client->setAuthClass('Google_OAuth2');
		$this->client->setApplicationName($site->name);
		
		// Set client id and client secret
		$client_id = elgg_get_plugin_setting('client_id', 'gdrive');
		$client_secret = elgg_get_plugin_setting('client_secret', 'gdrive');
		$this->client->setClientId($client_id);
		$this->client->setClientSecret($client_secret);
		
		$this->client->setRedirectUri(elgg_get_site_url() . 'gdrive/authenticate');
		$this->client->setState(substr($_SERVER["REQUEST_URI"], 1));
		
		// Create Google Drive Service
		$this->drive = new Google_DriveService($this->client);
		$this->calendar = new Google_CalendarService($this->client);
		
	}
	
	/**
	 * Authenticate
	 */
	public function authenticate() {
		
		// Authenticate
		if (isset($_GET['code'])) {
			$this->client->authenticate();
			$_SESSION['token'] = $this->client->getAccessToken();
		}
		
		if (isset($_SESSION['token'])) {
			$this->client->setAccessToken($_SESSION['token']);
		}
		
	}
	
	/**
	 * Create Aut Url
	 */
	public function createAuthUrl() {
		
		return $this->client->createAuthUrl();
		
	}
	
	/**
	 * Is Authenticated
	 */
	public function isAuthenticated() {
		
		if ($this->client->getAccessToken()) {
			return true;
		}
		
		return false;
		
	}
	
	/**
	 * Create Folder
	 */
//	public function createFolder(ProjectGroup $entity) {
//		
//		if (!elgg_instanceof($entity, 'group', 'project')) {
//			return false;
//		}
//		
//		$title = $entity->title;
//		$description = $entity->description;
//		$mime_type = 'application/vnd.google-apps.folder';
//		
//		$file = new Google_DriveFile();
//		$file->setTitle($title);
////		$file->setDescription($description);
//		$file->setMimeType($mime_type);
//		
//		try {
////			$data = file_get_contents($tmp_name);
//			
//			$created_file = $this->drive->files->insert($file, array(
////				'data' => $data,
//				'mimeType' => $mime_type,
//			));
//			
//			// Uncomment the following line to print the File ID
//			// print 'File ID: %s' % $createdFile->getId();
//			
//			return $created_file;
//		}
//		catch (Exception $e) {}
//		
//		return false;
//		
//	}
	
	/**
	 * Insert File
	 */
	public function insertFile(GDrive $entity, $file = array()) {
		
		if (!elgg_instanceof($entity, 'object', 'gdrive')) {
			return false;
		}
		
		if (!is_array($file) || empty($file)) {
			return false;
		}
		
		$title = $entity->title;
		$description = $entity->description;
		$mime_type = $file['type'];
		$tmp_name = $file['tmp_name'];
		
		$file = new Google_DriveFile();
		$file->setTitle($title);
		$file->setDescription($description);
		$file->setMimeType($mime_type);
		
		// Set the parent folder.
//		if ($parentId != null) {
//			$parent = new ParentReference();
//			$parent->setId($parentId);
//			$file->setParents(array($parent));
//		}
		
		try {
			$data = file_get_contents($tmp_name);
			
			$created_file = $this->drive->files->insert($file, array(
				'data' => $data,
				'mimeType' => $mime_type,
			));
			
			// Uncomment the following line to print the File ID
			// print 'File ID: %s' % $createdFile->getId();
			
			return $created_file;
		}
		catch (Exception $e) {}
		
		return false;
		
	}
    
    /**
	 * Insert File Special
     * 
     * Create file with a particular mime type
	 */
	public function insertFileSpecial($document_type = '') {
        
        $document_types = $this->getDocumentTypesToCreate();
        if (!in_array($document_type, $document_types)) {
            return FALSE;
        }
		
		$mime_type = array_keys($document_types, $document_type);
        $mime_type = current($mime_type);
		
		$file = new Google_DriveFile();
		$file->setMimeType($mime_type);
		
		try {
			$created_file = $this->drive->files->insert($file, array(
				'mimeType' => $mime_type,
			));
			
			// Uncomment the following line to print the File ID
			// print 'File ID: %s' % $createdFile->getId();
			
			return $created_file;
		}
		catch (Exception $e) {}
		
		return false;
		
	}
	
	/**
	 * Insert Permission
	 */
	public function insertPermission($file_id, $value, $type, $role) {
		
		$permission = new Google_Permission();
		
		$permission->setValue($value);
		$permission->setType($type);
		$permission->setRole($role);
		
		// Set options
		$options_params = array(
			'sendNotificationEmails' => true,
		);
		
		try {
		  return $this->drive->permissions->insert($file_id, $permission, $options_params);
		}
		catch (Exception $e) {}
		
		return false;
		
	}
	
	/**
	 * Delete Permission
	 */
	public function deletePermission($file_id, $permission_id) {
		
		try {
			return $this->drive->permissions->delete($file_id, $permission_id);
		}
		catch (Exception $e) {}
		
		return false;
	}
    
    /**
     * Get type documents to create
     */
    public function getDocumentTypesToCreate() {
        
        $document_types = array(
            'application/vnd.google-apps.document' => 'document',
            'application/vnd.google-apps.spreadsheet' => 'spreadsheet',
        );
        
        return $document_types;
        
    }
    
    /**
     * List
     */
    public function listFiles($parameters = array()) {
		
        $defauls = array(
//            'maxResults' => 10,
        );
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters = array_merge($defauls, $parameters);
        
		try {
		  return $this->drive->files->listFiles($parameters);
		}
		catch (Exception $e) {}
		
		return false;
        
    }
    
    /**
     * Get file
     */
    public function getFile($file_id) {
        
		try {
		  return $this->drive->files->get($file_id);
		}
		catch (Exception $e) {}
		
		return false;
        
    }
    
    /**
     * Create Entity
     */
    public function createEntity(Google_DriveFile $file, $options = array()) {
        
        $success = FALSE;
        
        if ($file instanceof Google_DriveFile) {
            $defaults = array(
                'owner_guid' => elgg_get_logged_in_user_guid(),
                'container_guid' => elgg_get_logged_in_user_guid(),
                'access_id' => ACCESS_LOGGED_IN,
            );
            if (!is_array($options)) {
                $options = array();
            }
            $options = array_merge($defaults, $options);
            
            $gdrive = new GDrive();
            $gdrive->owner_guid = $options['owner_guid'];
            $gdrive->container_guid = $options['container_guid'];
            $gdrive->access_id = $options['access_id'];
            $gdrive->title = $file->getTitle();
            $gdrive_guid = $gdrive->save();
            if ($gdrive_guid) {
                $gdrive->file_id = $file->getId();
                $gdrive->alternative_link = $file->getAlternateLink();
                $gdrive->mimetype = $file->getMimeType();
                
                // Create river
                $type = 'object';
                $subtype = 'gdrive';
                $river_action = 'create';
                add_to_river("river/$type/$subtype/$river_action", $river_action, $gdrive->getOwnerGUID(), $gdrive->getGUID());
                
                // Set permissions
                $gdrive->insertPermissionsCollaborators($this);
                $gdrive->insertPermissionsVisitors($this);
                
                $success = $gdrive;
            }
        }
        
        return $success;
        
    }

}
