<?php

	require_once("modelos/proveedores.php");

	$objProveedores = new proveedores();


	$listaProveedores = $objProveedores->listar();

	
?>
<h1>Proveedores</h1>

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
			<th></th>
		</tr>
	</thead>

	<tbody>

<?php  foreach($listaProveedores as $proveedor){ ?>

		<tr>
			<td><?=$proveedor['id']?></td>
			<td><?=$proveedor['nombre']?></td>
			<td><?=$proveedor['descripcion']?></td>
			<td>
				<a class="btn btn-floating blue lighten-2">
					<i class="material-icons">edit</i>
				</a>
				<a class="btn btn-floating red">
					<i class="material-icons">delete</i>
				</a>
			</td>
		</tr>

<?php  } ?>

	</tbody>
</table>