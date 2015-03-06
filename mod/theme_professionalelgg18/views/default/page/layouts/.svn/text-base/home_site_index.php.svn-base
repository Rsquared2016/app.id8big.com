<?php
/**
 * Esta vista es la encargada de llamar a las otras vistas para organizar la informacion.
 * Esto seria como el wrapper del index.
 */

//Check if we have a custom html into the theme settings.

$body_html = elgg_get_plugin_setting('body_html', THEME_NAME);

$body_html = elgg_extract('content', $vars, $body_html);

if($body_html) {
	echo $body_html;
	return;
}

?>
<div id="homeCont">
	<?php
		/*
		if(theme_slideshow_enabled()) {
			echo elgg_view('page/home/slideshow');
		}
		*/
	?>
	<div class="homeTxtCont">
		<div class="homeImg flRig"><img src="<?php echo THEME_GRAPHICS_CUSTOM; ?>home-images/img-home.png" alt="" /></div>
		<div class="homeTxt flLef">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<h2><?php echo elgg_echo('homesite:title:1'); ?></h2>
						<p><?php echo elgg_echo('homesite:text:1'); ?></p>
					</td>
				</tr>
			</table>
		</div>
		<div class="clearfloat"></div>
	</div>
	<div class="homeContactTxtCont">
		<div class="homeContactTxt flLef">
			<h3>
				<?php echo elgg_echo('homesite:about:title:1'); ?>
				<span class="compName"><?php echo elgg_echo('homesite:about:title:2'); ?></span>
			</h3>
			<p><?php echo elgg_echo('homesite:about:text:1'); ?></p>
		</div>
		<div class="homeContactInfo flLef">
			<h3><?php echo elgg_echo('homesite:about:title:2'); ?></h3>
			<ul>
				<li class="subTitle"><?php echo elgg_echo('homesite:contact:info:1'); ?></li>
				<li><?php echo elgg_echo('homesite:contact:info:2'); ?></li>
				<li><?php echo elgg_echo('homesite:contact:info:3'); ?></li>
				<li><?php echo elgg_echo('homesite:contact:info:4'); ?></li>
				<li><?php echo elgg_echo('homesite:contact:info:5'); ?></li>
				<li><a href="<?php echo elgg_echo('homesite:contact:info:6:2'); ?>"><?php echo elgg_echo('homesite:contact:info:6:1'); ?> <?php echo elgg_echo('homesite:contact:info:6:2'); ?></a></li>
			</ul>
		</div>
		<div class="clearfloat"></div>
	</div>
</div>
