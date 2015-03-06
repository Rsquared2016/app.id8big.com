<?php
/*
 *  Twitter Connect tab
 */
re_validate_next_steps();

if (is_plugin_enabled('twitterservice')) {
    $user_id = get_loggedin_userid();
    $twitter_name = get_plugin_usersetting('twitter_name', $user_id, 'twitterservice');
    $access_key = get_plugin_usersetting('access_key', $user_id, 'twitterservice');
    $access_secret = get_plugin_usersetting('access_secret', $user_id, 'twitterservice');
    $plugins = twitterservice_get_tweeting_plugins();
    $twitter_url = twitterservice_get_authorize_url($vars['url'] . 'twitterservice/authorize?skip_for_tab=' . current_page_url());
}

$prev_tab = 'professional_information';
$user_type = get_input('user_type', US_USER);

switch ($user_type) {
    case US_BAR:
	$prev_tab = 'guest_bartenders';
	break;

    case US_COMPANY:
	$prev_tab = 'profile_image';
	break;

    default:
	$prev_tab = 'professional_information';
	break;
}
?>
<form action="<?php echo $vars['url'] ?>action/register/step/twitter_connect/" method="POST">
<?php echo elgg_view('input/securitytoken'); ?>
    <div class="userSettingsWhite uswReg">
	<div class="regLefRig">
<?php if (is_plugin_enabled('twitterservice')) { ?>
    	    <div class="twitterConnect">
		<?php if (!$access_key || !$access_secret) { ?>
			<a href="<?php echo $twitter_url ?>"><img src="<?php echo THEME_GRAPHICS_CUSTOM ?>btn-twitter-reg.png" alt="" /></a>
			<?php
		    } else {
			$url = "{$CONFIG->site->url}twitterservice/revoke/?skip_for_tab=" . current_page_url();
			echo '<p class="twitter_anywhere">' . sprintf(elgg_echo('twitterservice:usersettings:authorized'), $twitter_name, $vars['config']->site->name) . '</p>';
			echo '<p>' . sprintf(elgg_echo('twitterservice:usersettings:revoke'), $url) . '</p>';
		    }
		    ?>
    	    </div>
		    <?php
		} else {
		    if (elgg_is_admin_logged_in()) {
			echo elgg_echo('register_exteps:twitterservice:disabled');
		    }
		}
		?>
	    <div class="innerTabInformation">
	    <?php echo elgg_view('register_exteps/steps/tab_info/generic_info', $vars) ?>
	    </div>
	    <div class="cThis">&nbsp;</div>
	</div>
	<div class="ktForm rBtn">
	    <div class="flRig">
		<input name="submit" type="submit" class="submit_button backButton" rel="<?php echo $prev_tab ?>" value="<?php echo elgg_echo('register_exteps:buttons:back') ?>" />
		<input name="submit" type="submit" class="submit_button" rel="<?php echo elgg_echo('register_exteps:buttons:finish') ?>" value="<?php echo elgg_echo('register_exteps:buttons:finish') ?>" />
		<div class="cThis">&nbsp;</div>
	    </div>
	    <div class="cThis">&nbsp;</div>
	</div>
    </div>
</form>
