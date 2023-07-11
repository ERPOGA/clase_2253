<?php

	//http://localhost/clase_2253/proyecto_git/sistema.php?r=borrar_proveedor&id=7

	require_once("modelos/proveedores.php");

	$mensaje = "";
	$respuesta = "";
	
	if(isset($_POST['id']) && $_POST['id'] > 0 && isset($_POST['boton']) && $_POST['boton'] == "borrar"){

		$id = $_POST['id'];
		$objProveedores = new proveedores();
		$existe = $objProveedores->cargar($id);
		if($existe){

			$respuesta = $objProveedores->borrar();

			if($respuesta){

				$mensaje = "El registro se borro correctamete";

			}else{

				$mensaje = "Error no se puedo borrar el registro";
			
			}	
		}else{
			// Entramos aca por que el registro no existe
			$respuesta = false;
			$mensaje = "No existe ese registro";
			
		}

	}else{

		$id = isset($_GET['id'])?$_GET['id']:"";

	}

	if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
		header("Location: sistema.php?r=lista_proveedores");
	}


?>
<h1>Borrar Proveedores </h1>

<form method="POST" action="sistema.php?r=borrar_proveedor">
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
				<a href="sistema.php?r=lista_proveedores" class="btn red lighten-2">Regresar</a>
			</div>
	<?php
		}else{
	?>
		<div class="col s6 offset-s3">
			<h3>Esta seguro que desea borrar el registro Nº: <?=$id?></h3>
		</div>
		<div class="col s6 offset-s3">
			<input type="hidden" name="id" value="<?=$id?>">
			<button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="borrar">Borrar
				<i class="material-icons right">send</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	<?php
		}
	?>
	</div>		
</form>