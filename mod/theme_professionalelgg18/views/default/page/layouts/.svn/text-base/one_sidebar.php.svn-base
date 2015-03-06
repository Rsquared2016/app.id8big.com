<?php

/**
 * Layout for main column with one sidebar
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['content'] Content HTML for the main column
 * @uses $vars['sidebar'] Optional content that is displayed in the sidebar
 * @uses $vars['title']   Optional title for main content area
 * @uses $vars['class']   Additional class to apply to layout
 * @uses $vars['nav']     HTML of the page nav (override) (default: breadcrumbs)
 */

	$context = elgg_get_context();
	$class = 'elgg-layout elgg-layout-one-sidebar clearfix';

	if (isset($vars['class'])) {
		$class = "$class {$vars['class']}";
	}

	$three_col = theme_get_three_columns_support() && ($context != 'settings') || ($context == 'activity');

	// navigation defaults to breadcrumbs
	$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

	$right_sidebar = '';
	$left_sidebar = '';
	if($three_col) {
		$right_sidebar = elgg_view('page/elements/right_sidebar', $vars);
	}

	// Responsive layout customization.
	if($context == 'activity') {
		$left_sidebar = $right_sidebar;
		$right_sidebar = '';
		$three_col = false;
	}

	// three columns
	if ($three_col) {
		$class .= ' threeCol';
	}
	else { // two columns
		$class .= ' twoCol';
	}


?>

<div class="<?php echo $class; ?> ">
	<div class="sideBarsContainer">
		<div id="mnSiteResponsive" class="flLef">
			<?php echo elgg_view('page/elements/loggedin_block_responsive', $vars); ?>
			<div class="mnLefLimits"><?php echo elgg_view_menu('site'); ?></div>
		</div>
		<div class="elgg-sidebar flLef">
			<?php echo $left_sidebar; ?>
			<?php echo elgg_view('page/elements/sidebar', $vars); ?>
		</div>
		<div class="clearfloat"></div>
	</div>
	<div class="elgg-main elgg-body flN">
		<?php
			echo $nav;
			if ($vars['title'] != '') {
				echo elgg_view_title($vars['title']);
			}
			// @todo deprecated so remove in Elgg 2.0
			if (isset($vars['area1'])) {
				echo $vars['area1'];
			}
			if (isset($vars['content'])) {
				echo $vars['content'];
			}
		?>
	</div>
	<?php
		echo $right_sidebar;
	?>
</div>
