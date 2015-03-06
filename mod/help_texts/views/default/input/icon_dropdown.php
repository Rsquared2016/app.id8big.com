<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$options_values = help_texts_icons_get_data();

$new_Array = array();
$new_Array[''] = 'Select an icon';
foreach ($options_values as $key => $value) {
    $new_Array[$key] = $value;
}

$vars['options_values'] = $new_Array;
//$vars['placeholder'] = 'lalalas';

$value = $vars['value'];

echo elgg_view('input/dropdown', $vars);

?>

<script type="text/javascript">
    $(document).ready(function(){
        
        function format(state) {
            if (!state.id) return state.text;
            return "<div class='fs1 iconb' data-icon='&#xe" + state.id + ";'>&nbsp;&nbsp;&nbsp;" + state.text + "</div>";
        }

        function format2(state) {
            return format(state);
        }

        $("select[name=descriptive_icon]").select2({
            formatResult: format,
            formatSelection: format2,
            escapeMarkup: function(m) { return m;}
//            value: ["<?php  echo $value; ?>"]
        });
    });
 

</script>