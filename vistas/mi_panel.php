<?php

	require_once("modelos/administradores.php");

	$mensaje = "";
	$respuesta = "";

	$boton = isset($_POST['boton'])?$_POST['boton']:"";
	$id = isset($_SESSION['id'])?$_SESSION['id']:"";

	$objAdministrador = new administradores();
	$objAdministrador->cargar($id);

	if(isset($_POST['boton']) && $_POST['boton'] == "guardar"

		&& $id != "" 
		&& isset($_POST['txtNombre']) && $_POST['txtNombre'] != "" 
		&& isset($_POST['txtMail']) && $_POST['txtMail'] != ""){
	
		$objAdministrador->nombre 	= $_POST['txtNombre'];
		$objAdministrador->mail 	= $_POST['txtMail'];
		$respuesta = $objAdministrador->editar();

		if($respuesta == true){
			$mensaje = "Se modifico correctamente el registro";
		}else{
			$mensaje = "Error al modificar registro";
		}

	}


	if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
		header("Location: sistema.php");
	}


?>
<h1>Editar Perfil</h1>

<form method="POST" action="sistema.php?r=mi_panel">
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
			<input id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objAdministrador->nombre?>">
			<label for="nombre">Nombre</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="mail" type="text" class="validate" name="txtMail" value="<?=$objAdministrador->mail?>">
			<label for="mail">Mail</label>
		</div>
		<div class="col s6 offset-s3">
			<button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="guardar">Guardar
				<i class="material-icons right">save</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	</div>		
</form>