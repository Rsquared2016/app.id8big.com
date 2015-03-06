<?php

$values = help_texts_sections_get_data();

if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-dropdown {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-dropdown";
}

$defaults = array(
	'disabled' => false,
	'value' => '',
	'options_values' => array(),
	'options' => array(),
);

$vars = array_merge($defaults, $vars);

$options_values = $values;
unset($vars['options_values']);

$value = $vars['value'];
unset($vars['value']);

?>
<select <?php echo elgg_format_attributes($vars); ?>>
<?php

if ($options_values) {
	foreach ($options_values as $opt_group => $group) {
        if (is_array($group)) {
            echo "<optgroup label='$opt_group'>";
            foreach ($group as $opt_value => $option) {

                $option_attrs = elgg_format_attributes(array(
                    'value' => $opt_value,
                    'selected' => (string)$opt_value == (string)$value,
                ));

                echo "<option $option_attrs>$option</option>";
            }
            echo "</optgroup>"; 
        } else {
            $option_attrs = elgg_format_attributes(array(
                    'value' => $opt_group,
                    'selected' => (string)$opt_group == (string)$group,
                ));

            echo "<option $option_attrs>$group</option>";
        }
	}
}
?>
</select>
<script type="text/javascript">
    $(document).ready(function(){
       $("select[name=section]").select2({
            minimumResultsForSearch: -1
        });
    });
 

</script>