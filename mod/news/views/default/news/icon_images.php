<?php
/**
 * Generic icon view.
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */
$entity = $vars['entity']; 

$sizes = array('small', 'medium', 'large', 'tiny', 'master', 'topbar');
// Get size
if (!in_array($vars['size'], $sizes)) {
	$vars['size'] = "medium";
}

$alt = "";

if ($entity->title) {
	$alt .= $entity->title;
} else {
	if ($entity->name) {
		$alt .= $entity->name;
	}
}

// Get any align and js
if (!empty($vars['align'])) {
	$align = " align=\"{$vars['align']}\" ";
} else {
	$align = "";
}
if ($vars['class']) {
	$class = $vars['class'];
} else {
	$class = '';
}
?>
<div class="icon <?php echo $class ?>">
<?php
if ($enable_link) {
?><a href="<?php echo $vars['link'] ?>"><?php
}
?>
		<img src="<?php echo $entity->getIconURL($vars['size']); ?>" border="0" alt="<?php echo $alt ?>" <?php echo $align; ?> <?php echo $vars['js']; ?> />
	<?php
	if ($vars['link']) {
	?></a><?php
	}
	?>
</div>