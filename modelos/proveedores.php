<?php

require_once("modelos/generico.php");

class proveedores extends generico{

	// Es el nombre y tiene entre 3 y 100 caracteres alfanumerico
	public $nombre;
	// Es la descrpcion del proveedor
	public $descripcion;

	protected $tabla = "proveedores";

	public function constructor($arrayDatos = array()){
	
		$this->nombre = $arrayDatos['nombre'];
		$this->descripcion = $arrayDatos['descripcion'];

	}

	public function cargar($id){

		$sql = "SELECT * FROM proveedores WHERE id = :id ";
		$arraySQL = array("id" => $id);
	
		$lista = $this->traerRegistros($sql, $arraySQL);

		if(isset($lista[0]['id'])){

			$this->nombre 		= $lista[0]['nombre'];
			$this->descripcion 	= $lista[0]['descripcion'];
			$this->id 			= $lista[0]['id'];			
			$retorno = true;

		}else{

			$retorno = false;

		}

		return $retorno;

	}



	public function ingresar(){
		/*
			En este metodo se encarga de ingresar los regisros
		*/		
	
		$sql = "INSERT proveedores SET
					nombre = :nombre,
					descripcion = :descripcion,
					estado = 1;
				";
		$arrayDatos = array(
			"nombre" => $this->nombre,
			"descripcion" => $this->descripcion
		);
		
		$respuesta = $this->ejecutar($sql, $arrayDatos);

		return $respuesta;

	}

	public function editar(){
		/*
			En este metodo se encarga de editar los registros
		*/

	
		$sql = "UPDATE proveedores SET
					nombre = :nombre,
					descripcion = :descripcion
					WHERE id = :id;
				";

		$arrayDatos = array(
			"id" => $this->id,
			"nombre" => $this->nombre,
			"descripcion" => $this->descripcion
		);

		$respuesta = $this->ejecutar($sql, $arrayDatos);

		return $respuesta;

	}

	public function borrar(){
		/*
			En este metodo se encarga de borrar los registros
		*/
		/*
			SELECT count(*) as total FROM contenidos WHERE id_proveedor = $this->id and estado = 1
			if(total > 0){
				no borramos el registro					
			}
		*/
		$sql = "UPDATE proveedores SET
					estado = '0'
				WHERE id = :id;
			";				
		$arrayDatos = array(
			"id" => $this->id
		);
		$respuesta = $this->ejecutar($sql, $arrayDatos);
		return $respuesta;
		
	}

	public function altas($listaProveedores){

		$sql = "UPDATE proveedores SET
					estado = '1'
				WHERE id IN (".$listaProveedores.");
			";				
		$respuesta = $this->ejecutar($sql);
		return $respuesta;

	}


	public function listar($filtro = array()){
		/*
			Este metodo se encarga de retornar una lista de registro de la base de datos
		*/
		$estado = isset($filtro['estado'])?$filtro['estado']:"1";	

		$sql = "SELECT * FROM proveedores
					WHERE estado = :estado 
				ORDER BY id";

		if(isset($filtro['inicio']) && isset($filtro['cantidad'])){
			$sql .= " LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";
		}		
					
		$arraySQL = array("estado" => $estado);

		$lista = $this->traerRegistros($sql, $arraySQL);

		return $lista;

	}

	public function totalRegistros(){

	
		$sql = "SELECT count(*) as total FROM ".$this->tabla." WHERE estado = 1";
		$lista = $this->traerRegistros($sql);
		if(isset($lista[0]['total'])){
			$retorno = $lista[0]['total'];		
		}else{
			$retorno = 0;		
		}
		return $retorno;

	}

}











?>