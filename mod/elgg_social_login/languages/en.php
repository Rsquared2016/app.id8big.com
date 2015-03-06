<?php

$english = array(
	// Settings
	'elgg_social_login:settings:yes' => 'YES',
	'elgg_social_login:settings:no' => 'NO',
	'elgg_social_login:settings:warning' => 'Warning:<br />Unfortunately Your server failed the requirements check for this plugin and most likely it won\'t work correctly!',
	'elgg_social_login:settings:recommendation' => 'We highly recommend to first run the plugin requirements test and to read the plugin user guide. If you need further assistance, feel free to contact me at <b>hybridauth@gmail.com</b>',
	'elgg_social_login:settings:run:test' => 'Run the plugin requirements test',
	'elgg_social_login:settings:guide' => 'Read the plugin user guide',
	'elgg_social_login:settings:test:mode' => 'Plugin Test Mode Active?',
	'elgg_social_login:settings:test:mode:recommendation' => 'We recommend to set <b>test mode</b> to <b style="color:green">YES</b> until you are sure you want to go live.',
	'elgg_social_login:settings:privacy:web:page' => 'Do you have privacy web page?',
	'elgg_social_login:settings:privacy:web:page:leave' => 'leave it black if you dont.',
	'elgg_social_login:settings:providers:setup' => 'Providers setup',
	'elgg_social_login:settings:providers:setup:note' => 'Except for OpenID providers, each social network and identities provider will require that you create an external application linking your Web site to theirs apis. These external applications ensures that users are logging into the proper Web site and allows identities providers to send the user back to the correct Web site after successfully authenticating their Accounts.',
	'elgg_social_login:settings:providers:setup:note:1' => 'To correctly setup these Identity Providers please carefully follow the help section of each one.',
	'elgg_social_login:settings:providers:setup:note:2' => 'If <b>Provider Satus</b> is set to <b style="color:red">NO</b> then users will not be able to login with this provider on you website.',
	'elgg_social_login:settings:allow:sign' => 'Allow users to sign on with %s?',
	'elgg_social_login:settings:allow:import:contacts' => 'Allow users to import contacts with %s?',
	'elgg_social_login:settings:how:to:setup' => 'How to setup %s:',
	'elgg_social_login:settings:go:to' => 'Go to',
	'elgg_social_login:settings:create:application' => 'and create a new application.',
	'elgg_social_login:settings:fill' => 'Fill out any required fields such as the application name and description.',
	'elgg_social_login:settings:google:note' => 'On the "Create Client ID" popup switch to advanced settings by clicking on (more options).',
	'elgg_social_login:settings:provide:url' => 'Provide this URL as the Callback URL for your application:',
	'elgg_social_login:settings:myspaces:note' => 'Put your website domain in the External Url and External Callback Validation fields. This should match with the current hostname <em style="color:#CB4B16;">%s</em>.',
	'elgg_social_login:settings:live:note' => 'Put your website domain in the Redirect Domain field. This should match with the current hostname <em style="color:#CB4B16;">%s</em>.',
	'elgg_social_login:settings:facebook:note' => 'Put your website domain in the Site URL field. This should match with the current hostname <em style="color:#CB4B16;">%s</em>.',
	'elgg_social_login:settings:linkedin:note' => 'Put your website domain in the Integration URL field. This should match with the current hostname <em style="color:#CB4B16;">%s</em>.',
	'elgg_social_login:settings:linkedin:note:1' => 'Set the <b>Application Type</b> to <em style="color:#CB4B16;">Web Application</em>.',
	'elgg_social_login:settings:twitter:note' => 'Put your website domain in the Application Website and Application Callback URL fields. This should match with the current hostname <em style="color:#CB4B16;">%s</em>.',
	'elgg_social_login:settings:twitter:note:1' => 'Set the <b>Application Type</b> to <em style="color:#CB4B16;">Browser</em>.',
	'elgg_social_login:settings:twitter:note:2' => 'Set the <b>Default Access Type</b> to <em style="color:#CB4B16;">Read</em>.',
	'elgg_social_login:settings:registered' => 'Once you have registered, copy and past the created application credentials into this setup page.',
	'elgg_social_login:settings:openid:note' => 'No registration required for OpenID based providers',
	
	// Diagnostics
	'elgg_social_login:diagnostics:title' => 'Social Login Plugin Diagnostics',
	'elgg_social_login:diagnostics:rewrite:title' => '1. URL Rewrite',
	'elgg_social_login:diagnostics:rewrite:note' => 'The rewrite rules on your server appear to be setup correctly for this plugin to work.',
	'elgg_social_login:diagnostics:system:requirements:title' => '2. System Requirements',
	'elgg_social_login:diagnostics:installed' => 'installed',
	'elgg_social_login:diagnostics:installed:not' => 'not installed',
	'elgg_social_login:diagnostics:disabled' => 'is disabled',
	'elgg_social_login:diagnostics:enabled' => 'enabled',
	'elgg_social_login:diagnostics:oauth:compatible:not' => 'is not compatible with this plugin, and many providers like twitter and myspace wont work! Please disabled it!',
	'elgg_social_login:diagnostics:pecl:compatible:not' => 'is not compatible with this library',
	'elgg_social_login:diagnostics:end' => 'End of Diagnostics!',
	
	// Social Login
	'elgg_social_login:connect:with' => 'Or connect with',
	'elgg_social_login:created:account' => 'A new user account has been created from your %s account.',
    'elgg_social_login:signed:success' => 'You have signed in with %s',
    'elgg_social_login:loading' => 'Loading...',
    'elgg_social_login:contacting' => 'Contacting',
    'elgg_social_login:please:wait' => 'please wait...',
	
	// Social Import Contacts
	'social_import_contacts' => 'Grow your network',
	'social_import_contacts:welcome' => 'Welcome to',
	'social_import_contacts:select:platform' => 'Select platform',
	'social_import_contacts:username' => 'Username',
	'social_import_contacts:password' => 'Password',
	'social_import_contacts:invite' => 'Invite',
	'social_import_contacts:provider:invite' => 'Invite through %s',
	'social_import_contacts:later' => 'Later',
	'social_import_contacts:text' => "Leverage your innovation and enterpreuner capital! Invite email contacts and your social network to follow you and your projects.",
	'social_import_contacts:disclaimer' => '(*) Saludoc no almacenará sus claves lorem Ipsum is simply dummy text.',
	'social_import_contacts:error:get:contacts' => 'There was an error while trying to get the contacts from %s.',
	'social_import_contacts:error:invite:contacts' => 'There was an error while trying to invite to the %s contacts.',
	'social_import_contacts:success:invite:contacts' => '%s contacts were successfully invited.',
	'social_import_contacts:invite:text' => 'Select the contacts to invite from <b>%s</b>.',
	'social_import_contacts:error:contacts:empty' => 'You must select at least one contact to import.',
	'social_import_contacts:error:provider:empty' => 'Invalid platform.',
	'social_import_contacts:form:message' => 'Message',
	'social_import_contacts:message:subject' => 'Join to %s.',
	'social_import_contacts:message:body' => 'I want to invite you to join my network here on %s.',
	'social_import_contacts:to:project:message:body' => 'I want to invite you to join my project %s on %s.',
	'social_import_contacts:social:btn:invite:contacts' => 'Invite Contacts',
	'social_import_contacts:social:btn:email' => 'Your email contacts',
	'social_import_contacts:social:btn:share' => 'Your social network',
	'social_import_contacts:social:url:invite:contacts' => 'URL to invite your contacts',
	'social_import_contacts:social:btn:share:facebook' => 'Share on Facebook',
	'social_import_contacts:social:btn:share:twitter' => 'Share on Twitter',
	'social_import_contacts:invite_contacts:introduction' => 'To invite contacts to join you on this network, enter their email addresses below (one per line):',
	'social_import_contacts:invite_contacts:message' => 'Enter a message they will receive with your invitation:',
	'social_import_contacts:invite_contacts:message:default' => '
Hi,

I want to invite you to join my network here on %s.',
	'social_import_contacts:invite_contacts:invite' => 'Invite',
	'social_import_contacts:invite_contacts:noemails' => 'No email addresses were entered.',
	'social_import_contacts:invite_contacts:subject' => 'Invitation to join %s',
	'social_import_contacts:invite_contacts:email' => '
You have been invited to join %s by %s. They included the following message:

%s

To join, click the following link:

%s

You will automatically add them as a friend when you create your account.',
	'social_import_contacts:invite_contacts:invitations_sent' => 'Invites sent: %s. There were the following problems:',
	'social_import_contacts:invite_contacts:email_error' => 'The following addresses are not valid: %s',
	'social_import_contacts:invite_contacts:already_members' => 'The following are already members: %s',
	'social_import_contacts:invite_contacts:success' => 'Your contacts were invited.',
	'social_import_contacts:invited:contacts:provider:empty' => 'You did not invite any contacts through %s.',
	'social_import_contacts:invited:contacts:provider' => 'Contacts invited through %s',
    'social_import_contacts:invite:to:project' => 'Invite external user to the project'
);
add_translation('en', $english);