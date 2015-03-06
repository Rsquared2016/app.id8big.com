<?php
/**
* register_exteps
*
* @author Bortoli German
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/
?>	
<script type="text/javascript">
        // opacity
        function lbOpacity(element, value) {
            var value_noie = value / 100;
            $(element).css('filter', 'alpha(opacity=' + value + ')');
            $(element).css('-moz-opacity', value_noie);
            $(element).css('-khtml-opacity', value_noie);
            $(element).css('opacity',value_noie);
        }   
        // center horizontally
        function lbCenterHoriz(lo_que) {
            var x = parseFloat($(window).width()) / 2 - parseFloat($(lo_que).width()) / 2;
            var y = $(window).scrollTop() + $(window).height() / 2 - parseFloat($(lo_que).height()) / 2;
            x = x + 'px';
            y = y + 'px';
            $(lo_que).css({'left': x, 'top': y});
        }
        // center vertically
        function lbCenterVert(lo_que) {
        lo_que_height = $(lo_que).height();
            window_height = $(window).height();
            document_height = $(document).height();
            var y = $(window).scrollTop(); //Default value
            if (window_height > lo_que_height) {
            y = $(window).scrollTop() + parseInt(window_height / 2) - parseInt(lo_que_height / 2);
            } else {
                //this code fix the problem of infinity scroll
            if (y > document_height-lo_que_height) {
				y = document_height-lo_que_height;
	        }
            }            
            $(lo_que).css({'top': y});
        }
	
        // lightbox
	function lbShow(lb) {
        $('#register_exteps_lbBack').css('width', $(window).width() + 'px');
            $('#register_exteps_lbBack').css('height', $(document).height() + 'px');

            lbOpacity('#register_exteps_lbBack', 70);
            lbCenterHoriz(lb);
		lbCenterVert(lb);
                    
		$('#register_exteps_lbBack').fadeIn('normal', function() {$(lb).fadeIn('normal');});
	}

        function lbClose() {
        $('#register_exteps_lb').fadeOut('normal', function() {$('#register_exteps_lbBack').fadeOut('normal');});
	}

        function lbClearClass() {
        $('#register_exteps_lb .lbContent').attr('class','lbContent');
	}

        jQuery(document).ready(function() {
		//lbShow('.lbParticular');
		lbShow('#register_exteps_lb');

        $('#register_exteps_lbBack, #register_exteps_lb .lbCerrar').click(function() {	
        	lbClose();
            lbClearClass();
            return false;
		});

		$(window).scroll(function() {
			if($('#register_exteps_lb').is(':visible')) {
				lbCenterVert($('#register_exteps_lb'));
			}
		});	
        });

</script>