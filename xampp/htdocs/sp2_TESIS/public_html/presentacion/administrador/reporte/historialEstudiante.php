<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Administrador(array($idPersona));
	$persona->consultar();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$q=$_GET['q'];
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/ajax.js"></script>
<script>
function abrir(pagina) {
	window.open(pagina, 'null', 'height=500,width=600,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');
}
</script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
			<h3>Reporte Historial Estudiante</h3>
			<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre o Apellido</label><input type="text" id="q" name="q" value="<?php echo $q ?>" autocomplete='off' onKeyUp="return buscar(33,'')" /></fieldset><span id="loading"></span>
			</div>
    		<div id="resultados"></div>
		</td>
	</tr>
</table>
</body>
</html>

	