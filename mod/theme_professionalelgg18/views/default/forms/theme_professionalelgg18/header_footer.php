<?php

//Get logo.
$theme_logo = elgg_get_plugin_setting('theme_logo', THEME_NAME);

//Set default logo.
if(!$theme_logo) {
	$theme_logo = THEME_GRAPHICS_CUSTOM . 'logo.png';
}

$theme_favicon = ThemeSettings::getFaviconUrl();

//Future: footer config.
//$theme_footer_html = elgg_get_plugin_setting('theme_footer_html', 'theme_professionalelgg18');
$theme_footer_html = elgg_view('page/elements/footer', array());

?>
<div class="mtm">
	<label><?php echo elgg_echo("theme_professionalelgg18:settings:home:logo:url"); ?>:</label>
	<?php
	
	//Body html
	echo elgg_view('input/text', array(
		'name' => 'theme_logo',
		'value' => $theme_logo,
	));

	?>
	<div class="infoText">
		<?php 
			echo elgg_echo("theme_professionalelgg18:settings:home:logo:url:info:text"); 
		?>
	</div>
</div>
<div class="mtm">
	<label><?php echo elgg_echo("theme_professionalelgg18:settings:home:favicon:url"); ?>:</label>
	<?php
	
	//Body html
	echo elgg_view('input/text', array(
		'name' => 'theme_favicon',
		'value' => $theme_favicon,
	));

	?>
	<div class="infoText">
		<?php 
			$url = elgg_view('output/url', array('href' => 'http://www.favicon.cc/', 'text' => 'Favicon Generator'));
			echo elgg_echo("theme_professionalelgg18:settings:home:favicon:url:info:text", array($url)); 
		?>
	</div>
</div>
<div class="mtm">
	<label><?php echo elgg_echo("theme_professionalelgg18:settings:home:footer:title"); ?>:</label>
	<?php
	//Footer html
	echo elgg_view('input/plaintext', array(
		'name' => 'theme_footer_html',
		'value' => $theme_footer_html,
 		'class' => 'elgg-input-plaintext-theme-settings',
		'style' => 'height: 200px;'
	));
	?>
	<div class="infoText">
		<?php 
			echo elgg_echo("theme_professionalelgg18:settings:home:html:info:text"); 
		?>
	</div>
</div>


<div class="elgg-foot">
<?php 

//Submit
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('save')));
echo elgg_view('input/submit', array('name' => 'restore', 'value' => elgg_echo('Restore'), 'title' => 'Restore Original Html'));

?>
</div>