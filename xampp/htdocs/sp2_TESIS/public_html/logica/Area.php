<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Area
	{
	private $id;
	private $nombre;
	private $responsable;
	private $id_facultad;
	private $fabrica;
	private $conexion;
	
	function Area($datos)
		{	 
		$this->id=$datos[0];
		$this->nombre=$datos[1];
		$this->responsable=$datos[2];
		$this->id_facultad=$datos[3];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 
		
	function getId()
		{return $this->id;}

	function getNombre()
		{return $this->nombre;}

	function getResponsable()
		{return $this->responsable;}

	function getFacultad()
		{return $this->id_facultad;}
		
	function consultarTodos()
		{
		$this->conexion->ejecutar($this->fabrica->consultarTodos("area","id_facultad"));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Area($filas);
			$numReg++;
			}				
		return $registros;
		}   

	function insertar()
		{
		$datos=array(
			"nombre" => $this->nombre,
    		"responsable" => $this->responsable,
    		"id_facultad" => $this->id_facultad,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("area",$datos));		
		}   
		
	function consultar()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("area","id",$this->id));		
		$filas=$this->conexion->registro();		
		$this->id=$filas[0];
		$this->nombre=$filas[1];
		$this->responsable=$filas[2];
		$this->id_facultad=$filas[3];
		}   

	function actualizar()
		{
		$datos=array(
			"nombre" => $this->nombre,
    		"responsable" => $this->responsable,
    		"id_facultad" => $this->id_facultad,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("area",$datos,"id",$this->id));
		}   
	
	function consultarFacultad()
		{
		$condiciones=array(
			"id" => "='".$this->id_facultad."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultarCondiciones("facultad","nombre",$condiciones));
		$filas=$this->conexion->registro();
		return $filas[0];	
		}  
	
	function consultarAreaPrograma($id_facultad)
		{
		$condiciones=array(
			"id_facultad" => "='".$id_facultad."'",
			);	
		$this->conexion->ejecutar($this->fabrica->consultar("area","id_facultad",$id_facultad));
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=$filas;
			$numReg++;
			}				
		return $registros;
		}  
		
	}   	
?>