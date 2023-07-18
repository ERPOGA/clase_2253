<?php 


		$formulario = isset($_GET['r'])?$_GET['r']:"";

		if($formulario == "lista_proveedores"){

			include("vistas/lista_proveedores.php");	

		}elseif($formulario == "ingresar_proveedor"){

			include("vistas/ingresar_proveedor.php");	

		}elseif($formulario == "borrar_proveedor"){

			include("vistas/borrar_proveedor.php");	

		}elseif($formulario == "editar_proveedor"){

			include("vistas/editar_proveedor.php");	

		}elseif($formulario == "lista_generos"){

			include("vistas/lista_generos.php");	
		
		}elseif($formulario == "lista_directores"){

			include("vistas/lista_directores.php");	

		}elseif($formulario == "mi_panel"){

				include("vistas/mi_panel.php");	
				
		}else{

			echo("<h1>404 Pagina no existe</h1>");

		}




?>