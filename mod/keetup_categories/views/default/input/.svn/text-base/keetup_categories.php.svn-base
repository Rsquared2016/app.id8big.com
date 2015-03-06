<?php
	//KTODO: Organize the input keetup categories. Is a mess.
	$show_multiple_categories_link = $vars['show_multiple_categories_link'];
	$allow_multiple_categories = $vars['allow_multiple_categories'];
	$allow_delete = $vars['allow_delete'];
	$show_subcategories = true;
	$enable_subcategory_default_item = true;
	$show_category_only_info = false;
	
	$context = elgg_get_context();	
	
	//Other subcategory.
	 $allowed_subcat = $vars['config']->keetup_categories->allowed_other_subcategories;
	 $allowed_subcat_context = $vars['config']->keetup_categories->other_subcategories_context;

	 $other_subcat_enabled =  FALSE;
	 if($allowed_subcat && in_array($context, $allowed_subcat_context)) {
		 $other_subcat_enabled =  TRUE;
	 }
	 
	 //Check if comes from vars
	 if(array_key_exists('other_subcat_enabled', $vars)){
		 $other_subcat_enabled = $vars['other_subcat_enabled'];
	 }

	$category_group = elgg_get_context();
	if (isset($vars['category_group']) && is_string($vars['category_group'])) {
		$category_group = $vars['category_group'];
	}


	if(array_key_exists('show_subcategories', $vars)) {
		$show_subcategories = $vars['show_subcategories'];
	}

	if(array_key_exists('enable_subcategory_default_item', $vars)) {
		$enable_subcategory_default_item = $vars['enable_subcategory_default_item'];
	}

	if(array_key_exists('show_category_only_info', $vars)) {
		$show_category_only_info = $vars['show_category_only_info'];
	}

	$selectmultiarray = "";
	if($allow_multiple_categories) {
		$selectmultiarray = "[]";
	}

	$size = $vars['size'];
	if(!$size)
		$size = 10;

	$classname = $vars['classname'];

	if (!$classname) {
		if ($size == 1) {
			$classname .= ' size-1';
		}
	}

	$category_value = $vars['category_value'];
	//Try to get from $vars['entity']
	if(!$category_value && $vars['entity']) {
		$category_value = $vars['entity']->kt_category;
	}

	if (!$category_value && !$vars['entity']) {
		$category_value = get_input('category_id');
	}
	
	if (!$category_value && $vars['value']) {
		$category_value = $vars['value'];
	}

	$subcategory_value = $vars['subcategory_value'];
	//Try to get from $vars['entity']
	if(!$subcategory_value && $vars['entity']) {
		$subcategory_value = $vars['entity']->kt_subcategory;
	}
	
	if(!$subcategory_value) {
		$subcategory_value = get_input('subcategory_id');
	}

	if (!$subcategory_value && isset($_SESSION['subcategory_id'])) {
		$subcategory_value = $_SESSION['subcategory_id'];
	}
	
	$time = time() . rand(9999, 99999);

	$id_cont = 'contcat_' . $time;
	$id_cat = 'cat_' . $time;
	$id_sub = 'subcat_' . $time;


	$categories = keetup_categories_get_categories($category_group);

	if($show_subcategories) {
		$sub_categories = keetup_categories_get_subcategories(false,$category_group);
	}
	$cat_select_class = '';

	$content = '';

	if($categories){
		if($size == 1) {
			//Add customized inputs support, this should not be here. but...
			$vars['input_name_id'] = 'category_id';
			$pulldown_head = elgg_view('input/custom/pulldown_head', $vars);
			if($pulldown_head) {
				$content .= $pulldown_head;
				$cat_select_class .= ' selectStyle';
			}
		}
		if ($show_category_only_info) {
			$cat_select_class .= ' hidden';
		}
		$content .= "<select class=\"$cat_select_class\" name=\"category_id{$selectmultiarray}\" id=\"{$id_cat}\" size=\"$size\">";

		if ($size != 1) {
			$category_symbol = "»";
		} else {
			$category_symbol = "";
			//$categories = array_merge(array('0' => elgg_echo('keetup_categories:selectcategory')), $categories);
			
			if(array_key_exists('kt_categories_category_default_text', $vars)) {
				$category= $vars['kt_categories_category_default_text'];
			} else {
				$category= elgg_echo('keetup_categories:selectcategory');
			}
			
			$content .= "<option value=\"0\" {$selected}>" . "$category  $category_symbol" . "</option>";
		}

		foreach($categories as $cat_id => $category){
			$selected = ($category_value == $cat_id) ? "selected=\"selected\""  : '';
			$content .= "<option value=\"$cat_id\" {$selected}>" . "$category  $category_symbol" . "</option>";
		}
		$content .= "</select>";
		if($size == 1) {
			$content .= elgg_view('input/custom/pulldown_foot', $vars);
		}
	}

	$sub_cat_select_class = '';
	if($sub_categories){

		$display = '';
		/*if ($size == 1 && !$category_value) {
			$display = "style=\"display:none\"";
		}*/
		$subcatcontent = '';
		if($size == 1) {
			$vars['input_name_id'] = 'subcategory_id';
			$vars['class'] .= ' nmRig';
			//Add customized inputs support, this should not be here. but...
			$pulldown_head = elgg_view('input/custom/pulldown_head', $vars);
			if($pulldown_head) {
				$subcatcontent .= $pulldown_head;
				$sub_cat_select_class .= ' selectStyle';
			}
		}
		$subcatcontent .= "<select class=\"$sub_cat_select_class\" name=\"subcategory_id{$selectmultiarray}\" id=\"{$id_sub}\" size=\"$size\" $display>";

		foreach($sub_categories as $category_id => $subcategories){

			if($enable_subcategory_default_item) {
				if(array_key_exists('kt_categories_subcategory_default_text', $vars)) {
					$subcategory_def_text = htmlentities($vars['kt_categories_subcategory_default_text'], ENT_QUOTES, 'UTF-8');
				} else {
					$subcategory_def_text = htmlentities(elgg_echo('keetup_categories:selectsubcategory'), ENT_QUOTES, 'UTF-8');
				}
				
				$subcatcontent .= "<option class=\"sub_{$category_id}\" value=\"0\">" . $subcategory_def_text . "</option>";
			}

			foreach($subcategories as $subcategory_id => $subcategory){

				$selected = ($subcategory_value == $subcategory_id) ? "selected=\"selected\""  : '';
				$subcatcontent .= "<option class=\"sub_{$category_id}\" {$selected} value=\"{$subcategory_id}\">" . htmlentities($subcategory, ENT_QUOTES, 'UTF-8') . "</option>";


			}
		}

		$subcatcontent .= "</select>";
		if($size == 1) {
			$subcatcontent .= elgg_view('input/custom/pulldown_foot', $vars);
		}

		$content .= $subcatcontent;

	}

	$content .= "<div class=\"cont-action-categories\">";

	if ($size != 1) {
		$content .= "<div class='categories-selected'></div>";
	}
	if($allow_delete) {
		$content .= "<div class='categories-delete'><span><a href=\"javascript:void(0)\" title=\"" . elgg_echo('delete') . "\">" . elgg_echo('delete') . "</a></span></div>";
	}

	$content .= "</div>";

	if($categories) {

		echo "<div id='{$id_cont}' class='cont_categories $classname'>" . $content . "</div>" ;

		if($show_multiple_categories_link) {
			echo "<div class='multi-categories-link'><a href=\"javascript:void(0)\">" . elgg_echo('keetup_categories:add:multi') . "</a></div><div class=\"clearfloat\"></div>";
		}
	} else {
		echo '<p>' . elgg_echo('keetup_categories:category:no:categories') . '</p>';
	}

?>

<script type="text/javascript">
	var keetup_categories = keetup_categories || {};
	
	$(document).ready(function(){

		var selParent = '<?php echo $id_cat; ?>';
		var selChild = '<?php echo $id_sub; ?>';
		var selContent = '<?php echo $id_cont; ?>';
		var commentText = '<?php echo elgg_echo('keetup_categories:categoryselected'); ?>';
		var allowDelete = <?php echo ($allow_delete ? 1 : 0); ?>;
		var otherSubcatEnabled = <?php echo ($other_subcat_enabled ? 1 : 0); ?>;
		
		generateSubselects(selParent, selChild, selContent, commentText, otherSubcatEnabled);

		$('.categories-delete a').click(function(){
			$(this).parents('div.cont_categories').remove();
		})

	});

</script>
