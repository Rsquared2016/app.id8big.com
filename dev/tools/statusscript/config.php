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

/** 
* Configuration File 
* All below are configurable options 
* Enter "true" or "false"
**/
$server_name =				"KeetupStatus";
/* Set to true to show server load (seen in ssh uptime command) */
$show_load = 				true ;
/* Set to true to show RAM usage & RAM total */
$show_memory_usage = 		true ;
/* Set to true to show Swap usage */
$show_swap_usage = 			true ;
/* Set to true to show space usage (will list % usage for each 
* parition and total space available to server */
$show_space_usage = 		true ;
/* Show uptime (seen in ssh uptime command) */
$show_uptime =				true ;

/** 
* Status display:
* To display status, enter the port used for the specific service
* Eg. port 80 for HTTP
* Or to not display status, simply type "false".
* Eg. $show_http_status = false ;
**/
/* Show HTTP Status */
$show_http_status = 		80 ;
/* Show HTTPS Status */
$show_https_status = 		443 ;
/* Show FTP Status */
$show_FTP_status = 			21 ;
/* Show POP3 Status */
$show_pop3_status = 		110 ;
/* Show SMTP Status */
$show_smtp_status = 		25 ;
/* Show MySQL Status */
$show_MySQL_status = 		3306 ;
/* Show DNS Status */
$show_DNS_status = 			53 ;
/* Custom service (name) 
Ex. DirectAdmin */
$config_option_name = 		"ISPConfig" ;
/* Custom Service (port) 
Ex. 2222 */
$config_option_port =		81 ;

/**
* Version display
* Leave as true or false to display or not display version info
* If errors, or not displaying, you can override by entering the version 
* number
* Eg. $php_version = "5.2.2";
**/
$php_version = 				true ;
$mysql_version = 			true ;
$zend_version = 			true ;
$ioncube_version =			true ;
$apache_version = 			true ;
$linux_distro_version = 	true ;
$linux_kernel_version = 	true ;

/**
* Physical Hardware Display
* To show or hide set as true or false
* To override errors set value as desired info
* E.g. $cpu = 
**/

$cpu = 						true ;
$cpu_count = 				true ;
$cpu_speed =				true ;


?>

