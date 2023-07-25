<?php

	$nuevaClave = trim("aBcD123@");
	
	$resultado = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $nuevaClave);
	
	//print_r("<h3>".$nuevaClave."<h3>");

	/*
	// Validacion casera de clave
	$largoClave = strlen($nuevaClave);
	$resultado1 = preg_match('/[A-Z]/', $nuevaClave);
	$resultado2 = preg_match('/[a-z]/', $nuevaClave);
	$resultado3 = preg_match('/[0-9]/', $nuevaClave);
	$resultado4 = preg_match('/[^a-zA-Z0-9]/', $nuevaClave);
		//$resultado = preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', $nuevaClave);
	//$resultado = preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $nuevaClave);
	
	//print_r("<h3>".$resultado1."-".$resultado2."-".$resultado3."-".$resultado4."<h3>");
	*/

	
	var_dump($resultado);
	
	require_once("modelos/administradores.php");

	$mensaje = "";
	$respuesta = "";

	$boton = isset($_POST['boton'])?$_POST['boton']:"";
	$id = isset($_SESSION['id'])?$_SESSION['id']:"";

	$objAdministrador = new administradores();
	$objAdministrador->cargar($id);

	if($boton == "guardar" && $id != "" 	
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

	$clave = isset($_POST['txtClave'])?$_POST['txtClave']:"";
	$nuevaClave = isset($_POST['txtNuevaClave'])?$_POST['txtNuevaClave']:"";
	$confirmarClave = isset($_POST['txtConfirmarClave'])?$_POST['txtConfirmarClave']:"";

	if($boton == "clave" && $id != "" && $clave != "" && $nuevaClave != "" && $confirmarClave != ""){
	
		$respuesta = $objAdministrador->cambiarClave($clave, $nuevaClave, $confirmarClave);

		if($respuesta === true){
			$mensaje = "Se modifico correctamente el registro";
		}else{
			$mensaje = $respuesta;
			$respuesta = false;
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
		if($respuesta == true && $boton == "guardar"){
	?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
					<a href="sistema.php?r=lista_proveedores" class="btn blue lighten-2">Regresar</a>
				</div>				
			</div>
	<?php
		}elseif(($respuesta == false && $mensaje != "") && $boton == "guardar"){

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
<h1>Cambio de clave</h1>
<form method="POST" action="sistema.php?r=mi_panel">
	<div class="row">
		
	<?php 
		if($respuesta == true && $boton == "clave"){
	?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
					<a href="sistema.php?r=lista_proveedores" class="btn blue lighten-2">Regresar</a>
				</div>				
			</div>
	<?php
		}elseif(($respuesta == false && $mensaje != "") && $boton == "clave"){
			$altura = "100px";
			if(strlen($mensaje)> 70){
				$altura = "200px";
			}
	?>		
			<div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: <?=$altura?>; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
				</div>				
			</div>
	<?php
		}
	?>
		<div class="input-field col s6 offset-s3">
			<input id="clave" type="password" class="validate" name="txtClave" value="">
			<label for="clave">Clave</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="nuevaClave" type="password" class="validate" name="txtNuevaClave" value="">
			<label for="nuevaClave">Nueva Clave</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="confirmarClave" type="password" class="validate" name="txtConfirmarClave" value="">
			<label for="confirmarClave">Confiramar Clave</label>
		</div>		
		<div class="col s6 offset-s3">
			<button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="clave">Guardar
				<i class="material-icons right">save</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	</div>		
</form>