<?php
$public_key = elgg_extract('public_key', $vars);
$server = elgg_extract('server', $vars);
$errorpart = elgg_extract('errorpart', $vars);

elgg_load_css('recaptcha');

?>
<script type="text/javascript">
	var RecaptchaOptions = {
		theme : 'custom',
		custom_theme_widget: 'elgg-recaptcha-widget'
	};
</script>
<div id="elgg-recaptcha-widget" class="elggRecaptchaWidget nm" style="display: none;">
	<div class='rFrm rFrmRC clearfix'>
		<label><?php echo elgg_echo('recaptcha:label:human_verification'); ?></label>
		<div id="recaptcha_image" class="flRig"></div>
	</div>
	<div class='rFrm rFrmRC clearfix'>
		<label class="recaptcha_only_if_incorrect_sol" style="color: red;"><?php echo elgg_echo('recaptcha:error:incorrect') ?></label>
		<label class="recaptcha_only_if_image"><?php echo elgg_echo('recaptcha:info_txt:recaptcha_only_if_image') ?></label>
		<label class="recaptcha_only_if_audio"><?php echo elgg_echo('recaptcha:info_txt:recaptcha_only_if_audio') ?></label>
		<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
	</div>
	<div class='rFrm clearfix'>
		<label>&nbsp;</label>
		<ul class="elggCaptchaOptions">
			<li><a href="javascript:Recaptcha.reload()"><?php echo elgg_echo('recaptcha:info_txt:reload_captcha') ?></a></li>
			<li class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')"><?php echo elgg_echo('recaptcha:info_txt:recaptcha_only_if_audio:link') ?></a></li>
			<li class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')"><?php echo elgg_echo('recaptcha:info_txt:recaptcha_only_if_image:link') ?></a></li>
			<li><a href="javascript:Recaptcha.showhelp()"><?php echo elgg_echo('recaptcha:info_txt:help') ?></a></li>
		</ul>
	</div>
</div>
<script type="text/javascript" src="<?php echo $server ?>/challenge?k=<?php echo $public_key . $errorpart ?>"></script>
<noscript>
	<iframe src="<?php echo $server ?>/noscript?k=<?php echo $public_key . $errorpart ?>" height="300" width="500" frameborder="0"></iframe><br>
	<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
	<input type="hidden" name="recaptcha_response_field" value="manual_challenge" />
</noscript>
