<html>
	<head> 
		<title> Inserccion de importes en </title>
	</head>
	<body>
		<form>
		<center><td colspan="2" align ="center"><h1>Adicionar Clientes</h1></td></center>
		<table align="center" width="225" cellspacing="2" cellpadding="2" border="0">
		</form>
		<form>
		<LEFT> <td colspan="2" align="left"><h3>Cliente insertado</h3></td></LEFT>
		<table align="left" width="100" cellspacing="2" cellpadding="2" border="0">
		</form>
		<?
		$v_cod_cliente=$_GET["cod_cliente"];
		$v_nom_cliente="'".$GET["nom_cliente"]."'";
		
		$conexion = pg_connect("host=localhost port=5432 dbname=ventas user=postgres password=123");
		$sql = "INSERT INTO cliente(cod_cliente, nom_cliente) VALUES ($v_cod_cliente, $v_nom_cliente)";
		$result = pg_Exec($conexion,$sql);
		$sql = "select cod_cliente, nom_cliente from cliente where cod_cliente = $v_cod_cliente";
		$result = pg_Exec($conexion,$sql);
		while($row = pg_fetch_array($result))
		{
			echo $row["cod_cliente"]."-->".$row["nom_cliente"];
		}
		echo "<br>";
		?>
	</body>
</html>