<?php
	/* put common site javascript here */
?>
function hideCommonMn() {
	$('.elgg-menu-site .elgg-more ul.elgg-menu').hide();
    $('.subMnOn').removeClass('elgg-state-selected');
}
$(document).ready(
    function() {
        /* common top menu */
        $('.elgg-more a:first').bind('click touchend',
            function() {
                /* hide visible menus */
                if(typeof window.notificationsListHide == 'function') {
					notificationsListHide();	// hide other notifications list
				}
				if(typeof window.hideUserMn == 'function') {
					hideUserMn();				// hide user menu
				}
				/* show this menu */
                $(this).next('ul.elgg-menu').show();
                $(this).parent().addClass('elgg-state-selected subMnOn');
                return false;
            }
        );
        $('html').bind('click touchend',
            function() {
                hideCommonMn();
                hideLoginPopup();
            }
        );
        $('.elgg-menu-site .elgg-more a:first, .loginBtn, .loginFrmPopup').bind('click touchend',
            function(event) {
                event.stopPropagation();
            }
        );
        /* login popup */
        function hideLoginPopup() {
	        if($('#loginCont').hasClass('on')) {
		        $('#loginCont').removeClass('on');
	        }
        }
        $('.loginBtn').bind('click touchend',
        	function() {
        		$('#loginCont').toggleClass('on');
        		return false;
        	}
        );
    }
)