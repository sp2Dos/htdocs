<html>
	<head> 
		<title>Ejemplo conexión de PHP con postgreSQL</title>
	</head>
	<body>
		<?
		 $conexion = pg_connect("host = localhost port= 5432 dbname = postgres user = postgres password = 123");
		 $sql = "Select * from FACTURA_WEB";
		 $result = pg_exec($conexion,$sql);
		 while($row = pg_fetch_array($result))
		 {
		 	echo $row["cod_factura"]."--->".$row["nom_factura"]."--->".$row["val_factura"];
		 	echo "<br>";
		 }
		 pg_close($conexion);
        ?>
	</body>		
</html>