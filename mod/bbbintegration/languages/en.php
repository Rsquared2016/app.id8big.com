<?php

/**
 * meeting
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
	'meeting:admin' => "Meetings's Admin Area",
	'meeting:admin:settings' => 'Settings',
	'meeting:admin:about' => 'About',
	'item:object:meeting' => 'Meeting',
	'meeting' => 'Meetings',
	//Translation Here
	'meeting:ping:title' => 'Meetings Plugin',
	'meeting:ping:description' => 'Help us to improve the quality of this plugin. This program will send minimal information (elgg version, site url, name of the plugin) just once to the keetup.com servers to know the majority elgg versions the users have installed. Then we can focus on that particular versions.',
	'meeting:ping:description2' => 'We can also send to you a notification when we release new versions of this plugin so please add your email address',
	'meeting:ping:description3' => 'this will be used just to that end',
	'meeting:ping:thanks' => 'Thanks for help us',
	'meeting:ping:cancel' => 'No, thanks',
	'meeting:ping' => 'Yes, I want to help',
	'meeting:plugin:title' => 'Meetings',
	'meeting:plugin:listing:title' => 'Listing Meetings',
	'meeting:plugin:menu:title' => 'Meetings',
	'meeting:plugin:friendly_title' => 'Meetings',
	'meeting:plugin:page_owner:list' => 'All site Meetings\'s',
	'meeting:plugin:page_owner:add' => 'Add Meeting',
	'meeting_ktform:sorteable:link:first' => 'Order 1',
	'meeting_ktform:sorteable:link:second' => 'Order 2',
	'meeting_ktform:sorteable:link:third' => 'Order 3',
	'meeting_ktform:sorteable:link:tags' => 'Tags',
	/**
	 * Editable menus
	 */
	'meeting:add:title' => 'Add a Meeting',
	'meeting:edit:title' => 'Edit %s Meeting',
	/**
	 * Form labels text
	 */
	'meeting:meeting:label:image' => 'Main Image',
	'meeting:meeting:label:title' => 'Title',
	'meeting:meeting:label:name' => 'Name',
	'meeting:meeting:label:description' => 'Description',
	'meeting:meeting:label:tags' => 'Tags',
	'meeting:meeting:label:access_id' => 'Access',
	'meeting:meeting:label:shortdescription' => 'Brief Description',
	'meeting:meeting:info_text:description' => 'Description of the Meeting.',
	'meeting:meeting:info_text:shortdescription' => 'This is a short description',
	'meeting:meeting:label:submit:send' => 'Save',
	'meeting:meeting:label:submit:send:editing' => 'Edit',
	'meeting:meeting:label:submit:send:loading' => 'Saving ...',
    'meeting:meeting:label:start_date' => 'Start date',
    'meeting:meeting:label:start_time' => 'Start time',
    'meeting:meeting:label:user_start_date' => 'Start date on your city',
    'meeting:meeting:label:user_start_time' => 'Start time on your city',
    'meeting:time:select' => 'Select time',
    'meeting:meeting:label:duration' => 'Duration',
    'meeting:duration:select' => 'Select duration',
    'meeting:hours' => ' Hs',
    'meeting:duration:info_text' => 'If you leave it empty, the meeting ends when the last attendee leaves it.',
    'meeting:meeting:label:participants' => 'Maximum number of participants',
    'meeting:participants:select' => 'Select number',
    'meeting:participants:info_text' => 'If you leave it empty, the number of participants is unlimited.',
	'meeting:meeting:label:timezone' => 'Timezone',
    'meeting:timezone:label' => 'Select your timezone',
    'meeting:timezone:pulldown:label' => 'Select timezone',
	'meeting:timezone:pulldown:help:label' => 'By Hour / Country: ',
    /**
	 * Form labels text demo
	 */
	'meeting:meeting:label:dummie_autocomplete' => 'Autocomplete',
	'meeting:meeting:label:dummie_checkboxes' => 'Checkboxes',
	'meeting:meeting:label:dummie_date' => 'Date',
	'meeting:meeting:label:dummie_dropdown' => 'Dropdown',
	'meeting:meeting:label:dummie_email' => 'Email',
	'meeting:meeting:label:location' => 'Location',
	'meeting:meeting:label:dummie_radios' => 'Radios',
	'meeting:meeting:label:dummie_tag' => 'Tag',
	'meeting:meeting:label:dummie_url' => 'URL',
	'meeting:meeting:label:members' => 'Members',
	'meeting:meeting:label:other_image' => 'Other image',
	/**
	 * Search form labels
	 */
	'meeting:meeting_filter:label:keyword' => 'Keyword',
	'meeting:meeting_filter:label:owner' => 'Owner',
	 'meeting_ktform:filter:label:tags' => 'Tags',
	'meeting:meeting_filter:label:submit:send' => 'Search',
	'meeting:meeting_filter:label:submit:send:loading' => 'Search',
	'meeting_ktform:entities:meeting:listing:empty_results' => 'There are no Meetings to show.',
	'meeting:sort:title' => 'Sort By',
	/**
	 * River text
	 */
	'meeting:river:created' => '%s created',
	'meeting:river:updated' => '%s updated',
	'meeting:river:create' => 'a Meeting',
	'meeting:river:annotate' => 'a comment on',
	'river:comment:object:meeting' => '%s commented on %s',
	'meeting:listing:link:add' => 'Add',
	'meeting:listing:link:search' => 'Search',
	'meeting:add' => 'Add Meeting',
	'meeting:form:footer:has_required_fields' => '* Required Fields',
	'meeting:plugin:listing:friends' => "Friend's Meetings",
	'meeting:plugin:listing:mine' => "%s's Meetings",
	/**
	 * Widget text 
	 */
	'meeting:widget:description' => "Display your latest Meetings",
	'meeting:more' => 'View more',
	'meeting:none' => 'No Meetings',
	 
	 
	 'meeting:group' => 'Group Meetings',
	 'meeting:enablemeeting' => 'Enable group Meetings',
	'meeting:group_support' => 'Allow group support',
	'meeting:enable_rivers_items' => 'Enable creation of river items',
	'meeting:profile_label_above' => 'Labels profile above the field',
	'meeting:option:no' => 'No',
	'meeting:option:yes' => 'Yes',
    'meeting:settings:timezone' => 'Select site timezone',
    'meeting:admin:timezone:warning' => 'By changing the timezone, make sure you know what you are doing, because all the events dates will be affected.',
    'meeting:settings:server_url' => 'BigBlueButton Server URL',
    'meeting:settings:security_salt' => 'BigBlueButton Security Salt',
    
    'meeting:error:greater:start_date' => 'The meeting date may not be smaller than the current date.',
    'meeting:button:join' => 'Join',
    'meeting:error:join' => 'There was an error while trying to join the meeting.',
    'meeting:error:join:date' => 'The meeting has not started or has finished.',
    'meeting:error:join:participants' => 'The meeting has been completed with the maximum number of participants.',
    'meeting:participants:complete' => 'The number of participants is complete.',
    'meeting:status:not_started' => 'The meeting has not started.',
    'meeting:status:finished' => 'The meeting has finished.',
    
    'meeting:january'=> 'January',
	'meeting:february'=> 'February',
	'meeting:march'=> 'March',
	'meeting:april'=> 'April',
	'meeting:may'=> 'May',
	'meeting:june'=> 'June',
	'meeting:july'=> 'July',
	'meeting:august'=> 'August',
	'meeting:september'=> 'September',
	'meeting:october'=> 'October',
	'meeting:november'=> 'November',
	'meeting:december'=> 'December',
    'meeting:numbertodisplay' => 'Number of meetings to display',
    'meeting:join:member:not' => 'You must be a member of the group to join the meeting.',
    'meeting:button:invite:visitors' => 'Invite Visitors',
    'meeting:invited_visitors:message:subject' => "%s invite you to join a meeting.",
    'meeting:invited_visitors:message:body' => "Hi %s,
        
