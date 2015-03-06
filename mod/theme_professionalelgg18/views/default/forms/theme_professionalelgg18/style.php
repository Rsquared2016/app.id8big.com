<?php
/**
 * Admin section for editing theme style page 
 * 
 * Allow admin to change:
 * - Colors
 * - Font size
 * 
 */

	$style = array();

	//Copy and Paste the properties we want to modify from:
	//theme_professionalelgg18/views/default/css/theme_professionalelgg/setup.php
	/* basic / general configuration */
    $style['css']['base-font-size'] = "12px";                    // Font size
    $style['css']['base-color'] = "#404548";                     // Font color
    $style['css']['base-line-height'] = "16px";                  // Line height
    $style['css']['base-link-color'] = "#53A8F4";                // Link color
    $style['css']['base-border-color'] = "#E7ECEF";             	// Border color
    $style['css']['base-light-text-color'] = "#7b858a";          // Light text color (date, timestamp, etc.)
    $style['css']['body-background'] = "#dfe6ea"; 				// Body background (delete/add an image if necessary)
    $style['css']['cont-width'] = '990px';						// Main containers width
    
    /* header */
    $style['css']['header-height'] = '59px';						// Header height
    $style['css']['header-background-color'] = '#404548';		// Header background color
    
    /* footer */
    $style['css']['footer-height'] = 'auto';						// Footer height
    $style['css']['footer-background-color'] = '#dfe6ea';		// Footer background color

	
	//Get custom style or default
	$theme_default_style = elgg_get_plugin_setting('theme_default_style', THEME_NAME);
	$theme_custom_style = elgg_get_plugin_setting('theme_custom_style', THEME_NAME);
	
	if($theme_default_style) {
		$theme_default_style = unserialize($theme_default_style);
	}

	if($theme_custom_style) {
		$theme_custom_style = unserialize($theme_custom_style);
	}

	
	//Override style property.
	foreach ($style['css'] as $sKey => $sVal) {
		$new_val = '';
		if(is_array($theme_custom_style) && $theme_custom_style[$sKey]) {
			//Check custom
			$new_val = $theme_custom_style[$sKey];
		} else if (is_array($theme_default_style) && $theme_default_style[$sKey]) {
			//If not set default.
			$new_val = $theme_default_style[$sKey];
		}
		
		if($new_val) {
			$style['css'][$sKey] = $new_val;
		}
	}
	

?>
<?php
foreach($style['css'] as $sKey => $sVal) {
	
?>
<div class="mtm">
	<label><?php echo elgg_echo($sKey); ?></label>
	<?php
	$input_type = "input/text";
	
	//Body html
	$params = array(
		'name' => "css[$sKey]",
		'value' => $sVal,
		//'class' => 'elgg-input-plaintext-theme-settings',
	);
	
	//Detect if the field is a color ?
	if(strpos($sVal, '#') !== FALSE) {
		$input_type = "input/hidden";
		$params['data-rel'] = 'color-value';
		/*if($params['class']) {
			$params['class'] .= ' colorPicker';
		} else {
			$params['class'] = 'colorPicker';
		}*/
		
		echo '<div class="colorPicker">';
		echo elgg_view($input_type, $params);
		echo '</div>';
	} else {
		echo elgg_view($input_type, $params);
	}
	
	
	?>
</div>

<?php
}
?>
<div class="elgg-foot">
<?php 
//Submit
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('save')));
echo elgg_view('input/submit', array('name' => 'restore', 'value' => elgg_echo('Restore'), 'title' => 'Restore Default Css Style'));
?>
</div>

<script type="text/javascript">
//Opcion 1.	
/*$('.colorPicker').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val('#'+hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});*/

//Opcion 2. A implementar.
$('.colorPicker').each(function() {
	var ele = $(this);
	var inputColor = $('input[type=hidden]', ele).val()
	$(ele).css('backgroundColor', inputColor);
	$(ele).ColorPicker({
		color: inputColor,
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$(ele).css('backgroundColor', '#' + hex);
			$('input[data-rel="color-value"]', $(ele)).val('#' + hex);
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$('input[data-rel="color-value"]', $(ele)).val('#' + hex);
			$(el).ColorPickerHide();
		}
	});
});
</script>	
