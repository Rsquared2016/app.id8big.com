<?php
/**
 * Elgg login form
 *
 * @package Elgg
 * @subpackage Core
 */
 
$module = elgg_extract('module', $vars, 'aside');
$login_url = elgg_get_site_url();

if (elgg_get_config('https_login')) {
	$login_url = str_replace("http:", "https:", $login_url);
}

$body = elgg_view_form('login_lb_contents', array('action' => "{$login_url}action/login"));

?>
<div id="loginCont">
	<a href="<?php echo $vars['url']; ?>login" class="loginBtn"><span><?php echo elgg_echo('login:title'); ?></span></a>
	<?php
		echo elgg_view_module($module, '', $body);
	?>
</div>