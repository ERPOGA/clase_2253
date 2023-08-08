<?php

	require_once("modelos/proveedores.php");
	require_once("modelos/directores.php");
	require_once("modelos/contenidos.php");

	$id = isset($_GET['id'])?$_GET['id']:"";



	$mensaje = "";
	$respuesta = "";
	
	$boton = isset($_POST['boton'])?$_POST['boton']:"";
	$objContenidos = new contenidos();

	$objContenidos->cargar($id);

	if($boton == "cancelar"){

		// Aca lo que hacemos es redireccionar a la lista de proveedores
		header( 'Location: sistema.php?r=lista_contenidos');

	}elseif($boton == "editar"){

		//Aca en caso de que boton valga igresar lo que hacemos 
		//es ingresar el registro 
		print_r($_FILES);

		//$respuestaCopy = copy($_FILES['fileImg']['tmp_name'],"web/archivos/".$_FILES['fileImg']['name']);
		//print_r($respuestaCopy);

		$img = $objContenidos->subirImagen($_FILES['fileImg'], 600, 800);

		$arrayDatos = array();
		
		$arrayDatos['titulo'] = isset($_POST['txtTitulo'])?$_POST['txtTitulo']:"";
		$arrayDatos['descripcion'] = isset($_POST['txtDescripcion'])?$_POST['txtDescripcion']:"";
		$arrayDatos['id'] = isset($_POST['id'])?$_POST['id']:"";

		if($arrayDatos['id'] != "" && $arrayDatos['titulo'] != "" && $arrayDatos['descripcion'] != ""){
			
			
			$arrayDatos['anio'] = isset($_POST['numAnio'])?$_POST['numAnio']:"";
			$arrayDatos['idioma'] = isset($_POST['selIdioma'])?$_POST['selIdioma']:"";
			$arrayDatos['pais'] = isset($_POST['selPais'])?$_POST['selPais']:"";
			$arrayDatos['duracion'] = isset($_POST['numDuracion'])?$_POST['numDuracion']:"";
			$arrayDatos['tipoContenido'] = isset($_POST['selTipoContenido'])?$_POST['selTipoContenido']:"";
			$arrayDatos['idDirector'] = isset($_POST['selDirector'])?$_POST['selDirector']:"";
			$arrayDatos['idProveedor'] = isset($_POST['selProveedor'])?$_POST['selProveedor']:"";
			$arrayDatos['imagen'] = $img?$img:"";

			$objContenidos->constructor($arrayDatos);
			$respuesta = $objContenidos->editar();

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

	$listarPaises = $objContenidos->listarPaises();
	$objProveedores = new proveedores();
	$listaProveedores = $objProveedores->listaCorta();
	$objDirectores = new directores();
	$listaDirectores = $objDirectores->listaCorta();
?>
<h1>Editar Contenido Nº:<?=$objContenidos->id?> </h1>

<form method="POST" action="sistema.php?r=editar_contenidos" enctype="multipart/form-data">
	<div class="row">
		
	<?php 
		if($respuesta == true){
	?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
					<a href="sistema.php?r=lista_contenidos" class="btn blue lighten-2">Regresar</a>
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
			<input id="titulo" type="text" class="validate" name="txtTitulo" value="<?=$objContenidos->titulo?>">
			<label for="titulo">Titulo</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<textarea id="descripcion" class="materialize-textarea" name="txtDescripcion"><?=$objContenidos->descripcion?></textarea>
			<label for="descripcion">Descripcion</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="anio" type="number" class="validate" name="numAnio" min="1800" max="9999" value="<?=$objContenidos->anio?>">
			<label for="anio">Año</label>
		</div>
		
		<div class="input-field col s6 offset-s3">
			<select name="selIdioma">
				<option value="" disabled selected>Selecciones una Opcion</option>
<?php
				foreach($objContenidos->listaIdioma as $clave => $idiomas){
?>
					<option value="<?=$clave?>" <?php if($clave == $objContenidos->idioma){echo("selected");}  ?> ><?=$idiomas?></option>
<?PHP					
				}
?>
			</select>
			<label for="idioma">Idioma</label>
		</div>

		<div class="input-field col s6 offset-s3">
			<select name="selPais">
				<option value="" disabled selected>Selecciones un pais</option>
<?php
				foreach($listarPaises as $paises){
?>
					<option value="<?=$paises['countryIso']?>" <?php if($paises['countryIso'] == $objContenidos->pais){echo("selected");}  ?>><?=$paises['nombre']?></option>
<?PHP					
				}
?>

			</select>
			<label for="pais">pais</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="duracion" type="number" class="validate" name="numDuracion" min=0 max=999 value="<?=$objContenidos->duracion?>">
			<label for="duracion">duracion</label>
		</div>
		<div class="input-field col s6 offset-s3">
		<select name="selTipoContenido">
				<option value="" disabled selected>Selecciones una Opcion</option>
<?php
				foreach($objContenidos->listaTipoContenidos as $tipoContenido){
?>
					<option value="<?=$tipoContenido?>"  <?php if($tipoContenido == $objContenidos->tipoContenido){echo("selected");} ?>> <?=$tipoContenido?></option>
<?PHP					
				}
?>
			</select>			
			<label for="tipoContenido">Tipos Contenidos</label>
		</div>
		<div class="input-field col s6 offset-s3">
		<select name="selDirector">
				<option value="" disabled selected>Selecciones un Director</option>
<?php
				foreach($listaDirectores as $directores){
?>
					<option value="<?=$directores['id']?>"  <?php if($directores['id'] == $objContenidos->idDirector){echo("selected");} ?>><?=$directores['nombreCompleto']?></option>
<?PHP					
				}
?>

			</select>			
			<label for="idDirector">Director</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<select name="selProveedor">
				<option value="" disabled selected>Selecciones un proveedor</option>
<?php
				foreach($listaProveedores as $proveedor){
?>
					<option value="<?=$proveedor['id']?>" <?php if($proveedor['id'] == $objContenidos->idProveedor){echo("selected");} ?>><?=$proveedor['nombre']?></option>
<?PHP					
				}
?>

			</select>
			<label for="idProveedor">Proveedor</label>
		</div>
		<div class="file-field input-field col s6 offset-s3">
			<div class="btn blue lighten-1">
				<span>Archivo</span>
				<input type="file" name="fileImg">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>

		<div class="col s6 offset-s3">
			<input type="hidden" name="id" value="<?=$objContenidos->id?>">
			<button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="editar">Ingresar
				<i class="material-icons right">send</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	</div>		
</form>