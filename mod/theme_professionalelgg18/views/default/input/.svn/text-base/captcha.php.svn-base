<?php

/**
 * Elgg captcha plugin captcha hook view override.
 *
 * @package ElggCaptcha
 */

if (!is_callable('captcha_generate_token')) {
	return false;
}

// Generate a token which is then passed into the captcha algorithm for verification
$token = captcha_generate_token();

?>
<div class="rFrm rFrmCAPTCHA">
    <input type="hidden" name="captcha_token" value="<?php echo $token; ?>" />
    <label class="nmTop"><?php echo elgg_echo('captcha:entercaptcha'); ?></label>
    <div class="captchaInputImg">
		<div class="captchaImg flLef"><img class="captcha-input-image" src="<?php echo $vars['url'] . "captcha/$token"; ?>" /></div>
        <div class="captchaInput flRig"><?php echo elgg_view('input/text', array('name' => 'captcha_input', 'class' => 'captcha-input-text elgg-input-text nmRig')); ?></div>
        <div class="clearfloat"></div>
    </div>
    <div class="clearfloat"></div>
</div>