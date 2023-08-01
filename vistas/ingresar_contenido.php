<?php

	require_once("modelos/proveedores.php");
	require_once("modelos/directores.php");
	require_once("modelos/contenidos.php");

	$mensaje = "";
	$respuesta = "";
	
	$boton = isset($_POST['boton'])?$_POST['boton']:"";
	$objContenidos = new contenidos();

	if($boton == "cancelar"){

		// Aca lo que hacemos es redireccionar a la lista de proveedores
		header( 'Location: sistema.php?r=lista_contenidos');

	}elseif($boton == "ingresar"){

		//Aca en caso de que boton valga igresar lo que hacemos 
		//es ingresar el registro 
		
		$arrayDatos = array();
		
		$arrayDatos['titulo'] = isset($_POST['txtTitulo'])?$_POST['txtTitulo']:"";
		$arrayDatos['descripcion'] = isset($_POST['txtDescripcion'])?$_POST['txtDescripcion']:"";

		if($arrayDatos['titulo'] != "" && $arrayDatos['descripcion'] != ""){
			
			$arrayDatos['anio'] = isset($_POST['numAnio'])?$_POST['numAnio']:"";
			$arrayDatos['idioma'] = isset($_POST['selIdioma'])?$_POST['selIdioma']:"";
			$arrayDatos['pais'] = isset($_POST['selPais'])?$_POST['selPais']:"";
			$arrayDatos['duracion'] = isset($_POST['numDuracion'])?$_POST['numDuracion']:"";
			$arrayDatos['tipoContenido'] = isset($_POST['selTipoContenido'])?$_POST['selTipoContenido']:"";
			$arrayDatos['idDirector'] = isset($_POST['selDirector'])?$_POST['selDirector']:"";
			$arrayDatos['idProveedor'] = isset($_POST['selProveedor'])?$_POST['selProveedor']:"";

			$objContenidos->constructor($arrayDatos);
			$respuesta = $objContenidos->ingresar();

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
<h1>Ingresar Contenidos </h1>

<form method="POST" action="sistema.php?r=ingresar_contenidos">
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
			<input id="titulo" type="text" class="validate" name="txtTitulo">
			<label for="titulo">Titulo</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<textarea id="descripcion" class="materialize-textarea" name="txtDescripcion"></textarea>
			<label for="descripcion">Descripcion</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="anio" type="number" class="validate" name="numAnio" min="1800" max="9999">
			<label for="anio">Año</label>
		</div>
		
		<div class="input-field col s6 offset-s3">
			<select name="selIdioma">
				<option value="" disabled selected>Selecciones una Opcion</option>
<?php
				foreach($objContenidos->listaIdioma as $clave => $idiomas){
?>
					<option value="<?=$clave?>"><?=$idiomas?></option>
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
					<option value="<?=$paises['countryIso']?>"><?=$paises['nombre']?></option>
<?PHP					
				}
?>

			</select>
			<label for="pais">pais</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="duracion" type="number" class="validate" name="numDuracion" min=0 max=999>
			<label for="duracion">duracion</label>
		</div>
		<div class="input-field col s6 offset-s3">
		<select name="selTipoContenido">
				<option value="" disabled selected>Selecciones una Opcion</option>
<?php
				foreach($objContenidos->listaTipoContenidos as $tipoContenido){
?>
					<option value="<?=$tipoContenido?>"><?=$tipoContenido?></option>
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
					<option value="<?=$directores['id']?>"><?=$directores['nombreCompleto']?></option>
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
					<option value="<?=$proveedor['id']?>"><?=$proveedor['nombre']?></option>
<?PHP					
				}
?>

			</select>
			<label for="idProveedor">Proveedor</label>
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