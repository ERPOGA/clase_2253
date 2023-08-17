<?php

	if(isset($_SESSION['perfil']) && $_SESSION['perfil'] != "adm"){
		header('Location:sistema.php');
	}

?>
<h1>Generos</h1>