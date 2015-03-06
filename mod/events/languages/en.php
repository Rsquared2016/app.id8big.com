<?php

/**
 * events
 *
 * @author Bortoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
$english = array(
	/**
	 * Default translations
	 */
	'events:admin' => "Events Admin Area",
	'events:admin:settings' => 'Settings',
	'events:admin:about' => 'About',
	'item:object:event' => 'Event',
	'events' => 'Events',
	//Translation Here
	'events:ping:title' => 'Events Plugin',
	'events:ping:description' => 'Help us to improve the quality of this plugin. This program will send minimal information (elgg version, site url, name of the plugin) just once to the keetup.com servers to know the majority elgg versions the users have installed. Then we can focus on that particular versions.',
	'events:ping:description2' => 'We can also send to you a notification when we release new versions of this plugin so please add your email address',
	'events:ping:description3' => 'this will be used just to that end',
	'events:ping:thanks' => 'Thanks for help us',
	'events:ping:cancel' => 'No, thanks',
	'events:ping' => 'Yes, I want to help',
	'events:plugin:title' => 'Events',
	'events:plugin:listing:title' => 'Listing Events',
	'events:plugin:menu:title' => 'Events',
	'events:plugin:friendly_title' => 'events',
	'events:plugin:page_owner:list' => 'All site Events\'s',
	'events:plugin:page_owner:add' => 'Add an Event',
	'events:plugin:page_owner:calendar' => 'Calendar',
	'events:plugin:dummy:page_owner:list' => 'All site Dummies Event\'s',
	'events:plugin:dummy:page_owner:add' => 'Add Dummie Events',
	/**
	 * Editable menus
	 */
	'events:add:title' => 'Add an Event',
	'events:edit:title' => 'Edit %s Event',
	/**
	 * Form labels text
	 */
	'events:events:label:access_id' => 'Access',
	'events:events:label:submit:send' => 'Save',
	'events:events:label:submit:send:editing' => 'Edit',
	'events:events:label:submit:send:loading' => 'Saving ...',
	/**
	 * Search form labels
	 */
	'events:events_filter:label:keyword' => 'Keyword',
	'events:events_filter:label:owner' => 'Owner',
	'events:events_filter:label:submit:send' => 'Search',
	'events:events_filter:label:submit:send:loading' => 'Search',
	'events_ktform:entities:event:listing:empty_results' => 'There are no Events to show.',
	/**
	 * River text
	 */
	'events:river:created' => '%s created',
	'events:river:updated' => '%s updated',
	'events:river:create' => 'a Events',
	'events:river:annotate' => 'a comment on',
	'events:listing:link:add' => 'Add',
	'events:listing:link:search' => 'Search',
	'events:admin:timezone:title' => 'Select site timezone',
	 'events:admin:timezone:warning' => 'By changing the timezone, make sure you know what you are doing, because all the events dates will be affected',
	'events:register:timezone:error' => 'Please select the correct timezone',
	'events:register:timezone:label' => 'Select your timezone',
	'events:timezone:pulldown:label' => 'Please, choose one timezone',
	'events:timezone:pulldown:help:label' => 'By Hour / Country',
	/**
	 * Events Form 
	 */
	'events:events:label:image' => 'Main Image',
	'events:events:label:title' => 'Title',
	'events:events:label:description' => 'Description',
	'events:events:label:location' => 'Location',
	'events:events:label:start_date' => 'Start Date',
	'events:events:label:end_date' => 'End Date',
	'events:events:label:timezone' => 'Timezone',
	'events:end_time_smaller' => 'End date must be greater than start date',
	'events:events:label:start_time' => 'Start Time',
	'events:events:label:end_time' => 'End Time',
	'events_ktform:listing:top:titles:location' => 'Location',
	'events_ktform:listing:top:titles:event_date' => 'Date',
	'events_ktform:filter:label:from_date' => 'Start Date',
	'events_ktform:filter:label:to_date' => 'End Date',
	
	// Access
	'events:access:event_access_public' => 'Public',
	'events:access:event_access_private' => 'Private',
	
	// Invite
	'events:button:invite' => 'Invite',
	'events:form:invite:title' => 'Invite to Users to %s Event',
	'events:form:invite:invite' => 'Send',
	'events:form:invite:users' => 'Select the users to invite',
	'events:search:users:no:results' => 'No results.',
	'events:invite:error:users:empty' => 'You must select at least one user.',
	'events:invite:error' => 'There was an error trying to invite users.',
	'events:invite:success' => 'Users have been invited successfully.',
	'events:invite:error:users' => 'Users have been invited successfully but an error occurred while trying to invite to some users.',
	'events:invite:subject' => '%s has invited you to the event %s',
	'events:invite:body' => '%s has invited you to the event %s.
		
To see the event, click here:

