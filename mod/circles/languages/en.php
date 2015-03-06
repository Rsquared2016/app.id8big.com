<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

$english = array(
	'circles:admin' => "circles's Admin Area",
	'circles:admin:settings' => 'Settings',
	'circles:admin:about' => 'About',
	'circles:ping:title' => 'circles Plugin',
	'circles:ping:description' => 'Help us to improve the quality of this plugin. This program will send minimal information (elgg version, site url, name of the plugin) just once to the keetup.com servers to know the majority elgg versions the users have installed. Then we can focus on that particular versions.',
	'circles:ping:description2' => 'We can also send to you a notification when we release new versions of this plugin so please add your email address',
	'circles:ping:description3' => 'this will be used just to that end',
	'circles:ping:thanks' => 'Thanks for help us',
	'circles:ping:cancel' => 'No, thanks',
	'circles:ping' => 'Yes, I want to help',
	
	/* Circles */
	'circles' => 'Circles',
//	'circles:title' => 'Circles of Following',
	'circles:title' => 'Organize people you follow into circles',
	'circles:section:search:button' => 'Search',
	'circles:section:search:nofriends' => 'No followings for',
	'circles:section:friends' => 'Followings',
	'circles:section:friends:empty' => 'No followings',
	'circles:section:circles' => 'Circles',
	'circles:section:circles:note' => 'Drag people to your circles to follow and share',
	'circles:section:circles:new' => 'Click here to create a new circle',
	'circles:section:circles:name' => '%s',
	'circles:add' => '+',
	'circles:remove' => '-',
	'circles:widget:dashboard:empty' => 'No circles to show.',
	'circles:search' => 'Search',
	'circles:search:keyword' => 'Keyword',
	
	/* Form */
	'circles:form:title:new' => 'Create a new circle',
	'circles:form:title:edit' => 'Edit the circle',
	'circles:form:name' => 'Name',
	'circles:form:submit:new' => 'Create',
	'circles:form:submit:edit' => 'Edit',
	
	/* Profile */
	'circles:profile:add' => "Add to circles",
	
	/* Riverdashboard */
	'circles:riverdashboard:title' => 'Activity',
	'circles:riverdashboard:filter' => 'Filter',
	'circles:riverdashboard:circles:title' => 'Circles',
	'circles:riverdashboard:type:title' => 'Type',
	'circles:riverdashboard:circles:options:all' => 'All',
	'circles:riverdashboard:circles:options:mine' => 'Mine',
	'circles:riverdashboard:circles:options:friends' => 'Following',
	'circles:riverdashboard:circles:view:all' => 'View all',
	'circles:riverdashboard:empty' => 'No activity to display',
	'circles:delete:circle' => 'Delete circle',
	
	/* Error */
	'circles:error:noname' => 'You need to give your circle a name before it can be created.',
	'circles:error:delete:friend' => 'Could not delete friend.',
	'circles:error:add:friend' => 'Could not add friend.',
	'circles:error:member:yes' => 'Your friend already belongs to the circle.',
	'circles:error:delete' => 'There was an error trying to remove the circle.',
	
	/* Success */
	'circles:success:circlesadd' => 'Your circle was successfuly created',
	'circles:success:delete:friend' => 'Deleted friend.',
	'circles:success:add:friend' => 'Added friend.',
	'circles:success:delete' => 'The circle has been successfully removed.',
);

add_translation("en", $english);
