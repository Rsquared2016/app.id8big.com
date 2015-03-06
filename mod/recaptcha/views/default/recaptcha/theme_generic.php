<?php
$public_key = elgg_extract('public_key', $vars);
$server = elgg_extract('server', $vars);
$errorpart = elgg_extract('errorpart', $vars);

$theme = recaptcha_get_custom_theme();

?>

<script type="text/javascript">
 var RecaptchaOptions = {
    theme : '<?php echo $theme ?>',
    lang: '<?php echo get_language() ?>'
 };
 </script>

 <?php

echo '<script type="text/javascript" src="'. $server . '/challenge?k=' . $public_key . $errorpart . '"></script>

<noscript>
<iframe src="'. $server . '/noscript?k=' . $public_key . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
</noscript>';