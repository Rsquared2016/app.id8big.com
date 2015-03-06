<?php
/**
 * Help texts English language file
 */

$english = array(

	/**
	 * Menu items and titles
	 */
	'help_texts' => "Help tips",
	'help_texts:add' => "Add help tip",
	'help_texts:edit' => "Edit help tip",
	'help_texts:owner' => "%s's help_texts",
	'help_texts:friends' => "Friends' help tips",
	'help_texts:everyone' => "All site help tips",
	'help_texts:this' => "Help text this page",
	'help_texts:this:group' => "Help text in %s",
	'help_texts:bookmarklet' => "Get bookmarklet",
	'help_texts:bookmarklet:group' => "Get group bookmarklet",
	'help_texts:inbox' => "Help tips inbox",
	'help_texts:morehelp_texts' => "More help_texts",
	'help_texts:more' => "More",
	'help_texts:with' => "Share with",
	'help_texts:new' => "A new help text",
	'help_texts:address' => "Address of the help text",
	'help_texts:none' => 'No help tips',

	'help_texts:notification' =>
'%s added a new help text:

%s - %s
%s

View and comment on the new help text:
%s
',

	'help_texts:delete:confirm' => "Are you sure you want to delete this resource?",

	'help_texts:numbertodisplay' => 'Number of help tips to display',

	'help_texts:shared' => "Bookmarked",
	'help_texts:visit' => "Visit resource",
	'help_texts:recent' => "Recent help tips",

	'river:create:object:help_texts' => '%s bookmarked %s',
	'river:comment:object:help_texts' => '%s commented on a bookmark %s',
	'help_texts:river:annotate' => 'a comment on this help text',
	'help_texts:river:item' => 'an item',

	'item:object:help_texts' => 'Help tips',

	'help_texts:group' => 'Group help tips',
	'help_texts:enablehelp_texts' => 'Enable group help tips',
	'help_texts:nogroup' => 'This group does not have any help tips yet',
	'help_texts:more' => 'More help tips',

	'help_texts:no_title' => 'No title',

	/**
	 * Widget and bookmarklet
	 */
	'help_texts:widget:description' => "Display your latest help tips.",

	'help_texts:bookmarklet:description' =>
			"The help texts bookmarklet allows you to share any resource you find on the web with your friends, or just bookmark it for yourself. To use it, simply drag the following button to your browser's links bar:",

	'help_texts:bookmarklet:descriptionie' =>
			"If you are using Internet Explorer, you will need to right click on the bookmarklet icon, select 'add to favorites', and then the Links bar.",

	'help_texts:bookmarklet:description:conclusion' =>
			"You can then save any page you visit by clicking it at any time.",

	/**
	 * Status messages
	 */

	'help_texts:save:success' => "Your item was successfully saved.",
	'help_texts:delete:success' => "Your help text was deleted.",

	/**
	 * Error messages
	 */

	'help_texts:save:failed' => "Your help text could not be saved. Make sure you've entered a title, description, descriptive icon and section and then try again.",
	'help_texts:save:invalid' => "The address of the help text is invalid and could not be saved.",
	'help_texts:delete:failed' => "Your help text could not be deleted. Please try again.",
    'help_texts:target_url:wrong' => 'Wrong url format, please enter a correct url.',
    
    'help_texts:descriptive_icon' => 'Descriptive Icon',
    'help_texts:target_url' => 'Url',
    'help_texts:section' => 'Section',
    'help_texts:section:option:choose' => 'Select a Section',
    'help_texts:section:option:dashboard:mdgraph' => 'Dashboard MDGraph',
    'help_texts:section:option:contact:edit' => 'Contact: add/edit',
    'help_texts:section:option:contact:profile' => 'Contact: Profile',
    'help_texts:section:option:list:import' => 'List: Import',
    'help_texts:section:option:list:list' => 'List: Listing',
    'help_text:widget:title' => 'Help Tips',
    'help_texts:mandatory' => 'All field with a * are mandatory',
    
            /*    SECTIONS    */
    //Activity
    'help_texts:section:activity' => 'Activity',
    'help_texts:section:activity:dashboard' => 'Dashboard',
    'help_texts:section:activity:wire' => 'Wire',
    //People
    'help_texts:section:people' => 'People',
    'help_texts:section:people:circles' => 'Circles',
    'help_texts:section:people:community' => 'Community',
    'help_texts:section:people:following' => 'Following',
    'help_texts:section:people:followers' => 'Followers',
    //Projects
    'help_texts:section:projects' => 'Projects',
    'help_texts:section:projects:lists' => 'Lists',
    //Files
    'help_texts:section:files' => 'Files',
    'help_texts:section:files:lists' => 'Lists',
    'help_texts:section:files:upload' => 'Upload',
    //Schedule
    'help_texts:section:schedule' => 'Schedule',
    'help_texts:section:schedule:calendar' => 'Calendar',
    'help_texts:section:schedule:video_conference' => 'Video Conference',
    //Social
    'help_texts:section:social' => 'Social',
    'help_texts:section:social:news' => 'News',
    'help_texts:section:social:blog' => 'Blogs',
    'help_texts:section:social:groups' => 'Groups',
    'help_texts:section:social:jobs' => 'Jobs',
    'help_texts:section:social:bookmarks' => 'Bookmarks',
    
    
    'help_texts:view_more' => 'View more',
);

add_translation('en', $english);