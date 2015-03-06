<?php

/*
 * GCalendar: gcalendar/authenticate/index
 */

?>
<script type="text/javascript">
	
	var el = window.opener.document.getElementsByClassName('gcalendar-auth-yes')[0];
	
	if (el) {
		var tag_name = el.tagName;
		
		switch(tag_name) {
			case 'FORM':
				el.submit();
				break;
			case 'A':
				el.click();
				break;
		}
	}
	
	window.close();

</script>