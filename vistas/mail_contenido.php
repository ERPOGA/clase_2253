<?php

	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require ('vendor/autoload.php');
	require_once ('modelos/contenidos.php');

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);
	$objContenido = new contenidos();
	$filtro = array("mail" => true);
	$listaContenidos = $objContenido->listar($filtro);

	try{

		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;  
		$mail->isSMTP();     
		$mail->Host       = 'mail.openmulita.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'clase@openmulita.com'; 
		$mail->Password   = 'Clase2253';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
		$mail->Port       = 465;

		//Recipients
		$mail->setFrom('clase@openmulita.com', 'Clase');
		
		$mail->addAddress('damisintesis109@hotmail.com', 'Tu ');     //Add a recipient
		$mail->addCC('dam.delgado.109@gmail.com');
		//$mail->addBCC('bcc@example.com');

		$mail->isHTML(true);    
		$mail->Subject = 'Test de la clase';
		
		$body    = '<h1>Hola!!!!!!!</h1>';
		$body    .= '<h2>Nuestros ultimos Ingresos</h2>';
		$body    .= '<table border="1">';
		foreach($listaContenidos as $contenido){
			$body    .=	'
				<tr>
					<td style="width:150px">
						<div style="width:150px">
							<img src="cid:'.$contenido['img'].'" width="150px"/>
						</div>	
					</td>
					<td>
						<span>'.$contenido['titulo'].'</span>
						<br/>
						<span>'.$contenido['descripcion'].'</span>
					</td>
				</tr>
			';
		}
		$body    .= "</table>";

		foreach($listaContenidos as $contenido){
			$mail->AddEmbeddedImage(
				'web/archivos/'.$contenido['img'],
				$contenido['img'],
				'web/archivos/'.$contenido['img'],
				'base64', 'image/jpeg');			
		}
		//https://openmulita.com/mifotos/'.$contenido['img'].'


		$mail->Body		= $body;
		$mail->AltBody = 'No soy html';
	
		$mail->send();
    	echo 'Se envio el mail correctamente';

	}catch(Exception $e){

		echo $e->getMessage();
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	
	}

?>


<h1>Hola!!!!!!!</h1>
<h2>Nuestros ultimos Ingresos</h2>
<table border="1">
<?php 
	foreach($listaContenidos as $contenido){
?>		
	<tr>
		<td width = "120px">
			<img src="web/archivos/<?=$contenido['img']?>" width="100px"/>
		</td>
		<td>
			<span><?=$contenido['titulo']?></span>
			<br/>
			<span><?=$contenido['descripcion']?></span>
		</td>
	</tr>
<?php
	}
?>
</table>