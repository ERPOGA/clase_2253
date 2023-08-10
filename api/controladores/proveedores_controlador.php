<?php

	require_once("modelos/proveedores.php");

	class proveedores_controlador {


		public function ingresar($arrayEntrada){


			$objProveedores = new proveedores();
			$arrayDatos = array();
			
			$arrayDatos['nombre'] = isset($arrayEntrada['txtNombre'])?$arrayEntrada['txtNombre']:"";
			$arrayDatos['descripcion'] = isset($arrayEntrada['txtDescripcion'])?$arrayEntrada['txtDescripcion']:"";
	
			if($arrayDatos['nombre'] != "" && $arrayDatos['descripcion'] != ""){
				
				$objProveedores->constructor($arrayDatos);
				$respuesta = $objProveedores->ingresar();
				if($respuesta){
					$retorno = "Se ingreso el registro correctamente";
				}else{
					$retorno = "Error al ingresar registro";
				}
				return $retorno;

			}else{
				$retorno = "Por favor enviar datos completos";
			}
			return $retorno;

		}


	}



?>