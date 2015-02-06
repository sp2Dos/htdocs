<?php 
require_once 'HTML/Progress/monitor.php';
	
$bar = new HTML_Progress();
$mon = new HTML_Progress_Monitor();

$li = $bar->getListeners();
printf("try 1: %d listener(s) <br/>", count($li));

$bar->addListener($mon);
$li = $bar->getListeners();
printf("try 2: %d listener(s) <br/>", count($li));
?>