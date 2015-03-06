<?php
/**
* register_exteps
*
* myclass lib description here...
* 
* @author Bortoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

/* [To delete] 
*  This is the myclass library
*/
 
function myclass_init() {
	// Register entity type and class
    // This is needed to handle the Class
	add_subtype("object", "myclass", "MyClass");
 
	// Register entity type
        //If you register this, the object will appear in the search results, be carefull.
	register_entity_type('object','myclass');
}
 

register_elgg_event_handler('init','system','myclass_init');


/*
 * 
 * Some extra functions
 * 
 * */
function my_class_extra_function() {
 
}