<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

$title = elgg_view_title(elgg_echo("circles:title"));

$search_link_text = elgg_echo('circles:search');
?>
<div class="mainTitleTop">
	<?php echo $title; ?>
	<div class="mainTitleControls">
		<a href='#' id="btnShowHideSrchFrm"><?php echo $search_link_text ?></a>
	</div>
	<div class="clearfloat">&nbsp;</div>
</div>