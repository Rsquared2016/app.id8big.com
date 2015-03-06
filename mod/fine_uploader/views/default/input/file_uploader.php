<?php


$name = elgg_extract('name', $vars);
$id = elgg_extract('id', $vars, $name.'-'.uniqid('fl'));


elgg_load_js('fine_uploader');
elgg_load_css('fine_uploader');
elgg_load_js('file_fine_uploader');


?>

<div data-uploadtype="fine" id="<?php echo $id; ?>" data-name="<?php echo $name; ?>">
    <noscript>			
    <p>Please enable JavaScript to use file uploader.</p>
    <!-- or put a simple form for upload here -->
    </noscript>         
</div>  

<?php if (elgg_is_xhr()) { ?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  // Code using $ as usual goes here.
	  elgg.fine_uploader_generate_inputs();
	});
</script>

<?php } ?>
