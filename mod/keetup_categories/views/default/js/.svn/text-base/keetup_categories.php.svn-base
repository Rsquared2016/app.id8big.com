<?php
	/*
	 * Usefull JS Functions.
	 * */

 $context = elgg_get_context();
 //Other subcategory.
 $allowed_subcat = $vars['config']->keetup_categories->allowed_other_subcategories;
 $allowed_subcat_context = $vars['config']->keetup_categories->other_subcategories_context;

 $other_subcat_enabled =  FALSE;
 if($allowed_subcat && in_array($context, $allowed_subcat_context)) {
	 $other_subcat_enabled =  TRUE;
 }
 
?>
<script type="text/javascript">
	var keetup_categories = keetup_categories || {};

	keetup_categories.other_subcat_enabled = <?php echo (($other_subcat_enabled)? 1: 0); ?>;

	$('.multi-categories-link a').click(function() {
		$.ajax({
			type: "GET",
			url: "<?php echo $vars['url']?>mod/keetup_categories/keetup_categories.php",
			dataType: "html", 
			data: ({callback:true, allow_multiple_categories:true, allow_delete:true}),
			success: function(data) {
				var elements = $('#layout_canvas .cont_categories').size();
				$($('#layout_canvas .cont_categories').get(elements-1)).after(data);
			}
		})
	})

	function generateSubselects(selParent, selChild, selContent, commentText, otherSubCatEnabled) {
		var other_option = "<option class=​sub_other value=other>​"+"<?php echo elgg_echo('keetup_categories:subcategories:other:text')?>"+"</option>​";			
		
		$("body").append('<select style="display:none;" id="' + selParent + selChild + '"></select>');
		$('#' + selParent + selChild).html($("#" + selChild + " option"));

		var selParentValue = $('#' + selParent).attr('value');
		$('#'+selChild).html($("#" + selParent + selChild + " .sub_" + selParentValue).clone());

		putTextCategory(selParent, selChild, selContent, commentText);

		//$('#'+selParent).trigger("change");
		//General.
		var otherSCEnabled = keetup_categories.other_subcat_enabled;
		
		if(typeof (otherSubCatEnabled) != 'undefined') {
			otherSCEnabled = otherSubCatEnabled;
		}
		
		//Add other.
		if(otherSCEnabled && $('#'+selChild).html() != '') {
			$('#'+selChild).append(other_option);
		}

		$('#'+selParent).change(function(){
			var selParentValue = $('#'+selParent).val();
			$('#'+selChild).html($("#"+selParent+selChild+" .sub_"+selParentValue).clone());
			
			//Add other.
			if(otherSCEnabled) {
				$('#'+selChild).append(other_option);
			}

			$('#'+selChild).trigger("change");
			$('#'+selChild).focus();
		});
		

		$('#' + selContent + ' select').change(function(){
			putTextCategory(selParent, selChild, selContent, commentText);	
		});
		
		$('#'+selChild).change(function(){
			var val = $(this).val();
			
			if(val == 'other') {
				var inputOtherField = '<span class="ktSubCategoryOtherInput"><label>Other</label>' + '<input type="text" maxlength="30" name="'+'<?php echo KT_CATEGORIES_SUBCAT_OTHER_INPUT; ?>'+'" value="" class="txtFrm txtFrm33">' + '</span>';
				$('#'+selChild).after(inputOtherField);
				$('.ktSubCategoryOtherInput input').focus();
			} else {
				$('.ktSubCategoryOtherInput').remove();
			}
			
		});
	}
	

	function putTextCategory(selParent, selChild, selContent, commentText){

		sCat = ($.trim(substr($('#'+selParent+ ' option:selected').text(),0,-3)));
		sSubCat = $.trim($('#'+selChild+ ' option:selected').text());
		
		sCatSelected = '';
		sSubCatSelected = '';

		if(sCat != null)
			sCatSelected += "<strong>" + sCat  + "</strong>";

		if(sSubCat != null  && sSubCat != '')
			sSubCatSelected += ' » ' + "<strong>" + sSubCat + "</strong>";

		if(sCatSelected != '')
			$('#' + selContent + ' .categories-selected').html(commentText + sCatSelected + sSubCatSelected).show();

	}
	
	//Based in JS PHP
	function substr( f_string, f_start, f_length ) {
	    // Returns part of a string  
	    // 
	    // version: 810.1317
	    // discuss at: http://phpjs.org/functions/substr
	    // +     original by: Martijn Wieringa
	    // +     bugfixed by: T.Wild
	    // +      tweaked by: Onno Marsman
	    // *       example 1: substr('abcdef', 0, -1);
	    // *       returns 1: 'abcde'
	    // *       example 2: substr(2, 0, -6);
	    // *       returns 2: ''
	    f_string += '';

	    if(f_start < 0) {
	        f_start += f_string.length;
	    }

	    if(f_length == undefined) {
	        f_length = f_string.length;
	    } else if(f_length < 0){
	        f_length += f_string.length;
	    } else {
	        f_length += f_start;
	    }

	    if(f_length < f_start) {
	        f_length = f_start;
	    }

	    return f_string.substring(f_start, f_length);
	}
		

</script>