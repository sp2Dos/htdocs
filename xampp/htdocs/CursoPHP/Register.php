<?php
include("Connection.php");
if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['user']) && !empty($_POST['user'])
	&& isset($_POST['pwd']) && !empty($_POST['pwd']) && isset($_POST['RptPwd']) && !empty($_POST['RptPwd'])
	&& isset($_POST['email']) && !empty($_POST['email'])) 
{
	if ($_POST['pwd'] == $_POST['RptPwd']) 
	{
		$con = mysql_connect($host,$user,$pw) or die("Error --> Server");
		mysql_select_db($dataBase,$con) or die("Error --> DataBase");

		mysql_query("INSERT INTO register (name,user,pwd,email) VALUES ('$_POST[name]','$_POST[user]','$_POST[pwd]','$_POST[email]')",$con);
		echo "Insert Data: "."<br>";

		echo "Name: ".$_POST['name']."<br>";
		echo "User: ".$_POST['user']."<br>";
		echo "Password: ".$_POST['pwd']."<br>";
		echo "E-mail: ".$_POST['email']."<br>";
	}
	else
		echo "The passsword not equals";
}
else
	echo "Emptys Fields";
?>