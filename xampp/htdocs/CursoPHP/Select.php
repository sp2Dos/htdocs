<?php
include("Connection.php");

$bool = false;
$con = mysql_connect($host,$user,$pw) or die ("Error Connect to server");
mysql_select_db($dataBase,$con) or die ("Error Connect to DataBase");

$register = mysql_query("SELECT * FROM prueba WHERE name = '$_POST[nameFmr]'") or die ("Error consult: ".mysql_error());

while ($reg = mysql_fetch_array($register)) {
	
	$bool = true;
	echo $reg['name']."<br>";
	echo $reg['pw']."<br>";
}
?>