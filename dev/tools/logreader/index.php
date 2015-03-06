<?php
session_start();

//Default data.
$show = 'php';
$lines = 100;
$host = 'local';

if(isset($_GET['show']) && $_GET['show']) {
	$show = $_GET['show'];
}

if(isset($_GET['lines']) && $_GET['lines']) {
	$lines = $_GET['lines'];
}

if(isset($_GET['host']) && $_GET['host']) {
	$host = $_GET['host'];
}


switch($show) {
	case 'apache':
		if($host == 'local') {
			$log_file = "/Applications/MAMP/logs/apache_error_log";
		} else if($host == 'server') {
			$log_file = "/var/log/apache2/error.log";
		}
		break;

	case 'mysql':
		if($host == 'local') {
			$log_file = "/Applications/MAMP/logs/mysql_error_log.err";
		} else if($host == 'server') {
			$log_file = "/var/log/mysql.log";
		}
			
		break;

	case 'php':
		if($host == 'local') {
			$log_file = "/Applications/MAMP/logs/php_error.log";
		} else if($host == 'server') {
			$log_file = "/var/log/apache2/error.log";
		}
				
	default:
		break;
}

$command = "tail -n{$lines} {$log_file}";

exec($command, $output);

//Ordenamos alreves
if(is_array($output))
{
	//rsort($output);
        $tam = sizeof($output);
}

if(isset($_SESSION['ultimo']))
	$ultimo = $_SESSION['ultimo'];
	
?>
<style>
	table {font-size:0.9em;}
	table th {border-bottom:1px solid red;}
	table td {border-bottom:1px solid gray;}
</style>

<table border="0">
    <tr>
        <th width="15%">Date</th>
        <th>Message</th>
    </tr>
<?php
	$cambio = false;
    foreach($output as $i => $line) {
        // sample line: [Wed Oct 01 15:07:23 2008] [error] [client 76.246.51.127] PHP 99. Debugger->handleError() /home/gsmcms/public_html/central/cake/libs/debugger.php:0
        $line = $output[$tam-$i-1];
        preg_match('~^\[(.*?)\]~', $line, $date);
        if(empty($date[1])) {
                continue;
        }
        preg_match('~\] \[([a-z]*?)\] \[~', $line, $type);
        preg_match('~\] \[client ([0-9\.]*)\]~', $line, $client);
        preg_match('~\] (.*)$~', $line, $message);
        
        if(isset($ultimo) && $ultimo == $date[1])
        	$cambio = true;
        
        if($i==0)
        {
        	if(isset($_SESSION['ultimo']) && $_SESSION['ultimo'] != $date[1] || !isset($_SESSION['ultimo']))
        		$_SESSION['ultimo'] = $date[1];
        }
        
        
        ?>
    <tr <?= (!$cambio) ? 'style="background:#FF4F4F;"' : ''  ?>>
        <td><?=$date[1]?></td>
        <td><?=$message[1]?></td>
    </tr>
        <?
    }
?>
</table>
