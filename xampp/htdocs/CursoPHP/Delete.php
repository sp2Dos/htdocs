<?php

if (!empty($_POST['myFile']))
{
	$myFileName = $_POST['myFile'];
	unlink($myFileName);
	echo "The file has been removed";
}
else
	echo "Must select a file";

?>