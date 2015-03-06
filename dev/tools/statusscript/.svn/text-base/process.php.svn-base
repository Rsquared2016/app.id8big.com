<?php

/*************************************************************************
* This file is part of StatusScript
*
* StatusScript is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 3 of the License, or
* (at your option) any later version.
*
* StatusScript is distributed in the hope that it will be useful,
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
require_once("config.php");

function show_uptime()
{
	$uptime = shell_exec("cut -d. -f1 /proc/uptime");
	$days = floor($uptime/60/60/24);
	$hours = str_pad($uptime/60/60%24,2,"0",STR_PAD_LEFT);
	$mins = str_pad($uptime/60%60,2,"0",STR_PAD_LEFT);  
	$secs = str_pad($uptime%60,2,"0",STR_PAD_LEFT);	
	return array(
	"days" => $days,
	"hours" => $hours,
	"mins" => $mins,
	"secs" => $secs
	);
}
function show_load() 
{
	$load = shell_exec("uptime");
	$load = explode("load average:", $load);
	$load = explode(", ", trim($load[1]));
	$cpus = trim(shell_exec("cat /proc/cpuinfo | grep processor | cut -d' ' -f 1 | sort | uniq -c | sort -n | awk '{print $1}'"));
	if($load[0] == "0.00") { $load["%load"] = 0; } else 
	{
	$load["%load"] = round(($load[0]/$cpus)*100);
	}
	$load["cpus"] = $cpus;
	return $load;
}
function show_mem_usage()
{
	$total_mem = trim(shell_exec("free -m | grep 'Mem:' | awk '{print $2}'"));
	$used_mem = trim(shell_exec("free -m | grep 'Mem:' | awk '{print $3}'")-shell_exec("free -m | grep 'Mem:' | awk '{print $7}'"));
	$free_mem = trim($total_mem-$used_mem);
	$percent_mem_used = round(($used_mem/$total_mem)*100);
	$mem["total"] = $total_mem;
	$mem["used"] = $used_mem;
	$mem["free"] = $free_mem;
	$mem["%used"] = $percent_mem_used;
	return $mem;
}
function show_swap_usage()
{
	$total_swap = trim(shell_exec("free -m | grep 'Swap:' | awk '{print $2}'"));
	$used_swap = trim(shell_exec("free -m | grep 'Swap:' | awk '{print $3}'"));
	$free_swap = trim($total_swap-$used_swap);
	$percent_swap_used = round(($used_swap/$total_swap)*100);
	$swap["total"] = $total_swap;
	$swap["used"] = $used_swap;
	$swap["free"] = $free_swap;
	$swap["%used"] = $percent_swap_used;
	return $swap;
}
function show_space_usage()
{
	$space = array();
	$space_lines = explode("\n", shell_exec("df -h"));
		foreach($space_lines as $line) 
		{
			if(strpos($line, "Filesystem")===false && strlen(trim($line)) > 1) {
				$partition = explode(" ", $line);
				$partition = $partition[count($partition)-1];
				$partitions = array();
				$partitions["path"] = $partition;
				
				$spaceusg = explode(" ", $line);
				$spaceusg_i = 1;
					foreach($spaceusg as $spacepart) 
					{
						if(strpos($spacepart, "G") || strpos($spacepart, "M")) 
						{
							if($spaceusg_i == 1) {
							$partitions["total"] = $spacepart;
							} elseif($spaceusg_i == 2) {
							$partitions["used"] = $spacepart;							
							} elseif($spaceusg_i == 3) {
							$partitions["free"] = $spacepart;							
							} else {
							$partitions[$spaceusg_i] = $spacepart;
							}					
							$spaceusg_i++;
						}
					}
					if(empty($partitions["free"])) 
					{ 
						$partitions["free"] = "0M";
					}
					if(strpos($partitions["total"], "M"))
					{
						$partitions["total"] = "0.".str_replace("M", "", $partitions["total"])."G";
					}
					if(strpos($partitions["used"], "M"))
					{
						$partitions["used"] = "0.".str_replace("M", "", $partitions["used"])."G";
					}
					if(strpos($partitions["free"], "M"))
					{
						$partitions["free"] = "0.".str_replace("M", "", $partitions["free"])."G";
					}						
				$partitions["%used"] = round(trim(str_replace("G", "", $partitions["used"]))/trim(str_replace("G", "", $partitions["total"]))*100);
				$space[] = $partitions;
				
			}
		}
	return $space;
}

function version() 
{
	$phpver = phpversion();
	$mysqlver = mysql_get_client_info();
	$zendver = zend_version();
	$versions = shell_exec("php -v");
	$ioncube_version = explode("ionCube PHP Loader", $versions);
	$ioncube_version = @explode(",", $ioncube_version[1]);
	$ioncube_version = $ioncube_version[0];
		if(empty($ioncube_version)) 
		{
			$ioncube_version = "N/A";
		}
	$apache_version = explode("/", apache_get_version());
	$apache_version = explode(" ", $apache_version[1]);
	$apache_version = $apache_version[0];
	if(empty($apache_version)) {
		$apache_version = explode("/", strtolower(exec("curl http://localhost/none | grep Apache")));
		$apache_version = explode(" ", $apache_version[1]);
		$apache_version = $apache_version[0];
	}
	$mysql_version = trim(shell_exec("php -i | grep 'Client API version' | cut -d' ' -f 5"));
	return array(
	"php" => $phpver, 
	"zend" => $zendver, 
	"ioncube" => $ioncube_version,
	"apache" => $apache_version,
	"mysql" => $mysqlver
	);
}

function linux_kernel() 
{
	return array(
	"distro" => trim(shell_exec("cat /etc/redhat-release")),
	"kernel" => trim(shell_exec("uname -a | awk '{print $3}'"))
	);
}

function cpu_info() 
{
	$cpu_count = trim(shell_exec("cat /proc/cpuinfo | grep processor | cut -d' ' -f 1 | sort | uniq -c | sort -n | awk '{print $1}'"));
	$cpu_info = shell_exec("cat /proc/cpuinfo");
	$cpu_manufacturer = explode("vendor_id", $cpu_info);
	$cpu_manufacturer = explode("\n", $cpu_manufacturer[1]);
		if(strpos(strtolower($cpu_manufacturer[0]), "amd")) 
		{
			$cpu_manufacturer = "AMD";
		} else 
		{
			$cpu_manufacturer = "Intel";
		}
	$model_name = explode("model name", $cpu_info);
	$model_name = explode("\n", $model_name[1]);
	$model_name = trim(str_replace(":", "", $model_name[0]));
	$speed = explode("cpu MHz", $cpu_info);
	$speed = explode("\n", $speed[1]);
	$speed = trim(str_replace(":", "", $speed[0]));
	return array(
	"cpu_count" => $cpu_count,
	"cpu_manufacturer" => $cpu_manufacturer,
	"model_name" => $model_name,
	"speed" => $speed
	);
}

function is_port_open($port = 80) 
{
	$port = @fsockopen("localhost", $port);
	@fclose($port);
	if($port) 
	{
	$port_["status"] = "Up";
	$port_["color"] = "#12f311";
	} else 
	{
	$port_["status"] = "Down";
	$port_["color"] = "#ff0000";
	}
	return $port_;
}

if($show_load == true) { $load = show_load(); }
if($show_memory_usage == true) { $mem_usage = show_mem_usage(); }
if($show_swap_usage == true) { $swap_usage = show_swap_usage(); }
if($show_space_usage == true) { $space_usage = show_space_usage(); }
if($php_version == true || $mysql_version == true || $zend_version == true || $ioncube_version == true || $apache_version == true) { $versions = version(); }
if($linux_kernel_version || $linux_distro_version) { $linux = linux_kernel(); }
if($cpu || $cpu_count || $cpu_speed) { $cpui = cpu_info(); }

?>