<?php
//Add some metatags of fullCalendar.
$CURRENT_LANGUAGE = get_language();

?>
<script type='text/javascript'>
//<![CDATA[
	//Validates if it is already added and do not include it.
	if (typeof ($().fullCalendar) == 'undefined') {
		document.write('<link rel="stylesheet" type="text/css" href="<?php echo $vars['url']; ?>mod/events/vendors/fullcalendar/fullcalendar/fullcalendar.css" \/> ');
		document.write('<link rel="stylesheet" type="text/css" href="<?php echo $vars['url']; ?>mod/events/vendors/fullcalendar/fullcalendar/fullcalendar.print.css" media="print" \/> ');
<?php
switch ($CURRENT_LANGUAGE) {
    case 'en':
?>
		document.write('<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/events/vendors/fullcalendar/fullcalendar/fullcalendar.min.en.js"><\/script>');
<?php
        break;
    case 'es':
?>
		document.write('<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/events/vendors/fullcalendar/fullcalendar/fullcalendar.min.es.js"><\/script>');
<?php        
        break;

    default:
?>
		document.write('<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/events/vendors/fullcalendar/fullcalendar/fullcalendar.min.en.js"><\/script>');
<?php
        break;
}
?>

	}
//]]>
</script>