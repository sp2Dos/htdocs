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
<link rel="stylesheet" href="estilos/toolTip.css"> 
<script src="scripts/toolTip.js"></script>
<script language="Javascript">
function confirmacion(parametro){
	return confirm('Esta seguro que desea eliminar la empresa con NIT: '+parametro+ '?');
}
function mensaje(men,parametro){
	if(men==1)
		ddrivetip('Editar la Entidad con NIT: '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==2)
		ddrivetip('Agregar convenio a la Entidad con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)	
	else if(men==3)
		ddrivetip('Consultar convenios de la Entidad con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==4)
		ddrivetip('Colocar No visible la Entidad con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==5)
		ddrivetip('Colocar visible la Entidad con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
	else if(men==6)
		ddrivetip('Eliminar Entidad con NIT '+parametro,((parametro.length*8)>200)?parametro.length*8:200)
}
</script>
<script src="scripts/ajax.js"></script>
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Coordinador de Prácticas: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuAdministrador.php");?></td>		
		<td valign="top">
			<h3>Consultar Entidad</h3>
			<div align="center">
			<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nombre</label><input type="text" id="q" name="q" value="<?php echo $q ?>" autocomplete='off' onKeyUp="return buscar(11,'')"></fieldset><span id="loading"></span>
			</div>
    		<div id="resultados"></div>
		</td>
	</tr>
</table>
</body>
</html>

	