<?php
	/**
	 * Kt Category display (small)
	 *
	 * @uses $vars['entity'] The kt_category entity
	 */

	$guid = $vars['entity']->getGUID();
	$category = $vars['entity']->title;

	$sub_categories_list = '';
	$category_group = $vars['entity']->category_group;
	
	if ($category_group) {
		$category_group = elgg_echo("keetup_categories:category_group:context:{$category_group}");
		$category_group = '<span class="infoCategoryGroup">['.$category_group.']</span>';
	} else {
		$category_group = '';
	}

	//Get an array of subcategories.
	$sub_categories = $vars['entity']->getSubCategoriesNames();
	
	if($sub_categories) {
		$sub_categories_list = implode(', ', $sub_categories);
	}	

?>
	
	<div class="listItem"> 
		<div class="inner">
			<div class="title">
				<?php echo $category ?> <?php echo $category_group?>
			</div>
			<div class="txt">
				<?php echo $sub_categories_list; ?>
			</div>
		</div>
		<?php if($vars['entity']->canEdit()) { ?>
		<ul class="options">
			<li class="one">
				<?php // Edit ?>
				<a href="<?php echo $vars['url'] . "admin/administer_utilities/keetup_categories?tab=categories&op=edit&guid=$guid"?>" ><?php echo elgg_echo('edit')?></a>
			</li>
			<li class="two">
				<?php
				//Delete
				echo elgg_view("output/confirmlink", array(
					'href' => $vars['url'] . "action/keetup_categories/delete?guid=" . $guid,
					'confirm' => elgg_echo('keetup_categories:deleteconfirm:category'),
				));
				?>
			</li>
		</ul>
		<?php } ?>
		<div class="cThis">&nbsp;</div>
	</div>