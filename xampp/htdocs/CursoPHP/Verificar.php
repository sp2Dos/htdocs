<?php
session_start();

if (isset($_SESSION['username'])) 
{
	echo "You can see this page";
	echo "<br><a href=Destroye.php>Session Close </a>";
}
else
echo "You can't see this page, register and init session";
?>