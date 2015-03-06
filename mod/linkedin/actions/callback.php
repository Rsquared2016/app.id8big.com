<?php

if(!class_exists('OAuthConsumer'))
{
    require_once dirname(dirname(__FILE__)).'/model/OAuth.php';
}
require_once dirname(dirname(__FILE__)).'/model/OAuthLinkedin.php';
global $CONFIG;

$request_token = unserialize($_SESSION['linkedin']['token']);
$linkedin = new OAuthLinkedin(
        elgg_get_plugin_setting('linkedin_key', 'linkedin'),
        elgg_get_plugin_setting('linkedin_secret', 'linkedin')
);
$linkedin->getAccessToken($request_token, (int)$_GET['oauth_verifier']);

$response = $linkedin->request('https://api.linkedin.com/v1/people/~:(id,first-name,last-name,headline,picture-url,location:(country:(code)))');
$xml = simplexml_load_string($response);

// look for existing user
$user = elgg_get_entities_from_metadata(array(
	'type' => 'user',
    'metadata_name_value_pair' => array('name' => 'linkedin_id', 'value' => $xml->id)
));

// register them
if(empty($user))
{
	$username = str_replace(' ', '_', strtolower($xml->{'first-name'}.$xml->{'last-name'}));
    $user = get_user_by_username($username);
    
    while($user !== false) // find a unique username
    {
        $username .= rand(0,9);
        $user = get_user_by_username($username);
    }

    $name = $xml->{'first-name'}.' '.$xml->{'last-name'};
    $password = sha1(time().$xml->id.rand(1, 999999999));

    $guid = register_user($username, $password, $name, $username.'@example.com');
    $user = get_user($guid);

    $user->linkedin_user = true; // can't change subtype
    $user->linkedin_id = $xml->id;
    $user->linkedin_sync = true;
    $user->email = ''; // register() requires this, linkedin will not supply it so reset fake@
}
else
{
    $user = $user[0]; // first and only user in entity array
}

login($user);

// sync profile
if($user->linkedin_sync)
{
	$user->briefdescription = $xml->headline;
	
    // update profile pic
    if(!empty($xml->{'picture-url'}) && $user->linkedin_profile_pic_url != $xml->{'picture-url'})
    {
        $filename = $CONFIG->dataroot.'linkedinpic.jpg';
        $file = file_get_contents($xml->{'picture-url'});
        file_put_contents($filename, $file);
        
        $pics['topbar'] = get_resized_image_from_existing_file($filename, 16, 16, true, 0, 0, 0, 0, true);
        $pics['tiny']   = get_resized_image_from_existing_file($filename, 25, 25, true, 0, 0, 0, 0, true);
        $pics['small']  = get_resized_image_from_existing_file($filename, 40, 40, true, 0, 0, 0, 0, true);
        $pics['medium'] = get_resized_image_from_existing_file($filename, 100, 100, true, 0, 0, 0, 0, true);
        $pics['large']  = get_resized_image_from_existing_file($filename, 200, 200);
        $pics['master'] = get_resized_image_from_existing_file($filename, 550, 550);

        $filehandler = new ElggFile();
        $filehandler->owner_guid = $user->getGUID();
        foreach($pics as $k => $v)
        {
            $filehandler->setFilename('profile/'.$user->guid.$k.'.jpg');
            $filehandler->open("write");
            $filehandler->write($v);
            $filehandler->close();
        }
        unlink($filename);
        $user->icontime = time(); // What's the purpose of this line?
        $user->linkedin_profile_pic_url = $xml->{'picture-url'};
        elgg_trigger_event('profileiconupdate',$user->type,$user);
        add_to_river('river/user/default/profileiconupdate','update',$user->guid,$user->guid);
    }
}

forward();
exit;
