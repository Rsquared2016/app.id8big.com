<?php
//Start session
session_start();

//Set time limit to 0
ini_set('max_execution_time', 0);
//ini_set('display_errors', 1);

//Load lib
require_once "lib/export.php";

$repo = "svn://server/keetup/elggbase/trunk";
//Low revision, should be -1 the current revision you want.
$rev_low = 50; 

//The last revision or HEAD, should work ok.
$rev_hi = 'HEAD';

$onthefly = false;

//Proyect folder/zip name
$proyect_name = "elggbase_2010_12_31";

$debug = false;

$export = new Export($repo, $rev_hi, $rev_low, $proyect_name, $onthefly, $debug);
if ($export->export()) {
	if (!$onthefly) {
		$export->showSummary();
	}
	$export->zip();
}
