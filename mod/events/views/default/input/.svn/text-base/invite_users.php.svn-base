<?php

/*
 * Invite Users
 */

$entity = elgg_extract('entity', $vars, null);
if (!elgg_instanceof($entity, '', '', 'Events')) {
	return false;
}

// URLs
$ac_url = $vars['url'] . 'events/search_users/' . $entity->getGUID();

$sent_to = array();
if (array_key_exists('value', $vars) && is_array($vars['value'])) {
	$sent_to = $vars['value'];
}
elseif (isset($_SESSION['sent_to']) && is_array($_SESSION['sent_to'])) {
	$sent_to = $_SESSION['sent_to'];
}

// Internalnames
$default_internalname = 'send_to';
$default_internalname_hidden = 'send_to_guid';

if(!array_key_exists('name', $vars)) {
	$vars['name'] = $default_internalname;
}

if(!array_key_exists('name_hidden', $vars)) {
	$vars['name_hidden'] = $default_internalname_hidden;
}

if(!$vars['class']) {
	$vars['class'] = '';
}

$vars['class'] .= ' autocomplete sentToField';

?>
<?php
	// KTODO: input user autocomplete
?>
<div class='sentToSearchWrapper'>
	<div class="destinationUsersWrapper">
		<input type="hidden" class="sentToIdHdn" name="<?php echo $vars['name_hidden']; ?>" value='' />
		<?php
			//If the internalname if different than location, add a hidden input of location.
			if($vars['name'] != $default_internalname) {
				echo elgg_view('input/hidden', array_merge($vars, array('name' => $default_internalname, 'js' => 'css="sentToLblHdn"')));
			}
			// Input autocomplete.
			echo elgg_view('input/text', $vars);
		?>
	</div>
