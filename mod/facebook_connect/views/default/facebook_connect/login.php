<?php

$url =  elgg_get_site_url().'facebook_connect/login';
$img_url = elgg_get_site_url() . 'mod/facebook_connect/graphics/LoginWithFacebook.png';

$login = <<<__HTML
<div id="login_with_facebook">
	<a href="$url"><center><img src="$img_url" alt="Facebook" style="padding-left:40px";/></center></a>
</div>
__HTML;

echo $login;
echo "<b><center><span style='padding-left:40px';>".elgg_echo('facebook_connect:orlogin')."</span></center></b>";
echo "<hr/>";
?>