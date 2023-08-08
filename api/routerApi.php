<?php


	if(isset($PARAMETROS['accion']) && $PARAMETROS['accion'] != ""){

		$arrayAccion = explode(":", $PARAMETROS['accion']);

		print_r($arrayAccion);

		$arrayParametros = [];
		$arrayParametros['proveedor'] = "proveedores_controlador";


		if(isset($arrayParametros[$arrayAccion[0]])){

			require_once("api/controladores/".$arrayParametros[$arrayAccion[0]].".php");
			$objControlador = new $arrayParametros[$arrayAccion[0]]();

			$varMetodo = strval($arrayAccion[1]);
			$respuesta = $objControlador -> $varMetodo($PARAMETROS);

			var_dump($respuesta);

		}



	}










?>