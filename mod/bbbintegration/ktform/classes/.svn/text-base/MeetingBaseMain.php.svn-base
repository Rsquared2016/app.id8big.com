<?php

/**
 * Main class that handle the ktform features
 *
 * @author Bortoli German <gbortoli@keetup.com>
 */
class MeetingBaseMain {

	public static $GALLERY_ONE_ROW_MAX_TEXT = 20;
	public static $GALLERY_TWO_ROW_MAX_TEXT = 33;
	public static $Meeting_st_OWNER_ICON_NAME = 'photo_owner';

	public static function ktform_get_current_tab() {
		$current_tab = get_input('ktform_current_tab');

		return $current_tab;
	}

	public static function ktform_set_current_tab($tab) {
		set_input('ktform_current_tab', $tab);
		return true;
	}

	/**
	 * Function to add listing tabs
	 * 
	 * @param string $context
	 * @param array $tabs => array(
	 * 	'tab_key_name' => 'tab url' 
	 * )
	 * //The tab url, could use wildcard. If not you must add the specific url.
	 * //Ej: array('my_page' => '%my_page') => Will be converted to: array('my_page' => 'http://site/plugin/my_page')
	 *
	 * @return mix | bool 
	 */
	public static function ktform_add_listing_tabs($context, $tabs) {
		global $CONFIG;

		if (!$context) {
			return false;
		}

		if (!is_array($tabs)) {
			return false;
		}

		if (!isset($CONFIG->ktform->add_tabs)) {
			$CONFIG->ktform->add_tabs = array();
		}

		//Check if its a single tab or an array of tabs.
		$current = current($tabs);

		if (is_array($current)) {
			$CONFIG->ktform->add_tabs[$context] = $tabs;
		} else {
			$CONFIG->ktform->add_tabs[$context][] = $tabs;
		}

		return true;
	}

	/**
	 * Unset a tab for certain context.
	 * 
	 * @param type $context => The context of the tabs.
	 * @param type $tabs Array with the name of the tabs to remove as a value of the array. // array('tab_name1', 'tab_name2');
	 * @return type 
	 */
	public static function ktform_remove_listing_tabs($context, $tabs) {
		global $CONFIG;

		if (!$context) {
			return false;
		}

		if (!is_array($tabs)) {
			return false;
		}

		if (!isset($CONFIG->ktform->remove_tabs)) {
			$CONFIG->ktform->remove_tabs = array();
		}

		$CONFIG->ktform->remove_tabs[$context] = $tabs;

		return true;
	}

	public static function ktform_get_listing_tabs($plugin_page_url, $context) {
		global $CONFIG;

		if (!$plugin_page_url) {
			return false;
		}

		if (!$context) {
			return false;
		}

		//Default tabs.
		//All links.
		$links['all'] = $plugin_page_url . 'all/';

		//Only logged in could have this links.
		if (elgg_is_admin_logged_in()) {
			$username = elgg_get_logged_in_user_entity()->username;

			$links['mine'] = "{$plugin_page_url}owner/{$username}";
			if (elgg_is_active_plugin('friends')) {
				$links['friends'] = "{$plugin_page_url}friends/";
			}
		}

		//Add new tabs
		if (isset($CONFIG->ktform->add_tabs[$context])) {
			foreach ($CONFIG->ktform->add_tabs[$context] as $key => $tab_params) {
				$tab_key = key($tab_params);
				$tab_url = current($tab_params);

				$url = str_replace('%', $plugin_page_url, $tab_url);

				$links[$tab_key] = $url;
			}
		}

		//Remove tabs.
		if (isset($CONFIG->ktform->remove_tabs[$context])) {
			foreach ($CONFIG->ktform->remove_tabs[$context] as $tab_key) {
				unset($links[$tab_key]);
			}
		}


		return $links;
	}

	/**
	 * Function to set an object as comentable.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @param bool $comments
	 * @return mix | bool 
	 */
	public static function ktform_set_entity_comments_support($object_subtype, $comments = TRUE, $options = array()) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		if (!is_array($options)) {
			$options = array($options);
		}

		//Support for bulk actions
		$default = array(
			 'comments' => $comments,
			 'bulk_support' => FALSE,
		);

		$options = array_merge($default, $options);

		$CONFIG->ktform->$object_subtype->comments_support = $options;

