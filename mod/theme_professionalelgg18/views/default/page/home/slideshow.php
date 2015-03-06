<?php /* slideshow */ ?>
<div class="slideshow">
    <div class="img"><img src="<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/slides/1.jpg" alt="" id="imgSlideshow" /></div>
    <div class="txt on" id="txt1">
		<h2><span class="no">SHARING OPPORTUNITIES AND EXPERIENCES</span></h2>
	</div>
	<div class="txt" id="txt2">
		<h2><span class="no">SHARING OPPORTUNITIES AND EXPERIENCES</span></h2>
	</div>
	<div class="txt" id="txt3">
		<h2><span class="no">SHARING OPPORTUNITIES AND EXPERIENCES</span></h2>
	</div>
	<div class="txt" id="txt4">
		<h2><span class="no">SHARING OPPORTUNITIES AND EXPERIENCES</span></h2>
	</div>
	<div class="txt" id="txt5">
		<h2><span class="no">SHARING OPPORTUNITIES AND EXPERIENCES</span></h2>
	</div>
	<ul class="ssNavigator">
		<li class="first on liImg"><a rel="txt1" href="<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/slides/1.jpg">&nbsp;</a></li>
        <li class="liImg"><a rel="txt2" href="<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/slides/2.jpg">&nbsp;</a></li>
        <li class="liImg"><a rel="txt3" href="<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/slides/3.jpg">&nbsp;</a></li>
        <li class="liImg"><a rel="txt4" href="<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/slides/4.jpg">&nbsp;</a></li>
        <li class="last nmRig liImg"><a rel="txt5" href="<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/slides/5.jpg">&nbsp;</a></li>
        <li class="prev"><a href="<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/slides/5.jpg">&nbsp;</a></li>
        <li class="next"><a href="<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/slides/2.jpg">&nbsp;</a></li>
    </ul>
	<div class="imgMask">&nbsp;</div>
</div>
<script type="text/javascript">
	$(document).ready(
		function() {
			var base_url = '<?php echo THEME_GRAPHICS_CUSTOM ?>slideshow/';
			var delay_change = 10000;
			var li_now = $('li.first');
			var id_image_slideshow = '#imgSlideshow';

			function next_prev(direction) {
				if($(id_image_slideshow).is(':animated')) {
					return false;
				}
				/* get directions */
				if(direction == 'next') {
					if(li_now.hasClass('last')) {
						li_now = $('li.first');
					}
					else {
						li_now = li_now.next('li');
					}
				}
				else if(direction == 'prev') {
					if(li_now.hasClass('first')) {
						li_now = $('li.last');
					}
					else {
						li_now = li_now.prev('li');
					}
				}
				/* change picture */
				$('li').removeClass('on');

				change_image(li_now, id_image_slideshow);
				li_now.addClass('on');

			}
			function change_image(li_image, id_image) {
				var img_a = li_image.find('a');
				var img_src = img_a.attr('href');
				var img_slideshow = $(id_image);

				$('.slideshow .txt.on').hide();
				$('.slideshow .txt.on').removeClass('on');

				img_slideshow.unbind('load');
				img_slideshow.bind('load', function() { $(this).fadeIn(); })
				img_slideshow.stop(true, true).fadeOut('normal', function () { img_slideshow.attr('src', img_src); $('#' + img_a.attr('rel')).addClass('on'); });

			}
			$('li.next a').bind('click touchend',
				function() {
					next_prev('next');
					return false;
				}
			);
			$('li.prev a').bind('click touchend',
				function() {
					next_prev('prev');
					return false;
				}
			);
			$('li.liImg').bind('click touchend',
				function() {
					if(($(this).hasClass('on')) || $(id_image_slideshow).is(':animated')) {
						return false;
					}
					else {
						$('li').removeClass('on');
						li_now = $(this);
						change_image(li_now, id_image_slideshow);
						li_now.addClass('on');
						clearInterval(timer_id );
					}
					return false;
				}
			);
			function next_img() {
				next_prev('next');
			}
			var timer_id = setInterval(next_img, delay_change);
		}
	);
</script>
