<?php
/**
* top_notifications
*
* @author German Scarel
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

/* lighbtox */ 
?>
<script type="text/javascript">
//<![CDATA[

function top_notifications_redirect() {
	var url = '<?php echo $vars['url'].'top_notifications/admin/?tab=about' ?>';
	window.location.href = url;
}

$(document).ready(function(){
	top_notifications_redirect();
});

//]]>
</script>