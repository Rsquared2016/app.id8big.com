<?php
    /* jobs_ktform module javascript */
	//KTODO: Agregar namespace a javascript.
?>
<script type="text/javascript">


	function jobs_ktform_process_submit(element) {

		//Change to Sending...
		var submit = $('input[type=submit]', $(element));

		var savingTextDefault = '<?php echo elgg_echo('jobs_ktform:form:add:submit:default:text') ?>';
		var savingText = $(submit).attr('rel');

		if(savingText == '' || savingText == undefined) {
			savingText = savingTextDefault;
		}

		//We should search for input[type=submit]
		$(submit).addClass('disabled').attr('disabled', 'disabled').val(savingText);

		//alert('hola');
		//return false;

	}


	function disable_submit(wrapper, input, text) {
		$(input, wrapper)
	}

    function make_align() {
        // sets container height for vertical alignment (aided by a table...)

		$('.search_listing_info').each(
			function() {
				var height_init = $('.infoListing').height();
				$(this).find('.itemCol').each(
					function() {
						if($(this).height() > height_init) {
							if($.browser.msie && (parseFloat(jQuery.browser.version) > 7)) {
								return;
							}
							else {
								height_init = $(this).height();
							}
						}
					}
				);
				$(this).find('.itemListingCols, .itemCol').height(height_init);
			}
		);

        //$('.itemListingCols').height(Math.max($('.infoListing').height(), $('.itemCol').height()));
        // sets secondary titles width
        $('.ulListingTitle li').width($('.itemCol').width());
    }

    // we put this outside document ready, so it works in IE8
    if($.browser.msie && (jQuery.browser.version == '8.0')) {
        make_align();
        /*$('.itemCol span').height($('.itemCol span').height()); // if we don't do this, IE8 won't align items vertically
        $('.aRectangle').height($('.aRectangle').height()); // if we don't do this, IE8 won't align items vertically */
    }
    // for any other browser, we act normally
    else {
        $(document).ready(
            function() {
                make_align();
            }
        );
    }

	/**
	 * Add a a query string to a url.
	 * @params url - A simple url.
	 * @params params - Query string, must begin without ? or &.
	 */
	function jobs_ktform_add_params_to_url(url, params) {
		if(url.indexOf('?') == -1) {
			url = url+'?'+params;
		} else {
			url = url+'&'+params;
		}
		return url;
	}

    $(document).ready(
        function() {
			$('#btnShowHideSrchFrm').click(
				function() {
					if(!$('.ktHiddenSrchFrm').is(':animated')) {
						if(($.browser.msie) && (parseFloat($.browser.version) <= 8)) {
							$('.ktHiddenSrchFrm').toggle();
						}
						else {
							$('.ktHiddenSrchFrm').slideToggle();
						}
						$(this).toggleClass('on');
					}
					return false;
				}
			);

            /* listing items menu */
            function hide_item_listing_menus() {
                // Hide the menus if visible
                $('.itemListingToolsWrapper').removeClass('on');
                $('.itemListingTools').hide();
            }
            $('.itemListingToolsWrapper').click(
                function() {
                    hide_item_listing_menus();
                    $(this).find('.itemListingTools').show();
                    $(this).addClass('on');
                }
            );
            $('html').click(
                function() {
                    hide_item_listing_menus();
                }
            );
            $('.itemListingToolsWrapper, .itemListingTools').click(
                function(event){
                    event.stopPropagation();
                }
            );
            var max_zindex = $('.search_listing').length;
            $('.search_listing').each(
                function() {
                    $(this).css('z-index', max_zindex);
                    max_zindex--;
                }
            );
            /* tooltips */
				
//				
//            $('.aInteract.ttip, .fivestar-ratings-output .fivestar-ratings-innerwrapper').c({
//                content: {
//                        text: false // Use each elements title attribute
//                },
//                position: {
//                    corner: {
//                        target: 'topMiddle',
//                        tooltip: 'bottomMiddle'
//                    }
//                },
//                style: {
//                    tip: {
//                        corner: 'bottomMiddle',
//                        size: {
//                           x: 8,
//                           y : 10
//                        }
//                    }
//                }
//            });

			//$('.fivestar-messages').qtip('api');

            /* top tools */
            $('.ktToolsTop .ktChk').click(
                function() {
                    if(!$(this).hasClass('on')) {
                        $(this).addClass('on')
                        $('.search_listing_icon input.ktChk').attr('checked', 'checked');
                    }
                    else {
                        $(this).removeClass('on')
                        $('.search_listing_icon input.ktChk').removeAttr('checked');
                    }
                }
            );

            /* Disable submit */
            //$('form[name=]')
            //$('ktForm rBtn')

		//Add some borders.
		if($('#owner_block_submenu .submenu_group').length > 1) {
			var i=0;
			$('#owner_block_submenu .submenu_group').each(function() {
				if(i!=0) {
					$(this).css('border-top', '1px solid #CCC').
						css('padding-top', '10px').
						css('margin-top', '10px');
				}
				i++;

			});
		}

		//Bulk actions.
		$('.ktFrmBulkActionsWrapper form').submit(function(){
			var form = $(this);
			var actionSel = $('.ktSel', $(this)).val();

			if(actionSel == 'undefined' || actionSel == '') {
				alert('<?php echo elgg_echo('jobs_ktform:bulk_actions:error:select:an:action')?>');
				return false;
			} else {
				//Add action.
				form.attr('action', actionSel);
			}

			//Get selected checks.
			if($('.chckCont input[type=checkbox].ktChk:checked').length == 0) {
				alert('<?php echo elgg_echo('jobs_ktform:bulk_actions:error:check:a:checkbox')?>')
				return false;
			} else {
				//Add guids.
				$('.chckCont input[type=checkbox].ktChk:checked').each(function() {
					//Create hidden.
					var hdnCheck = document.createElement('input');
					$(hdnCheck).attr('type', 'hidden').attr('name', 'guids[]').val($(this).val());

					//Add to form
					$(form).append(hdnCheck);

				});
			}
		});

		/**
		 * Ajax implementations
		 */

		$('form[rel=<?php echo json_encode(KtJob_st_AJAX_REL_ATTR) ?>]').live('submit', function(event) {

			var form = $(this);
			var submit_button = $('input[type=submit]', $(form));

			// Save tinymcd
			if (typeof(tinyMCE) != 'undefined') {
				tinyMCE.triggerSave();
			}

			var form_options = {
//				dataType:  'json', //This is not usefull for now, because some plugins could return just some HTML instead json objects

				data: { callback: true }, //force the callback, because the uploads files use an iframe and the requested_with header is not sent.

				beforeSend: function(xhr) {
					xhr.setRequestHeader("HTTP_X_REQUESTED_WITH", "XMLHttpRequest"); // force XMLHttprequest, for older and ugly browsers, read about IE
				},
				
				beforeSubmit: function(arr, submitted_form, options) {
				   $(submitted_form).trigger('ajax_before_submit', [arr, submitted_form, options]);
				 },

				success: function(data, statusText, xhr, submitted_form) {

					if ($(submit_button).attr('rel')) {
						jobs_ktform_process_submit(form);
						$(submit_button).removeAttr('disabled');
					}

					/**
					 * Trigger the event so others plugins could extend this function and display some messages.
					 *
					 * Example:
					 *
					 * $('.ktFrm.demo form').bind('ajax_submit', function(event, data, statusText, xhr) {
					 *     console.log(data);
					 * });
					 *
					 */
					$(submitted_form).trigger('ajax_submit', [data, statusText, xhr]);
				},

				error: function (xmlRequest, textStatus, errorThrown) {
					alert(errorThrown);
				}



			};


			$(form).ajaxSubmit(form_options);

			//Prevent default submission
			event.preventDefault();

		});


			/**
			* End of ajax implementations
			 */

        } //End Of Doc Ready
    );

</script>
