<?php
/*
 * CUSTOM JS
 */
?>
//<script type="text/javascript">
     $(document).ready(
        function() {
            $('.ktFormWrapperGroup.bADateGroup .elgg-input-checkboxes input[type="checkbox"]').change(function() {
                if ($(this).is(':checked')) {
                    $('.ktFormWrapperGroup.bEDateGroup').hide();
                    $('.ktFormWrapperGroup.bEDateGroup.inline').hide();
                    $('.ktFormWrapperGroup.bADateGroup.inline').hide();
                } else {
                    $('.ktFormWrapperGroup.bEDateGroup').show();
                    $('.ktFormWrapperGroup.bEDateGroup.inline').show();
                    $('.ktFormWrapperGroup.bADateGroup.inline').show();
                }
            });
            $('.ktFormWrapperGroup.bADateGroup .elgg-input-checkboxes input[type="checkbox"]').change();
            
            $('select#user_timezone_group, select#timezone_group').change(function(event) {
                var value = $(this).val();
                
                if ($(this).attr('id') == 'user_timezone_group') {
                    switch(value) {
                        case 'united_states':
                            var opt = $('select#united_states option').clone();
                            $('select#user_timezone option').remove();
                            $('select#user_timezone').append(opt);
                            $('select#user_timezone').val('0');
                            break;
                        case 'all_the_world':
                            var opt = $('select#all_the_world option').clone();
                            $('select#user_timezone option').remove();
                            $('select#user_timezone').append(opt);
                            $('select#user_timezone').val('0');
                            break;
                    }
                }
                else {
                    switch(value) {
                        case 'united_states':
                            var opt = $('select#united_states option').clone();
                            $('select#timezone option').remove();
                            $('select#timezone').append(opt);
                            $('select#timezone').val('0');
                            break;
                        case 'all_the_world':
                            var opt = $('select#all_the_world option').clone();
                            $('select#timezone option').remove();
                            $('select#timezone').append(opt);
                            $('select#timezone').val('0');
                            break;
                    }
                }
            });
        }
        
    );

    
    