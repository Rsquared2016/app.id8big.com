<?php 

//Get curl version.
$curl_version = 0;
if(function_exists("curl_version")) {
    $curl_version = curl_version();
    $curl_version = $curl_version['version'];
}

//Check mod rewrite.
$mod_rewrite = FALSE;
if (function_exists('apache_get_modules')) {
  $modules = apache_get_modules();
  $mod_rewrite = in_array('mod_rewrite', $modules);
} else {
  $mod_rewrite =  getenv('HTTP_MOD_REWRITE')=='On' ? true : false ;
}

$server_configs = array(
  "PHP Version" => array(
    "required" => "5.0",
    "value"    => phpversion(),
    "result"   => version_compare(phpversion(), "5.0"),
  ),
  "DOMDocument extension" => array(
    "required" => true,
    "value"    => phpversion("DOM"),
    "result"   => class_exists("DOMDocument"),
  ),
  "PCRE" => array(
    "required" => true,
    "value"    => phpversion("pcre"),
    "result"   => function_exists("preg_match"),
  ),
  "Zlib" => array(
    "required" => true,
    "value"    => phpversion("zlib"),
    "result"   => function_exists("gzcompress"),
    "fallback" => "Recommended to compress PDF documents",
  ),
  "MBString extension" => array(
    "required" => true,
    "value"    => phpversion("mbstring"),
    "result"   => function_exists("mb_send_mail"),
    "fallback" => "Recommended, this is needed to encode string headers into email, to solve problem with UTF8 chars. ",
  ),
  "GD" => array(
    "required" => true,
    "value"    => phpversion("gd"),
    "result"   => function_exists("imagecreate"),
    "fallback" => "Required if you have images in your documents",
  ),
  "CURL" => array(
    "required" => true,
    "value"    => $curl_version,
    "result"   => function_exists("curl_init"),
    "fallback" => "Required if you want to get data from url",
  ),
  "JSON_DECODE" => array(
    "required" => true,
    "value"    => '',
    "result"   => function_exists('json_decode'),
    "fallback" => "Required, Facebook Service use it, and ajax calls too.",
  ),
  "MOD_REWRITE" => array(
    "required" => true,
    "value"    => '',
    "result"   => $mod_rewrite,
    "fallback" => "Required, very important to format friendly url.",
  ),
  "APC" => array(
    "required" => true,
    "value"    => phpversion("apc"),
    "result"   => function_exists("apc_fetch"),
    "fallback" => "Recommended for better performances",
  ),
);

//Try to delete first.
$folder_name = 'delete_this';
$rs = @rmdir($folder_name);
if ($rs) {
	echo 'The folder "delete_this" was deleted successfully. <br />';
}

$rs = mkdir($folder_name,'0777');
if ($rs) {
	echo 'The folder "delete_this" in the current path was created successfully <br />';
	echo 'Permission File/Folder Creation Success <br />';
} else {
	echo 'Your server have errors to create files, check permissions <br />';
}


//Send email
$to = "socialadmin@keetup.com";
$subject = "Prueba de servidor en {$_SERVER['HTTP_HOST']}";
$body = "Envio de email desde {$_SERVER['HTTP_HOST']}";

$rs = mail($to, $subject, $body);

if($rs) {
	echo 'The mail was successfull sent <br />';
} else {
	echo 'There was an error sendind the mail <br />';
}

//KTODO: Add some css and colors :)
?>

<table class="setup">
  <tr>
    <th></th>
    <th>Required</th>
    <th>Present</th>
  </tr>
  
  <?php foreach($server_configs as $label => $server_config) { ?>
    <tr>
      <td class="title"><?php echo $label; ?></td>
      <td><?php echo ($server_config["required"] === true ? "Yes" : 
$server_config["required"]); ?></td>
      <td class="<?php echo ($server_config["result"] ? "ok" : 
(isset($server_config["fallback"]) ? "warning" : "failed")); ?>">
        <?php
        echo $server_config["value"];
        if ($server_config["result"] && !$server_config["value"]) echo 
"Yes";
        if (!$server_config["result"] && 
isset($server_config["fallback"])) {
          echo "<div>No. ".$server_config["fallback"]."</div>";
        }
        ?>
      </td>
    </tr>
  <?php } ?>
  
</table>