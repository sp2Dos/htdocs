<?php

$archivo = fopen("a.txt" , "r") or die("Problemas al abrir el archivo");

	while ( !feof($archivo)) {
		
		$getFile = fgets($archivo);
		$saltoLinea = nl2br($getFile);
		echo $saltoLinea;
	}
?>