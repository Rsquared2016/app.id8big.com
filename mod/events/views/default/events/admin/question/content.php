<?php
/**
* events_ktform
*
* @author Bortoli German and German Bortoli
* @link http://community.elgg.org/profile/pedroprez
* @copyright (c) Keetup 2010
* @link http://www.keetup.com/
* @license GNU General Public License (GPL) version 2
*/

/* lighbtox */ 
return FALSE;
?>
<script type="text/javascript">
//<![CDATA[

function events_ktform_redirect() {
	var url = '<?php echo $vars['url'].'events_ktform/admin/?tab=about' ?>';
	window.location.href = url;
}

$(document).ready(function(){
	events_ktform_redirect();
});

//]]>
</script>