<?php

$entity = $vars['entity'];

if($entity instanceof KtCategory) {
	$category = $entity;
} else {
	return false;
}

$category_url = keetup_get_category_url($category->getGUID());

?>
<div class="flLef KtCategory KtCategoriesListing">
	<a href="<?php echo $category_url; ?> ">
	<?php
		echo $category->getName();
	?>
	</a>
</div>
<div class="cThis">&nbsp;</div>
