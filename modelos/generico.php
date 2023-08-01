
<?php

	class generico {

		// Es el identificador del registro y es autonumerico
		public $id;
				
		protected function traerRegistros($sql, $arrayDatos = array()){

			try{
				if(file_exists("configuracion/db.php")){
					include("configuracion/db.php");
				}
				$host = isset($BASEDATOS['host'])?$BASEDATOS['host']:"localhost";
				$puerto = isset($BASEDATOS['puerto'])?$BASEDATOS['puerto']:"3306";
				$usuario = isset($BASEDATOS['usuario'])?$BASEDATOS['usuario']:"root";
				$clave = isset($BASEDATOS['clave'])?$BASEDATOS['clave']:"";
				$db = isset($BASEDATOS['db'])?$BASEDATOS['db']:"curso_2253";
				$conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$mysqlPrepare = $conexion->prepare($sql);		
				$mysqlPrepare->execute($arrayDatos);	
				$lista = $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);		

			}catch(Exception $error){

				print_r($error->getMessage());
				$lista = false;

			}

			return $lista;


		}

		public function ejecutar($sql, $arraySQL = array()){

			try{

				if(file_exists("configuracion/db.php")){
					include("configuracion/db.php");
				}
				$host = isset($BASEDATOS['host'])?$BASEDATOS['host']:"localhost";
				$puerto = isset($BASEDATOS['puerto'])?$BASEDATOS['puerto']:"3306";
				$usuario = isset($BASEDATOS['usuario'])?$BASEDATOS['usuario']:"root";
				$clave = isset($BASEDATOS['clave'])?$BASEDATOS['clave']:"";
				$db = isset($BASEDATOS['db'])?$BASEDATOS['db']:"curso_2253";
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

		public function constructor($arrayDatos = array()){}
	
		public function cargar($id){}

		public function listar($filtro = array()){}

		public function listarPaises(){
			/*
				Este metodo devuelve una lista de paises			
			*/
			$arrayRetono = array();	
			$arrayRetono[] = ["nombre"=>"Uruguay", "countryIso"=>"UY"];
			$arrayRetono[] = ["nombre"=>"Estados Unidos", "countryIso"=>"US"];
			$arrayRetono[] = ["nombre"=>"Argentina", "countryIso"=>"AR"];
			$arrayRetono[] = ["nombre"=>"Alemania", "countryIso"=>"DE"];
			$arrayRetono[] = ["nombre"=>"Reino Unido", "countryIso"=>"UK"];
			$arrayRetono[] = ["nombre"=>"Mexico", "countryIso"=>"MX"];

			return $arrayRetono;

		}


	}






?>