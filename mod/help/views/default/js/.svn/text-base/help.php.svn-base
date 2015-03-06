<?php
/*
 * Help Js
 */
?>
//<script type="text/javascript">
/* Help */
$('.mnTopLevel').live('click', function() {
	var parent_li = $(this).parent();
	var parent_li_inner_wrapper_1 = $(this).parent().find('div.innerWrapper1');
	;
	var active_li = $('.lv1.on');
	var active_li_inner_wrapper_1 = $('.lv1.on').find('div.innerWrapper1');
	var time_slide = 500;

	function show_mn_lv_1() {
		parent_li.slideDown();
		parent_li.addClass('on');
		parent_li_inner_wrapper_1.slideDown(time_slide);
	}

	if(parent_li.hasClass('.on') || active_li_inner_wrapper_1.is(':animated')) {
		return false;
	}

	if(active_li_inner_wrapper_1.length) {
		active_li_inner_wrapper_1.slideUp(time_slide, function() {
			$('.cwLefSmn li.on').removeClass('on');
			active_li.removeClass('on');
			$('.cwLefSmn2').hide();
			show_mn_lv_1();
		});
	}
	else {
		show_mn_lv_1();
	}

	return false;
});

$('.mn2ndLevel').live('click', function() {
	var parent_li = $(this).parent();
	var sub_mn = parent_li.find('.cwLefSmn2');
	var active_li = $('.cwLefSmn .on');
	var time_slide = 500;

	function show_mn_lv_2() {
		parent_li.addClass('on');
		sub_mn.slideDown(time_slide);
	}

	if(parent_li.hasClass('.on') || sub_mn.is(':animated') || sub_mn.is(':visible')) {
		return false;
	}

	if(active_li.length) {
		active_li.find('.cwLefSmn2').slideUp(time_slide, function() {
			active_li.removeClass('on');
			show_mn_lv_2();
		});
	}
	else {
		show_mn_lv_2();
	}


	return false;
});
//</script>