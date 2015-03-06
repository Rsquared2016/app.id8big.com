<?php
/**
 * Esta vista es la encargada de llamar a las otras vistas para organizar la informacion. 
 * Esto seria como el wrapper del index.
 */

//Check if we have a custom html into the theme settings.
$body_html = elgg_get_plugin_setting('body_html', 'theme_professionalelgg18');

if($body_html) {
	echo $body_html;
	return;
}

$mod_graphics = $vars['url'] . 'mod/sparkfire/graphics/';

?>
<div id="homeCont">
	<div class="imgHome">
		<h2 class="h2TitleHome"><span class="txt1"><?php echo elgg_echo('home:title:1:1'); ?></span> <span class="txt2"><?php echo elgg_echo('home:title:1:2'); ?></span><a href="<?php echo $vars['url']; ?>register" class="btnStartNow" title="<?php echo elgg_echo('home:title:1:3'); ?>"></a></h2>
	</div>
	<div class="homeCols">
	<?php
		for($i_cont = 1; $i_cont < 4; $i_cont++) {
	?>
		<div class="homeCol homeCol<?php echo $i_cont; ?> flLef">
			<h3><?php echo elgg_echo('home:column:' . $i_cont . ':title'); ?></h3>
			<h4><?php echo elgg_echo('home:column:' . $i_cont . ':subtitle'); ?></h4>
			<div class="colTxt">
				<?php echo elgg_echo('home:column:' . $i_cont . ':text'); ?>
			</div>
		</div>
	<?php
		}
	?>
		<div class="clearfloat"></div>
	</div>
</div>