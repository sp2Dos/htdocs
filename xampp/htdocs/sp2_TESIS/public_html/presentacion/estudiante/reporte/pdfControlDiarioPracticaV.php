<?php
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
	$datos[0]=$datosReporte[12];
	$empresa=new Empresa($datos);
	$empresa->consultar();
	$datos[0]=$datosReporte[13];
	$area=new Area($datos);
	$area->consultar();
$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mesesitos=array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
$nombre_archivo = "pdf/ControlDiarioPractica_codEstudiante_".$idEstudiante."_Fecha_".$fechaInicial."_".$fechaFinal.".pdf";


$contenido = "
<html>
<body>
<table width='720' border='0' align='center' cellpadding='0' cellspacing='0'>
	<tr>
		<td width='120'></td>
		<td width='120'></td>
		<td width='120'></td>
		<td width='120'></td>
		<td width='120'></td>
		<td width='120'></td>
	</tr>
	<tr>
		<td align='center' border='0' colspan='2'><img src='img/logoSimboloTitulo.jpg'></td>
		<td align='center' border='0' colspan='2'><strong>CONTROL DIARIO DE PRACTICA<br>Generado por: SP2</strong></td>
		<td align='center' border='0' colspan='2'><em>Fecha y hora de impresion<br>".date("Y-m-d H:i")."</em></td>
	</tr>
	<tr bgcolor='#CFCFCF'>
		<td align='center' border='0' colspan='6'><strong>INFORMACION PRACTICA PROFESIONAL</strong></td>
	</tr>	
	<tr>
		<td align='left' border='0' colspan='3'><strong>Estudiante:</strong> <em><u>".$estudiante->getNombre()." ".$estudiante->getApellido()."</u></em></td>
		<td align='left' border='0' colspan='2'><strong>Codigo:</strong> <em><u>".$estudiante->getCodigo()."</u></em></td>
		<td align='left' border='0' colspan='1'><strong>Periodo:</strong> <em><u>".$datosReporte[10]."</u></em></td>
	</tr>
	<tr>
		<td align='left' border='0' colspan='3'><strong>Entidad:</strong> <em><u>".$empresa->getNombre()."</u></em></td>
		<td align='left' border='0' colspan='3'><strong>Sup. Ent.:</strong> <em><u>".$datosReporte[11]."</u></em></td>
	</tr>	
	<tr>
		<td align='left' border='0' colspan='3'><strong>Sup.Univ.:</strong> <em><u>".$datosReporte[2]." ".$datosReporte[3]."</u></em></td>
		<td align='left' border='0' colspan='3'><strong>Semana:</strong> <em><u>".$fechaInicial." a ".$fechaFinal."</u></em></td>
	</tr>
	<tr>
		<td align='left' border='0' colspan='2'><strong>Area:</strong> <em><u>".$area->getNombre()."</u></em></td>
		<td align='left' border='0' colspan='4'><strong>Convenio:</strong> <em><u>".$datosReporte[9]."</u></em></td>
	</tr>
	<tr bgcolor='#CFCFCF'>
		<td align='center' border='0' colspan='6'><strong>INFORMACION ACTIVIDADES</strong></td>
	</tr>	
	<tr>
		<td align='center' border='1' colspan='1'><strong>Fecha<br>Hora, Duracion</strong></td>
		<td align='center' border='1' colspan='4'><strong>ACTIVIDADES</strong></td>
		<td align='center' border='1' colspan='1'><strong>VoBo<br>Sup. Entidad</strong></td>
	</tr>";
	$tiempoTotal=0;
	$horaTotal=0;
	$minutoTotal=0;
	for($i=0; $i<count($controlesDiarios); $i++)
		{
		$contenido.="<tr>					
		<td align='center' border='1' colspan='1'>".substr($controlesDiarios[$i][1],8,2)."/".$mesesitos[substr($controlesDiarios[$i][1],5,2)-1]."/".substr($controlesDiarios[$i][1],0,4)."<br>".substr($controlesDiarios[$i][2],0,5)." - ".substr($controlesDiarios[$i][3],0,5).", ".substr($controlesDiarios[$i][4],0,5)."</td>
		<td border='1' colspan='4'>".$controlesDiarios[$i][5]."<br>.</br><br>.</br><br>.</br><br>.</br></td>
		<td align='center' border='1' colspan='1'></td>
		</tr>";
		$horaTotal+=substr($controlesDiarios[$i][4],0,2);
		$minutoTotal+=substr($controlesDiarios[$i][4],3,2);
		}
	$horasAdicionales=(int)($minutoTotal/60);
	$horaTotal+=$horasAdicionales;
	$minutoTotal=$minutoTotal%60;
$contenido.="
	<tr><td align='center' border='1' colspan='6'><strong>TOTAL TIEMPO SEMANAL: ".$horaTotal." horas, ".$minutoTotal." minutos</strong></td></tr>
	<tr><td align='left' border='0' colspan='6'>Cumple con los tiempos establecidos  por la normatividad organizacional: SI <u>&nbsp;&nbsp;&nbsp;&nbsp;</u> NO <u>&nbsp;&nbsp;&nbsp;&nbsp;</u></td></tr>
	<tr><td align='left' border='1' colspan='6'><strong>OBSERVACIONES: </strong></td></tr>
	<tr><td align='left' border='1' colspan='6'>.</td></tr>
	<tr><td align='left' border='1' colspan='6'><strong>ANOTACIONES DEL SUPERVISOR UNIVERSITARIO:</strong></td></tr>
	<tr><td align='left' border='1' colspan='6'>.</td></tr>
	<tr><td align='left' border='0' colspan='2'>.</td></tr>
	<tr><td align='left' border='0' colspan='2'>.</td></tr>
	<tr><td align='left' border='0' colspan='2'>.</td></tr>
	<tr><td align='left' border='1' colspan='2'></td><td align='left' border='0' colspan='2'></td><td align='left' border='1' colspan='2'></td></tr>
	<tr><td align='center' border='0' colspan='2'>PROFESIONAL EN FORMACION</td><td align='left' border='0' colspan='2'></td><td align='center' border='0' colspan='2'>SUPERVISOR FUKL</td></tr>
</table>
</body>
</html>";
	require('html2fpdf/html2fpdf.php');
	$pdf=new HTML2FPDF();
	$pdf->AddPage("P");
	$pdf->WriteHTML($contenido);
	$pdf->Output($nombre_archivo);	
?>
<script>location.replace('<?php echo $nombre_archivo ?>');</script>