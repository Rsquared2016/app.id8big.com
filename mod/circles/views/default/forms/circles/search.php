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

?>
<div class="ktHiddenSrchFrm">
	<form id="formSearch">
		<div class="ktFormWrapperGroup ktG50 ktG50Extra">
			<div class="ktFormWrapper">
				<label><?php echo elgg_echo('circles:search:keyword'); ?></label>
				<div class="frmField">
					<?php
						echo elgg_view('input/text', array('name' => 'search', 'value' => '', 'class' => 'txtFrm txtFrm100'));
					?>
					<div class="clearfloat">&nbsp;</div>
				</div>
				<div class="clearfloat">&nbsp;</div>
			</div>
		</div>
		<div class="rBtnSrchFrm mTop1">
			<?php
				echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('circles:section:search:button')));
			?>
		</div>
		<div class="clearfloat">&nbsp;</div>
	</form>
</div>
<script type="text/javascript">
$(document).ready(function() {
	
	$('#formSearch').submit(function(e) {
		
		var url = '<?php echo $vars['url']; ?>circles/searchfriends/';
		var values = $(this).serialize();
		
		$('.searchResultFriends').load(url, values, function() {
			// quitar reloj
			$('li', $('.listFriends')).draggable({
				helper: "clone",
				revert: "invalid" // when not dropped, the item will revert back to its initial position
			});
		});
		
		return false;
	});
	
});
</script>