<?php

	require_once("modelos/contenidos.php");

	class contenidos_controlador {


		public function listar($arrayFiltros){


			$objProveedores = new contenidos();
			$arrayDatos = array();
							
			$retorno = $objProveedores->listar();

			return $retorno;

		}


	}



?>