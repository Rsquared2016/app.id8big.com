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
<div class="newCircle">
	<a class="createCircle" href="<?php echo $vars['url'] ?>circles/new/?from=circles">
		<?php echo elgg_echo('circles:section:circles:new') ?>
	</a>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('.createCircle').click(function(event) {
		event.preventDefault();

		var url = $(this).attr('href');

		$.fancybox({
			href: url,
			onStart: function() { $('#fancybox-wrap, #fancybox-outer, #fancybox-content').addClass('ktCirclesFancyBoxAdd'); },
			onClosed: function() { $('#fancybox-wrap, #fancybox-outer, #fancybox-content').removeClass('ktCirclesFancyBoxAdd'); }
		});
	});
});
</script>