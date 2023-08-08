<?php

	require_once("modelos/proveedores.php");

	class proveedores_controlador {


		public function ingresar($arrayEntrada){


			$objProveedores = new proveedores();
			$arrayDatos = array();
			
			$arrayDatos['nombre'] = isset($arrayEntrada['txtNombre'])?$arrayEntrada['txtNombre']:"";
			$arrayDatos['descripcion'] = isset($arrayEntrada['txtDescripcion'])?$arrayEntrada['txtDescripcion']:"";
	
			if($arrayDatos['nombre'] != "" && $arrayDatos['descripcion'] != ""){
				
				print_r($arrayDatos);
				$objProveedores->constructor($arrayDatos);
				$respuesta = $objProveedores->ingresar();
				return $respuesta;

			}	
			return false;

		}


	}



?>