<?php

/*
 * User sidebar settings.
 * Only appears if logged in is the same page owner.
 */
if(elgg_is_logged_in() && elgg_get_page_owner_guid() == elgg_get_logged_in_user_guid()) {
	$user = elgg_get_logged_in_user_entity();
	if(!$user->canEdit()) {
		return false;
	}
?>

<div>
	
</div>

<?php

	//User edit inline fields
	$fields = sparkfire_get_page_owner_fields();
?>
<div class="user-profile-inline-fields">
	<?php
		foreach($fields as $key => $data) {
			$value = ($data)?$data:'';
	?>
		<div class="itemInlineWrapper">
			<div class="itemInlineTitleWrapper">
				<h3><?php echo elgg_echo("profile:$key")?></h3>
				<?php
					echo elgg_view('output/url', array(
						'href' => 'javascript:void(0)',
						'text' => elgg_echo('edit'),
						'class' => 'elgg-button elgg-button-action btn-mini editInline',
					));

				?>
			</div>
			<p class="inlineEdit" data-name="<?php echo $key?>" data-rel="inline_edit"><?php echo $value; ?></p>
		</div>
	
	<?php
		}
	?>
	
</div>


<?php 
}
?>