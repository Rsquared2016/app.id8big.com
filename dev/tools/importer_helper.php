<style>
	pre {border: 1px solid red; padding: 3px;}
	form {width: 508px;}
	input { font-size: 16px; margin: 4px 2px; width: 500px; }
	input[type="submit"] { float: right; width: 200px; }
	small { padding: 2px 0 0 4px;}
	.fl { clear: both; }
			
</style>
<?php
//Default proyect name.
$project_def = 'elggdemo';

//Get proyect name.
$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = explode('/', trim($request_uri, '/'));

$project_name = current($request_uri);

$path = (isset($_GET['path']) ? $_GET['path'] : "{$_SERVER['DOCUMENT_ROOT']}/{$project_name}/");
$dataroot = isset($_GET['dataroot']) ? $_GET['dataroot'] : "{$_SERVER['DOCUMENT_ROOT']}/elggdata/{$project_name}/";
$url = isset($_GET['url']) ? $_GET['url'] : "http://local/{$project_name}/";

if ($path && $dataroot && $url) {
		$sql = <<<EOT
UPDATE `elgg_datalists` 
    SET `value` =  '{$path}'  
    WHERE `name` = 'path';
 
UPDATE `elgg_datalists` 
    SET `value` = '{$dataroot}' 
    WHERE `name` = 'dataroot';
 
UPDATE `elgg_sites_entity` 
    SET `url` = '{$url}' 
    WHERE `guid` = 1;
EOT;
	}

?>
<h3>Tool for update the db</h3>
<form method="GET">
	<input name="path" value="<?php echo $path ?>" /><br />
	<small>Path is the path of the application. Eg: /Users/pedroprez/Sites/elggdemo/</small>
	<br />
	<input name="dataroot" value="<?php echo $dataroot ?>" /><br />
	<small>Data root is the path of the application data. Eg: /Users/pedroprez/Sites/elggdata/elggdemo/</small>
	<br />
	<input name="url" value="<?php echo $url ?>" /><br />
	<small>Url is the url site. Eg: http://localhost/elggdemo/</small>
	<br />
	<input type="submit" />
	<div class='fl'></div>
<?php 
if ($sql) {
	echo "<pre>$sql</pre>";
}
?>
</form>
