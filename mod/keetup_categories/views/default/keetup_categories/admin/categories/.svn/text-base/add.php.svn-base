<?php
	//Get data
	
	$entity = $vars['entity'];

	//On edit.
	if($entity) {
		$category = $entity->title;
		$sub_categories_names = $entity->getSubCategoriesNames();
		
//		elgg_dump($sub_categories_names);
		
		$sub_categories_json = json_encode($sub_categories_names);
		$category_group = $entity->category_group;
//		elgg_dump($sub_categories_json);
	} else {
		$category = get_input('category');
		$sub_categories = get_input('sub_categories');
		$category_group = get_input('category_group');
	}


	echo elgg_view('input/form_header', array(
		'action' => $vars['url'] . "action/keetup_categories/add",
		'id' => 'keetup_categories_form', 
	));
?>
	<div>
		<label>
			<span class='lft'>
				<?php echo elgg_echo('keetup_categories:category:title') ?>:
			</span> <br /> 
			<span class='rgt'>
				<?php echo elgg_view('input/text', array('name' => 'category', 'value' => $category))?>
				<small><?php echo elgg_echo('keetup_categories:category:title:tip') ?></small>
			</span>	
		</label>
	</div>
		<label>
			<span class='lft'>
				<?php echo elgg_echo('keetup_categories:category:group') ?>:
			</span> <br /> 
			<span class='rgt'>
				<?php echo elgg_view('input/dropdown', array('name' => 'category_group', 'value' =>$category_group, 'options_values' => keetup_category_get_group() )) ?>
				<small><?php echo elgg_echo('keetup_categories:category:group:tip') ?></small>
			</span>	
		</label> 		
	<div class="subcategory_wrapper">
		<label>
			<span class='lft'>
				<?php echo elgg_echo('keetup_categories:category:sub_category') ?>:
			</span> <br /> 
			<span class='rgt'>
				<?php echo elgg_view('input/text', array('name' => 'sub_category_value')) ?>
				<small><?php echo elgg_echo('keetup_categories:category:sub_categories:tip') ?></small>
			</span>	
		</label> 
		<div class='cThis'></div>
		<div class="rBtn">
			<input type="button" class="submit_button add" value="<?php echo elgg_echo("add"); ?>" />
		</div>
	</div>
	<div id="keetup_categories_vf_container">
		<div id="keetup_categories_vf_preview_container">
			<h3 class="settings"><?php echo elgg_echo('keetup_categories:category:sub_categories'); ?></h3>
			<?php 
				/*Generate this in edit mode*/ 
			?>
			<ul id="keetup_categories_vf_element_container"></ul>		
		</div>
	</div>
	<div class="buttons">
		<?php 
		if($entity) {
			echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $entity->getGUID()));
		} 
		?> 
		<input type="submit" value="<?php echo elgg_echo('save') ?>" />
	</div>
	<div class='cThis'></div>
<?php
	echo elgg_view('input/form_footer');
?>

<script type="text/javascript">
<!--
	//Edit or session case
		<?php if($sub_categories_json) { ?>
		//Document load.
			$(function() {
				var sub_categories = <?php echo $sub_categories_json; ?>;
				for(ielem in sub_categories) {
					
					var element = sub_categories[ielem];
					generate_element(element, ielem);
				}
			});
				 
		<?php } ?>


	$(function() {	
	//Manage some events	
		$('.removeme').live('click', function(){
			var wrapper = $(this).parent();
			
			//Show alert message only when you are deleting a subcategory already saved.
			if($('input.id', wrapper).length) {
				if(confirm("<?php echo elgg_echo('keetup_categories:deleteconfirm:subcategory:js'); ?>")) {
					element_id = $('span.liid', $(wrapper)).html();
					$(document.createElement('input')).attr('class', 'action').attr('name','sub_categories['+element_id+'][action]').attr('type','hidden').val('delete').appendTo(wrapper);
					wrapper.addClass('hidden');
				}	
			} else {
				$(this).parent().remove();
			}
			//Clear inputs
			keetup_categories_clear_vf_inputs();
		});

		$('.canceledit').live('click', function(){
			//Clear inputs			
			keetup_categories_clear_vf_inputs();
		});

		$('.editme').live('click', function(){
			var wrapper = $(this).parent();
			var itemVal = $('.text', wrapper).html()
			
			//Remove previous selected.
			$('#keetup_categories_vf_element_container .selected').removeClass('selected');

			//Add to input the value.
			$('input[name=sub_category_value]').val(itemVal);
			
			//Add wrapper selected class.
			wrapper.addClass('selected');

			//Change value of input.
			$('.rBtn .add').val('update');

			//Add cancel button next to edit.
			if(!$('.rBtn .canceledit').length) {
				$(document.createElement('input')).attr('type','button').attr('class','submit_button canceledit').val('cancel').appendTo($('.rBtn'));
			}
		}); 
		 
		$('.subcategory_wrapper input[name=sub_category_value]').keypress(function(event){
			if(event.keyCode == 13){
				$('.rBtn .add').trigger('click');
				return false;
			}
		}); 

	//Add functionality
		$('.rBtn .add').click(function() {
	
			//Input elements
			var value = $('input[name=sub_category_value]').val();

			//Check if we are editing.
			if($('#keetup_categories_vf_element_container .selected').length) {
				var li = $('#keetup_categories_vf_element_container .selected');

				//Only change value.
				$('.text', li).html(value);
				$('input.value', li).val(value);

				//Remove class
				$(li).removeClass('selected');
				
				
			} else {
				//Call to the generate element function
				generate_element(value);
			}
			

			//Clear inputs
			keetup_categories_clear_vf_inputs();

		});

	});

		function generate_element(value, id) {
			//Count li elements
			var li_cant = parseInt($('#keetup_categories_vf_element_container li').size());
			var errors = false;
			
			if(value) { 
	
				if (!errors) {
					//Display the user selection
					var html = Array();
					html.push(value);
							
					//Create the element container.
					li = $(document.createElement('li')).html("<span class='text'>" + html.join(' | ') + '</span>');

					//Value
					$(document.createElement('input')).attr('class', 'value').attr('name','sub_categories['+li_cant+'][value]').attr('type','hidden').val(value).appendTo(li);

					//Guid
					if(id) {
						$(document.createElement('input')).attr('class', 'id').attr('name','sub_categories['+li_cant+'][id]').attr('type','hidden').val(id).appendTo(li);
					}

					//Element number.
					$(document.createElement('span')).attr('class', 'liid hidden').html(li_cant).appendTo(li);					

					//Remove btn
					$(document.createElement('input')).attr('type','button').attr('class','submit_button removeme').val('remove').appendTo(li);
					
					//Edit btn
					$(document.createElement('input')).attr('type','button').attr('class','submit_button editme').val('edit').appendTo(li);
					
					$(li).appendTo('#keetup_categories_vf_element_container');

				}
			} else { 
				keetup_categories_show_errors('You must complete value');
			}
		}

		function keetup_categories_clear_vf_inputs() {
			$('.subcategory_wrapper input[type=text]').val('');
			$('.rBtn input[type=button]').val('add');
			$('.rBtn .canceledit').remove();
			$('#keetup_categories_vf_element_container .selected').removeClass('selected');
			
		}
		
	// Function that display errors
		function keetup_categories_show_errors(msg) {
			alert(msg)
		}
//-->
</script>


