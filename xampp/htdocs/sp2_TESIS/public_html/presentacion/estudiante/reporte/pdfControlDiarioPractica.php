<?php
	require_once('html2pdf/html2pdf.class.php');
	require_once('logica/Convenio.php');
	require_once('logica/Estudiante.php');	
	require_once('logica/Convenio.php');	
	require_once('logica/Area.php');	
	require_once('logica/Empresa.php');	

	function UltimoDia($anho,$mes){
		if (((fmod($anho,4)==0) and (fmod($anho,100)!=0)) or (fmod($anho,400)==0)) { 
			$dias_febrero = 29;
		} else {
			$dias_febrero = 28;
		}
		switch($mes) {
			case '01': return 31; break;
			case '02': return $dias_febrero; break;
			case '03': return 31; break;
			case '04': return 30; break;
			case '05': return 31; break;
			case '06': return 30; break;
			case '07': return 31; break;
			case '08': return 31; break;
			case '09': return 30; break;
			case '10': return 31; break;
			case '11': return 30; break;
			case '12': return 31; break;
		}
	} 

	$idEstudiante=$_GET['idEstudiante'];
	$idConEstSup=$_GET['idConEstSup'];
	$fechaInicial=$_GET['fecha'];		
	$diaFinal=substr($fechaInicial,8,2)+6;
	$diasMes=UltimoDia(substr($fechaInicial,0,4),substr($fechaInicial,5,2));
	if($diaFinal>$diasMes){	
		$diaFinal-=$diasMes;
		$mesFinal=substr($fechaInicial,5,2);
		$mesFinal++;
		if($mesFinal<10){
			$mesFinal="0".$mesFinal;
		}
		if($diaFinal<10){
			$diaFinal="0".$diaFinal;
		}
		$fechaFinal=substr($fechaInicial,0,4)."-".$mesFinal."-".$diaFinal;				
	}else{
		if($diaFinal<10){
			$diaFinal="0".$diaFinal;
		}
		$fechaFinal=substr($fechaInicial,0,8).$diaFinal;	
	}
    $datos = array();
    $datos[0]=$idEstudiante;
	$estudiante = new Estudiante($datos);
 	$estudiante->consultar();
	$convenio = new Convenio(array()); 
	$controlesDiarios=$convenio->consultarControlDiarioPracticaFecha($idConEstSup,$fechaInicial,$fechaFinal);
	$datosReporte=$convenio->consultarDatosReportePDF($idConEstSup);
	$datos[0]=$datosReporte[11];
	$empresa=new Empresa($datos);
	$empresa->consultar();
	$datos[0]=$datosReporte[12];
	$area=new Area($datos);
	$area->consultar();
