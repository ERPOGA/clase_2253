<?php

	require_once("comandos/controladores/controlador_generico.php");
	require_once("modelos/proveedores.php");

	class controlador_altaProveedores extends controlador_generico{

		public $totalModificados;

		public function procesar(){
			
			$this->horaInicio = date("Y-m-d H:i:s");

			$objProveedores = new proveedores();

			$arrayFiltro = array("estado"=>0);
			$listaProveedores = $objProveedores->listar($arrayFiltro);
			$inProveedores = array();
			foreach($listaProveedores as $proveedores){

				$inProveedores[] = $proveedores['id'];


			}
			$this->totalModificados = count($inProveedores);
			$strProveedores = implode(",",$inProveedores);
			//print_r($strProveedores);
			// Valido que la lista strProveedores tenga algo
			if($strProveedores != ""){
				$respuesta = $objProveedores->altas($strProveedores);
			}
			sleep(3);
			$this->horaFin = date("Y-m-d H:i:s");

		}

		public function resultados(){

			print_r("\nHora de inicio:".$this->horaInicio);
			print_r("\nSe modificaron ".$this->totalModificados." registros");
			print_r("\nHora Fin:".$this->horaFin);
	
		}




	}



?>