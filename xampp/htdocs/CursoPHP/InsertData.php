<?php
	include("Connection.php");

	if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['pw']) && !empty($_POST['pw'])) 
	{
		$con = mysql_connect($host,$user,$pw) or die("Error to connect");
		mysql_select_db($dataBase, $con) or die("Error to connect");

		mysql_query("INSERT INTO prueba(name,pw) VALUES ('$_POST[name]','$_POST[pw]')",$con);

		echo "Insert OK";
	}
	else
		echo "Fileds Emptys";
?>