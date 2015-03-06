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
	<div class="footerCols">
		<div class="footerCol footerCol1 flLef">
			<h4><?php echo elgg_echo('footer:column:1:title'); ?></h4>
			<ul class="ulFootCol">
				<li><a href="<?php echo $vars['url']; ?>useragreement"><?php echo elgg_echo('footer:column:5:link:1'); ?></a></li>
				<li><a href="<?php echo $vars['url']; ?>privacypolicy"><?php echo elgg_echo('footer:column:5:link:2'); ?></a></li>
				<li><?php echo elgg_echo('footer:copy:1'); ?> <?php echo date('Y'); ?> <a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:1:title'); ?></a></li>
			</ul>
		</div>

		<div class="footerCol footerCol2 flLef nmRig">
			<h4><?php echo elgg_echo('footer:column:5:title'); ?></h4>
			<ul class="socialIcons flN">
				<li class="item1"><a target="_blank" href="https://www.facebook.com/pages/ID8Big/1500625673509851" title="Facebook"></a></li>
				<li class="item2"><a target="_blank" href="https://twitter.com/ID8Big" title="Twitter"></a></li>
				<li class="item3"><a target="_blank" href="http://www.linkedin.com/company/sparkfire-labs?trk=vsrp_companies_cluster_name&trkInfo=VSRPsearchId%3A276948351412963284952%2CVSRPtargetId%3A3573818%2CVSRPcmpt%3Acompanies_cluster" title="LinkedIn"></a></li>
				<li class="item4 nmRig"><a target="_blank" href="#" title="RSS"></a></li>
			</ul>

		</div>
		<div class="footerSlogans flRig">
			<?php /*<div class="fs1"><a href="http://elgg.org" target="_blank" title="<?php echo elgg_echo('footer:powered'); ?>"></a></div>*/ ?>
			<?php /*<div class="fs2"><a href="http://www.keetup.com" target="_blank" title="<?php echo elgg_echo('footer:keetup'); ?>"></a></div> */ ?>
			<div class="clearfloat"></div>
		</div>
		<div class="clearfloat"></div>
	</div>
	<!--
	<div class="footerCols">
		<div class="footerCol footerCol1 flLef">
			<h4><?php echo elgg_echo('footer:column:1:title'); ?></h4>
			<ul class="ulFootCol">
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:1:link:1'); ?></a></li>
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:1:link:2'); ?></a></li>
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:1:link:3'); ?></a></li>
			</ul>
		</div>
		<div class="footerCol footerCol2 flLef">
			<h4><?php echo elgg_echo('footer:column:2:title'); ?></h4>
			<ul class="ulFootCol">
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:2:link:1'); ?></a></li>
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:2:link:2'); ?></a></li>
			</ul>
		</div>
		<div class="footerCol footerCol3 flLef">
			<h4><?php echo elgg_echo('footer:column:3:title'); ?></h4>
			<ul class="ulFootCol">
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:3:link:1'); ?></a></li>
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:3:link:2'); ?></a></li>
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:3:link:3'); ?></a></li>
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:3:link:4'); ?></a></li>
			</ul>
		</div>
		<div class="footerCol footerCol4 flLef">
			<h4><?php echo elgg_echo('footer:column:4:title'); ?></h4>
		</div>
		<div class="footerCol footerCol5 flLef nmRig">
			<h4><?php echo elgg_echo('footer:column:5:title'); ?></h4>
			<ul class="socialIcons flN">
				<li class="item1"><a target="_blank" href="http://www.facebook.com/pages/Sparkfire-Labs/142034925960274" title="Facebook"></a></li>
				<li class="item2"><a target="_blank" href="https://twitter.com/SparkFireLabs" title="Twitter"></a></li>
				<li class="item3"><a target="_blank" href="#" title="LinkedIn"></a></li>
				<li class="item4 nmRig"><a target="_blank" href="#" title="RSS"></a></li>
			</ul>
			<ul class="ulFootCol">
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:5:link:1'); ?></a></li>
				<li><a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:column:5:link:2'); ?></a></li>
			</ul>
		</div>
		<div class="clearfloat"></div>
	</div>
	-->
	<!--
	<div class="newsAndCopy">
		<form action="" class="elgg-form flLef" id="frmNewsletter">
			<h4><?php echo elgg_echo('footer:news:title'); ?></h4>
			<fieldset>
				<input type="text" class="elgg-input-text input-newsletter flLef" value="<?php echo elgg_echo('footer:news:input'); ?>" title="<?php echo elgg_echo('footer:news:title'); ?>" />
				<input type="submit" class="elgg-input-submit flLef" value="<?php echo elgg_echo('footer:news:btn'); ?>" />
			</fieldset>
		</form>
		<ul class="ulFoot flRig">
			<li><?php echo elgg_echo('footer:copy:1'); ?> <?php echo date('Y'); ?> <a href="<?php echo $vars['url']; ?>"><?php echo elgg_echo('footer:copy:2'); ?></a></li>
		</ul>
		<div class="clearfloat"></div>
	</div>
	-->
	<script type="text/javascript">
		$(document).ready(
			function() {
				/* clear word from text inputs */
				var input_txt = $('input.input-newsletter');
				input_txt.focus(function() {
					var el = $(this);
					if(el.val() == el.attr('title')) {
						$(this).val('');
					}
				}).blur(function() {
					var el = $(this);
					/* use the elements title attribute to store the
					default text - or the new HTML5 standard of using
					the 'data-' prefix i.e.: data-default="some default" */
					if(el.val() == '')
					el.val(el.attr('title'));
				});	
			}
		);
	</script>