		return true;
	}

	/**
	 * Get if an object subtype have comments supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_entity_comments_support($object_subtype, $entity = FALSE) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->comments_support) &&
				  $CONFIG->ktform->$object_subtype->comments_support['comments']) {

			if ($entity instanceof ElggEntity) {
				return self::ktform_is_entity_commentable($entity);
			}

			return $CONFIG->ktform->$object_subtype->comments_support['comments'];
		}

		return false;
	}

	public static function ktform_get_entity_comments_support_options($object_subtype, $entity = FALSE) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->comments_support)) {
			return $CONFIG->ktform->$object_subtype->comments_support;
		}

		return false;
	}

	/**
	 * Function to set an object as likeable.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @param bool $comments
	 * @return mix | bool 
	 */
	public static function ktform_set_entity_likes_support($object_subtype, $likes = TRUE) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		$CONFIG->ktform->$object_subtype->likes_support = $likes;

		return true;
	}

	/**
	 * Get if an object subtype have likes supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_entity_likes_support($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		if (!elgg_is_admin_logged_in()) {
			return FALSE;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->likes_support)) {
			return $CONFIG->ktform->$object_subtype->likes_support;
		}

		return false;
	}

	/**
	 * Function to set a comment as likeable.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_set_comment_likes_support($object_subtype, $likes = TRUE) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		$CONFIG->ktform->$object_subtype->comment_likes_support = $likes;

		return true;
	}

	/**
	 * Get if a comment have likes supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_comment_likes_support($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		if (!elgg_is_admin_logged_in()) {
			return FALSE;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->comment_likes_support)) {
			return $CONFIG->ktform->$object_subtype->comment_likes_support;
		}

		return false;
	}

	/**
	 * Function to set an object as rateable.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @param bool $comments
	 * @return mix | bool 
	 */
	public static function ktform_set_entity_rating_support($object_subtype, $enabled = TRUE, $options = array()) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		$default = array(
			 'enabled' => $enabled,
			 //Extra fields.
			 'profile' => TRUE,
			 'listing' => TRUE,
		);

		$options = array_merge($default, $options);

		//If the profile is enabled.
		if ($options['listing']) {
			$fields = array(
				 'rate' => array(
					  'type' => 'elggx_fivestar', //Static output.
					  //'output_view' => 'elggx_fivestar/elggx_fivestar', //Enable vote.
					  'options' => array(
							'min' => TRUE,
					  ),
				 ),
			);

			self::ktform_set_extra_listing_fields($object_subtype, $fields);
		}

		$CONFIG->ktform->$object_subtype->rating_support = $options;

		return true;
	}

	/**
	 * Get if an object subtype have likes supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_entity_rating_support($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		if (!elgg_is_admin_logged_in()) {
			return FALSE;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->rating_support)) {
			return $CONFIG->ktform->$object_subtype->rating_support;
		}

		return false;
	}

	/**
	 * Function to set an object as comentable.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @param bool $comments
	 * @return mix | bool 
	 */
	public static function ktform_set_entity_category_support($object_subtype, $category = TRUE) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		$CONFIG->ktform->$object_subtype->category_support = $category;

		return true;
	}

	/**
	 * Get if an object subtype have comments supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_entity_category_support($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->category_support)) {
			return $CONFIG->ktform->$object_subtype->category_support;
		}

		return false;
	}

	/**
	 * Function to set if an entity can have image supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype the object subtype to set the image support
	 * @param bool $image if the object will support images, if FALSE then will hide images icons on listing.
	 * @param bool $photo_owner if set on true, instead to show the object icon, will display the owner icon
	 * 
	 * @return mix | bool 
	 */
	public static function ktform_set_entity_image_support($object_subtype, $image = TRUE, $photo_owner = FALSE) {
		global $CONFIG;

		//KTODO: Seria interesante que esta funcionalidad se agregue en el formulario, si se detecta el soporte de imagenes, que se agregue el input image en el form.
		if (!$object_subtype) {
			return false;
		}

		$CONFIG->ktform->$object_subtype->image_support = $image;

		if ($photo_owner === TRUE) {
			$CONFIG->ktform->$object_subtype->image_support = self::$Meeting_st_OWNER_ICON_NAME;
			return $CONFIG->ktform->$object_subtype->image_support;
		}

		return true;
	}

	/**
	 * Get true or false if an entity have image supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_entity_image_support($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->image_support)) {
			return $CONFIG->ktform->$object_subtype->image_support;
		}

		return false;
	}

	/*
	 * Extra fields in listing.
	 * 
	 * These fields should be added to the listing fields space.
	 * The name of the field will be. elgg_echo('listing:fields:fieldname')
	 * Will be used an output or the metadata name instead. 
	 *
	 * */

	public static function ktform_get_extra_listing_fields($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->listing_extra_fields)) {
			return $CONFIG->ktform->$object_subtype->listing_extra_fields;
		}

		return false;
	}

	/**
	 * Custom fields to show on the listing, 
	 * 
	 * @param string $object_subtype
	 * @param array $fields	the key is the internalname and the value is the type of output
	 * 
	 *
	 * Fields to show on the listing.
	 * There are a range of options supported:
	 * - No key, metadata value. 
	 * 		Eg: $fields = array('meta1', 'meta2');
	 * 
	 * - The key is the internalname and the value is the type of output. 
	 * 		Eg: $fields = array('tags' => 'tags', 'name' => 'text');
	 * 
	 * -  The key is the internalname and the value is an array of options. 
	 * 		Eg: $fields = array(
	 * 				'mypulldown' => array(
	 * 					'type' => 'pulldown', //This will use default: output/pulldown
	 * 					'options' => array(
	 * 						'options_values' => array(), //The options of the view.
	 * 					),
	 * 
	 * 					//'output_view' => 'myview/mycustompulldown', //This will use a custom view, instead of default output.
	 * 				)
	 * 			);
	 * 
	 *
	 *
	 * @return array 
	 */
	public static function ktform_set_extra_listing_fields($object_subtype, $fields, $type = 'normal') {
		global $CONFIG;
//listing_full_extra_fields
//listing_extra_fields
		$kt_listing_name = 'listing_extra_fields';

		switch ($type) {
			case 'full':
				$kt_listing_name = 'listing_full_extra_fields';
				break;

			default:
				$kt_listing_name = 'listing_extra_fields';
				break;
		}


		if (!$object_subtype) {
			return false;
		}

		$formated_fields = array();
		//Pre-format fields.
		if (isset($CONFIG->ktform->$object_subtype->$kt_listing_name)) {
			$formated_fields = $CONFIG->ktform->$object_subtype->$kt_listing_name;
		}

		if (is_array($fields) && count($fields) > 0) {
			foreach ($fields as $key => $val) {
				//Default internalname
				$internalname = $key;

				//Default: Suppose we are talking about a output/text.
				$options = array('type' => 'text');

				if (is_numeric($internalname)) {
					//Convert the val to key.
					$internalname = $val;
				} else {
					if (!is_array($val)) {
						//Suppose the val is the output type.
						$options['type'] = $val;
					} else {
						$options = $val;
					}
				}

				//Add output_view support
				if (!is_array($val) || is_array($val) && !array_key_exists('output_view', $val)) {
					$options['output_view'] = "output/{$options['type']}";
				}

				$formated_fields[$internalname] = $options;
			}

			$CONFIG->ktform->$object_subtype->$kt_listing_name = $formated_fields;
			return true;
		}

		return false;
	}

	/*
	 * Extra fields in listing full.
	 * 
	 * These fields should be added to the listing fields space.
	 * The name of the field will be. elgg_echo('listing:fields:fieldname')
	 * Will be used an output or the metadata name instead. 
	 *
	 * */

	public static function ktform_get_extra_listing_full_fields($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->listing_full_extra_fields)) {
			return $CONFIG->ktform->$object_subtype->listing_full_extra_fields;
		}

		return false;
	}

	/**
	 * Custom fields to show on the listing full.
	 * 
	 * @param string $object_subtype
	 * @param array $fields	the key is the internalname and the value is the type of output
	 * 
	 * 	egg array('custom_tag' => 'tags')
	 * 
	 * if single array is setted for egg array('custom_tag') then it will print the metadata as value, you can do this but is not safe to use in that way.
	 *
	 * @return array 
	 */
	public static function ktform_set_extra_listing_full_fields($object_subtype, $fields) {
		return self::ktform_set_extra_listing_fields($object_subtype, $fields, 'full');
	}

	/**
	 * Function to set support of bulk actions.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @param bool $enabled
	 * @param array $options
	 * 
	 * 	'enabled' => bool
	 * 
	 * 	'tab' => string | tab to apply the bulk action
	 * 
	 * 	'links' => 'links to the actions'
	 * 
	 * @return mix | bool 
	 */
	public static function ktform_set_bulk_action_support($object_subtype, $enabled = TRUE, $options = array()) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		$default = array(
			 'enabled' => $enabled,
			 'tab' => '', //Customs links for differente tabs/url :S
			 'links' => array(),
		);

		$options = array_merge($default, $options);


		$CONFIG->ktform->$object_subtype->bulk_actions = $options;

		return true;
	}

	/**
	 * Get if an object subtype have likes supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_bulk_action_support($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		if (!elgg_is_admin_logged_in()) {
			return FALSE;
		}

		//Hide check if context is different to object_subtype
		$bulk_context_validation = get_input('bulk_context_validation', FALSE);
		$context = elgg_get_context();
		if ($bulk_context_validation && $context != $object_subtype) {
			return false;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->bulk_actions)) {
			return $CONFIG->ktform->$object_subtype->bulk_actions;
		}

		return false;
	}

	/**
	 * Return an array of key value pairs of bulk actions. This will be used into a pulldown.
	 * 
	 * - key: is the bulk action url
	 * - value: is the text displayed
	 * 
	 * Calls a hook with:
	 * 	elgg_trigger_plugin_hook('ktform:entity:bulk:links:actions', 'entity', $params, $bulk_actions);
	 * 		$params = array('object_subtype' => '', 'tab' => 'current_tab_selected')
	 * 
	 * @param string $object_subtype
	 * @return array
	 */
	public static function ktform_get_bulk_action_links($object_subtype) {
		global $CONFIG;

		$tab = self::ktform_get_current_tab();

		/*
		 * - key is the action link.
		 * - value is the text displayed.
		 */
		//Default delete link.
		$delete_link = "{$CONFIG->url}action/meeting/meeting/bulk/delete";

		$bulk_actions = array(
			 '' => elgg_echo('ktform:bulk_actions:select:one'),
			 $delete_link => elgg_echo('ktform:bulk_actions:delete'),
		);

		//Throws a hook.
		//Call a hook.
		$params = array(
			 'object_subtype' => $object_subtype,
			 'tab' => $tab,
			 'context' => elgg_get_context(),
		);

		$bulk_actions = elgg_trigger_plugin_hook('ktform:entity:bulk:links:actions', 'entity', $params, $bulk_actions);


		return $bulk_actions;
	}

	/**
	 * Return the default entity actions.
	 * Should be: edit, delete.
	 * 
	 * Throws a Hook: elgg_trigger_plugin_hook('ktform:entity:links:actions', 'object', $params, $entity_actions)
	 * 
	 * @param string $object_subtype
	 * 
	 * return array
	 */
	public static function ktform_get_entity_actions_link_default($entity, $section = 'listing') {
		global $CONFIG;

		$entity_actions = array();

		$type = $entity->type;
		$subtype = $entity->getSubtype();

		//Default links actions.
		//Edit.
		//This link should be editable. :S
		if ($entity->canEdit() && $subtype) {
			$entity_actions['edit'] = elgg_view('output/url', array(
				 'text' => elgg_echo('edit'),
				 'href' => "{$CONFIG->url}{$subtype}/edit/{$entity->getGUID()}",
					  ));

			//Delete.
			$entity_actions['delete'] = elgg_view('output/confirmlink', array(
				 'href' => "{$CONFIG->url}action/meeting/meeting/delete?guid={$entity->getGUID()}",
				 'text' => elgg_echo('delete')
					  ));
		}

		//Call a hook.
		$params = array(
			 'entity' => $entity,
			 'section' => $section,
		);

		$entity_actions = elgg_trigger_plugin_hook('ktform:entity:links:actions', $type, $params, $entity_actions);

		return $entity_actions;
	}

	/**
	 * Set the configuration of the plugin to manage the filters.
	 * 
	 * @global mix $CONFIG
	 * @param array $options 
	 * 
	 * 		$options = array(
	 * 			'plugin_name' => 'The plugin name, this is usefull to render the form action, and manage other stuffs',
	 * 			'filter' => 'Is the filter php classname to handle the way that will filter.
	 * 		)
	 */
	public static function ktform_set_filter($options = array()) {
		global $CONFIG;

		if (!is_array($options)) {
			$options = array();
		}

		//action_url, ktfilter
		$defaults = array(
			 'plugin_name' => FALSE,
			 'filter' => 'MeetingBaseFilter',
		);

		$options = array_merge($defaults, $options);

		if (empty($options['plugin_name'])) {
			throw new Exception('No Plugin name setted on the filter, File: ' . __FILE__ . ' in line ' . __LINE__);
		}

		$std_object = (object) $options;

		$CONFIG->ktformfilter[$options['plugin_name']] = $std_object;
	}

	/**
	 * Get the string php classname of the filter, depending on the plugin name
	 * 
	 * @global mix $CONFIG
	 * @param string $plugin_name
	 * @return array 
	 */
	public static function ktform_get_filter($plugin_name) {
		global $CONFIG;

		if ($CONFIG->ktformfilter) {
			if (array_key_exists($plugin_name, $CONFIG->ktformfilter)) {
				return $CONFIG->ktformfilter[$plugin_name];
			}
		}

		return FALSE;
	}

	/**
	 * This function will construct the filter object and return it, to manage filtering.
	 *
	 * @param string $plugin_name
	 * @return Instance MeetingBaseFilter
	 */
	public static function ktform_get_filter_object($plugin_name) {

		$filter = self::ktform_get_filter($plugin_name);
		if (!$filter) {
			return FALSE;
		}


		$filter_classname = $filter->filter;

		if (class_exists($filter_classname)) {
			$options = array(
				 'plugin_name' => $plugin_name,
			);
			//KTODO: Filter construct: add extensible options ?
			return new $filter_classname($options);
		}

		return FALSE;
	}

	/**
	 * Set the fields to a plugin
	 * 
	 * @global mix $CONFIG
	 * @param string $plugin_name
	 * @param array $fields
	 * @return boolean
	 *  
	 */
	public static function ktform_set_plugin_fields($plugin_name, $fields) {
		global $CONFIG;

		if (!is_array($fields)) {
			return FALSE;
		}

		if (empty($plugin_name) && !is_string($plugin_name)) {
			return FALSE;
		}

		return $CONFIG->$plugin_name->ktfields = $fields;
	}

	/**
	 * Get the plugin fields.
	 * 
	 * @global mix $CONFIG
	 * @param string $plugin_name
	 * @return mix 
	 */
	public static function ktform_get_plugin_fields($plugin_name) {
		global $CONFIG;

		if (!is_string($plugin_name)) {
			return FALSE;
		}

		return $CONFIG->$plugin_name->ktfields;
	}

	/**
	 * Convert a string to camel case, optionally capitalizing the first char and optionally setting which characters are
	 * acceptable.
	 *
	 * First, take existing camel case and add a space between each word so that it is in Title Form; note that
	 *   consecutive capitals (acronyms) are considered a single word.
	 * Second, capture all contigious words, capitalize the first letter and then convert the rest into lower case.
	 * Third, strip out all the non-desirable characters (i.e, non numerics).
	 *
	 * EXAMPLES:
	 * $str = 'Please_RSVP: b4 you-all arrive!';
	 *
	 * To convert a string to camel case:
	 *  ktform_camelize_string($str); // gives: PleaseRsvpB4YouAllArrive
	 *
	 * To convert a string to an acronym:
	 *  ktform_camelize_string($str, true, 'A-Z'); // gives: PRBYAA
	 *
	 * To convert a string to first-lower camel case without numerics but with underscores:
	 *  ktform_camelize_string($str, false, 'A-Za-z_'); // gives: please_RsvpBYouAllArrive
	 *
	 * @param  string  $str              text to convert to camel case.
	 * @param  bool    $capitalizeFirst  optional. whether to capitalize the first chare (e.g. "camelCase" vs. "CamelCase").
	 * @param  string  $allowed          optional. regex of the chars to allow in the final string
	 * 
	 * @return string camel cased result
	 * 
	 * @author Sean P. O. MacCath-Moran   www.emanaton.com
	 */
	public static function ktform_camelize_string($str, $capitalizeFirst = true, $allowed = 'A-Za-z0-9') {
		return preg_replace(
							 array(
						'/([A-Z][a-z])/e', // all occurances of caps followed by lowers
						'/([a-zA-Z])([a-zA-Z]*)/e', // all occurances of words w/ first char captured separately
						'/[^' . $allowed . ']+/e', // all non allowed chars (non alpha numerics, by default)
						'/^([a-zA-Z])/e' // first alpha char
							 ), array(
						'" ".$1', // add spaces
						'strtoupper("$1").strtolower("$2")', // capitalize first, lower the rest
						'', // delete undesired chars
						'strto' . ($capitalizeFirst ? 'upper' : 'lower') . '("$1")' // force first char to upper or lower
							 ), $str
		);
	}