$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mesesitos=array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
$nombre_archivo = "pdf/ControlDiarioPractica_codEstudiante_".$idEstudiante."_Fecha_".$fechaInicial."_".$fechaFinal.".pdf";
$contenido = "
<html>
<body>
<table width='960' border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='130'></td>
		<td width='130'></td>
		<td width='130'></td>
		<td width='130'></td>
		<td width='130'></td>
		<td width='130'></td>
		<td width='130'></td>
		<td width='130'></td>
	</tr>
	<tr>
		<td align='center' border='0' colspan='2'><img src='img/logoSimboloTitulo.jpg'></td>
		<td align='center' border='0' colspan='4'><strong>CONTROL DIARIO DE PRACTICA<br>Generado por: SP2</strong></td>
		<td align='center' border='0' colspan='2'><em>Fecha y hora de impresion<br>".date("Y-m-d H:i")."</em></td>
	</tr>
	<tr bgcolor='#CFCFCF'>
		<td align='center' border='0' colspan='8'><strong>INFORMACION PRACTICA PROFESIONAL</strong></td>
	</tr>	
	<tr>
		<td align='left' border='0' colspan='3'><strong>Estudiante:</strong> <em><u>".$estudiante->getNombre()." ".$estudiante->getApellido()."</u></em></td>
		<td align='left' border='0' colspan='2'><strong>Codigo:</strong> <em><u>".$estudiante->getCodigo()."</u></em></td>
		<td align='left' border='0' colspan='1'><strong>Periodo:</strong> <em><u>".$datosReporte[10]."</u></em></td>
		<td align='left' border='0' colspan='3'><strong>Semana:</strong> <em><u>".$fechaInicial." a ".$fechaFinal."</u></em></td>
	</tr>
	<tr>
		<td align='left' border='0' colspan='3'><strong>Entidad:</strong> <em><u>".$empresa->getNombre()."</u></em></td>
		<td align='left' border='0' colspan='3'><strong>Convenio:</strong> <em><u>".$datosReporte[9]."</u></em></td>
		<td align='left' border='0' colspan='3'><strong>Area:</strong> <em><u>".$area->getNombre()."</u></em></td>
	</tr>	
	<tr>
		<td align='left' border='0' colspan='4'><strong>Supervisor Universitario:</strong> <em><u>".$datosReporte[2]." ".$datosReporte[3]."</u></em></td>
		<td align='left' border='0' colspan='4'><strong>Supervisor Entidad:</strong> <em><u>".$empresa->getSupervisor()."</u></em></td>
	</tr>
	<tr bgcolor='#CFCFCF'>
		<td align='center' border='0' colspan='8'><strong>INFORMACION ACTIVIDADES</strong></td>
	</tr>	
	<tr>
		<td align='center' border='1' colspan='1'><strong>Fecha<br>Hora<br>Duracion</strong></td>
		<td align='center' border='1' colspan='6'><strong>ACTIVIDADES</strong></td>
		<td align='center' border='1' colspan='1'><strong>VoBo<br>Supervisor<br>Entidad</strong></td>
	</tr>";
	
	for($i=0; $i<count($controlesDiarios); $i++)
		{
		$contenido.="<tr>					
		<td align='center' border='1' colspan='1'>".substr($controlesDiarios[$i][1],8,2)." de ".$mesesitos[substr($controlesDiarios[$i][1],5,2)-1]." de ".substr($controlesDiarios[$i][1],0,4)."<br>".substr($controlesDiarios[$i][2],0,5)." - ".substr($controlesDiarios[$i][3],0,5)."<br>".substr($controlesDiarios[$i][4],0,5)."</td>
		<td width='480' align='left' border='1' colspan='6'>".str_replace("\n","<br>",$controlesDiarios[$i][5])."</td>
		<td align='center' border='1' colspan='1'></td>
		</tr>";
		}
$contenido.="
	<tr><td align='center' border='1' colspan='8'><strong>TOTAL TIEMPO SEMANAL</strong></td></tr>
	<tr><td align='left' border='0' colspan='8'>Cumple con los tiempos establecidos  por la normatividad organizacional (horarios, reuniones, trabajos, ejecución del cronograma): SI <u>&nbsp;&nbsp;&nbsp;&nbsp;</u> NO <u>&nbsp;&nbsp;&nbsp;&nbsp;</u></td></tr>
	<tr><td align='left' border='0' colspan='2'><strong>OBSERVACIONES</strong></td></tr>
	<tr><td align='left' border='1' colspan='8'>.</td></tr>
	<tr><td align='left' border='0' colspan='4'><strong>ANOTACIONES DEL SUPERVISOR UNIVERSITARIO</strong></td></tr>
	<tr><td align='left' border='1' colspan='8'>.</td></tr>
	<tr><td align='left' border='0' colspan='2'>.</td></tr>
	<tr><td align='left' border='0' colspan='2'>.</td></tr>
	<tr><td align='left' border='0' colspan='2'>.</td></tr>
	<tr><td align='left' border='1' colspan='2'></td><td align='left' border='0' colspan='4'></td><td align='left' border='1' colspan='2'></td></tr>
	<tr><td align='center' border='0' colspan='2'>PROFESIONAL EN FORMACION</td><td align='left' border='0' colspan='4'></td><td align='center' border='0' colspan='2'>SUPERVISOR UNIVERSITARIO FUKL</td></tr>
</table>
</body>
</html>";
	require('html2fpdf/html2fpdf.php');
	$pdf=new HTML2FPDF();
	$pdf->AddPage("L");
	$pdf->WriteHTML($contenido);
	$pdf->Output($nombre_archivo);	
?>
<script>location.replace('<?php echo $nombre_archivo ?>');</script>