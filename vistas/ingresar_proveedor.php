<?php

	require_once("modelos/proveedores.php");

	$mensaje = "";
	$respuesta = "";
	
	$boton = isset($_POST['boton'])?$_POST['boton']:"";

	if($boton == "cancelar"){

		// Aca lo que hacemos es redireccionar a la lista de proveedores
		header( 'Location: sistema.php?r=lista_proveedores');

	}elseif($boton == "ingresar"){

		//Aca en caso de que boton valga igresar lo que hacemos 
		//es ingresar el registro 
		$objProveedores = new proveedores();
		$arrayDatos = array();
		
		$arrayDatos['nombre'] = isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
		$arrayDatos['descripcion'] = isset($_POST['txtDescripcion'])?$_POST['txtDescripcion']:"";

		if($arrayDatos['nombre'] != "" && $arrayDatos['descripcion'] != ""){
			
			$objProveedores->constructor($arrayDatos);
			$respuesta = $objProveedores->ingresar();

			if($respuesta == true){
				$mensaje = "Se ingreso correctamente el registro";
			}else{
				$mensaje = "Error al ingresar registro";
			}

		}else{

			$mensaje = "Por favor llenar todos los campos";
			$respuesta = false;
		}
		
	}


?>
<h1>Ingresar Proveedores </h1>

<form method="POST" action="sistema.php?r=ingresar_proveedor">
	<div class="row">
		
	<?php 
		if($respuesta == true){
	?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
					<a href="sistema.php?r=lista_proveedores" class="btn blue lighten-2">Regresar</a>
				</div>				
			</div>
	<?php
		}elseif($respuesta == false && $mensaje != ""){
	?>		
			<div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
				</div>				
			</div>
	<?php
		}
	?>


		<div class="input-field col s6 offset-s3">
			<input id="nombre" type="text" class="validate" name="txtNombre">
			<label for="nombre">Nombre</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<textarea id="descripcion" class="materialize-textarea" name="txtDescripcion"></textarea>
			<label for="descripcion">Descripcion</label>
		</div>
		<div class="col s6 offset-s3">
			<button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="ingresar">Ingresar
				<i class="material-icons right">send</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	</div>		
</form>