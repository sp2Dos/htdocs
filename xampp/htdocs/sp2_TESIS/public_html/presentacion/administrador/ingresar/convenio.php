<?php 
	session_start();	
	require_once('logica/Administrador.php');	
	require_once('logica/Area.php');	
	require_once('logica/Actividad.php');	
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
	$nitEmpresa=$_GET['nitEmpresa'];
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/validarIngresarConvenio.js"></script>
<script src="scripts/validarCorreo.js"></script>
<link rel="stylesheet" href="estilos/sexyalertbox.css" type="text/css" media="all" />
<script src="scripts/mootools.js" type="text/javascript"></script>
<script src="scripts/sexyalertbox.packed.js" type="text/javascript"></script>
<script src="scripts/CalendarPopup.js" type="text/javascript"></script>
<script>document.write(getCalendarStyles());</script>
<script>
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</script>
<link rel="stylesheet" href="estilos/CalendarPopup.css" type="text/css" media="all" />
<script>
window.addEvent('domready', function() {
    Sexy = new SexyAlertBox();
});

function validar()
	{
	if((mensaje=verificar(document.forms.Formulario))!="") 
		{Sexy.alert('<h1>Alerta</h1><em>Validacion de Convenio</em><p>'+mensaje+'</p>');return false;}
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
			<h3>Agregar Convenio</h3>
			<form name="Formulario" method="post" action="index.php?id=272" enctype="multipart/form-data">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Nit Entidad</label><input type="text" name="nitEmpresa" value="<?php echo $nitEmpresa ?>" readonly="true" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Nombre</label><input type="text" name="nombre" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Supervisor</label><input type="text" name="supervisor" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha Inicial</label><input name="fechaInicial" type="text" id="fechaInicial" onclick="cal1xx.select(document.forms[0].fechaInicial,'fechaInicial','yyyy-MM-dd'); return false;" readonly="true" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha Final</label><input name="fechaFinal" type="text" id="fechaFinal" onclick="cal1xx.select(document.forms[0].fechaFinal,'fechaFinal','yyyy-MM-dd'); return false;" readonly="true" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Perido</label>
				<select name="periodo">
				<?php for($i=date("Y")+1; $i>=2009; $i--) echo "<option value='".$i."-2'>".$i."-2</option><option value='".$i."-1'>".$i."-1</option>"; ?>
				</select>
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Cupos Ofrecidos</label>
				<select name="cupos">
				<?php for($i=1; $i<=20; $i++) echo "<option value='".$i."'>".$i."</option>"; ?>
				</select>
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Visible</label><input name="visible" type="radio" value="1" class="checkbox" checked />SI<input name="visible" type="radio" value="0" class="checkbox" />NO</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Firmado</label><input name="firmado" type="radio" value="1" class="checkbox" />SI<input name="firmado" type="radio" value="0" class="checkbox" checked />NO</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Observaciones</label><textarea name="observaciones"></textarea></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Area</label><select name="area">
				<option value="0">Seleccione</option>
				<?php 
				$area = new Area(array()); 
				$areas = $area->consultarTodos();		
				for($i=0; $i<count($areas); $i++)
					echo "<option value='".$areas[$i]->getId()."'>".$areas[$i]->getNombre()."</option>";
				?>				
				</select></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">Actividades</label><br /><br /><div style="text-align:left; width: 300px ">
				<?php 
				$actividad = new actividad(array()); 
				$actividades = $actividad->consultarTodos();		
				for($i=0; $i<count($actividades); $i++)
					echo "<input type='checkbox' class='checkbox' name='actividades[]' value='".$actividades[$i]->getId()."'>".$actividades[$i]->getNombre()."</input><br>";
				?>				
				</div></fieldset>
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();">	
				</div>
			</form>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>

	

