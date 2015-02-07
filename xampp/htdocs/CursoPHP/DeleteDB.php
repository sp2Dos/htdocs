<?php
include("Connection.php");

$con = mysql_connect($host,$user,$pw) or die ("Error Connect to server");
mysql_select_db($dataBase,$con) or die ("Error Connect to DataBase");

$reg = mysql_query("SELECT id FROM prueba WHERE name = '$_POST[nameFmr]'",$con);

if ($re = mysql_fetch_array($reg)) {
	
	mysql_query("DELETE FROM prueba WHERE name = '$_POST[nameFmr]'",$con);
	echo "Th register has been removed";
}
?>