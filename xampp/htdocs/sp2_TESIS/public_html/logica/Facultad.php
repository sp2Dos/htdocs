<?php
require_once('persistencia/Fabrica.php');
require_once('persistencia/Conexion.php');

class Facultad
	{
	private $id;
	private $nombre;
	private $decano;
	private $coordinador;
	private $telefono;
	private $fabrica;
	private $conexion;
	
	function Facultad($datos)
		{	 
		$this->id=$datos[0];
		$this->nombre=$datos[1];
		$this->decano=$datos[2];
		$this->coordinador=$datos[3];
		$this->telefono=$datos[4];
		$this->fabrica = new Fabrica();
		$this->conexion = new Conexion();
		} 
		
	function getId()
		{return $this->id;}

	function getNombre()
		{return $this->nombre;}

	function getDecano()
		{return $this->decano;}

	function getCoordinador()
		{return $this->coordinador;}

	function getTelefono()
		{return $this->telefono;}

	function consultarTodos()
		{
		$this->conexion->ejecutar($this->fabrica->consultarTodos("facultad","nombre"));		
		$registros = array();
		$numReg=0;
		while($filas=$this->conexion->registro())
			{
			$registros[$numReg]=new Facultad($filas);
			$numReg++;
			}				
		return $registros;
		}   

	function insertar()
		{
		$datos=array(
			"id" => $this->id,
			"nombre" => $this->nombre,
    		"decano" => $this->decano,
    		"coordinador" => $this->coordinador,
    		"telefono" => $this->telefono,
			);				
		$this->conexion->ejecutar($this->fabrica->insertar("facultad",$datos));		
		}   

	function consultar()
		{
		$this->conexion->ejecutar($this->fabrica->consultar("facultad","id",$this->id));		
		$filas=$this->conexion->registro();		
		$this->id=$filas[0];
		$this->nombre=$filas[1];
		$this->decano=$filas[2];
		$this->coordinador=$filas[3];
		$this->telefono=$filas[4];
		}   

	function actualizar()
		{
		$datos=array(
			"nombre" => $this->nombre,
    		"decano" => $this->decano,
    		"coordinador" => $this->coordinador,
    		"telefono" => $this->telefono,
			);				
		$this->conexion->ejecutar($this->fabrica->actualizar("facultad",$datos,"id",$this->id));
		}   
		
	}   	
?>