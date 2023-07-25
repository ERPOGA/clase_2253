
<?php

class controlador_generico{

	protected $horaInicio;

	protected $horaFin;


	public function __construct($arrayDatos = array()){
				
	}
	
	public function procesar(){

		$this->horaInicio = date("Y-m-d H:i:s");

		sleep(5);

		$this->horaFin = date("Y-m-d H:i:s");
		
	}

	public function resultados(){

		print_r("\nHora de inicio:".$this->horaInicio);
		print_r("\nHora Fin:".$this->horaFin);

	}


}

?>