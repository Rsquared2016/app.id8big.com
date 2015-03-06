<?php

if(!class_exists('OAuthConsumer'))
{
    require_once dirname(dirname(__FILE__)).'/model/OAuth.php';
}
require_once dirname(dirname(__FILE__)).'/model/OAuthLinkedin.php';

$linkedin = new OAuthLinkedin(
        elgg_get_plugin_setting('linkedin_key', 'linkedin'),
        elgg_get_plugin_setting('linkedin_secret', 'linkedin'),
        elgg_add_action_tokens_to_url($CONFIG->url.'action/linkedin/callback')
);
$request_token = $linkedin->getRequestToken();
$_SESSION['linkedin']['token'] = serialize($request_token);

forward('https://www.linkedin.com/uas/oauth/authenticate?oauth_token='.$request_token->key);
exit;
?>