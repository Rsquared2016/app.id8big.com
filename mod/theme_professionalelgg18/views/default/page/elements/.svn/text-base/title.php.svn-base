<?php
/**
 * Elgg title element
 *
 * @uses $vars['title'] The page title
 * @uses $vars['class'] Optional class for heading
 */

$class= '';
if (isset($vars['class'])) {
	$class = $vars['class'];
}

if (empty($vars['title'])) {
	return true;
}
?>
<h2 class="<?php echo $class; ?> mainContentsTitle subMnCont">
	<?php
		if(THEME_RESPONSIVE_SUPPORT && elgg_is_logged_in()) {
	?>
		<span class="h2titleShowSidebar hasSubMn"></span>
		<span class="elgg-sidebar"></span>
	<?php
		}
	?>
	<span class="titleTxt"><?php echo $vars['title']; ?></span>
</h2>
