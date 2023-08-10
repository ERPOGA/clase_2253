<?php


	if(isset($PARAMETROS['accion']) && $PARAMETROS['accion'] != ""){

		$arrayAccion = explode(":", $PARAMETROS['accion']);

		$arrayParametros = [];
		$arrayParametros['proveedor'] = "proveedores_controlador";
		$arrayParametros['contenido'] = "contenidos_controlador";

		if(isset($arrayParametros[$arrayAccion[0]])){

			require_once("api/controladores/".$arrayParametros[$arrayAccion[0]].".php");
			$objControlador = new $arrayParametros[$arrayAccion[0]]();

			$varMetodo = strval($arrayAccion[1]);
			$respuesta = $objControlador -> $varMetodo($PARAMETROS);

			print_r(json_encode(array("mensaje" => $respuesta)));

		}else{

			print_r(json_encode(array("mensaje" => "No existe controlador")));

		}



	}










?>