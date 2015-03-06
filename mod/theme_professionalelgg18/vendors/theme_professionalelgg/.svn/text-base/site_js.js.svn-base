/* put common site javascript here */
function hideCommonMn() {
	$('.elgg-menu-site .elgg-more ul.elgg-menu').hide();
    $('.subMnOn').removeClass('elgg-state-selected');
}
$(document).ready(
    function() {
        /* common top menu */
		$('.elgg-more a:first-child').bind('click touchend',
            function() {
                /* hide visible menus */
                if(typeof window.notificationsListHide == 'function') {
					notificationsListHide();	// hide other notifications list
				}
				if(typeof window.hideUserMn == 'function') {
					hideUserMn();				// hide user menu
				}

				/* show this menu */
				if(elgg.responsive) { // Responsive code.
					var site_menu = $(this).parents('ul.elgg-menu');
					site_menu.append($(this).next('ul.elgg-menu').find('li'));
					// Delete more btn.
					$(this).parents('.elgg-more').remove();
				}
				else {
					$(this).next('ul.elgg-menu').show();
					$(this).parent().addClass('elgg-state-selected subMnOn');
				}
				/* avoid returning false for elements which are not "more" */
				if($(this).parent().hasClass('elgg-more')) {
					return false;
				}
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
				$('.loginFrmPopupInner input[name=username]').focus();
        		return false;
        	}
        );
		$('.loginFrmPopup input[name=password], .loginFrmPopup input[name=username]').keydown(function(event) {
			if (event.which == '13') {
				$('.elgg-form-login').submit();
			}
		});

		/* elastic textarea for status update */
       	$('textarea#thewire-textarea').elastic();

       	/* profile description's show more / less */
		var txt_cont = $('.profile-aboutme-contents');
		var desc_original_h = txt_cont.height();
		var desc_total_h = 0;
		var txt_delay = 500;

		function show_text_expander() {

			if(txt_cont.is(':animated')) {
				return false;
			}

			desc_total_h = $('.pamInner').outerHeight();

			if(desc_total_h > desc_original_h) {
				$('#showMore').show(0);
			}
			else {
				$('#showMore').hide(0);
			}

		}

		function calculate_text_height() {
			if(txt_cont.hasClass('on')) {
				desc_total_h = $('.pamInner').outerHeight();
				txt_cont.height(desc_total_h);
			}
		}

		function profile_text_setup() {
			calculate_text_height();
			show_text_expander();
		}

		$('#showMore').bind('click touchend',
			function() {
				/* shrink */
				if(txt_cont.hasClass('on')) {
					txt_cont.removeClass('on');
					txt_cont.stop(true, true).animate({'height': desc_original_h}, txt_delay);
					$(this).removeClass('itsOn');
				}
				/* grow */
				else {
					txt_cont.addClass('on');
					txt_cont.stop(true, true).animate({'height': desc_total_h}, txt_delay);
					$(this).addClass('itsOn');
				}
				return false;
			}
		);

		$(window).resize(
			function() {
				profile_text_setup();
			}
		);

		profile_text_setup();

		/* generic submenu handling */
		$('.hasSubMn').bind('click touchend',
			function() {
				var sub_mn_cont = $(this).parents('.subMnCont');

				sub_mn_cont.toggleClass('on');
				return false;
			}
		);
		// hide when clicking anywhere but...
		$('html').bind('click touchend',
			function() {
			    $('.subMnCont, .headerSubSectItem').removeClass('on');
			    $('.elgg-page-header').removeClass('headerSSOn');
			}
		);
		// ...allow clicking on certain items
		$('h2 .elgg-sidebar, .h2titleShowSidebar, .headerSubsections, .headerSubSectItem, #mnSiteResponsiveHeader ul').bind('click touchend',
			function(event) {
			    event.stopPropagation();
			}
		);

		/* header subsections handling */
		$('.btnSubHeader').bind('click touchend',
			function() {
				$('.headerSubsections').toggleClass('on');
				$('.headRig').toggleClass('hOn');
				return false;
			}
		);
		/* show / hide left menu */
		var lef_mn = $('.mnLefLimits ul');
		var lef_mn_start_pos = $('.mnLefLimits ul').width();
		var lef_mn_end_pos = 0;
		var lef_mn_anim_time = 300;

		function hide_lef_site_mn() {
			lef_mn.animate({ 'left': -lef_mn_start_pos + 'px' }, lef_mn_anim_time, function() {
				$('#mnSiteResponsive').removeClass('on');
			});
		}

		$('#mnLefShowHide').bind('click touchend',
			function() {
				if(lef_mn.is(':animated')) {
					return false;
				}
				// hide
				if($('#mnSiteResponsive').hasClass('on')) {
					hide_lef_site_mn();
				}
				else { // show
					$('#mnSiteResponsive').addClass('on');
					$('.mnLefLimits').addClass('shadow');
					lef_mn.animate({ 'left': lef_mn_end_pos + 'px' }, lef_mn_anim_time);
				}
				return false;
			}
		);
//		$('html').bind('click',
//			function() {
//			    if(lef_mn.is(':animated')) {
//					return false;
//				}
//			    hide_lef_site_mn();
//			}
//		);
		lef_mn.bind('click touchend',
			function(event) {
			    event.stopPropagation();
			}
		);

		/* profile responsive menu */
		$('#btnShowHideMnRespProfile').bind('click touchend',
			function() {
				$('.allProfileMenus').css({ 'right' : -($('.profile .elgg-inner').width() - ($('.imgProfileContainer').width() + 2)) + 'px' }); // place menu
				$('.allProfileMenus, #btnShowHideMnRespProfile').toggleClass('on');
				return false; // DO NOT DELETE THIS
			}
		);
		$('html').bind('click touchend',
			function() {
			    $('.allProfileMenus, #btnShowHideMnRespProfile').removeClass('on');
			}
		);
		$('.allProfileMenus, #btnShowHideMnRespProfile').bind('click touchend',
			function(event) {
			    event.stopPropagation();
			}
		);
			
		//Fix of sidebar on responsive layout when menues goes wilds with parents submenues
		$(".mainContentsTitle .elgg-sidebar").delegate(".elgg-menu-parent", "click touchend", elgg.ui.toggleMenu);			

		/* fix for 1024x768 resolution: show/hide menu button on profile */
		/* KTODO: find a better way to do this… */
		elgg.ui.toggles = function(event) {
			event.preventDefault();

			// @todo might want to switch this to elgg.getSelectorFromUrlFragment().
			var target = $(this).toggleClass('elgg-state-active').attr('href');
			$(target).slideToggle('medium');

			$('.imgProfileContainerSidebar').toggleClass('hide1024');

		};

    }
);
