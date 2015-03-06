<?php
$forwarding_login_val = elgg_get_plugin_setting('forwarding_login', THEME_NAME);

$forwarding_logo_off_val = elgg_get_plugin_setting('forwarding_logo_off', THEME_NAME);
$forwarding_logo_in_val = elgg_get_plugin_setting('forwarding_logo_in', THEME_NAME);

if (empty($forwarding_login_val)) {
	$forwarding_login_val = ThemeSettings::getForwardLoggedInURL();
	$forwarding_login_val = ThemeSettings::getEncodedUrl($forwarding_login_val);
}

if (empty($forwarding_logo_off_val)) {
	$forwarding_logo_off_val = ThemeSettings::getForwardHomePageOutURL();
	$forwarding_logo_off_val = ThemeSettings::getEncodedUrl($forwarding_logo_off_val);
}

if (empty($forwarding_logo_in_val)) {
	$forwarding_logo_in_val = ThemeSettings::getForwardHomePageInURL();
	$forwarding_logo_in_val = ThemeSettings::getEncodedUrl($forwarding_logo_in_val);
}

$helpers = ThemeSettings::getUrlHelpers();
?>


<div class="elgg-module  elgg-module-info elgg-module-forward-help">
	<div class="elgg-head">
		<h3><?php echo elgg_echo('theme_professionalelgg18:settings:forwarding:help') ?></h3>
	</div>
	<div class="elgg-body">
		<ul>
			<li><?php echo elgg_echo('theme_professionalelgg18:settings:forwarding:help:site_url', array($helpers['site_url'], elgg_get_site_url())) ?></li>
			<li><?php echo elgg_echo('theme_professionalelgg18:settings:forwarding:help:username', array($helpers['username'], $helpers['site_url'].'profile/'.$helpers['username'])) ?></li>
			
		</ul>
	</div>
</div>

<div class="mtm">
	<label for="forwarding_login"><?php echo elgg_echo("theme_professionalelgg18:settings:forwarding:login:url"); ?>:</label>
	<?php
	echo elgg_view('input/text', array(
		'name' => 'forwarding_login',
		'value' => $forwarding_login_val,
		'id' => "forwarding_login",
	));
	?>
	<div class="infoText">
		<?php
		echo elgg_echo("theme_professionalelgg18:settings:forwarding:login:url:info:text");
		?>
	</div>
</div>

<div class="logosUrls">

	<div class="mtm">
		<h3><?php echo elgg_echo('theme_professionalelgg18:settings:forwarding:logo:title') ?></h3>
	</div>

	<div class="mtm">

		<label for="forwarding_logo_off"><?php echo elgg_echo("theme_professionalelgg18:settings:forwarding:logo_off:url"); ?>:</label>
		<?php
		echo elgg_view('input/text', array(
			'name' => 'forwarding_logo_off',
			'value' => $forwarding_logo_off_val,
			'id' => "forwarding_logo_off",
		));
		?>
		<div class="infoText">
			<?php
			echo elgg_echo("theme_professionalelgg18:settings:forwarding:logo_off:url:info:text");
			?>
		</div>
	</div>
	<div class="mtm">

		<label for="forwarding_logo_in"><?php echo elgg_echo("theme_professionalelgg18:settings:forwarding:logo_in:url"); ?>:</label>
		<?php
		echo elgg_view('input/text', array(
			'name' => 'forwarding_logo_in',
			'value' => $forwarding_logo_in_val,
			'id' => "forwarding_logo_in",
		));
		?>
		<div class="infoText">
			<?php
			echo elgg_echo("theme_professionalelgg18:settings:forwarding:logo_in:url:info:text");
			?>
		</div>
	</div>

</div>



<div class="elgg-foot">
	<?php
	echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('save')));
	?>
</div>