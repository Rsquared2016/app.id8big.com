<?php


$dataroot = (empty($_REQUEST['dataroot']))? dirname(__FILE__) : $_REQUEST['dataroot'];

if ($dataroot) {
	if (is_writable($dataroot)) {
		echo '<b style="color: green"> Your folder is writable </b>';
	} else {
		echo '<b style="color: red"> Your folder is not writable </b>';
	}
}

?>


<form action="" method="POST">
	<input type="text" name="dataroot" style="width: 500px" value="<?php echo $dataroot; ?>" />
	<input type="submit" />
</form>