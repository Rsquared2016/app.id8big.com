<?php
/**
 * Avatar crop form
 *
 * @uses $vars['entity']
 */
//elgg_load_js('jquery.imgareaselect');
//elgg_load_js('elgg.avatar_cropper');
//elgg_load_css('jquery.imgareaselect');

elgg_load_js('theme.crop.js');
elgg_load_css('theme.crop.css');
/**
 * @TODO: HIDE THIS FORM IF NO TIMEICON SETTED 
 */
$master_img = elgg_view('output/img', array(
	 'src' => $vars['entity']->getIconUrl('master'),
	 'alt' => elgg_echo('avatar'),
	 'class' => 'mrl originalImage',
	 'id' => 'user-avatar-cropper',
		  ));

$preview_img = elgg_view('output/img', array(
	 'src' => $vars['entity']->getIconUrl('master'),
	 'alt' => elgg_echo('avatar'),
	 'id' => 'user_avatar_preview',
		  ));

$img_bounds = getimagesize($vars['entity']->getIconUrl('master'));
$json_bounds = json_encode(array($img_bounds[0], $img_bounds[1]));

?>
<div class="clearfix cropContainer">
<?php echo $master_img; ?>
	
	<div class="previewCrop">
		<div id="user-avatar-preview-title"><label><?php echo elgg_echo('avatar:preview'); ?></label></div>
		<div class="previewAvatar" style="width:100px;height:100px;overflow:hidden;">
			<?php echo $preview_img ?>
		</div>
		<div class="clearfloat"></div>
	</div>
	<div class="clearfloat"></div>
</div>
<div class="elgg-foot">
<?php
$coords = array('x1', 'x2', 'y1', 'y2');
foreach ($coords as $coord) {
	echo elgg_view('input/hidden', array('name' => $coord, 'value' => $vars['entity']->$coord, 'id' => $coord));
}

echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['entity']->guid));

echo elgg_view('input/submit', array('value' => elgg_echo('avatar:create')));
?>
</div>


<script type="text/javascript">
	var x1 = <?php if ($vars['user']->x1) { echo $vars['user']->x1; } else {echo 0;} ?>;
	var x2 = <?php if ($vars['user']->x2) { echo $vars['user']->x2; } else {echo 200;} ?>;
	var y1 = <?php if ($vars['user']->y1) { echo $vars['user']->y1; } else {echo 0;} ?>;
	var y2 = <?php if ($vars['user']->y2) { echo $vars['user']->y2; } else {echo 200;} ?>;
</script>
	
 <script type="text/javascript">
	 
	 
    jQuery(function($){
	  // Create variables (in this scope) to hold the API and image size
      var jcrop_api, boundx, boundy;
      var true_sizes = <?php echo $json_bounds ?>;
		
      $('#user-avatar-cropper').Jcrop({
        onChange: updatePreview,
        onSelect: updatePreview,
        aspectRatio: 1,
		  allowSelect: true,
		  allowResize: true,
	    
		  boxWidth: 352, 
//		  trueSize: true_sizes,

		  minSize: [ 100, 100 ]
      },function(){
        // Use the API to get the real image size
        var bounds = this.getBounds();
		  
        boundx = bounds[0];
        boundy = bounds[1];
        // Store the API in the jcrop_api variable
        jcrop_api = this;
		  
		  this.tellSelect();
		  this.animateTo([ x1, y1, x2, y2 ]);
      });

      function updatePreview(c)
      {
        if (parseInt(c.w) > 0)
        {
			  
			  //Square
          var rx = 100 / c.w;
          var ry = 100 / c.h;
          

          $('#user_avatar_preview').css({
            width: Math.round(rx * boundx) + 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
			 
			 
			 //Update on form the coords
			 $('#x1').val(c.x);
			 $('#y1').val(c.y);
			 
			 $('#x2').val(c.x2);
			 $('#y2').val(c.y2);
			 
        }
      };
    });

  </script>
  