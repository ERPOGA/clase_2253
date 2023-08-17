<?php

require_once("modelos/generico.php");

class contenidos extends generico{

	public $titulo;

	public $descripcion;

	public $anio;

	public $idioma;

	public $pais;

	public $duracion;

	public $tipoContenido;

	public $idDirector;

	public $idProveedor;

	public $estado;

	public $imagen;

	protected $tabla = "contenidos";

	public $listaIdioma = [
		"ES_ES" => "Español España",
		"ES_LA" => "Español Latinoamerica",
		"EN_US" => "Ingles USA",
		"EN_UK" => "Ingles Reino Unido",
		"FR_FR" => "Frances",
		"PT_PO" => "Portugues Portugal",
		"PT_BR" => "Portugues Brasil"
	];

	public $listaTipoContenidos = ['Peliculas','Series','Video Clip'];


	public function constructor($arrayDatos = array()){

		$this->id 			= isset($arrayDatos['id'])?$arrayDatos['id']:"";
		$this->titulo 		= $arrayDatos['titulo'];
		$this->descripcion 	= $arrayDatos['descripcion'];
		$this->anio 		= $arrayDatos['anio'];		
		$this->idioma 		= $arrayDatos['idioma'];
		$this->pais 		= $arrayDatos['pais'];
		$this->duracion 	= $arrayDatos['duracion'];
		$this->tipoContenido = $arrayDatos['tipoContenido'];
		$this->idDirector 	= $arrayDatos['idDirector'];
		$this->idProveedor	= $arrayDatos['idProveedor'];
		$this->imagen		= $arrayDatos['imagen'];

	}

	public function cargar($id){

		$sql = "SELECT * FROM contenidos WHERE id = :id ";
		$arraySQL = array("id" => $id);
	
		$lista = $this->traerRegistros($sql, $arraySQL);

		if(isset($lista[0]['id'])){

			$this->id 			= $lista[0]['id'];
			$this->titulo 		= $lista[0]['titulo'];
			$this->descripcion 	= $lista[0]['descripcion'];
			$this->anio 		= $lista[0]['anio'];		
			$this->idioma 		= $lista[0]['idioma'];
			$this->pais 		= $lista[0]['pais'];
			$this->duracion 	= $lista[0]['duracion'];
			$this->tipoContenido = $lista[0]['tipo_contenido'];
			$this->idDirector 	= $lista[0]['id_director'];
			$this->idProveedor	= $lista[0]['id_proveedor'];
			$this->imagen		= $lista[0]['img'];

			$retorno = true;

		}else{

			$retorno = false;

		}
		return $retorno;

	}


	public function ingresar(){
		/*
			En este metodo se encarga de ingresar los regisros
		*/		
	
		$sql = "INSERT contenidos SET
					titulo 		= :titulo,
					descripcion = :descripcion,
					anio 		= :anio,
					idioma 		= :idioma,
					pais 		= :pais,
					duracion 	= :duracion,
					tipo_contenido = :tipoContenido,
					id_director = :idDirector,
					id_proveedor= :idProveedor,
					img			= :imagen,
					estado 		= 1;
				";
		$arrayDatos = array(
			"titulo" 		=> $this->titulo,
			"descripcion" 	=> $this->descripcion,
			"anio" 			=> $this->anio,
			"idioma" 		=> $this->idioma,
			"pais" 			=> $this->pais,
			"duracion" 		=> $this->duracion,
			"tipoContenido" => $this->tipoContenido,
			"idDirector" 	=> $this->idDirector,
			"idProveedor" 	=> $this->idProveedor,
			"imagen" 		=> $this->imagen,
		);
		
		$respuesta = $this->ejecutar($sql, $arrayDatos);

		return $respuesta;

	}


	public function editar(){
		/*
			En este metodo se encarga de ingresar los regisros
		*/		
	
		$sql = "UPDATE contenidos SET
					titulo 		= :titulo,
					descripcion = :descripcion,
					anio 		= :anio,
					idioma 		= :idioma,
					pais 		= :pais,
					duracion 	= :duracion,
					tipo_contenido = :tipoContenido,
					id_director = :idDirector,
					id_proveedor= :idProveedor";

		if($this->imagen){
			$sql .= " ,img = '$this->imagen' ";
		}
		$sql .=	" WHERE id = :id; ";

		$arrayDatos = array(
			"titulo" 		=> $this->titulo,
			"descripcion" 	=> $this->descripcion,
			"anio" 			=> $this->anio,
			"idioma" 		=> $this->idioma,
			"paiss" 			=> $this->pais,
			"duracion" 		=> $this->duracion,
			"tipoContenido" => $this->tipoContenido,
			"idDirector" 	=> $this->idDirector,
			"idProveedor" 	=> $this->idProveedor,
			"id"			=> $this->id
		);
		
		print_r($arrayDatos);

		$respuesta = $this->ejecutar($sql, $arrayDatos);

		return $respuesta;

	}

	public function listar($filtro = array()){
		/*
			Este metodo se encarga de retornar una lista de registro de la base de datos
		*/
		$estado = isset($filtro['estado'])?$filtro['estado']:"1";	

		$sql = "SELECT 
						c.id,
						c.titulo,
						c.descripcion,
						c.anio,
						c.idioma,
						c.pais,
						c.duracion,
						c.tipo_contenido,
						c.id_director,
						CONCAT(d.nombre,' ',d.apellido) AS nombreDirector,  
						c.id_proveedor,
						p.nombre AS nombreProveedor,
						c.img,
						c.estado 
					FROM contenidos c
					INNER JOIN directores d ON d.id = c.id_director
					INNER JOIN proveedores p ON p.id = c.id_proveedor 
					WHERE c.estado = :estado ";
		

		if(isset($filtro['mail']) && $filtro['mail'] != ""){
			// Este filtro es para el envio de mail
			$sql .=" ORDER BY id DESC LIMIT 3";
		}else{
			$sql .=" ORDER BY id";
			if(isset($filtro['inicio']) && isset($filtro['cantidad'])){
				$sql .= " LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";
			}
	
		}
			
					
		$arraySQL = array("estado" => $estado);

		$lista = $this->traerRegistros($sql, $arraySQL);

		return $lista;

	}

	public function totalRegistros(){

		$sql = "SELECT count(*) as total FROM ".$this->tabla." WHERE estado = 1";
		$lista = $this->traerRegistros($sql);
		if(isset($lista[0]['total'])){
			$retorno = $lista[0]['total'];		
		}else{
			$retorno = 0;		
		}
		return $retorno;

	}


}






?>