</div>
<script type='text/javascript'>
	// Funcion para renderizar el item de usuario a quien enviar
	function events_add_user_destination(id, name, type, icon) {
		if (id && name && type) {
			// add the user
			var item = '<li>';
				item += '	<input type="hidden" name="' + type + '_destination[]" value="' + id + '" rel="' + type + '_destination_' + id + '" />';
				item += '	<input type="hidden" value="' + id + '" name="members[]">';
				item += '	<div class="elgg-image-block">';
				item += '		<div class="elgg-image">';
				item += '			<div class="elgg-avatar elgg-avatar-tiny">';
				item += '				<a class="" href="">';
				item += '					<img src="' + icon + '" alt="" />';
				item += '				</a>';
				item += '			</div>';
				item += '		</div>';
				item += '		<div class="elgg-image-alt">';
				item += '			<a class="elgg-userpicker-remove" href="#">X</a>';
				item += '		</div>';
				item += '		<div class="elgg-body">' + name + '</div>';
				item += '	</div>';
				item += '</li>';
			
			$(".elgg-user-picker-list").append(item);
			
		}
	}
	// Si vino algo en value, agrego los usuarios y collecciones
	<?php
		if (!empty($sent_to) && is_array($sent_to)) {
			// Agrego los usuarios
			$users = $sent_to;
			foreach($users as $user_guid) {
				$user = get_user($user_guid);
				if ($user) {
		?>				
					// Agrego el usuario
					events_add_user_destination('<?php echo $user_guid ?>', '<?php echo $user->name; ?>', 'user', '<?php echo $user->getIcon('tiny'); ?>');
	<?php
				}
			}
		}
	?>
	
	jQuery(document).ready(function($) {		
		var geo_last_cache = '<?php //echo $value ?>';
		var cache = {}, lastXhr;
		$('.sentToSearchWrapper .autocomplete').autocomplete({
			minLength: 2,
			matchContains: true,
			delay: 500,
			source: function( request, response) {
				var term = request.term;
				var url = "<?php echo $ac_url; ?>";
				
				if ( term in cache ) {
					response( cache[ term ] );
					return;
				}
				
				$('.sentToSearchWrapper .ui-autocomplete-input').addClass('ui-autocomplete-loading');
				lastXhr = $.getJSON( url, request, function( data, status, xhr ) {
					cache[ term ] = data;
					if ( xhr === lastXhr ) {
						response( data );
					}
					
					if(status=='success'){
						$('.sentToSearchWrapper .ui-autocomplete-input').removeClass('ui-autocomplete-loading');
					}
				});
			},
			select: function( event, ui ) {
				var id = ui.item.id,
					name = ui.item.name,
					type = ui.item.type,
					ico = ui.item.icon;
				
				// KTODO: View user selected
				// Chequeo si ya no se agrego el usaurio, si no se agrego, lo agrego
				var $user_added = $('input[rel='+type+'_destination_'+id+']');
				if ($user_added.length == 0) {
					events_add_user_destination(id, name, type, ico);
				}
				
				$('.sentToSearchWrapper').click();
				
				// Empty value
				$(this).val('');

				return false;
			},
			focus: function( event, ui ) {
				return false;
			}
		})
		.data( "autocomplete" )._renderItem = function( ul, item ) {
			if(!$(ul).hasClass('ui-autocomplete-events')) {
				$(ul).addClass('ui-autocomplete-events').attr('id', 'ul-events');
			}
			var element = $( "<li></li>" ).addClass(item.type);
			
  			//Do we need the label and value ?
  			// Info begin.
			var link = null;
			if(item.type != 'li-events-header') {
				link = $('<a></a>');
			}
			else {
				link = $('<div></div>');
			}
			var info = '';

			if((item.type == 'li-events-header')) {
				$(link).addClass('ignore');
			}

			// define if this item is a header or footer type item
			var hf_item = false;
			if ((item.type == 'li-events-header') || (item.type == 'li-events-footer')) {
				hf_item = true;
			}

			// we will not use an image for the list's header or footer
			if(!hf_item) {
				
				// start .elgg-image-block
				info += '<div class="elgg-image-block clearfix elgg-autocomplete-item">';
				
				// Add icon / image
				info += '<div class="elgg-image">';
				info += '<div class="elgg-avatar elgg-avatar-tiny' +' elgg-autocomplete-item">';

				if(item.icon != 'undefined' && item.icon) {
					info += "<img src='" + item.icon + "' alt='' />";
				}

				info += '</div>';	// close elgg-image
				info += '</div>';	// close elgg-avatar

			}

			// we will not use a body div for the list's header or footer
			if(!hf_item) {
				// Add main info.
				info += '<div class="elgg-body">';
			}

			// The title
			if(hf_item) {
				// one kind for header / footer...
				if (item.type == 'li-events-header') {
					info += "<h4>" + item.text + "</h4>";
				}
				else if (item.type == 'li-events-footer') {
					info += item.text;
				}
			}
			else {
				// ...and another for common items
				info += "<h3>" + item.name + "</h3>";
			}
			
			// close elgg-body
			if(!hf_item) {
				info += '</div>';
			}

			// Info end
			$(link).html(info);

			// Return element.
			element.data( "item.autocomplete", item )
			.append(link)
			.appendTo( ul );

			return element;
			
		};

		// Validation: If we select an autocomplete option, and try to delete it, remove the asociated searched element.
		$('.sentToSearchWrapper .autocomplete').keyup(function() {
			var parent = $(this).parent('.sentToSearchWrapper');
			
			var recent_val = $(this).val();
			recent_val = recent_val.replace(/^\s*|\s*$/g,"");
			
			if(geo_last_cache != '') {
				if(recent_val != geo_last_cache) {
					$('input[type=hidden].sentToIdHdn', parent).val('');
				}
			}
		});
		
		// Delete user from list
		$('.elgg-userpicker-remove').live('click', function(event){
			event.preventDefault();
			$(this).parents('li').remove();
		});
		
		$('.sentToSearchWrapper').click(function() {
			$('.sentToField').focus();
			$(this).addClass('sentToSearchFocus');
		});
		
		$('.sentToField').blur(function() {
			$('.sentToSearchWrapper').removeClass('sentToSearchFocus');
		});
		
	});
	//End of Doc Ready.
</script>