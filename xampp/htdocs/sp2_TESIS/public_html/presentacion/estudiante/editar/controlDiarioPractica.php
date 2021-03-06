<?php 
	session_start();	
	require_once('logica/Supervisor.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Area.php');	
	$idPersona=$_SESSION['idPersona'];
	if($idPersona=="")
		{
		?>
		<script>location.replace('index.php');</script>	
		<?php	
		}
	$persona = new Estudiante(array($idPersona));
	$persona->consultarNombre();
	if($persona->getNombre()=="")
		{
		?>
		<script>location.replace('index.php?id=-1');</script>	
		<?php			
		}
	$idCDP=$_GET['idCDP'];
	$idConEstSup=$_GET['idConEstSup'];	
	$actualizado=false;
	if(!empty($_POST['enviar']))
		{
		$convenio = new Convenio(array()); 
		$convenio->actualizarControlDiarioPractica($idCDP,$_POST['fecha'],$_POST['horaEntrada'],$_POST['horaSalida'],$_POST['duracion'],$_POST['actividades'],$idConEstSup);		
		$actualizado=true;
		}
	$convenio = new Convenio(array($idCDP)); 
	$controlDiario=$convenio->consultarControlDiarioPracticaId($idCDP);	
//	echo($controlDiario[2]);
//		echo($controlDiario[3]);
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/CalendarPopup.js" type="text/javascript"></script>
<script>document.write(getCalendarStyles());</script>
<script>
var cal1xx = new CalendarPopup("testdiv1");
cal1xx.showNavigationDropdowns();
</script>
<script>
function calcularDuracion()
	{
	entrada=document.forms.Formulario.horaEntrada;
	hentrada=entrada[entrada.selectedIndex].value
	salida=document.forms.Formulario.horaSalida;
	hsalida=salida[salida.selectedIndex].value
	duracion=document.forms.Formulario.duracion;
	tiempoE=hentrada.split(":");
	tiempoS=hsalida.split(":");
	if(parseInt(tiempoE[0])>parseInt(tiempoS[0]) || parseInt(tiempoE[0])==parseInt(tiempoS[0])&& parseInt(tiempoE[1])>=parseInt(tiempoS[1]))
		{
		alert("La hora de Salida debe ser mayor a la hora de entrada");entrada.selectedIndex=salida.selectedIndex;
		duracion.value="1:00";
		}
	else
		{
		horas=parseInt(tiempoS[0])-parseInt(tiempoE[0]);
		minutos=parseInt(tiempoS[1])-parseInt(tiempoE[1]);
		if(minutos<0)
			{
			horas--;
			minutos+=60;
			}
		if(minutos==0)
			duracion.value=horas+":0"+minutos;
		else
			duracion.value=horas+":"+minutos;	
		}
	}
</script>
<link rel="stylesheet" href="estilos/CalendarPopup.css" type="text/css" media="all" />
</head>
<body>
<div align="center"><?php include("presentacion/banner.php")?></div>
<div align="right">Usted esta en el sistema como Estudiante: <?php echo $persona->getNombre() . " " . $persona->getApellido(); ?></div>
<table class="tabla">
	<tr>
		<td class="menu"><?php include("presentacion/menuEstudiante.php");?></td>		
		<td valign="top">
			<h3>Editar Actividad en Control Diario de Practica</h3>
			<?php if($actualizado) {echo "<div align='center' class='rojo'><strong>El registro fue actualizado correctamente.</strong></div>";} ?>
			<form name="Formulario" method="post" action="index.php?id=109&idCDP=<?php echo $idCDP ?>&idConEstSup=<?php echo $idConEstSup ?>">
				<div align="center">
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Fecha</label><input name="fecha" type="text" id="fecha" onclick="cal1xx.select(document.forms[0].fecha,'fecha','yyyy-MM-dd'); return false;" readonly="true" value="<?php echo $controlDiario[1] ?>" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora Entrada</label>
				<select name="horaEntrada" onchange="calcularDuracion()">
				<?php
					for($i=6;$i<=22;$i++)
					{
						for($j=0;$j<=50;$j+=10)
						{
							if($j==0)
								$h=$i.":00";
							else
								$h=$i.":".$j;
							echo "<option value='".$h."' ",($i==substr($controlDiario[2], 0,2)+0 && $j==substr($controlDiario[2], 3,2)+0)?"selected>": ">", $h."</option>";	
						}						
					}		
				?>
				</select>				
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Hora Salida</label>
				<select name="horaSalida" onchange="calcularDuracion()">
				<?php
					for($i=6;$i<=22;$i++)
					{
						for($j=0;$j<=50;$j+=10)
						{
							if($j==0)
								$h=$i.":00";
							else
								$h=$i.":".$j;
							echo "<option value='".$h."' ",($i==substr($controlDiario[3], 0,2)+0 && $j==substr($controlDiario[3], 3,2)+0)?"selected>": ">",$h."</option>";	
						}						
					}		
				?>
				</select>								
				</fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Duracion</label><input type="text" name="duracion" readonly="true" value="<?php echo substr($controlDiario[4],0,5) ?>" /></fieldset>
				<fieldset><label class="impar" onMouseOver="this.className='verde'" onMouseOut="this.className='impar'">*Actividades</label>
				<textarea name="actividades" rows="10"><?php echo $controlDiario[5] ?></textarea>
				</fieldset>
				<input name="enviar" type="submit" value="Enviar" onClick="return validar();" />	
				</div>
			</form>
		</td>
	</tr>
</table>
<div id='testdiv1' style="VISIBILITY: hidden; POSITION: absolute; BACKGROUND-COLOR: white; layer-background-color: white"></div>
</body>
</html>

	