%s',
	
	// Guests
	'events:guests:tabs:yes' => 'Attend',
	'events:guests:tabs:maybe' => 'Maybe',
	'events:guests:tabs:no' => 'Not attending',
	'events:guests:tabs:not_replied' => 'Invited',
	'events:button:attend:yes' => 'Attend',
	'events:button:attend:maybe' => 'Maybe',
	'events:button:attend:no' => 'Not attending',
	'events:guests:attend:success' => 'Thank you for your response.',
	'events:guests:attend:error' => 'There were an error, please try again.',
	
	'events:guests:listing:empty:yes' => 'There are no users attending to this event yet.',
	'events:guests:listing:empty:maybe' => 'There are no users that maybe will attend.',
	'events:guests:listing:empty:no' => 'There are no users that will not attend.',
	'events:guests:listing:empty:not_replied' => 'There are no pending invited users yet.',
	'events:guests:listing:tabs:invite_link' => "Invite your friends clicking here.",
    
    'events:guests:title:yes' => 'You will assist to this event',
	'events:guests:title:maybe' => 'You maybe will assist to this event',
	'events:guests:title:no' => 'You will not assist to this event',
	
	/**
	 * List Actions
	 */
	'events:list:cancel' => 'Cancel',
	'events:list:reopen' => 'Reopen',
	
	'events:no_event' => 'This is no event',
	'events:no_permission' => 'You have no permission to request this action',
	
	'events:canceled' => 'The event has been canceled succefully',
	'events:reopened' => 'The event has been reopened succefully',
	
	'events:notification:event:canceled:subject' => 'Event %s was canceled',
	'events:notification:event:canceled:message' => 'Event %s was canceled.
		
To see the event, click here:

%s',
	
	'events:notification:event:reopened:subject' => 'Event %s was reopened',
	'events:notification:event:reopened:message' => 'Event %s was reopened.
		
To see the event, click here:

%s',
	
	'events:widget:events:title' => 'Events',
	 
	 'river:comment:object:event' => '%s commented on the event %s',
	'events:attend:yes' => 'Yes',
	'events:attend:maybe' => 'Maybe',
	'events:attend:not_replied' => 'No Replied',
	'events:attend:no' => 'No',
	'events:calendar' => 'Events Calendar',
	'events:calendar:qtip:title:button:close' => 'Close',
	'events:event_when' => 'When',
	'events:location' => 'Location',
	'events:description' => 'Description',
	'events:calendar:qtip:desc:link:view:more' => 'View more',
	'events:calendar:qtip:desc:add:text' => 'Add an Event to this day',
	'events:calendar:qtip:desc:search:text' => 'Search all events on this day',
	'events:january'=> 'January',
	'events:february'=> 'February',
	'events:march'=> 'March',
	'events:april'=> 'April',
	'events:may'=> 'May',
	'events:june'=> 'June',
	'events:july'=> 'July',
	'events:august'=> 'August',
	'events:september'=> 'September',
	'events:october'=> 'October',
	'events:november'=> 'November',
	'events:december'=> 'December',
	'events:January'=> 'January',
	'events:February'=> 'February',
	'events:March'=> 'March',
	'events:April'=> 'April',
	'events:May'=> 'May',
	'events:June'=> 'June',
	'events:July'=> 'July',
	'events:August'=> 'August',
	'events:September'=> 'September',
	'events:October'=> 'October',
	'events:November'=> 'November',
	'events:December'=> 'December',
	 
	'events:start_event_date_time_user:label' => 'Start in your time zone' ,
	'events:end_event_date_time_user:label' => 'End in your time zone' ,
    'events_ktform:filter:label:from_date' => 'Start date',
    'events_ktform:filter:label:to_date' => 'End date',
    'events:plugin:page_owner:calendar' => 'Calendar',
    'events:enable:events' => 'Enabled group events',
    'event:all_day' => 'All day',
    'events:more' => 'View all',
    'events:add' => 'Add Event',
    'events:none' => 'No Events',
    
    'events:plugin:page_owner:past_events' => 'Past Events',
    'events:plugin:listing:past:title' => 'Past Events',
    
    'events:group_support' => 'Enabled group support',
	'events:enable_rivers_items' => 'Enabled creation of river items',
	'events:profile_label_above' => 'Etiquetas de perfil encima de los campos',
	'events:option:no' => 'No',
	'events:option:yes' => 'Yes',
    'events:num_events' => "Number of events to display",
	'events:loading' => 'Loading...',
	'events:canceled:text' => 'The event was canceled.',
	'events:form:footer:has_required_fields' => '* Required fields',
    'groups:tabs:events' => 'Events',
	'events:plugin:listing:mine' => '%s\'s Events',
	'events:plugin:listing:friends' => 'Friend\'s Events',
    'events:events:label:file' => 'File',
    'calendar:events' => 'Events',
    'calendar:meeting' => 'Meetings',
    'calendar:gtask' => 'Tasks',
    'calendar:gcalendar' => 'Google Calendar',
    'events:united_states' => 'United States',
    'events:all_the_world' => 'All the world',
);

add_translation("en", $english);