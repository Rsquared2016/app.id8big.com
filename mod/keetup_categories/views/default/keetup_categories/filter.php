<?php
	
//Filter data
	$category_id = get_input('category_id', '');
	$subcategory_id = get_input('subcategory_id', '');

?>
<div class="ktCategoriesFilterWrapper">
   <?php
		echo elgg_view('input/form_header', array(
			'action' => current_page_url(),
			'disable_security' => TRUE,
			'method' => 'GET',
		));
	?>

	<div class="filterItem">
		<?php 
			echo elgg_view('input/keetup_categories', array(
				'size' => 1,
				'category_value' => $category_id,
				'subcategory_value' => $subcategory_id,
				'enable_category_default_item' => true,
				'enable_subcategory_default_item' => true,
				//'category_group' => 'contenido',
				'show_subcategories' => true				
		   ));
		 ?>
	</div>
	<div class="rBtn">
		<input type="submit" value="<?php echo elgg_echo('keetup_categories:filter:btn'); ?>" class='filter_submit' />
	</div>
	<div class="cThis">&nbsp;</div>
	<?php
		echo elgg_view('input/form_footer');
	?>
</div>