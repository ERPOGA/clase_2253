<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');
header('content-type: application/json; charset=utf-8');

$PARAMETROS = json_decode(file_get_contents('php://input'), true);

include("api/routerApi.php");


// txtNombre=Disney&txtDescripcion=El+conglomerado+mas+grande+del+mundo+con+el+raton+mikey+mause&id=1&boton=guardar
/*
	{
		"txtNombre":"Disney",
		"txtDescripcion":"El conglomerado mas grande del mundo con el raton mikey mause",
		"accion":"proveedor:ingresar"
	}

*/

?>