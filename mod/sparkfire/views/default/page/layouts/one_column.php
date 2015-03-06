<?php
/**
 * Elgg one-column layout
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['content'] Content string
 * @uses $vars['class']   Additional class to apply to layout
 */

$class = 'elgg-layout elgg-layout-one-column clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// navigation defaults to breadcrumbs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

$context = elgg_get_context();
$avoid_context = array('login', 'register', 'forgotpassword','register_ex');
$avoid_context_fix_classes = 'nmLef';
$avoid_context_fix_classes_2 = 'np nBg noShadow noRounded nb';

?>
<div class="<?php echo $class; ?>">
	<?php
		/* do not show sidebar */
		if(!in_array($context, $avoid_context)) {
			$avoid_context_fix_classes = '';
			$avoid_context_fix_classes_2 = '';
	?>
	<div class="sideBarsContainer">
		<div id="mnSiteResponsive">
			<div class="mnLefLimits">
				<?php echo elgg_view('page/elements/static_mn'); ?>
			</div>
		</div>
	</div>
	<?php
		}
	?>
	<div class="elgg-body elgg-main <?php echo $avoid_context_fix_classes; ?>">
         <?php echo $nav; ?>
        <div class="bgWhiteAndShadow clearfix <?php echo $avoid_context_fix_classes_2; ?>">
            <?php echo $vars['content']; ?>
        </div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(
		function() {
			/* IE8 and below hackage */
			if($.browser.msie && (parseInt($.browser.version) <= 8)) {
				$('.elgg-page').addClass('unresponsiveIE');
			}
		}
	);
</script>
