<?php
/*************************************************************************
* This file is part of Palmer's ServerStatus
*
* Palmer's ServerStatus is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 3 of the License, or
* (at your option) any later version.
*
* Palmer's ServerStatus is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* Copyright Colin Palmer 2007 to Present Day <colin.p@lmer.biz>
* With thanks to Steve McManus <steve@statichost.co.uk>
*************************************************************************/
require_once("process.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $server_name ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="style.css" type="text/css" rel="stylesheet" />
		<style type="text/css">
			html, body {
				font-family: "Lucida Sans Unicode", "Tahoma", sans-serif;
				font-size: 12px;
				margin: 2%;
			}
			h1 {
				font-size: 2em;
			}
			h3 {
				font-size: 1em;
				font-weight: bold;
				padding: 0px;
				margin: 0px;
			}
			.percentage_backdrop {
				width: 100%;
				height: 20px;
				background-color: #12f311;
				text-align: center;
			}
			.percentage_filled {
				height: 16px;
				margin-top: 2px;
				margin-left: 2px;
				background-color: #ff0000;
				float: left;
				color: #FFF;
				margin-right: 2px;
			}
		</style>		
	</head>
	<body>
	<h1>Status on <?php echo $server_name ?></h1>
	<table width="100%">
	<?php if($show_load) { ?>
		<tr width="100%">
			<td width="10%">Load</td>
			<td width="80%">
				<div class="percentage_backdrop">
					<div class="percentage_filled" style="width:<?php echo $load["%load"]?>%">
						<?php echo $load["%load"]?>%
					</div>
				</div>
			</td>
			<td width="10%">
				<?php echo $load[0]."/".$load["cpus"].".00"; ?>
			</td>
		</tr>
	<?php } if($show_memory_usage) { ?>
		<tr>
			<td>Memory Usage</td>
			<td>
				<div class="percentage_backdrop">
					<div class="percentage_filled" style="width:<?php echo $mem_usage["%used"]?>%">
						<?php echo $mem_usage["%used"]?>%
					</div>
				</div>
			</td>
			<td><?php echo $mem_usage["used"]."MB/".$mem_usage["total"]."MB"; ?></td>
		</tr>
	<?php } if($show_swap_usage) { ?>
		<tr>
			<td>Swap Usage</td>
			<td>
				<div class="percentage_backdrop">
					<div class="percentage_filled" style="width:<?php echo $swap_usage["%used"]?>%">
						<?php echo $swap_usage["%used"]?>%
					</div>
				</div>
			</td>
			<td><?php echo $swap_usage["used"]."MB/".$swap_usage["total"]."MB"; ?></td>
		</tr>
	<?php } if($show_space_usage) { ?>
		<tr>
			<td colspan="3" style="text-align:center;">
			<h3>Space Usage</h3>
			</td>
		</tr>
		<?php foreach($space_usage as $space) { ?>
		<tr>
			<td><?php echo $space["path"]; ?></td>
			<td>
				<div class="percentage_backdrop">
					<div class="percentage_filled" style="width:<?php echo $space["%used"]?>%">
						<?php echo $space["%used"]?>%
					</div>
				</div>
			</td>
			<td><?php echo $space["used"]."B/".$space["total"]."B"; ?></td>
		</tr>
		<?php } ?>
	<?php } ?>
	</table>
	<table width="100%">
		<tr>
			<td colspan="2" style="text-align:center;">
			<h3>Service Status</h3>
			</td>
		</tr>	
	<?php if($show_http_status) { 
	$status = is_port_open($show_http_status);
	?>
		<tr width="100%">
			<td width="81%">
			HTTP
			</td>
			<td width="9%" style="color:#FFF;text-align:center;background-color:<?php echo $status["color"]; ?>">
			<?php echo $status["status"]; ?>
			</td>
		</tr>
	<?php } ?>
	<?php if($show_https_status) { 
	$status = is_port_open($show_https_status);
	?>
		<tr>
			<td>
			HTTPS
			</td>
			<td style="color:#FFF;text-align:center;background-color:<?php echo $status["color"]; ?>">
			<?php echo $status["status"]; ?>
			</td>
		</tr>
	<?php } ?>
	<?php if($show_FTP_status) { 
	$status = is_port_open($show_FTP_status);
	?>
		<tr>
			<td>
			FTP
			</td>
			<td style="color:#FFF;text-align:center;background-color:<?php echo $status["color"]; ?>">
			<?php echo $status["status"]; ?>
			</td>
		</tr>
	<?php } ?>
	<?php if($show_pop3_status) { 
	$status = is_port_open($show_pop3_status);
	?>
		<tr>
			<td>
			POP3
			</td>
			<td style="color:#FFF;text-align:center;background-color:<?php echo $status["color"]; ?>">
			<?php echo $status["status"]; ?>
			</td>
		</tr>
	<?php } ?>
	<?php if($show_smtp_status) { 
	$status = is_port_open($show_smtp_status);
	?>
		<tr>
			<td>
			SMTP
			</td>
			<td style="color:#FFF;text-align:center;background-color:<?php echo $status["color"]; ?>">
			<?php echo $status["status"]; ?>
			</td>
		</tr>
	<?php } ?>
	<?php if($show_MySQL_status) { 
	$status = is_port_open($show_MySQL_status);
	?>
		<tr>
			<td>
			MySQL
			</td>
			<td style="color:#FFF;text-align:center;background-color:<?php echo $status["color"]; ?>">
			<?php echo $status["status"]; ?>
			</td>
		</tr>
	<?php } ?>
	<?php if($show_DNS_status) { 
	$status = is_port_open($show_DNS_status);
	?>
		<tr>
			<td>
			DNS
			</td>
			<td style="color:#FFF;text-align:center;background-color:<?php echo $status["color"]; ?>">
			<?php echo $status["status"]; ?>
			</td>
		</tr>
	<?php } ?>
	<?php if($config_option_name) { 
	$status = is_port_open($config_option_port);
	?>
		<tr>
			<td>
			<?php echo $config_option_name; ?>
			</td>
			<td style="color:#FFF;text-align:center;background-color:<?php echo $status["color"]; ?>">
			<?php echo $status["status"]; ?>
			</td>
		</tr>
	<?php } ?>
	</table>
	<table width="100%">
		<tr width="100%">
			<td width="50%" valign="top">
				<table width="100%">
					<?php if($show_uptime || $show_load) { ?>
					<tr width="100%">
						<td colspan="2" style="text-align:center;">
							<h3>Uptime &amp; Load</h3>
						</td>
					</tr>
					<?php if($show_uptime) { ?> 
					<tr>
						<td width="50%">
							Uptime
						</td>
						<td width="50%" style="text-align:right;">
							<?php 
							$uptime = show_uptime();
							echo "$uptime[days] Days, $uptime[hours] Hours, $uptime[mins] Minutes"; ?>
						</td>
					</tr>
					<?php } ?>
					<?php if($show_load) { ?> 
					<tr>
						<td width="50%">
							Load
						</td>
						<td width="50%" style="text-align:right;">
							<?php echo "$load[0], $load[1], $load[2]"; ?>
						</td>
					</tr>
					<?php } } ?>							
					<tr width="100%">
						<td colspan="2" style="text-align:center;">
							<h3>Version Info</h3>
						</td>
					</tr>
					<?php if($php_version) { ?>
					<tr>
						<td width="50%">
							PHP Version
						</td>
						<td width="50%" style="text-align:right;">
							<?php echo $versions["php"]; ?>
						</td>
					</tr>
					<?php } ?>
					<?php if($mysql_version) { ?>
					<tr>
						<td>
							MySQL Version
						</td>
						<td style="text-align:right;">
							<?php echo $versions["mysql"]; ?>
						</td>
					</tr>
					<?php } ?>			
					<?php if($zend_version) { ?>
					<tr>
						<td>
							Zend Version
						</td>
						<td style="text-align:right;">
							<?php echo $versions["zend"]; ?>
						</td>
					</tr>
					<?php } ?>	
					<?php if($ioncube_version) { ?>
					<tr>
						<td>
							ionCube Version
						</td>
						<td style="text-align:right;">
							<?php echo $versions["ioncube"]; ?>
						</td>
					</tr>
					<?php } ?>
					<?php if($apache_version) { ?>
					<tr>
						<td>
							Apache Version
						</td>
						<td style="text-align:right;">
							<?php echo $versions["apache"]; ?>
						</td>
					</tr>
					<?php } ?>
				
				</table>
			</td>
			<td width="50%" valign="top">
				<table width="100%">
					<tr width="100%">
						<td colspan="2" style="text-align:center;">
							<h3>Linux Info</h3>
						</td>
					</tr>
					<?php if($linux_distro_version) { ?>
					<tr>
						<td width="50%">
							Linux Distrobution
						</td>
						<td width="50%" style="text-align:right;">
							<?php echo $linux["distro"]; ?>
						</td>
					</tr>
					<?php } ?>
					<?php if($linux_kernel_version) { ?>
					<tr>
						<td>
							Kernel Version
						</td>
						<td style="text-align:right;">
							<?php echo $linux["kernel"]; ?>
						</td>
					</tr>
					<?php } ?>
					
					<tr width="100%">
						<td colspan="2" style="text-align:center;">
							<h3>CPU Info</h3>
						</td>
					</tr>
					<?php if($cpu) { ?>
					<tr>
						<td width="50%">
							CPU Manufacturer
						</td>
						<td width="50%" style="text-align:right;">
							<?php echo $cpui["cpu_manufacturer"]; ?>
						</td>
					</tr>
					<?php } ?>
					<?php if($cpu) { ?>
					<tr>
						<td>
							Model Name
						</td>
						<td style="text-align:right;">
							<?php echo $cpui["model_name"]; ?>
						</td>
					</tr>
					<?php } ?>	
					<?php if($cpu_speed) { ?>
					<tr>
						<td>
							CPU Frequency
						</td>
						<td style="text-align:right;">
							<?php echo $cpui["speed"]; ?>MHz
						</td>
					</tr>
					<?php } ?>							
					<?php if($cpu_count) { ?>
					<tr>
						<td>
							Number of CPUs
						</td>
						<td style="text-align:right;">
							<?php echo $cpui["cpu_count"]; ?>
						</td>
					</tr>
					<?php } ?>							
						
				</table>
			</td>
		</tr>
	</table>
	<br />
	<center>&copy; Copyright <a href="http://www.colinpalmer.com/">Colin Palmer</a> 2007</center>
	</body>
</html>