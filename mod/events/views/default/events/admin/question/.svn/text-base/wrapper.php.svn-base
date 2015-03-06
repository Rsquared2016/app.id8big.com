<?php
/**
* ktform
*
* @author Bortoli German and German Bortoli
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
        $('#ktform_lbBack').css('width', $(window).width() + 'px');
            $('#ktform_lbBack').css('height', $(document).height() + 'px');

            lbOpacity('#ktform_lbBack', 70);
            lbCenterHoriz(lb);
		lbCenterVert(lb);
                    
		$('#ktform_lbBack').fadeIn('normal', function() {$(lb).fadeIn('normal');});
	}

        function lbClose() {
        $('#ktform_lb').fadeOut('normal', function() {$('#ktform_lbBack').fadeOut('normal');});
	}

        function lbClearClass() {
        $('#ktform_lb .lbContent').attr('class','lbContent');
	}

        jQuery(document).ready(function() {
		//lbShow('.lbParticular');
		lbShow('#ktform_lb');

        $('#ktform_lbBack, #ktform_lb .lbCerrar').click(function() {	
        	lbClose();
            lbClearClass();
            return false;
		});

		$(window).scroll(function() {
			if($('#ktform_lb').is(':visible')) {
				lbCenterVert($('#ktform_lb'));
			}
		});	
        });

</script>