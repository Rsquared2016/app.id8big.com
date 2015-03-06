<?php
/**
 * Elgg footer
 * The standard HTML footer that displays across the site
 *
 * @package Elgg
 * @subpackage Core
 *
 */

//echo elgg_view_menu('footer', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));

//echo elgg_view('page/elements/social-icons');

//Check if we have custom footer.
$footer_html = elgg_get_plugin_setting('theme_footer_html', THEME_NAME);

if($footer_html) {
	echo $footer_html;
	return;
}

?>
	<ul class="ulFoot">
		<li><a href="#"><?php echo elgg_echo('footer:terms'); ?></a></li>
		<li class="sep">|</li>
		<li><?php echo elgg_echo('footer:copy:1'); ?> <?php echo date('Y'); ?> <a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:copy:2'); ?></a></li>
	</ul>
	<div class="footerSlogans">
		<div class="fs1"><a href="http://elgg.org" target="_blank" title="<?php echo elgg_echo('footer:powered'); ?>"></a></div>
		<div class="fs2"><a href="http://www.keetup.com" target="_blank" title="<?php echo elgg_echo('footer:keetup'); ?>"></a></div>
		<div class="clearfloat"></div>
	</div>
	<div class="clearfloat"></div>
