<?php


class proveedores {

	// Es el identificador del registro y es autonumerico
	public $id;
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

		$host = "localhost";
		$puerto = "3306";
		$usuario = "root";
		$clave = "";
		$db = "curso_2253";
		$conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT * FROM proveedores WHERE id = :id ";
		$arraySQL = array("id" => $id);

		$mysqlPrepare = $conexion->prepare($sql);		
		$mysqlPrepare->execute($arraySQL);	
		$lista = $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);

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

	public function listar($filtro = array()){
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

		$sql = "SELECT * FROM proveedores
					WHERE estado = '1'
				ORDER BY id
					LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";

		$mysqlPrepare = $conexion->prepare($sql);
		
		$mysqlPrepare->execute();	

		$lista = $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);

		return $lista;

	}


	protected function ejecutar($sql, $arraySQL = array()){

		try{

			$host = "localhost";
			$puerto = "3306";
			$usuario = "root";
			$clave = "";
			$db = "curso_2253";
			$conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$stm = $conexion->prepare($sql);
			$respuesta = $stm->execute($arraySQL);

		}catch(Exception $error){

			print_r($error->getMessage());
			$respuesta = false;

		}
		return $respuesta;

	}


	public function totalRegistros(){

		$host = "localhost";
		$puerto = "3306";
		$usuario = "root";
		$clave = "";
		$db = "curso_2253";
		$conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT count(*) as total FROM ".$this->tabla." WHERE estado = 1";

		$mysqlPrepare = $conexion->prepare($sql);	
		$mysqlPrepare->execute();	
		$lista = $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);

		if(isset($lista[0]['total'])){
			$retorno = $lista[0]['total'];		
		}else{
			$retorno = 0;		
		}

		return $retorno;

	}

}











?>