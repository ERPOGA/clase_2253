<?php


class proveedores {

	// Es el identificador del registro y es autonumerico
	public $id;
	// Es el nombre y tiene entre 3 y 100 caracteres alfanumerico
	public $nombre;
	// Es la descrpcion del proveedor
	public $descripcion;


	public function constructor($arrayDatos = array()){
	
		$this->nombre = $arrayDatos['nombre'];
		$this->descripcion = $arrayDatos['descripcion'];

	}

	public function ingresar(){
		/*
			En este metodo se encarga de ingresar los regisros
		*/

	}

	public function editar(){
		/*
			En este metodo se encarga de editar los registros
		*/
	}

	public function borrar(){
		/*
			En este metodo se encarga de borrar los registros
		*/
	}

	public function listar(){
		/*
			Este metodo se encarga de retornar una lista de registro de la base de datos
		*/
		$host = "localhost";
		$puerto = "3306";
		$usuario = "root";
		$clave = "";
		$db = "curso_2253";
		$conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT * FROM proveedores ORDER BY nombre";

		$mysqlPrepare = $conexion->prepare($sql);
		
		$mysqlPrepare->execute();	

		$lista = $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);

		return $lista;

	}




}











?>