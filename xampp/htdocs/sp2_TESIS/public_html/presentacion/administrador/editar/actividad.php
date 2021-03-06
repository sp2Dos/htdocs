<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Actividad.php');	
	require_once('logica/Area.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Administrador(array($idPersona));
	$persona->consultarNombre();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$id=$_GET['idEdit'];
	$actividad = new Actividad(array($id));
	$actividad->consultar();
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/validarIngresarActividad.js"></script>
<script src="scripts/validarCorreo.js"></script>
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script>
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});

function validar()
	{
	if((mensaje=verificar(document.forms.Formulario))!="") 
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Area</em><p>'+mensaje+'</p>');return false;}
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
			<h3>Editar Proceso</h3>
			<form name="Formulario" method="post" action="index.php?id=265">
				<div align="center">
				<input type="hidden" name="id" value="<?php echo $actividad->getId() ?>" />
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Nombre</label><input name="nombre" type="text" value="<?php echo $actividad->getNombre() ?>"></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Area</label><select name="area">
				<option value="0">Seleccione</option>
				<?php 
				$area = new Area(array()); 
				$areas = $area->consultarTodos();		
				for($i=0; $i<count($areas); $i++)
					echo "<option value='".$areas[$i]->getId()."'",($areas[$i]->getId()==$actividad->getArea())? " selected" : "" ,">".$areas[$i]->getNombre()."</option>";
				?>				
				</select></fieldset>
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();">	
				</div>
			</form>
		</td>
	</tr>
</table>
</body>
</html>

	

