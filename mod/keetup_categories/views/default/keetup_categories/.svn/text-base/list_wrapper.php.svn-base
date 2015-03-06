<?php
/*
 * Wrapper container of list entities
 * */
$keetup_categories = keetup_category_get_group();
$keetup_categories = array('0' => elgg_echo('keetup_categories:admin:filter_by:all_categories'))+keetup_category_get_group();

$filter_by = get_input('filter_by');
?>
<div class="ktCategoriesWrapper">
	<div class="listElementsWrapper">
	
		<div class="filterKeetupCategories">
			<div class="ktFormWrapper">
				<label for="">Filter By</label>
				<div class="frmField">
					<?php echo elgg_view('input/dropdown', array('name' => 'category_group', 'id' => 'filter_keetup_category','value' => $filter_by ,'options_values' => $keetup_categories, 'class' => 'filterKtCategoryPulldown')) ?>
				</div>
				<div class="clearfloat">&nbsp;</div>
			</div>
			<div class="clearfloat">&nbsp;</div>
		</div>
		
		<?php echo $vars['elements']; ?>
	</div>
</div>

<?php 
	echo elgg_view('keetup_categories/admin/js');
?>