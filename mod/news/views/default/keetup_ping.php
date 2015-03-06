<?php
/**
* news
*
* @author Diego Gallardo
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/
?>
<div  class='keetup_ping'>&nbsp;</div>
<div class="pingContent">
	<div class='ContentWrapper'>
		<h2><?php echo elgg_echo('news:ping:title'); ?></h2>
		<p>
			<?php echo elgg_echo('news:ping:description'); ?>
		</p>
		<form method='post' action='<?php echo $vars['url']?>mod/news/vendors/plugin/ping.php'>
			<p><?php echo elgg_echo('news:ping:description2'); ?> <small>(<?php echo elgg_echo('news:ping:description3'); ?>)</small>.<br /></p>
			<label>
				E-mail:
				<input type="text" name='email_address' value='' />
			</label>
			<div class='clearfloat'></div>
			<div class='ping_buttons'>
				<button type="submit" class="submit_button">
					<?php echo elgg_echo('news:ping'); ?>
				</button>
			</div>
		</form>
	</div>
</div>