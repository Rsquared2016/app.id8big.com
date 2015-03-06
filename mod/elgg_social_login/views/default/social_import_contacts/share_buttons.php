<?php

/**
 * Share Buttons
 */

$user_logged_in = elgg_get_logged_in_user_entity();
if (!elgg_instanceof($user_logged_in, 'user')) {
	return false;
}

$invite_url = social_import_contacts_get_invite_url($user_logged_in);
$url = urlencode($invite_url);

$lang = get_current_language();
?>
<div class="shareButtonsWrapper">
	<div class="shareUrl">
		<label><?php echo elgg_echo('social_import_contacts:social:url:invite:contacts') ?></label>
		<?php echo elgg_view('input/text', array('name' => 'share', 'id' => 'share', 'value' => $invite_url, 'readonly' => 'readonly')); ?>
	</div>
	<div class="shareButtons">
		<span class="shareTxt"><?php echo elgg_echo('social_import_contacts:social:btn:share'); ?></span>
		<a href="http://www.facebook.com/share.php?u=<?php echo $url ?>" target="_blank" class="shareButton shareFacebook">
			<img src="<?php echo ELGG_SOCIAL_LOGIN_GRAPHICS; ?>share_facebook.png" alt="<?php echo elgg_echo('social_import_contacts:social:btn:share:facebook'); ?>" />
		</a>
		<a href="https://twitter.com/share?url=<?php echo $url ?>" target='_blank' class="shareButton shareTwitter" data-url="<?php echo $url ?>" data-lang="<?php echo $lang; ?>" data-size="large" data-text="" data-count="none">
			<img src="<?php echo ELGG_SOCIAL_LOGIN_GRAPHICS; ?>share_twitter.png" alt="<?php echo elgg_echo('social_import_contacts:social:btn:share:twitter'); ?>" />
		</a>
	</div>
</div>
<div class="clearfloat"></div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>