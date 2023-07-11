<?php

	require_once("modelos/proveedores.php");

	$objProveedores = new proveedores();

	

	/*
	Pagina 1 = 1,2,3,4,5   (LIMIT 0,5)
 	Pagina 2 = 6,7,8,9,10  (LIMIT 5,5)
	Pagina 3 = 11,12,13,14,15 (LIMIT 10,5)
	Pagina 4 = 16,17  (LIMIT 15,5)

	(1-1) * 5 = 0
	(2-1) * 5 = 5
	(3-1) * 5 = 10
	(4-1) * 5 = 15
	*/

	$cantidad = isset($_GET['cantidad'])?$_GET['cantidad']:3;
	$pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

	$totalRegistros = $objProveedores->totalRegistros();

	// Pagina Anterior va a ser igua al maximo entre la pagina actual menos 1 y 1
	$paginaAnterior = max(($pagina - 1), 1);
	/*
	$paginaAnterior = $pagina - 1;
	if($paginaAnterior < 1){
		$paginaAnterior = 1;
	}
	*/

	$totalPagina = ceil($totalRegistros/$cantidad);
	
	// Pagina siguente va a ser el menor numero entre la pagina actual + 1 y el total de maximo de paginas
	$paginaSiguente = min( ($pagina + 1) , $totalPagina);

	/*
	$paginaSiguente = $pagina + 1;
	if($paginaSiguente > $totalPagina){
		$paginaSiguente = $totalPagina;
	}
	*/

	$arrayFiltros = array();
	$arrayFiltros['inicio'] = ($pagina - 1) * $cantidad;
	$arrayFiltros['cantidad'] = $cantidad;

	$listaProveedores = $objProveedores->listar($arrayFiltros);

	
?>
<h1>Proveedores pagina N°: <?=$pagina?>/<?=$totalPagina?>, total registro:<?=$totalRegistros?> </h1>

<table class="striped">
	<thead>
		<tr>
			<th colspan="4">
				<a href="sistema.php?r=ingresar_proveedor" class="btn blue lighten-2 right">
					<i class="material-icons">add</i> Nuevo
				</a>
			</th>
		</tr>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th style="width:150px"></th>
		</tr>
	</thead>

	<tbody>

<?php  foreach($listaProveedores as $proveedor){ ?>

		<tr>
			<td><?=$proveedor['id']?></td>
			<td class="truncate" style="max-width:200px"><?=$proveedor['nombre']?></td>
			<td ><?=$proveedor['descripcion']?></td>
			<td>
				<a href="sistema.php?r=editar_proveedor&id=<?=$proveedor['id']?>" class="btn btn-floating blue lighten-2">
					<i class="material-icons">edit</i>
				</a>
				<a href="sistema.php?r=borrar_proveedor&id=<?=$proveedor['id']?>" class="btn btn-floating red">
					<i class="material-icons">delete</i>
				</a>
			</td>
		</tr>

<?php  } ?>
		<tr>
			<td colspan="4">
				<ul class="pagination center-align">
					<li class="waves-effect">
						<a href="sistema.php?r=lista_proveedores&pagina=1">
							<i class="material-icons">fast_rewind</i>
						</a>
					</li>
					<li class="waves-effect">
						<a href="sistema.php?r=lista_proveedores&pagina=<?=$paginaAnterior?>">
							<i class="material-icons">chevron_left</i>
						</a>
					</li>
					<!-- 
					<li class="active">
						<a href="sistema.php?r=lista_proveedores&pagina=1">1</a>
					</li>
					-->
<?php
					for($i = ($pagina-2); $i <= ($pagina+2); $i++ ){

						/*
							Reviso si $i es menos < 1 o $i es mayor al total de pagina
						*/
						if($i < 1 || $i > $totalPagina){
							/*
								En caso que se cumpla una de las 2 condicion lo que hacemos es 
								omitir el resto del codigo con el comando continue,
							*/
							continue;
						}
						$color = "waves-effect";
						if($i == $pagina){
							$color = "active";
						}
?>
					<li class="<?=$color?>">
						<a href="sistema.php?r=lista_proveedores&pagina=<?=$i?>"><?=$i?></a>
					</li>
<?php
					}
?>
					
					<li class="waves-effect">
						<a href="sistema.php?r=lista_proveedores&pagina=<?=$paginaSiguente?>">
							<i class="material-icons">chevron_right</i>
						</a>
					</li>
					<li class="waves-effect">
						<a href="sistema.php?r=lista_proveedores&pagina=<?=$totalPagina?>">
							<i class="material-icons">fast_forward</i>
						</a>
					</li>
				</ul>
			</td>	
		</tr>

	</tbody>
</table>