<?php
$content = $vars['content'];
$url = $vars['url'];

$tab = $vars['tab'];
$selected_tabs = $vars['selected_tabs'];

//$step_number = 1;
$step_number = 2; //Changed because step 1 is register.
?>

<div class="registerExCont">
	<?php
		echo elgg_view('register_steps/steps/tabs', $vars);
	?>
	<?php /*<ul class="elgg-menu-filter" id="register_tab">
	<?php
		foreach ($selected_tabs as $tab_key => $tab_text) {
	?>
		<li class="<?php echo ($tab == $tab_key) ? 'elgg-state-selected' : ''; ?> tabNumber<?php echo $step_number; ?>">
    		<a>
   		    	<span class="theTxt"><?php echo elgg_echo('register_exteps:tab:step') ?></span>
   		    	<span class="theNumber"><?php echo $step_number; ?></span>
   			</a>
   	    </li>
	<?php
    		$step_number++;
		}
	?>
	</ul>*/ ?>
   	<div class="insideFormTabs">
		<?php echo $content; ?>
    </div>
</div>
<script type="text/javascript">
    var register_url = '<?php echo $vars['url'] ?>register/?tab=';
    jQuery(document).ready(function($) {
	// Code using $ as usual goes here.
	$('.elgg-button.backButton').click(function(e){
	    e.preventDefault();
	    
	    var prev_tab = $(this).attr('rel');
	    if (!prev_tab) {
		prev_tab = 'profile_image';
	    }
			
	    var register_go_to = register_url+prev_tab;
			
	    document.location.href = register_go_to;
	});
    });
    
</script>