%s invite you to join a meeting. To see more information about this click the link below:

%s

Make sure you are logged into the website before clicking on the following link otherwise you will be redirected to the login page.

(You cannot reply to this email.)",
    'meeting:collaborators:message:subject' => "A new meeting on project %s has created.",
    'meeting:collaborators:message:body' => "Hi %s,
        
%s create a meeting on project %s. To see more information about this and invite visitors please click the link below:

%s

Make sure you are logged into the website before clicking on the following link otherwise you will be redirected to the login page.

(You cannot reply to this email.)",
    'groups:tabs:meeting' => 'Meeting',
    'meeting:invited_visitors:empty' => 'You need to select allmost one visitor to invite',
    'meeting:invited_visitors:message:error' => 'There was an error during the invite of visitors.',
    'meeting:invited_visitors:message:success' => 'The invitation was sended succefully.',
    'meeting:invite:visitors:no_visitors' => 'The project has not visitors.',
	
    // Online users
    'meeting:online:users:title' => 'Online users',
    'meeting:online:team:title' => 'Online team',
    'meeting:online:users:empty' => 'No online users.',
    'meeting:online:team:empty' => 'No team members.',
//    'meeting:widgets:online:users:title' => 'Online users',
    'meeting:widgets:online:users:title' => 'Online team',
    'meeting:widgets:online:users:subtitle' => 'Online',
    'meeting:widgets:online:users:view:all' => 'View all',
//    'meeting:widgets:online:users:empty' => 'No online users.',
    'meeting:widgets:online:users:empty' => 'No team members.',
    'meeting:widgets:online:users:talk' => 'Talk',
	
	// Request talk
	'meeting:request:talk:success' => 'The request was successfully sent.',
	'meeting:request:talk:error' => 'There was an error while trying to request the talk.',
	
	// Talk
    'meeting:talk:error' => 'There was an error while trying to start the talk.',
    'meeting:talk:decline:error' => 'There was an error while trying to decline the talk.',
    'meeting:talk:decline:success' => 'The talk has been successfully declined.',
    'meeting:talk:meeting:name' => 'Meeting between %s and %s',
    'meeting:talk:meeting:title' => 'Meeting with %s',
    'meeting:talk:request:1' => 'wants to talk to you.',
    'meeting:talk:accept:1' => 'accepted to talk with you.',
	'meeting:talk:decline:1' => 'declined to talk with you.',
    'meeting:talk:request:2' => 'If you want to talk, press \'Accept\', otherwise, press \'Decline\'.',
    'meeting:talk:accept:2' => 'To go to the meeting, press \'Go\'.',
    'meeting:talk:request:accept' => 'Accept',
    'meeting:talk:request:decline' => 'Decline',
	'meeting:talk:leave' => '%s leave of the meeting.',
	'meeting:talk:accept' => 'Go',
	'meeting:talk:decline:accept' => 'Accept',
	'meeting:talk:unload' => 'If you reload your page, you will leave the meeting',
    'meeting:talk:exit' => 'Close the talk',
    'meeting:meeting:exit' => 'Close the meeting',
);

add_translation("en", $english);