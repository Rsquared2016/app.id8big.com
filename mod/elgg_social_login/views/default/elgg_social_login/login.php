<?php
	global $CONFIG;
	global $HA_SOCIAL_LOGIN_PROVIDERS_CONFIG;

	require_once "{$CONFIG->pluginspath}elgg_social_login/settings.php"; 

	$in_login_lightbox = elgg_extract('in_login_lightbox', $vars, false);
	
	$social_login_class = 'socialLoginRegister';
	if (elgg_in_context('login')) {
		$social_login_class = 'socialLoginLogin';
		
		if (elgg_is_active_plugin('theme_professionalelgg18') && $in_login_lightbox) {
			$social_login_class .= ' loginCustom';
		}
	}
	
	// display "Or connect with" message, or not.. ?
	$or_connect_with = "<div class='socialLoginWrapper ".$social_login_class."'><div class='socialLoginTxt'><b>".elgg_echo('elgg_social_login:connect:with').":</b></div>";
	$connect_icons = '';

	// display provider icons
	foreach( $HA_SOCIAL_LOGIN_PROVIDERS_CONFIG AS $item ){
		$provider_id     = @ $item["provider_id"];
		$provider_name   = @ $item["provider_name"];

		$assets_base_url = "{$vars['url']}mod/elgg_social_login/graphics/";

		if( elgg_get_plugin_setting( 'ha_settings_' . $provider_id . '_enabled', 'elgg_social_login' ) ){
			$connect_icons .= '<a href="javascript:void(0);" title="'.$provider_name.'" class="ha_connect_with_provider" provider="'.$provider_id.'">';
			$connect_icons .= '<img alt="'.$provider_name.'" title="'.$provider_name.'" src="'.$assets_base_url . '32x32/' . strtolower( $provider_id ) . '.png" />';
			$connect_icons .= '</a>';
		} 
	}
	if (!empty($connect_icons)) {
		echo $or_connect_with;
		echo $connect_icons;
	}

	// provide popup url for hybridauth callback
	?>
		<input id="ha_popup_base_url" type="hidden" value="<?php echo "{$vars['url']}mod/elgg_social_login/"; ?>authenticate.php?" />
	<?php

	// link attribution && privacy page 
	?>
	
	<?php   
	echo "</div>";
?>
<script>
	$(function(){
		$(".ha_connect_with_provider").click(function(){
			popupurl = $("#ha_popup_base_url").val();
			provider = $(this).attr("provider");

			window.open(
				popupurl+"provider="+provider,
				"hybridauth_social_sing_on", 
				"location=1,status=0,scrollbars=0,width=800,height=570"
			); 
		});
	});  
</script> 
