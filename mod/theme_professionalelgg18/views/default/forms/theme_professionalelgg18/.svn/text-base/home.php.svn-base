<?php
/**
 * Edit form body for home html.
 * 
 */
//$type = $vars['type'];

//Get home site layout.
$params = array();
$body_html = elgg_view_layout('home_site_index', $params);
//$home_html_enabled = ThemeSettings::customHomeEnabled();

?>
<?php
/*
?>
<div class="mtm">
	<label><?php echo elgg_echo("theme_professionalelgg18:settings:home:body:enabled:title"); ?>:</label>
	<?php
	
	//Body html
	echo elgg_view('input/dropdown', array(
		'name' => 'home_html_enabled',
		'options_values' => array('yes' => elgg_echo('theme:yes'), 'no' => elgg_echo('theme:no')),
		'value' => $home_html_enabled,
	));

	?>
	<div class="infoText"></div>
</div>
 <?php
*/
?>
<div class="mtm">
	<label><?php echo elgg_echo("theme_professionalelgg18:settings:home:body:title"); ?>:</label>
	<?php
	
	//Body html
	echo elgg_view('input/plaintext', array(
		'name' => 'body_html',
		'value' => $body_html,
		'class' => 'elgg-input-plaintext-theme-settings',
		'style' => 'height: 400px;'
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
