<?php

require_once("modelos/generico.php");

class directores extends generico{

	
	// Es el nombre y tiene entre 3 y 100 caracteres alfanumerico
	public $nombre;
	// Son los apellidos de los directores
	public $apellido;
	// Es la fecha de nacimiento del director y esta expresada YYYY-mm-dd
	public $fechaNacimiento;
	// El el pais donde nacio el director y esta expresado en CountryIso 2 digitos
	public $pais;

	public function constructor($arrayDatos = array()){
	
		$this->nombre = $arrayDatos['nombre'];
		$this->apellido = $arrayDatos['apellido'];
		$this->fechaNacimiento = $arrayDatos['fechaNacimiento'];
		$this->pais = $arrayDatos['pais'];

	}

	public function cargar($id){

		$sql = "SELECT * FROM directores WHERE id = :id ";
		$arraySQL = array("id" => $id);
	
		$lista = $this->traerRegistros($sql, $arraySQL);

		if(isset($lista[0]['id'])){

			$this->nombre 			= $lista[0]['nombre'];
			$this->apellido 		= $lista[0]['apellido'];
			$this->fechaNacimiento 	= $lista[0]['fechaNacimiento'];
			$this->pais 			= $lista[0]['pais'];
			$this->id 				= $lista[0]['id'];			
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
	
		$sql = "INSERT directores SET
					nombre = :nombre,
					apellido = :apellido,
					fecha_nacimiento = :fechaNacimiento,
					pais = :pais,
					estado = 1;
				";
		$arrayDatos = array(
			"nombre" => $this->nombre,
			"apellido" => $this->apellido,
			"fechaNacimiento" => $this->fechaNacimiento,
			"pais" => $this->pais
		);
		
		$respuesta = $this->ejecutar($sql, $arrayDatos);

		return $respuesta;

	}

	public function editar(){
		/*
			En este metodo se encarga de editar los registros
		*/

	
		$sql = "UPDATE directores SET
					nombre = :nombre,
					apellido = :apellido,
					fecha_nacimiento = :fechaNacimiento,
					pais = :pais,
					WHERE id = :id;
				";

		$arrayDatos = array(
			"id" => $this->id,
			"apellido" => $this->apellido,
			"fechaNacimiento" => $this->fechaNacimiento,
			"pais" => $this->pais
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
		$sql = "UPDATE directores SET
					estado = '0'
				WHERE id = :id;
			";				
		$arrayDatos = array(
			"id" => $this->id
		);
		$respuesta = $this->ejecutar($sql, $arrayDatos);
		return $respuesta;
		
	}

	public function listar($filtro = array()){
		/*
			Este metodo se encarga de retornar una lista de registro de la base de datos
		*/
		
		$sql = "SELECT * FROM directores
					WHERE estado = '1'
				ORDER BY id
					LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";

		$lista = $this->traerRegistros($sql);
		return $lista;

	}
	
	public function listaCorta(){
		/*
			Este metodo se encarga de retornar una lista de registro de la base de datos
		*/		
		$sql = "SELECT id, CONCAT(apellido, ' ', nombre) as nombreCompleto  FROM directores
					WHERE estado = '1'
				ORDER BY apellido, nombre";

		$lista = $this->traerRegistros($sql);
		return $lista;

	}

	

	public function totalRegistros(){
	
		$sql = "SELECT count(*) as total FROM directores WHERE estado = 1";
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