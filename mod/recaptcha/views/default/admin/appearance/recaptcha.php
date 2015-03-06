<?php
$base_url = $vars['url'];
$graphics_url = $base_url.'mod/recaptcha/graphics/';
?>


<div class="recaptchaThemeSelectorContainer">
	<ul class="recaptchaThemeSelector">
		<li data-theme="red">
			<p><?php echo elgg_echo('admin:appearence:theme:title:red') ?></p>
			<img src="<?php echo $graphics_url ?>red.png"/>
		</li>
		<li data-theme="white">
			<p><?php echo elgg_echo('admin:appearence:theme:title:white') ?></p>
			<img src="<?php echo $graphics_url ?>white.png"/>
		</li>
		<li data-theme="blackglass">
			<p><?php echo elgg_echo('admin:appearence:theme:title:blackglass') ?></p>
			<img src="<?php echo $graphics_url ?>blackglass.png"/>
		</li>
		<li data-theme="clean">
			<p><?php echo elgg_echo('admin:appearence:theme:title:clean') ?></p>
			<img src="<?php echo $graphics_url ?>clean.png"/>
		</li>
		<li data-theme="custom">
			<p><?php echo elgg_echo('admin:appearence:theme:title:custom') ?></p>
			<img src="<?php echo $graphics_url ?>custom.png"/>
		</li>
	</ul>

	<?php echo elgg_view_form('recaptcha/theme_selector', array('id' => 'theme_selector_form'), array()); ?>

</div>


<script type="text/javascript">


	jQuery(document).ready(function($) {
  	// Code using $ as usual goes here.

  		var default_theme = $('#theme_selector_input').val();
  		var default_list = $('.recaptchaThemeSelector li[data-theme='+default_theme+']');

  		var default_image = $('img', default_list);

  		$('.recaptchaThemeSelector li').removeClass('active');
  			
  		default_list.addClass('active');

  		$('.recaptchaThemeSelector li img').css('border', "none").css('cursor', 'pointer');  
  		default_image.css('border', "solid 2px red"); 

  		

  		$('.recaptchaThemeSelector li img').click(function() {
  			var image_element = $(this);
  			var list_element = image_element.parents('li');

  			var choosen_theme = list_element.data('theme');

  			$('.recaptchaThemeSelector li').removeClass('active');
  			
  			list_element.addClass('active');

  			$('.recaptchaThemeSelector li img').css('border', "none");  
  			image_element.css('border', "solid 2px red");  

  			$('#theme_selector_input').val(choosen_theme);
  		});
	});
</script>