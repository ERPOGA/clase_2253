<?php

	require_once("modelos/proveedores.php");

	$mensaje = "";
	$respuesta = "";
	
	$boton = isset($_POST['boton'])?$_POST['boton']:"";
	$id = isset($_GET['id'])?$_GET['id']:"";

	$objProveedor = new proveedores();
	$objProveedor->cargar($id);

	if(isset($_POST['boton']) && $_POST['boton'] == "guardar"
		&& isset($_POST['id']) && $_POST['id'] > 0 
		&& isset($_POST['txtNombre']) && $_POST['txtNombre'] != "" 
		&& isset($_POST['txtDescripcion']) && $_POST['txtDescripcion'] != ""){

		$id = $_POST['id'];
		/*
		$arrayDatos = array(
			"nombre" => $_POST['nombre'],
			"descripcion" => $_POST['descripcion']
		);		
		*/
		$objProveedor->cargar($id);
		//$objProveedor->constructor($arrayDatos);
		$objProveedor->nombre = $_POST['txtNombre'];
		$objProveedor->descripcion = $_POST['txtDescripcion'];
		$respuesta = $objProveedor->editar();

		if($respuesta == true){
			$mensaje = "Se modifico correctamente el registro";
		}else{
			$mensaje = "Error al modificar registro";
		}

	}


	if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
		header("Location: sistema.php?r=lista_proveedores");
	}


?>
<h1>Editar Proveedor N°: <?=$id?> </h1>

<form method="POST" action="sistema.php?r=editar_proveedor">
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
			<input id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objProveedor->nombre?>">
			<label for="nombre">Nombre</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<textarea id="descripcion" class="materialize-textarea" name="txtDescripcion"><?=$objProveedor->descripcion?></textarea>
			<label for="descripcion">Descripcion</label>
		</div>
		<div class="col s6 offset-s3">
			<input type="hidden" name="id" value="<?=$objProveedor->id?>" >
			<button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="guardar">Guardar
				<i class="material-icons right">save</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	</div>		
</form>