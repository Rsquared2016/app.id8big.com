<?php 
	require_once (dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body>
	<div class="wrap">
		<h2><?php echo elgg_echo('elgg_social_login:diagnostics:title'); ?></h2> 
		
		<p>
			<h3><?php echo elgg_echo('elgg_social_login:diagnostics:rewrite:title'); ?></h3> 
<?php
	# {{{ Rewrite Diagnostics ? 
		$testing = @ $_REQUEST['url'];

		if ( $testing == "http://www.example.com" ) {
			echo "<b style='color:green;'>OK!</b> " . elgg_echo('elgg_social_login:diagnostics:rewrite:note');
		}
		else{ 
			echo sprintf( '<b style="color:red;">FAIL!</b> Expected "http://www.example.com", received "%s".', $testing );
		} 
	# }}} end Rewrite Diagnostics 
?>
		</p>

		<hr />

		<p>
			<h3><?php echo elgg_echo('elgg_social_login:diagnostics:system:requirements:title') ?></h3> 
<?php
	# {{{ System Requirements ?
		// check for php 5.2
		echo "<h4>2.1 - PHP 5.2</h4>";

		if ( version_compare( PHP_VERSION, '5.2.0', '>=' ) ){
			echo "<b style='color:green;'>OK!</b> PHP >= 5.2.0 " . elgg_echo('elgg_social_login:diagnostics:installed') . ".";
		}
		else{ 
			echo "<b style='color:red;'>FAIL!</b> PHP >= 5.2.0 " . elgg_echo('elgg_social_login:diagnostics:installed:not') . ".";
		}

		// OAuth API 1.8 is not compatible with this plugin
		echo "<h4>2.4 - OAuth API 1.8 plugin</h4>";

		if( ! class_exists('OAuthException') ) {
			echo "<b style='color:green;'>OK!</b> OAuth API plugin " . elgg_echo('elgg_social_login:diagnostics:disabled') . ".";
		}
		else{ 
			echo "<b style='color:red;'>FAIL!</b> OAuth API plugin " . elgg_echo('elgg_social_login:diagnostics:enabled') . ".<br /><b>OAuth API plugin</b> " . elgg_echo('elgg_social_login:diagnostics:oauth:compatible:not');
		}

		// PHP Curl extension [http://www.php.net/manual/en/intro.curl.php] 
		echo "<h4>2.2 - CURL Extension</h4>";

		if ( function_exists('curl_init') ) {
			echo "<b style='color:green;'>OK!</b> PHP Curl extension [http://www.php.net/manual/en/intro.curl.php] " . elgg_echo('elgg_social_login:diagnostics:installed') . ".";
		}
		else{ 
			echo "<b style='color:red;'>FAIL!</b> PHP Curl extension [http://www.php.net/manual/en/intro.curl.php] " . elgg_echo('elgg_social_login:diagnostics:installed:not') . ".";
		} 

		// PHP JSON extension [http://php.net/manual/en/book.json.php]
		echo "<h4>2.3 - JSON Extension</h4>";

		if ( function_exists('json_decode') ) {
			echo "<b style='color:green;'>OK!</b> PHP JSON extension [http://php.net/manual/en/book.json.php] " . elgg_echo('elgg_social_login:diagnostics:installed') . ".";
		}
		else{ 
			echo "<b style='color:red;'>FAIL!</b> PHP JSON extension [http://php.net/manual/en/book.json.php] " . elgg_echo('elgg_social_login:diagnostics:disabled') . ".";
		} 

		// OAuth PECL extension is not compatible with this library
		echo "<h4>2.4 - PECL OAuth Extension</h4>";

		if( ! extension_loaded('oauth') ) {
			echo "<b style='color:green;'>OK!</b> PECL OAuth extension [http://php.net/manual/en/book.oauth.php] " . elgg_echo('elgg_social_login:diagnostics:installed:not') . ".";
		}
		else{ 
			echo "<b style='color:red;'>FAIL!</b> PECL OAuth extension [http://php.net/manual/en/book.oauth.php] " . elgg_echo('elgg_social_login:diagnostics:installed') . ". OAuth PECL extension " . elgg_echo('elgg_social_login:diagnostics:pecl:compatible:not') . ".";
		} 
	# }}} end System Requirements
?>
		</p>

		<hr />

		<p>
			<?php echo elgg_echo('elgg_social_login:diagnostics:end'); ?>
		</p>
	</div>  
	
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11037160-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<script type="text/javascript"> var sc_project=7312365; var sc_invisible=1; var sc_security="30da00f3"; </script>
<script type="text/javascript" src="http://www.statcounter.com/counter/counter.js"></script> 

</body>
</html>
