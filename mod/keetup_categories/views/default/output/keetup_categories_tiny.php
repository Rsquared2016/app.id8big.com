
<?php
$entity = $vars['entity'];
if (!$entity) {
	$entity = get_entity($vars['value']);
}

$clean = $vars['clean'];
if (!$clean)
	$clean = true;

/**
 * Disabled atm
 */
$with_subcategory = FALSE;

$class = $vars['class'];
if (!$class)
	$class = '';

if (isset($entity->kt_category)) {
	$category = $entity->kt_category;
	if (isset($entity->kt_subcategory) && $entity->kt_subcategory != '') {
		$subcategory = $entity->kt_subcategory;
	}
} else {
	if ($vars['category_id']) {
		$category = $vars['category_id'];
		if ($vars['subcategory_id']) {
			$subcategory = $vars['subcategory_id'];
		}
	}
}


if ($category) {

	$category_id = $category;

	$category_url = keetup_get_category_url($category_id);
	$category_title = keetup_get_category($category_id);

	if ($with_subcategory) {
		$subcategory_id = $subcategory;
		$sub_category_title = keetup_get_subcategory($category_id, $subcategory_id);
		$sub_category_url = keetup_get_category_url($category_id, $subcategory_id);
	}
}
?>

<?php if ($category) { ?>
<span class="sep">·</span>
<span> <a href='<?php echo $category_url ?>'><?php echo $category_title ?></a> </span>
	<?php if ($with_subcategory) { ?>
		<a href="<?php echo $sub_category_url ?>"><?php echo $sub_category_title ?></a>
	<?php } ?>
<?php } ?>