//KTODO: We should handle user and groups.
	public static function ktform_get_subtype($vars) {
		$subtype_default = "default";
		$subtype = '';

		if ($vars['entity']) {
			$subtype = $vars['entity']->getSubtype();
			//amazing fix to twitter and facebook users
			if ($vars['entity'] instanceof ElggUser) {
				if ($subtype == 'facebook' || $subtype == 'twitter') {
					$subtype = '';
				}
			}

			$type = $vars['entity']->type;
		} else {
			$subtype = elgg_get_context();
		}

		if (empty($subtype)) {
			$subtype = $subtype_default;
			//If no subtype, return type.
			if ($type) {
				$subtype = $type;
			}
		}

		return $subtype;
	}

	/**
	 * This function return an array with k=>v wheres key is calendar_start and calendar_end
	 * The values are for the start time, the initial hour (0:0:0) of the timestamp, and the end date will return the 11.59.59 hours for that timestamp
	 * 
	 * @param bool|int $timestamp
	 * @return array 
	 */
	public static function ktform_get_default_dates($timestamp = FALSE) {

		if ($timestamp == FALSE) {
			$timestamp = time();
		}

		$current_date = getdate($timestamp);

		$defaults = array(
			 //This annotations are from Elgg calendar / entity / event functions.
			 'calendar_start' => get_day_start($current_date['mday'], $current_date['mon'], $current_date['year']),
			 'calendar_end' => get_day_end($current_date['mday'], $current_date['mon'], $current_date['year']),
		);

		return $defaults;
	}

	/*
	 * This function return the entity calendar date start.
	 * We suppose that use the calendar_start metadata.
	 * 
	 * @param Entity $entity
	 * 
	 * return timestamp.
	 */

	public static function ktform_get_entity_dates_start($entity) {
		$date = 0;

		if (!$entity) {
			return false;
		}

		$date = $entity->calendar_start;
		if (!$date) {
			//Throw a hook, so the entity could return the calendar date.
			$params = array(
				 'entity' => $entity,
			);

			$date = elgg_trigger_plugin_hook('entity:calendar:start', 'object', $params, $date);
		}

		return $date;
	}

	/*
	 * This function return the entity calendar date end.
	 * We suppose that use the calendar_start metadata.
	 * 
	 * @param Entity $entity
	 * 
	 * return timestamp.
	 */

	public static function ktform_get_entity_dates_end($entity) {
		$date = 0;

		if (!$entity) {
			return false;
		}

		$date = $entity->calendar_end;
		if (!$date) {
			//Throw a hook, so the entity could return the calendar date.
			$params = array(
				 'entity' => $entity,
			);

			$date = elgg_trigger_plugin_hook('entity:calendar:end', 'object', $params, $date);
		}

		return $date;
	}

	/**
	 * This function return the container guid of an input.
	 * This is supposed to be used into a form, with a hidden input.
	 * 
	 * 
	 * @return integer
	 */
	public static function ktform_get_container_guid() {
		$container_guid = (int) get_input('container_guid', 0);
		$container_entity = get_entity($container_guid);

		if (!($container_entity instanceof ElggEntity)) {
			$container_guid = elgg_get_logged_in_user_guid();
		}

		return $container_guid;
	}

	/**
	 * This function extend the page_owner functionality to objects, you could set as
	 * username: object:<guid>, and this will be the page owner.
	 * 
	 * It throws a hook, for validation in certains circunstaces.
	 * Hook: elgg_trigger_plugin_hook('object:owner:handler:validation', 'object', $params, TRUE)
	 * 
	 * You could validate the hook, with the context and the $params['object'].
	 *
	 * @global mix $CONFIG
	 * @return boolean 
	 */
	public function ktform_object_owner_handler() {
		global $CONFIG;

		$returnval = FALSE;

		if (!$returnval && ($username = get_input("username"))) {
			if (substr_count($username, 'object:')) {
				preg_match('/object:([0-9]+)/i', $username, $matches);
				$guid = $matches[1];
				$entity = get_entity($guid);
				if ($entity && $entity instanceof ElggObject) {
					$returnval = $entity->getGUID();

					//KTODO: Validate object container support. ?
					$params = array(
						 'entity' => $entity,
					);
					if (!elgg_trigger_plugin_hook('object:owner:handler:validation', 'object', $params, TRUE)) {
						$returnval = FALSE;
					}
				}
			}
		}

		return $returnval;
	}

	/**
	 * Takes in a comma-separated string and returns an array of tags which have been trimmed and set to lower case
	 *
	 * @param string $string Comma-separated tag string
	 * @return array|false An array of strings, or false on failure
	 */
	public static function ktform_clean_tag_array($array) {
		if (is_array($array)) {
			$ar = array_map('trim', $array); // trim blank spaces
			$ar = array_map('elgg_strtolower', $ar); // make lower case : [Marcus Povey 20090605 - Using mb wrapper function using UTF8 safe function where available]
			$ar = array_filter($ar, 'is_not_null'); // Remove null values
			return $ar;
		}
		return false;
	}

	/**
	 * This function return the user that you pass
	 * if none, will use the logged in user
	 * 
	 * @param int|ElggUser $user
	 * @return ElggUser|bool
	 */
	public static function ktform_get_user_entity($user = FALSE) {

		if ($user === FALSE) {
			$user = elgg_get_logged_in_user_entity();
		}

		if (is_numeric($user)) {
			$user = get_entity($user);
		}

		if ($user instanceof ElggUser) {
			return $user;
		}

		return FALSE;
	}

	/**
	 * Get the name of the most recent plugin to be called in the call stack (or the plugin that owns the current page, if any).
	 *
	 * i.e., if the last plugin was in /mod/foobar/, get_plugin_name would return foo_bar.
	 *
	 * @param boolean $mainfilename If set to true, this will instead determine the context from the main script filename called by the browser. Default = false.
	 * @return string|false Plugin name, or false if no plugin name was called
	 */
	public static function kt_get_plugin_name($mainfilename = false) {

		$plugin_name = FALSE;

		if (!$mainfilename) {

			$backtrace = debug_backtrace();

			if ($backtrace) {
				foreach ($backtrace as $step) {
					$file = $step['file'];
					$file = str_replace("\\", "/", $file);
					$file = str_replace("//", "/", $file);
					if (preg_match("/mod\/([a-zA-Z0-9\-\_]*)\//", $file, $matches)) {
						$plugin_name = $matches[1];
					}
				}
			}
		} else {
			if (preg_match("/pg\/([a-zA-Z0-9\-\_]*)\//", $_SERVER['REQUEST_URI'], $matches)) {
				$plugin_name = $matches[1];
			} else {
				$file = $_SERVER["SCRIPT_NAME"];
				$file = str_replace("\\", "/", $file);
				$file = str_replace("//", "/", $file);
				if (preg_match("/mod\/([a-zA-Z0-9\-\_]*)\//", $file, $matches)) {
					$plugin_name = $matches[1];
				}
			}
		}

		return $plugin_name;
	}

	/**
	 * Calculates the difference between 2 intervaltimes.
	 * 
	 * @param type $from - End time date
	 * @param type $to - Start time date
	 * @param type $display_units - year, month, week, day, hour, minute, second
	 * @param type $formated - If true return as string, otherwise as array.
	 * @return string 
	 */
