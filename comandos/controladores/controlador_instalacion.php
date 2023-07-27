<?PHP	

	require_once("comandos/controladores/controlador_generico.php");
	require_once("modelos/generico.php");


	class controlador_instalacion extends controlador_generico{

		protected $llave = true; //false 

		public function procesar(){

			$this->horaInicio = date("Y-m-d H:i:s");
			$arrayTabla = array();

			$arrayTabla[] ="
					SET FOREIGN_KEY_CHECKS = 0;
					DROP TABLE IF EXISTS administradores;
					DROP TABLE IF EXISTS proveedores;
					DROP TABLE IF EXISTS generos;
					DROP TABLE IF EXISTS directores;
					DROP TABLE IF EXISTS contenidos;
					DROP TABLE IF EXISTS contenidos_generos;
					DROP TABLE IF EXISTS imagenes;
					SET FOREIGN_KEY_CHECKS = 1;
			"; 

			$arrayTabla[] = "CREATE TABLE `administradores` (
								`id` int(3) NOT NULL AUTO_INCREMENT,
								`nombre` varchar(100) NOT NULL,
								`email` varchar(200) NOT NULL,
								`clave` varchar(100) NOT NULL,
								`estado` char(1) DEFAULT NULL,
								PRIMARY KEY (`id`)
							) ";

			$arrayTabla[] = "CREATE TABLE `proveedores` (
								`id` smallint(3) NOT NULL AUTO_INCREMENT,
								`nombre` varchar(100) NOT NULL,
								`descripcion` text,
								`estado` char(1) DEFAULT NULL,
								PRIMARY KEY (`id`)
							) ";

			$arrayTabla[] = "CREATE TABLE `generos` (
								`id` int(4) NOT NULL AUTO_INCREMENT,
								`nombre` varchar(100) DEFAULT NULL,
								`descripcion` text,
								`estado` char(1) DEFAULT NULL,
								PRIMARY KEY (`id`)
							)";

			$arrayTabla[] = "CREATE TABLE `directores` (
								`id` int(10) NOT NULL AUTO_INCREMENT,
								`nombre` varchar(20) NOT NULL,
								`apellido` varchar(30) DEFAULT NULL,
								`fecha_nacimiento` date DEFAULT NULL,
								`pais` char(2) DEFAULT NULL,
								`estado` char(1) DEFAULT NULL,
								PRIMARY KEY (`id`)
							)";	

			$arrayTabla[] = "CREATE TABLE `contenidos` (
								`id` int(50) NOT NULL AUTO_INCREMENT,
								`titulo` varchar(100) NOT NULL,
								`descripcion` mediumtext,
								`anio` year(4) DEFAULT NULL,
								`idioma` char(5) DEFAULT NULL,
								`pais` char(2) DEFAULT NULL,
								`duracion` smallint(3) DEFAULT NULL,
								`tipo_contenido` enum('Peliculas','Series','Video Clip') DEFAULT NULL,
								`id_director` int(10) NOT NULL,
								`id_proveedor` smallint(3) DEFAULT NULL,
								`estado` char(1) DEFAULT NULL,
								PRIMARY KEY (`id`),
								KEY `id_director` (`id_director`),
								KEY `id_proveedor` (`id_proveedor`),
								CONSTRAINT `fk_id_director` FOREIGN KEY (`id_director`) REFERENCES `directores` (`id`),
								CONSTRAINT `fk_id_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id`)
							) ";

			$arrayTabla[] = "CREATE TABLE `contenidos_generos` (
								`id` int(100) NOT NULL AUTO_INCREMENT,
								`id_contenido` int(50) NOT NULL,
								`id_genero` int(50) NOT NULL,
								`estado` char(1) DEFAULT NULL,
								PRIMARY KEY (`id`),
								KEY `id_contenido` (`id_contenido`),
								KEY `id_genero` (`id_genero`),
								CONSTRAINT `fk_id_contenidogen` FOREIGN KEY (`id_contenido`) REFERENCES `contenidos` (`id`),
								CONSTRAINT `fk_id_generocont` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`)
							)";
							
			$arrayTabla[] = "CREATE TABLE `imagenes` (
									`id` int(100) NOT NULL AUTO_INCREMENT,
									`id_contenido` int(50) NOT NULL,
									`tipo_imagen` tinyint(3) DEFAULT NULL,
									`descripcion` text,
									`estado` char(1) DEFAULT NULL,
									PRIMARY KEY (`id`),
									KEY `id_contenido` (`id_contenido`),
									CONSTRAINT `fk_id_contenido` FOREIGN KEY (`id_contenido`) REFERENCES `contenidos` (`id`)
								) ";
								
			$arrayTabla[] = "INSERT INTO `administradores` VALUES (1,'admin','admin@mail.com','21232f297a57a5a743894a0e4a801fc3','1');";

			$arrayTabla[] = "INSERT INTO `proveedores` VALUES (1,'Disney','El conglomerado mas grande del mundo con el raton mikey mause','1'),
								(2,'Sony','Empresa japonesa Y china','1'),
								(3,'HBO','Empresa de contenidos','1'),
								(4,'Paramount','Proveedor de peliculas','1'),
								(5,'Universal ','Proveedor mas antiguo de todos','1'),
								(6,'Test','Preovvedor','1'),
								(7,'CineAsia','Es cine para asiaticos','1'),
								(8,'Test','Preovvedor','1'),
								(9,'aaaaaaaaaaaaaaassssssssssssssssssssssrrrrrrrrrrrrrrrrr3333333333333333333333444444444444444','ddddddd','1'),
								(10,'CineEspaÃ±a','Proveedor para cine europeo independiente','1'),
								(11,'Nuevo','Es el proveedor mas nuevo','1'),
								(12,'dsadsadsad','asdsadsadsadsa','1'),
								(13,'Prueba hoy','Es un proveedor de prueba que ingreso hoy','1'),
								(14,'Nuevo','Es el proveedor mas nuevo','1'),
								(15,'Test Hoy','Es el proveedor mas nuevo','1'),
								(16,'new pro','new proveedor','1'),
								(17,'Test clase','es para demostrar','1'),
								(18,'Soy 19','Es el registro 19','1'),
								(19,'Regitro 18','Es el registro 18','1'),
								(20,'Soy el ultimo','Es el ultimo por el momento','1'),
								(21,'Nueva pagina','Es tes de nueva pagina','1'),
								(22,'Para pagina 9 ','Este es un registro mas','1');";


			$objGenerico = new generico();
			foreach($arrayTabla as $tabla){

				if($this->llave === true){
					$respuesta = $objGenerico->ejecutar($tabla);
					var_dump($respuesta);
				}else{
					print_r("\n La llave esta en false");
				}
				sleep("2");

			}		

			$this->horaFin = date("Y-m-d H:i:s");
		}


	}




?>