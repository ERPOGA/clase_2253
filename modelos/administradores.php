<?php

	require_once("modelos/generico.php");

	class administradores extends generico{

		public $nombre;

		public $mail;

		protected $clave;

		public $perfil;

		public function construnctor($arrayDatos){

			$this->nombre = $arrayDatos['nombre'];
			$this->mail = $arrayDatos['mail'];
			$this->clave = $arrayDatos['clave'];
			$this->perfil = $arrayDatos['perfil'];	

		}

		public function login($usuario, $clave){

			$sql = "SELECT * FROM administradores 
						WHERE (nombre = :nombre OR email = :mail)
							AND clave = :clave AND estado = 1";
			$arraySQL = array("nombre" => $usuario, "mail" => $usuario, "clave"=>md5($clave));

			$registro = $this->traerRegistros($sql, $arraySQL);

			if(isset($registro[0]['id'])){

				$this->id = $registro[0]['id'];
				$this->nombre= $registro[0]['nombre'];
				$this->mail = $registro[0]['email'];
				$this->perfil = $registro[0]['perfil'];
				$retorno = true;

			}else{
				$retorno = false;
			}

			return $retorno;

		}

		public function cargar($id){

			$sql = "SELECT * FROM administradores WHERE id = :id ";
			$arraySQL = array("id" => $id);
		
			$lista = $this->traerRegistros($sql, $arraySQL);
	
			if(isset($lista[0]['id'])){
	
				$this->nombre 	= $lista[0]['nombre'];
				$this->mail 	= $lista[0]['email'];
				$this->id 		= $lista[0]['id'];			
				$retorno = true;

			}else{
	
				$retorno = false;
	
			}
	
			return $retorno;
	
		}

		public function editar(){
			/*
				En este metodo se encarga de editar los registros
			*/
			$sql = "UPDATE administradores SET
							nombre = :nombre,
							email = :mail
						WHERE id = :id;
					";	
			$arrayDatos = array(
				"id" => $this->id,
				"nombre" => $this->nombre,
				"mail" => $this->mail
			);
	
			$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
	
		}

		public function cambiarClave($clave, $nuevaClave, $conClave){

			// All#152Trece&
			//$largoClave = strlen($nuevaClave);

			$resultado = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $nuevaClave);

			if($resultado == 0){
				$retorno = "La clave no tiene el valor esperado <br>
							La clave tiene que tener un minimo de 8 caracteres.
							Dentro de los 8 tiene que tener mayusculas, minusculas, numeros 
							y alguno de los siguentes caracteres especiales @$!%*#?&
							";
				return $retorno;
			}

			// Primero verificamos si las clave nueva y la confirmacion son iguales
			if( !($nuevaClave === $conClave) ){
				$retorno = "Las clave nueva y la confirmacion no coinciden";
				return $retorno;
			}
			// Verificamos si la clave original coincide con las guardada por el usuario
			$sql = "SELECT * FROM administradores 
						WHERE id = ".$this->id." AND clave = :clave";
			$arraySQL = array("clave"=>md5($clave));
			$registro = $this->traerRegistros($sql, $arraySQL);
			// Entramos en esta parte de aca si no existe el registro
			if(!isset($registro[0]['id'])){
				$retorno = "Las clave no es la correcta";
				return $retorno;
			}

			// Si estan todos los chequeos OK procedo a cambiar la clave
			$sql = "UPDATE administradores SET
						clave = :clave
					WHERE id = :id;
				";	
			$arrayDatos = array(
				"id" => $this->id,
				"clave" => md5($nuevaClave)
			);
			$respuesta = $this->ejecutar($sql, $arrayDatos);
			return $respuesta;

		}


	}








?>