//KTODO: Search a replace of this function, because is buggy. Calcula mal los meses.
	public static function ktform_get_time_diff($from, $to = null, $display_units = array(), $formated = TRUE, $format_options = array()) {
		$default_format = array(
			 'add_suffix' => TRUE,
			 'separator' => ', ',
		);

		$format_options = array_merge($default_format, $format_options);

		$to = (($to === null) ? (time()) : ($to));
		$to = ((is_numeric($to)) ? (int) ($to) : (strtotime($to)));
		$from = ((is_numeric($from)) ? (int) ($from) : (strtotime($from)));
		//Old units
		/* $units = array (
		  "year"   => 29030400, // seconds in a year   (12 months)
		  "month"  => 2419200,  // seconds in a month  (4 weeks)
		  "week"   => 604800,   // seconds in a week   (7 days)
		  "day"    => 86400,    // seconds in a day    (24 hours)
		  "hour"   => 3600,     // seconds in an hour  (60 minutes)
		  "minute" => 60,       // seconds in a minute (60 seconds)
		  "second" => 1         // 1 second
		  ); */
		$units = array(
			 "year" => 31556926, // seconds in a year   (12 months, Its a avg, from google calc)
			 "month" => 2629743.83, // seconds in a month  (24 hs * 30,4 days. Its a avg, from google calc)
			 "week" => 604800, // seconds in a week   (7 days)
			 "day" => 86400, // seconds in a day    (24 hours)
			 "hour" => 3600, // seconds in an hour  (60 minutes)
			 "minute" => 60, // seconds in a minute (60 seconds)
			 "second" => 1	// 1 second
		);


		if (count($display_units)) {
			$new_units = array();
			foreach ($display_units as $val) {
				if (array_key_exists($val, $units)) {
					$new_units[$val] = $units[$val];
				}
			}
			if (count($new_units)) {
				$units = $new_units;
			}
		}

		$diff = abs($from - $to);
		$suffix = '';
		if ($format_options['add_suffix']) {
			$suffix = (($from > $to) ? ("from now") : ("ago"));
		}

		$output = array();
		foreach ($units as $unit => $mult) {
			if ($diff >= $mult) {
				//$unit_diff = intval($diff / $mult);
				$unit_diff = floor($diff / $mult);
				if ($formated) {
					$unit_str = elgg_echo($unit);
					$and = (($mult != 1) ? ("") : ("and "));
					$output[] = $and . $unit_diff . " " . $unit_str . (($unit_diff == 1) ? ("") : ("s"));
				} else {
					$output[$unit] = $unit_diff;
				}
				//$diff -= intval($diff / $mult) * $mult;
				$diff -= $unit_diff * $mult;
			}
		}
		if ($formated) {
			$output = implode($format_options['separator'], $output);
			$output .= " " . $suffix;
		}

		return $output;
	}

	/**
	 * Validate if an entity can be commentable
	 * 
	 * @param ElggEntity $entity
	 * @param bool $disable_form || if true, then it will disable only the form if the metadata value is setted on disable_form
	 * @return bool 
	 */
	public static function ktform_is_entity_commentable(ElggEntity $entity, $disable_form = FALSE) {

		$meta_name = 'comments_on';

		if (!($entity instanceof ElggEntity)) {
			return FALSE;
		}

		if ($entity instanceof ElggGroup) {
			if ($entity->isMember() == FALSE) {
				return FALSE;
			}
		}

		$commentable_meta = $entity->$meta_name;

		if ($commentable_meta) {
			if (strtolower($commentable_meta) == 'off') {
				return FALSE;
			}
		}

		if ($disable_form) {
			if ($entity->$meta_name == 'disable_form') {
				return FALSE;
			}
		}

		return TRUE;
	}

	/**
	 * Validate if an entity can be commentable
	 * 
	 * @param ElggEntity $entity
	 * @param bool $disable_form || if true, then it will disable only the form if the metadata value is setted on disable_form
	 * @return bool 
	 */
	public static function ktform_is_entity_comments_disabled(ElggEntity $entity) {

		$meta_name = 'comments_on';

		if (!($entity instanceof ElggEntity)) {
			return FALSE;
		}

		$commentable_meta = $entity->$meta_name;

		if ($commentable_meta) {
			if (strtolower($commentable_meta) == 'off') {
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * Generates links for sortable titles
	 * 
	 * @param type $metadata_name
	 * @param type $link_text 
	 */
	public static function ktform_generate_sortable_link($metadata_name, $link_text = NULL) {

		if (empty($metadata_name)) {
			return FALSE;
		}

		$url = full_url();

		$sort_type = get_input('sort_type', 'asc');
		switch ($sort_type) {
			case 'asc':
				$sort_type = 'desc';
				break;

			default:
				$sort_type = 'asc';
				break;
		}

		$order_type = get_input('order_type', 'text');
		if ($order_type != 'text' && $order_type != 'integer') {
			$order_type = 'text';
		}

		$elements = array(
			 'order_by' => $metadata_name,
			 'sort_type' => $sort_type,
			 'order_type' => $order_type,
		);

		$url = elgg_http_add_url_query_elements($url, $elements);


		$link_class = 'sortableLink';
		if ($metadata_name == get_input('order_by')) {
			$link_class .= ' sortable' . self::ktform_camelize_string($sort_type, TRUE);
		}

		$link = elgg_view('output/url', array('text' => $link_text, 'href' => $url, 'class' => $link_class));

		return $link;

//	return $link_text;
	}

	/**
	 * Function to set an object as likeable.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @param bool $joinable
	 * @return mix | bool 
	 */
	public static function ktform_set_group_entity_joins_support($object_subtype, $joinable = TRUE) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		$CONFIG->ktform->$object_subtype->group_joinable = $joinable;

		return true;
	}

	/**
	 * Get if an object subtype have likes supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_group_entity_joins_support($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		if (!elgg_is_admin_logged_in()) {
			return FALSE;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->$object_subtype->group_joinable)) {
			return $CONFIG->ktform->$object_subtype->group_joinable;
		}

		return false;
	}

	/**
	 * Function to set an object as likeable.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @param bool $comments
	 * @return mix | bool 
	 */
	public static function ktform_set_entity_geolokation_support($object_subtype, $locatable = TRUE) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		if (!$CONFIG->ktform->geolokation) {
			$CONFIG->ktform->geolokation = array();
		}

		$CONFIG->ktform->geolokation[$object_subtype] = $object_subtype;

		return true;
	}

	/**
	 * Get if an object subtype have likes supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_entity_geolokation_support($object_subtype) {
		global $CONFIG;

		if (!$object_subtype) {
			return false;
		}

		if (!$CONFIG->ktform->geolokation) {
			return false;
		}

		//Should we use the object subtype.
		if (isset($CONFIG->ktform->geolokation[$object_subtype])) {
			return $CONFIG->ktform->geolokation[$object_subtype];
		}

		return false;
	}

	/**
	 * Get if an object subtype have likes supports.
	 * 
	 * @global mix $CONFIG
	 * @param string $object_subtype
	 * @return mix | bool 
	 */
	public static function ktform_get_entities_geolokation_support() {
		global $CONFIG;

		if (!$CONFIG->ktform->geolokation) {
			return false;
		} else {
			return $CONFIG->ktform->geolokation;
		}
	}

	/**
	 * Return a static array of countries
	 * 
	 * @return array 
	 */
	public static function ktform_get_static_countries() {
		$ar_countries = array(
			 'AF' => 'AFGHANISTAN',
			 'AL' => 'ALBANIA',
			 'DZ' => 'ALGERIA',
			 'AS' => 'AMERICAN SAMOA',
			 'AD' => 'ANDORRA',
			 'AO' => 'ANGOLA',
			 'AI' => 'ANGUILLA',
			 'AQ' => 'ANTARCTICA',
			 'AG' => 'ANTIGUA AND BARBUDA',
			 'AR' => 'ARGENTINA',
			 'AM' => 'ARMENIA',
			 'AW' => 'ARUBA',
			 'AU' => 'AUSTRALIA',
			 'AT' => 'AUSTRIA',
			 'AZ' => 'AZERBAIJAN',
			 'BS' => 'BAHAMAS',
			 'BH' => 'BAHRAIN',
			 'BD' => 'BANGLADESH',
			 'BB' => 'BARBADOS',
			 'BY' => 'BELARUS',
			 'BE' => 'BELGIUM',
			 'BZ' => 'BELIZE',
			 'BJ' => 'BENIN',
			 'BM' => 'BERMUDA',
			 'BT' => 'BHUTAN',
			 'BO' => 'BOLIVIA',
			 'BA' => 'BOSNIA AND HERZEGOVINA',
			 'BW' => 'BOTSWANA',
			 'BV' => 'BOUVET ISLAND',
			 'BR' => 'BRAZIL',
			 'IO' => 'BRITISH INDIAN OCEAN TERRITORY',
			 'BN' => 'BRUNEI DARUSSALAM',
			 'BG' => 'BULGARIA',
			 'BF' => 'BURKINA FASO',
			 'BI' => 'BURUNDI',
			 'KH' => 'CAMBODIA',
			 'CM' => 'CAMEROON',
			 'CA' => 'CANADA',
			 'CV' => 'CAPE VERDE',
			 'KY' => 'CAYMAN ISLANDS',
			 'CF' => 'CENTRAL AFRICAN REPUBLIC',
			 'TD' => 'CHAD',
			 'CL' => 'CHILE',
			 'CN' => 'CHINA',
			 'CX' => 'CHRISTMAS ISLAND',
			 'CC' => 'COCOS (KEELING) ISLANDS',
			 'CO' => 'COLOMBIA',
			 'KM' => 'COMOROS',
			 'CG' => 'CONGO',
			 'CD' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE',
			 'CK' => 'COOK IS.',
			 'CR' => 'COSTA RICA',
			 'CI' => 'COTE D IVOIRE',
			 'HR' => 'CROATIA',
			 'CU' => 'CUBA',
			 'CY' => 'CYPRUS',
			 'CZ' => 'CZECH REPUBLIC',
			 'DK' => 'DENMARK',
			 'DJ' => 'DJIBOUTI',
			 'DM' => 'DOMINICA',
			 'DO' => 'DOMINICAN REPUBLIC',
			 'TP' => 'EAST TIMOR',
			 'EC' => 'ECUADOR',
			 'EG' => 'EGYPT',
			 'SV' => 'EL SALVADOR',
			 'GQ' => 'EQUATORIAL GUINEA',
			 'ER' => 'ERITREA',
			 'EE' => 'ESTONIA',
			 'ET' => 'ETHIOPIA',
			 'FK' => 'FALKLAND ISLANDS (MALVINAS)',
			 'FO' => 'FAROE ISLANDS',
			 'FJ' => 'FIJI',
			 'FI' => 'FINLAND',
			 'FR' => 'FRANCE',
			 'GF' => 'FRENCH GUIANA',
			 'PF' => 'FRENCH POLYNESIA',
			 'TF' => 'FRENCH SOUTHERN TERRITORIES',
			 'GA' => 'GABON',
			 'GM' => 'GAMBIA',
			 'GE' => 'GEORGIA',
			 'DE' => 'GERMANY',
			 'GH' => 'GHANA',
			 'GI' => 'GIBRALTAR',
			 'GR' => 'GREECE',
			 'GL' => 'GREENLAND',
			 'GD' => 'GRENADA',
			 'GP' => 'GUADELOUPE',
			 'GU' => 'GUAM',
			 'GT' => 'GUATEMALA',
			 'GN' => 'GUINEA',
			 'GW' => 'GUINEA-BISSAU',
			 'GY' => 'GUYANA',
			 'HT' => 'HAITI',
			 'HM' => 'HEARD ISLAND AND MCDONALD ISLANDS',
			 'VA' => 'HOLY SEE (VATICAN CITY STATE)',
			 'HN' => 'HONDURAS',
			 'HK' => 'HONG KONG',
			 'HU' => 'HUNGARY',
			 'IS' => 'ICELAND',
			 'IN' => 'INDIA',
			 'ID' => 'INDONESIA',
			 'IR' => 'IRAN, ISLAMIC REPUBLIC OF',
			 'IQ' => 'IRAQ',
			 'IE' => 'IRELAND',
			 'IL' => 'ISRAEL',
			 'IT' => 'ITALY',
			 'JM' => 'JAMAICA',
			 'JP' => 'JAPAN',
			 'JO' => 'JORDAN',
			 'KZ' => 'KAZAKSTAN',
			 'KE' => 'KENYA',
			 'KI' => 'KIRIBATI',
			 'KP' => 'NORTH COREA',
			 'KR' => 'SOUTH KOREA',
			 'KW' => 'KUWAIT',
			 'KG' => 'KYRGYZSTAN',
			 'LA' => 'LAO PEOPLES DEMOCRATIC REPUBLIC',
			 'LV' => 'LATVIA',
			 'LB' => 'LEBANON',
			 'LS' => 'LESOTHO',
			 'LR' => 'LIBERIA',
			 'LY' => 'LIBYAN ARAB JAMAHIRIYA',
			 'LI' => 'LIECHTENSTEIN',
			 'LT' => 'LITHUANIA',
			 'LU' => 'LUXEMBOURG',
			 'MO' => 'MACAU',
			 'MK' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
			 'MG' => 'MADAGASCAR',
			 'MW' => 'MALAWI',
			 'MY' => 'MALAYSIA',
			 'MV' => 'MALDIVES',
			 'ML' => 'MALI',
			 'MT' => 'MALTA',
			 'MH' => 'MARSHALL IS.',
			 'MQ' => 'MARTINIQUE',
			 'MR' => 'MAURITANIA',
			 'MU' => 'MAURITIUS',
			 'YT' => 'MAYOTTE',
			 'MX' => 'MEXICO',
			 'FM' => 'MICRONESIA, FEDERATED STATES OF',
			 'MD' => 'MOLDOVA, REPUBLIC OF',
			 'MC' => 'MONACO',
			 'MN' => 'MONGOLIA',
			 'MS' => 'MONTSERRAT',
			 'MA' => 'MOROCCO',
			 'MZ' => 'MOZAMBIQUE',
			 'MM' => 'MYANMAR',
			 'NA' => 'NAMIBIA',
			 'NR' => 'NAURU',
			 'NP' => 'NEPAL',
			 'NL' => 'NETHERLANDS',
			 'AN' => 'NETHERLANDS ANTILLES',
			 'NC' => 'NEW CALEDONIA',
			 'NZ' => 'NEW ZEALAND',
			 'NI' => 'NICARAGUA',
			 'NE' => 'NIGER',
			 'NG' => 'NIGERIA',
			 'NU' => 'NIUE',
			 'NF' => 'NORFOLK ISLAND',
			 'MP' => 'NORTHERN MARIANA ISLANDS',
			 'NO' => 'NORWAY',
			 'OM' => 'OMAN',
			 'PK' => 'PAKISTAN',
			 'PW' => 'PALAU',
			 'PS' => 'PALESTINIAN TERRITORY, OCCUPIED',
			 'PA' => 'PANAMA',
			 'PG' => 'PAPUA NEW GUINEA',
			 'PY' => 'PARAGUAY',
			 'PE' => 'PERU',
			 'PH' => 'PHILIPPINES',
			 'PN' => 'PITCAIRN IS.',
			 'PL' => 'POLAND',
			 'PT' => 'PORTUGAL',
			 'PR' => 'PUERTO RICO',
			 'QA' => 'QATAR',
			 'RE' => 'REUNION',
			 'RO' => 'ROMANIA',
			 'RU' => 'RUSSIA',
			 'RW' => 'RWANDA',
			 'SH' => 'SAINT HELENA',
			 'KN' => 'SAINT KITTS AND NEVIS',
			 'LC' => 'SAINT LUCIA',
			 'PM' => 'SAINT PIERRE AND MIQUELON',
			 'VC' => 'SAINT VINCENT AND THE GRENADINES',
			 'WS' => 'SAMOA',
			 'SM' => 'SAN MARINO',
			 'ST' => 'SAO TOME AND PRINCIPE',
			 'SA' => 'SAUDI ARABIA',
			 'SN' => 'SENEGAL',
			 'RB' => 'SERBIA',
			 'SC' => 'SEYCHELLES',
			 'SL' => 'SIERRA LEONE',
			 'SG' => 'SINGAPORE',
			 'SK' => 'SLOVAKIA',
			 'SI' => 'SLOVENIA',
			 'SB' => 'SOLOMON ISLANDS',
			 'SO' => 'SOMALIA',
			 'ZA' => 'SOUTH AFRICA',
			 'GS' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
			 'ES' => 'SPAIN',
			 'LK' => 'SRI LANKA',
			 'SD' => 'SUDAN',
			 'SR' => 'SURINAME',
			 'SJ' => 'SVALBARD AND JAN MAYEN',
			 'SZ' => 'SWAZILAND',
			 'SE' => 'SWEDEN',
			 'CH' => 'SWITZERLAND',
			 'SY' => 'SYRIAN ARAB REPUBLIC',
			 'TW' => 'TAIWAN, PROVINCE OF CHINA',
			 'TJ' => 'TAJIKISTAN',
			 'TZ' => 'TANZANIA, UNITED REPUBLIC OF',
			 'TH' => 'THAILAND',
			 'TG' => 'TOGO',
			 'TK' => 'TOKELAU',
			 'TO' => 'TONGA',
			 'TT' => 'TRINIDAD AND TOBAGO',
			 'TN' => 'TUNISIA',
			 'TR' => 'TURKEY',
			 'TM' => 'TURKMENISTAN',
			 'TC' => 'TURKS AND CAICOS ISLANDS',
			 'TV' => 'TUVALU',
			 'UG' => 'UGANDA',
			 'UA' => 'UKRAINE',
			 'AE' => 'UNITED ARAB EMIRATES',
			 'GB' => 'UNITED KINGDOM',
			 'US' => 'UNITED STATES',
			 'UM' => 'UNITED STATES MINOR OUTLYING ISLANDS',
			 'UY' => 'URUGUAY',
			 'UZ' => 'UZBEKISTAN',
			 'VU' => 'VANUATU',
			 'VE' => 'VENEZUELA',
			 'VN' => 'VIET NAM',
			 'VG' => 'VIRGIN ISLANDS, BRITISH',
			 'VI' => 'VIRGIN ISLANDS, U.S.',
			 'WF' => 'WALLIS AND FUTUNA',
			 'EH' => 'WESTERN SAHARA',
			 'YE' => 'YEMEN',
			 'YU' => 'YUGOSLAVIA',
			 'ZM' => 'ZAMBIA',
			 'ZW' => 'ZIMBABWE'
		);

		return $ar_countries;
	}

	/**
	 * Camelize an array given, this is used for example, inside an array walk
	 * 
	 * @param string $element, the value of the array
	 * @param string $key , the key of the array
	 */
	public static function ktform_camelize_array_values_string(&$element, $key) {
		$element = self::ktform_camelize_string($element, TRUE, '[]');
	}

	/**
	 * Return a an array or value, used for options in pulldown, or json values
	 * 
	 * @param array $options
	 *  array(
	 * 	
	 * 		'value' => ELGG_ENTITIES_ANY_VALUE,
	 * 
	 * 		'is_pulldown' => FALSE,
	 * 
	 * 		'only_values' => FALSE,
	 * 
	 * 		'camelize_values' => FALSE,
	 * 		
	 * 		'as_json' => FALSE,
	 * 
	 * 	);
	 * 
	 * @return mix 
	 */
	public static function ktform_get_country_values($options = array()) {

		$defaults = array(
			 'value' => ELGG_ENTITIES_ANY_VALUE,
			 'is_pulldown' => FALSE,
			 'only_values' => FALSE,
			 'camelize_values' => FALSE,
			 'as_json' => FALSE,
		);

		$options = array_merge($defaults, $options);

		$ar_countries = self::ktform_get_static_countries();

		/**
		 *  Return only the values of the countries
		 */
		if ($options['only_values']) {
			$ar_countries = array_values($ar_countries);
		}

		/**
		 * If a country is given as value, then return them
		 */
		if ($options['value'] != ELGG_ENTITIES_ANY_VALUE) {

			$value = strtoupper($options['value']);

			$returnvalue = FALSE;

			if (isset($ar_countries[$value])) {

				$returnvalue = $ar_countries[$value];

				//Camelize the string
				if ($options['camelize_values']) {
					$returnvalue = self::ktform_camelize_string($returnvalue, TRUE);
				}
			}

			if ($options['as_json']) {
				$returnvalue = json_encode($returnvalue);
			}

			return $returnvalue;
		}


		if ($options['camelize_values']) {
			array_walk($ar_countries, 'ktform_camelize_array_values_string');
		}

		if ($options['is_pulldown']) {
			$ar_countries = array('0' => elgg_echo('ktform:country:pulldown:select_value')) + $ar_countries;
		}

		if ($options['as_json']) {
			$ar_countries = json_encode($ar_countries);
		}

		return $ar_countries;
	}

	/**
	 * Function to retrieve the values for checkboxes, radios, etc
	 * 
	 * @param array $vars the view vars
	 * @param bool $get_array if set to false,then return the first value of the array
	 * @return array
	 */
	public function get_values_for_outputs_with_options($vars, $get_array = TRUE) {
		$values = elgg_extract('value', $vars);
		$options = elgg_extract('options', $vars, array());
		
		if (empty($values)) {
			return;
		}
		
		$tmp_values = array();
		
		
		if (empty($options)) {
			$options = elgg_extract('options_values', $vars, array());
		} else {
			$options = array_flip($options);
		}
		

		if (!is_array($values)) {
			$values = array($values => $options[$values]);
		}		
		
		foreach ($values as $val) {
			if (isset($options[$val])) {
				$tmp_values[$val] = $options[$val];
			}
		}
		
		$current_value = $values;
		if (!empty($tmp_values)) {
			$current_value = $tmp_values;
		}
		
		if ($get_array) {
			return $current_value;
		}
		
		
		if (!empty($current_value)) {
			return current($current_value);
		} else {
			return '';
		}
	}

}
