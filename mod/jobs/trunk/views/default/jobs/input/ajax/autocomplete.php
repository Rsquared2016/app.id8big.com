<?php

/**
 * Normal Input
 * $autocomplete = elgg_view('input/ajax/autocomplete', array(
 *   'internalname' => 'autocompletado', 
 *   'search_options' => array('entity_type' => 'object', 'entity_subtype' => 'blog')),
 *		'is_multiple' => TRUE,
 * ); 
 * 
 *  KtForm Input
  			'search_blogs' =>
				array(
					'type' => 'ajax/autocomplete',
					'info_text' => TRUE,
					'label' => TRUE,				
					'container_group' => 'c',
					 'options' => array(
 						'is_multiple' => TRUE, //If allow multiple fields
						  'search_options' => array('entity_type' => 'object', 'entity_subtype' => 'blog'),
					 ),
				),
 */

$internalname = 'default_internalname';
if (isset($vars['internalname'])) {
	$internalname = $vars['internalname'];
}

$internalname_hidden = 'default_internalname_hidden';
if (!isset($vars['internalname_hidden'])) {
	$internalname_hidden = elgg_get_friendly_title($internalname).'_autocomplete';
}


if (isset($vars['is_multiple']) && $vars['is_multiple'] == TRUE) {
	$internalname = $internalname.'[]';
	$internalname_hidden = $internalname_hidden.'[]';
}

$vars['internalname_hidden'] = $internalname;
$vars['internalname'] = $internalname_hidden;

$internalid = elgg_get_friendly_title($internalname).rand();
$vars['internalid'] = $internalid;

$internal_id_hidden = elgg_get_friendly_title($internalname_hidden).rand();

//If comes vars value, and is an integer, get title of entity.
$value = '';
$value_hidden = '';

if($vars['value']) {
	$tmp_value_hidden = $vars['value'];
	$tmp_value = '';
	
	
	$value_entity = get_entity($tmp_value_hidden);
	if ($value_entity) {
		switch($value_entity->getType()) {
			case 'user':
				case 'group':
				$tmp_value = $value_entity->name;
			break;
			default:
				$tmp_value = $value_entity->title;
			break;
		}
	}
	
	if ($tmp_value && $tmp_value_hidden) {
		$value_hidden = $tmp_value_hidden;
		$vars['value'] = $tmp_value;
	}
	
}


if(!$vars['class']) {
	$vars['class'] = '';
}
$vars['class'] .= ' autocomplete';

//Add placeholder text based on ingredient type.
if(!array_key_exists('placeholder', $vars)) {
	$vars['placeholder'] = elgg_echo('geolokation:input:location:autocomplete:placeholder:default');
}

?>
<div class='genericAutocompleteWrapper'>
	<input type="hidden" class="locIdHdn" id="<?php echo $internal_id_hidden; ?>" name="<?php echo $vars['internalname_hidden']; ?>" value='<?php echo $value_hidden; ?>' />
	<?php
	//If the internalname if different than location, add a hidden input of location.
	/*if($vars['internalname'] != 'location') {
		echo elgg_view('input/hidden', array_merge($vars, array('internalname' => 'location', 'js' => 'css="locLblHdn"')));
	}*/
	
	//Input autocomplete.
	echo elgg_view('input/text', $vars)
	?>
</div>
<?php

/**
 * offset
 * limit
 * entity_type
 * entity_subtype
 * 
 * search_type => all || entities || tags || trigger plugin hook 
 * 
 * term
 */
if (!isset($vars['search_options']) && !is_array($vars['search_options'])) {
	$vars['search_options'] = array();
}

$ac_url = $vars['url'] . 'search_endpoint/';
$ac_url = elgg_http_add_url_query_elements($ac_url, $vars['search_options']);

//elgg_http_add_url_query_elements()

//KTODO: Add validation:
//Escribis algo, seleccionas el autocomplete, luego, emepezas a borrar lo que escribiste. La mitad
//de la palabra y queda con el resultado del autocomplete.


if(array_key_exists('noscript', $vars) && $vars['noscript']) {
    return TRUE;
}

?>
<script type='text/javascript'>
	$(function() {
		var <?php echo $internalid ?>_last_cache = '<?php echo $value ?>';
		var cache = {}, lastXhr;

			$('#<?php echo $internalid ?>').livequery(function() {
			$(this).autocomplete({
				minLength: 2,
				matchContains: true,
				url: '<?php echo $ac_url ?>',
				source: function( request, response) {
					var term = request.term;
					var url = this.options.url;
					
					if ( term in cache ) {
						response( cache[ term ] );
						return;
					}

					lastXhr = $.getJSON( url, request, function( data, status, xhr ) {
						cache[ term ] = data;
						if ( xhr === lastXhr ) {
							response( data );
						}
					});
				},
				select: function( event, ui ) {					
					var parent = $(event.target).parent('.genericAutocompleteWrapper');
					var id = ui.item.id;
					var label = ui.item.label;
					
					<?php echo $internalid ?>_last_cache = label;
					$('input[type=hidden].locIdHdn', parent).val(id);
					
					//$('input[type=hidden].locLblHdn', parent).val(label);
				},
				focus: function( event, ui ) {
					return false;
				},
				delay: 1000
			});
		});	
			

		//Validation: If we select an autocomplete option, and try to delete it, remove the asociated searched element.
		$('#<?php echo $internalid ?>').keyup(function() {
			var parent = $(this).parent('.genericAutocompleteWrapper');
			
			var recent_val = $(this).val();
			recent_val = recent_val.replace(/^\s*|\s*$/g,"");
			
			if(<?php echo $internalid ?>_last_cache != '') {
				if(recent_val != <?php echo $internalid ?>_last_cache) {
					$('#<?php echo $internal_id_hidden ?>').val('');
				}
			}
		});
		
		
		
		$('#<?php echo $internalid ?>').bind( "autocompletechange", function(event, ui) {
			
			if ($.isEmptyObject(ui.item)) {
				$('#<?php echo $internal_id_hidden ?>').val('');
			}
			
		});
			
	});	 //End of Doc Ready.	

</script>